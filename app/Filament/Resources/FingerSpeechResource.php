<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FingerSpeechResource\Pages;
use App\Models\FingerSpeech;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Notifications\Notification;

class FingerSpeechResource extends Resource
{
    protected static ?string $model = FingerSpeech::class;
    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';
    protected static ?string $navigationLabel = 'Bahasa Isyarat';
    protected static ?string $modelLabel = 'Bahasa Isyarat';
    protected static ?string $pluralModelLabel = 'Bahasa Isyarat';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(fn () => FingerSpeech::max('sort_order') + 1)
                            ->required()
                            ->label('Urutan'),
                            
                        TextInput::make('huruf')
                            ->required()
                            ->maxLength(1)
                            ->label('Huruf')
                            ->placeholder('Masukkan huruf'),
                            
                        FileUpload::make('gambar')
                            ->image()
                            ->required()
                            ->label('Gambar')
                            ->directory('finger-speech-images')
                            ->disk('public')
                            ->visibility('public')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png']),
                            
                        Textarea::make('deskripsi')
                            ->required()
                            ->maxLength(1000)
                            ->label('Deskripsi')
                            ->placeholder('Masukkan deskripsi gerakan'),
                    ])
                    ->columns(1)
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
                    
                TextColumn::make('huruf')
                    ->label('Huruf')
                    ->searchable()
                    ->sortable(),
                    
                ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->disk('public')
                    ->width(100)
                    ->height(100)
                    ->square(),
                    
                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->searchable(),
                    
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFingerSpeeches::route('/'),
            'create' => Pages\CreateFingerSpeech::route('/create'),
            'edit' => Pages\EditFingerSpeech::route('/{record}/edit'),
        ];
    }    
}