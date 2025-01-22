<?php

namespace App\Filament\Widgets;

use App\Models\ImageDetectionLog;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class AccuracyStatsWidget extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        $accuracyStats = ImageDetectionLog::selectRaw('
            COUNT(*) as total_predictions,
            SUM(CASE WHEN confidence >= 80 THEN 1 ELSE 0 END) as high_confidence,
            AVG(confidence) as avg_confidence,
            MIN(confidence) as min_confidence,
            MAX(confidence) as max_confidence
        ')->first();

        $chartData = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::now()->subDays($daysAgo);
            return ImageDetectionLog::whereDate('created_at', $date)
                ->avg('confidence') ?? 0;
        })->toArray();

        $successRateChart = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::now()->subDays($daysAgo);
            $total = ImageDetectionLog::whereDate('created_at', $date)->count();
            $success = ImageDetectionLog::whereDate('created_at', $date)
                ->where('confidence', '>=', 80)
                ->count();
            return $total > 0 ? ($success / $total) * 100 : 0;
        })->toArray();

        $successRate = $accuracyStats->total_predictions > 0
            ? ($accuracyStats->high_confidence / $accuracyStats->total_predictions) * 100
            : 0;

        return [
            Stat::make('Rata-rata Akurasi', number_format($accuracyStats->avg_confidence ?? 0, 1) . '%')
                ->description('Dari semua prediksi')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->chart($chartData)
                ->color('warning'),
            
            Stat::make('Tingkat Keberhasilan', number_format($successRate, 1) . '%')
                ->description('Prediksi di atas 80%')
                ->descriptionIcon('heroicon-m-check-circle')
                ->chart($successRateChart)
                ->color('success'),
                
            Stat::make('Range Akurasi', sprintf(
                "%s - %s",
                number_format($accuracyStats->min_confidence ?? 0, 1) . '%',
                number_format($accuracyStats->max_confidence ?? 0, 1) . '%'
            ))
                ->description('Min - Max confidence')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([
                    $accuracyStats->min_confidence ?? 0,
                    $accuracyStats->avg_confidence ?? 0,
                    $accuracyStats->max_confidence ?? 0,
                ])
                ->color('info'),
        ];
    }
}