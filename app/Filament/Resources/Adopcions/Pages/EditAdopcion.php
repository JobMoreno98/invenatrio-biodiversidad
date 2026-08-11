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
        // Verificamos si la especie_id del formulario es DIFERENTE a la del registro actual
        $adopcion = Adopcion::find($this->record->id)->value('especie_id');

        if ($data['especie_id'] != $adopcion) {

            // 1. Buscamos la NUEVA especie usando el ID que viene del formulario
            $especie = Especie::find($data['especie_id']);

            if ($especie) {
                // 2. Obtenemos el prefijo (3 primeras letras de la especie)
                $prefijo = strtoupper(substr($especie->nombre, 0, 3));

                // 3. Buscamos la última adopción registrada de esta misma especie
                $ultimaAdopcion = Adopcion::where('especie_id', $especie->id)
                    ->latest('id') // Ordenamos por el ID más reciente
                    ->first();

                $siguienteNumero = 1; // Por defecto empezamos en 1

                if ($ultimaAdopcion && $ultimaAdopcion->folio) {
                    // Si ya existe una, separamos el prefijo del número (ej: PER-005)
                    $partes = explode('-', $ultimaAdopcion->folio);

                    // Tomamos la última parte (005), la convertimos a entero y le sumamos 1
                    $ultimoNumero = (int) end($partes);
                    $siguienteNumero = $ultimoNumero + 1;
                }

                // 4. Formateamos el número para que tenga 3 dígitos con ceros a la izquierda
                $codigo = str_pad($siguienteNumero, 4, '0', STR_PAD_LEFT);

                // 5. Asignamos el NUEVO folio final al arreglo de datos
                $data['folio'] = "{$prefijo}-{$codigo}";
            }
        }

        return $data;
    }
}
