<?php

namespace App\Filament\Resources\ImageDetectionLogResource\Pages;

use App\Filament\Resources\ImageDetectionLogResource;
use App\Filament\Widgets\AccuracyStatsWidget;
use App\Filament\Widgets\ImageDetectionStats;
use Filament\Resources\Pages\ListRecords;

class ListImageDetectionLogs extends ListRecords
{
    protected static string $resource = ImageDetectionLogResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            ImageDetectionStats::class,
            AccuracyStatsWidget::class,
        ];
    }
}