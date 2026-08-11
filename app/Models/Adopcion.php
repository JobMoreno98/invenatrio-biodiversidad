<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Mews\Purifier\Facades\Purifier;

class Adopcion extends Model
{
    protected $guarded = [];

    public function especie()
    {
        return $this->belongsTo(Especie::class, 'especie_id');
    }

    protected function contenido(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Purifier::clean($value),
        );
    }

    public function getRouteKeyName(): string
    {
        return 'folio';
    }
}
