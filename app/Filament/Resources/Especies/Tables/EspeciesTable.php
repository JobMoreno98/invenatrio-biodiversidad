<?php

namespace App\Filament\Resources\Especies\Tables;

use BaconQrCode\Encoder\QrCode;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Filament\Actions\Action;
use Illuminate\Support\Str;

class EspeciesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre'),
                TextColumn::make('ecosistema.nombre'),

            ])->actions([])
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
                        // 1. Definir la URL pública de la especie

                        $qrContent = route('especies.show',  $record);
                        // 2. Definir el nombre del archivo de descarga
                        $fileName = 'qr-' . Str::slug($record->nombre ?? $record->id) . '.svg';

                        // 3. Configurar el renderizador de BaconQrCode para formato SVG vectorial
                        $renderer = new ImageRenderer(
                            new RendererStyle(400),
                            new SvgImageBackEnd() // Renderiza en formato de texto SVG estructurado
                        );
                        $writer = new Writer($renderer);

                        // 4. Retornar la descarga directa transmitiendo el string generado
                        return response()->streamDownload(
                            function () use ($writer, $qrContent) {
                                // writeString() devuelve el XML del SVG directamente en el búfer
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
