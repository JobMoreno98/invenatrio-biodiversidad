<?php

namespace App\Filament\Resources\Adopcions\Pages;

use App\Filament\Resources\Adopcions\AdopcionResource;
use App\Models\Adopcion;
use App\Models\Especie;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditAdopcion extends EditRecord
{
    protected static string $resource = AdopcionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // 1. Obtenemos la especie anterior registrada en la base de datos
        $especieIdAnterior = $this->record->especie_id;

        // 2. Si se cambió la especie en el formulario, recalculamos el folio
        if (isset($data['especie_id']) && $data['especie_id'] != $especieIdAnterior) {

            $especie = Especie::find($data['especie_id']);

            if ($especie && $especie->slug) {
                // Convertimos el slug a mayúsculas
                $prefijo = strtoupper($especie->slug);

                // Buscamos el número máximo registrado para el slug de esta nueva especie
                $ultimoFolio = Adopcion::where('especie_id', $especie->id)
                    ->where('folio', 'LIKE', "{$prefijo}-%")
                    ->pluck('folio')
                    ->map(function ($folio) {
                        $partes = explode('-', $folio);
                        return (int) end($partes);
                    })
                    ->max();

                $siguienteNumero = $ultimoFolio ? ($ultimoFolio + 1) : 1;
                $codigo = str_pad($siguienteNumero, 3, '0', STR_PAD_LEFT);

                // Resultado ej: PERICO-001 o GATO-PERSA-001
                $data['folio'] = "{$prefijo}-{$codigo}";
            }
        }

        return $data;
    }
}
