<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImageDetectionLogResource\Pages;
use App\Filament\Widgets\AccuracyStatsWidget;
use App\Filament\Widgets\ImageDetectionStats;
use App\Models\ImageDetectionLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;

class ImageDetectionLogResource extends Resource
{
    protected static ?string $model = ImageDetectionLog::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Statistik Deteksi';
    protected static ?string $navigationGroup = 'Monitoring';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('image_path')
                    ->label('Path Gambar')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('prediction_result')
                    ->label('Hasil Prediksi')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('status')
                    ->label('Status')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('ip_address')
                    ->label('IP Address')
                    ->disabled()
                    ->dehydrated(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y H:i:s')
                    ->sortable(),
                Tables\Columns\TextColumn::make('prediction_result')
                    ->label('Hasil Prediksi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'success' => 'success',
                        'failed' => 'danger',
                        default => 'primary',
                    }),
                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Gambar')
                    ->disk('public')
                    ->size(40),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'success' => 'Berhasil',
                        'failed' => 'Gagal',
                    ])
                    ->label('Status'),
                
                // Optional: Filter by date range
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListImageDetectionLogs::route('/'),
            'view' => Pages\ViewImageDetectionLog::route('/{record}'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ImageDetectionStats::class,
            AccuracyStatsWidget::class,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'warning' : 'primary';
    }
}