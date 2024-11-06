<?php

namespace App\Filament\Resources\FingerSpeechResource\Pages;

use App\Filament\Resources\FingerSpeechResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateFingerSpeech extends CreateRecord
{
    protected static string $resource = FingerSpeechResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Bahasa Isyarat ditambahkan')
            ->body('Data bahasa isyarat baru telah berhasil ditambahkan.');
    }
}