<?php

namespace App\Filament\Resources\ImageDetectionLogResource\Pages;

use App\Filament\Resources\ImageDetectionLogResource;
use Filament\Resources\Pages\ViewRecord;

class ViewImageDetectionLog extends ViewRecord
{
    protected static string $resource = ImageDetectionLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            
        ];
    }
}