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
        // 1. Accedemos directamente a la especie actual en la base de datos desde $this->record
        $especieIdAnterior = $this->record->especie_id;

        // 2. Solo recalculamos el folio si la especie cambió en el formulario
        if (isset($data['especie_id']) && $data['especie_id'] != $especieIdAnterior) {

            $especie = Especie::find($data['especie_id']);

            if ($especie) {
                $prefijo = strtoupper(substr($especie->nombre, 0, 3));

                // 3. Buscamos el número máximo asignado a la NUEVA especie
                $ultimoFolio = Adopcion::where('especie_id', $especie->id)
                    ->where('folio', 'LIKE', "{$prefijo}-%")
                    ->pluck('folio')
                    ->map(function ($folio) {
                        $partes = explode('-', $folio);
                        return (int) end($partes);
                    })
                    ->max();

                $siguienteNumero = $ultimoFolio ? ($ultimoFolio + 1) : 1;

                // 4. Formateamos a 3 dígitos (ajusta a 4 si prefieres 0001)
                $codigo = str_pad($siguienteNumero, 3, '0', STR_PAD_LEFT);

                // 5. Asignamos el nuevo folio
                $data['folio'] = "{$prefijo}-{$codigo}";
            }
        }

        return $data;
    }
}
