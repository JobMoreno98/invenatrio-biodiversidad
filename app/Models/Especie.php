<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Mews\Purifier\Facades\Purifier;


class Especie extends Model
{
    protected $guarded = [];
    protected $appends = ['ruta', 'imagen'];

    protected $casts = [
        'datos' => 'array',
        'contenido' => 'array',
        'caracteristicas' => 'array'
    ];

    public function ecosistema()
    {
        return $this->belongsTo(Ecosistema::class, 'ecosistema_id');
    }

    public function getRutaAttribute()
    {
        return route('especies.show', $this->slug);
    }
    public function getImagenAttribute()
    {
        return Storage::disk('imagenes')->url($this->fotografia);
    }


    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->slug = static::generateUniqueSlug($model->nombre);
        });

        static::updating(function ($model) {
            // Solo regenera el slug si el nombre cambió
            if ($model->isDirty('nombre')) {
                $model->slug = static::generateUniqueSlug($model->nombre, $model->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $nombre, $ignoreId = null): string
    {
        $slug = Str::slug($nombre);
        $originalSlug = $slug;
        $count = 1;

        $query = static::where('slug', $slug);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        while ($query->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;

            $query = static::where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
        }

        return $slug;
    }


    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    public function adopciones()
    {
        return $this->hasMany(Adopcion::class);
    }
}
