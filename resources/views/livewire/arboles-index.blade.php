<div>
    <div class="bg-white rounded-3xl shadow-xl p-8">
          
        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-0 gap-y-1 md:gap-5">
          
            <input wire:model.live.debounce.400ms="search" type="text"
                placeholder="Buscar por adoptante, especie o folio..."
                class="col-span-2 border rounded-md md:rounded-xl px-5 py-2 md:py-4 focus:outline-none focus:ring-2 focus:ring-primary">
            <button type="button" class="bg-primary rounded-md md:rounded-xl text-white w-full py-1">
                Buscar
            </button>
        </div>

        <label class="flex items-center gap-3 mt-6 cursor-pointer w-fit">
            <input wire:model.live="soloDisponibles" type="checkbox"
                class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
            <span class="text-gray-600 font-medium">
                Mostrar solo árboles disponibles para adoptar
            </span>
        </label>
    </div>

    <div class="py-16">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-4xl font-extrabold">
                Nuestros Árboles
            </h2>
            <p class="text-gray-500 font-medium">
                {{ $adopciones->total() }} {{ $adopciones->total() === 1 ? 'árbol' : 'árboles' }}
            </p>
        </div>

        <div wire:loading.class="opacity-50 pointer-events-none" class="transition">
            @if ($adopciones->isEmpty())
                <p class="text-center text-gray-400 py-20">
                    No se encontraron árboles con ese criterio.
                </p>
            @else
                <div class="grid md:grid-cols-3 gap-10">
                    @foreach ($adopciones as $adopcion)
                        @php
                            $disponible = blank($adopcion->adoptante);
                            $foto = $adopcion->foto ? asset('storage/' . $adopcion->foto) : $adopcion->especie->imagen;
                        @endphp
                        <div wire:key="arbol-{{ $adopcion->id }}"
                            class="card bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition">
                            <div class="overflow-hidden relative">
                                <img class="h-72 w-full object-cover" src="{{ $foto }}">
                                <span
                                    class="absolute top-4 right-4 {{ $disponible ? 'badge-disponible' : 'badge-adoptado' }} px-3 py-1 rounded-lg text-sm font-semibold">
                                    {{ $disponible ? 'Disponible' : 'Adoptado' }}
                                </span>
                            </div>
                            <div class="p-7">
                                <div class="flex justify-between items-center">
                                    <span class="bg-green-100 text-green-700 px-2 md:px-3 py-1 rounded-lg text-sm">
                                        {{ $adopcion->especie->cientifico }}
                                    </span>
                                    <span class="text-gray-400 font-mono text-sm">
                                        {{ $adopcion->folio }}
                                    </span>
                                </div>
                                <h3 class="text-2xl font-bold mt-5">
                                    {{ $adopcion->especie->nombre }}
                                </h3>
                                @unless ($disponible)
                                    <p class="text-gray-500">
                                        Adoptado por <strong>{{ $adopcion->adoptante }}</strong>
                                    </p>
                                @endunless

                                <a href="{{ route('adopciones.show', $adopcion->folio) }}"
                                    class="mt-8 inline-block text-primary font-bold">
                                    Ver árbol →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-14">
                    {{ $adopciones->links() }}
                </div>
            @endif
        </div>
    </div>
</div>