<?php

namespace App\Filament\Widgets;

use App\Models\ImageDetectionLog;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class ImageDetectionStats extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        $totalDetections = ImageDetectionLog::count();
        $successfulDetections = ImageDetectionLog::where('status', 'success')->count();
        $successRate = $totalDetections > 0 
            ? round(($successfulDetections / $totalDetections) * 100, 1)
            : 0;

        $lastWeekData = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::now()->subDays($daysAgo)->format('Y-m-d');
            return ImageDetectionLog::whereDate('created_at', $date)->count();
        })->toArray();

        $successData = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::now()->subDays($daysAgo)->format('Y-m-d');
            return ImageDetectionLog::whereDate('created_at', $date)
                ->where('status', 'success')
                ->count();
        })->toArray();

        $totalHariIni = ImageDetectionLog::whereDate('created_at', today())->count();
        $successHariIni = ImageDetectionLog::whereDate('created_at', today())
            ->where('status', 'success')
            ->count();
        
        return [
            Stat::make('Total Deteksi', $totalDetections)
                ->description("Rate keberhasilan: {$successRate}%")
                ->descriptionIcon('heroicon-m-camera')
                ->chart($lastWeekData)
                ->color('primary'),
            
            Stat::make('Deteksi Berhasil', $successfulDetections)
                ->description("{$successfulDetections} dari {$totalDetections}")
                ->descriptionIcon('heroicon-m-check-circle')
                ->chart($successData)
                ->color('success'),
            
            Stat::make('Hari Ini', $totalHariIni)
                ->description("{$successHariIni} berhasil dari {$totalHariIni}")
                ->descriptionIcon('heroicon-m-calendar')
                ->chart([
                    ImageDetectionLog::whereTime('created_at', '<=', now()->format('H:i:s'))
                        ->whereDate('created_at', today())
                        ->count(),
                    $totalHariIni
                ])
                ->color('info'),
        ];
    }
}