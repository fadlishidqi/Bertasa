<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ImageDetectionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'prediction_result',
        'confidence',
        'status',
        'ip_address',
        'error_message',
    ];

    protected $casts = [
        'confidence' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Accessors
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('d M Y H:i');
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }

    public function getConfidenceFormattedAttribute()
    {
        return $this->confidence ? number_format($this->confidence, 1) . '%' : '-';
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'success' => 'success',
            'failed' => 'danger',
            default => 'primary',
        };
    }

    // Scopes
    public function scopeSuccess($query)
    {
        return $query->where('status', 'success');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopeDateBetween($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
    }

    public function scopeHighConfidence($query, $threshold = 80.0)
    {
        return $query->where('confidence', '>=', $threshold);
    }

    public function scopeLowConfidence($query, $threshold = 80.0)
    {
        return $query->where('confidence', '<', $threshold);
    }

    // Methods
    public static function getStatistics()
    {
        $total = self::count();
        $success = self::success()->count();
        $failed = self::failed()->count();
        $averageConfidence = self::whereNotNull('confidence')->avg('confidence');

        return [
            'total' => $total,
            'success' => $success,
            'failed' => $failed,
            'success_rate' => $total > 0 ? round(($success / $total) * 100, 1) : 0,
            'average_confidence' => round($averageConfidence ?? 0, 1),
            'today' => self::today()->count(),
            'today_success' => self::today()->success()->count(),
            'high_confidence' => self::highConfidence()->count(),
            'low_confidence' => self::lowConfidence()->count(),
        ];
    }

    public static function getChartData($days = 7)
    {
        return collect(range($days - 1, 0))->map(function ($daysAgo) {
            $date = Carbon::now()->subDays($daysAgo);
            return [
                'date' => $date->format('d M'),
                'total' => self::whereDate('created_at', $date)->count(),
                'success' => self::whereDate('created_at', $date)->success()->count(),
                'failed' => self::whereDate('created_at', $date)->failed()->count(),
                'avg_confidence' => round(self::whereDate('created_at', $date)
                    ->whereNotNull('confidence')
                    ->avg('confidence') ?? 0, 1),
            ];
        });
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (isset($model->confidence)) {
                $model->status = $model->confidence >= 80.0 ? 'success' : 'failed';
            }
        });
    }
}