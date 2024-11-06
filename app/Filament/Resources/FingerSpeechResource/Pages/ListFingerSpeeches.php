<?php

namespace App\Filament\Resources\FingerSpeechResource\Pages;

use App\Filament\Resources\FingerSpeechResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFingerSpeeches extends ListRecords
{
    protected static string $resource = FingerSpeechResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
