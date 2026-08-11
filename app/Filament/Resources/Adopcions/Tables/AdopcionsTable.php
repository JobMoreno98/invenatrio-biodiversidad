<?php

namespace App\Filament\Resources\Adopcions\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Str;
use BaconQrCode\Renderer\ImageRenderer;

class AdopcionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('folio')->label('Folio')->searchable()->sortable(),
                TextColumn::make('especie.nombre')->searchable()->sortable(),
                TextColumn::make('adoptante')->searchable()->sortable()
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('descargarQr')
                    ->label('Descargar QR')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function ($record) {
                        $qrContent = route('adopciones.show',  $record->folio);
                        $fileName = 'qr-' . Str::slug($record->folio ?? $record->id) . '.svg';
                        $renderer = new ImageRenderer(
                            new RendererStyle(400),
                            new SvgImageBackEnd() 
                        );
                        $writer = new Writer($renderer);
                        return response()->streamDownload(
                            function () use ($writer, $qrContent) {
                                echo $writer->writeString($qrContent);
                            },
                            $fileName,
                            [
                                'Content-Type' => 'image/svg+xml',
                            ]
                        );
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
