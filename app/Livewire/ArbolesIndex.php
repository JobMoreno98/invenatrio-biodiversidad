<?php

namespace App\Livewire;

use App\Models\Adopcion;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ArbolesIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q', history: true)]
    public string $search = '';

    #[Url(as: 'disponibles', history: true)]
    public bool $soloDisponibles = false;

    protected string $paginationTheme = 'tailwind';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingSoloDisponibles(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $adopciones = Adopcion::query()
            ->with('especie')
            ->when($this->search, function ($query) {
                $termino = $this->search;

                $query->where(function ($q) use ($termino) {
                    $q->where('adoptante', 'like', "%{$termino}%")
                        ->orWhere('folio', 'like', "%{$termino}%")
                        ->orWhereHas('especie', function ($eq) use ($termino) {
                            $eq->where('nombre', 'like', "%{$termino}%")
                                ->orWhere('cientifico', 'like', "%{$termino}%");
                        });
                });
            })
            ->when($this->soloDisponibles, function ($query) {
                $query->where(function ($q) {
                    $q->whereNull('adoptante')->orWhere('adoptante', '');
                });
            })
            ->latest()
            ->paginate(24);

        return view('livewire.arboles-index', compact('adopciones'));
    }
}