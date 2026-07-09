@php
    $title = 'HOME';
@endphp
@extends('layouts.app')
@push('css')
    <style>
        body {
            font-family: Manrope, sans-serif;
        }

        .glass {
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, .75);
        }

        .hero {
            background-image:
                linear-gradient(to right, rgba(0, 0, 0, .55), rgba(0, 0, 0, .15)),
                url("https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1800&q=80");
            background-size: cover;
            background-position: center;
        }

        .card:hover img {
            transform: scale(1.08);
        }

        img {
            transition: .5s;
        }
    </style>
@endpush
@section('content')
    <section class="hero min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-6">
            <div class="max-w-2xl">
                <p class="uppercase tracking-[6px] text-secondary mb-4">
                    Enciclopedia Natural
                </p>
                <h1 class="text-6xl font-black text-white leading-tight">
                    Descubre las especies que hacen único nuestro centro universitario.

                </h1>
                <!--
                                                            <p class="text-gray-200 mt-8 text-lg leading-relaxed">

                                                                Explora información científica sobre flora, fauna y ecosistemas mediante una experiencia moderna y
                                                                visual.

                                                            </p>
                                            -->
                <div class="mt-10 flex gap-5">
                    <button class="bg-primary px-8 py-4 rounded-full text-white hover:bg-green-700 transition">
                        Explorar especies
                    </button>
                    <!--
                                                        <button class="bg-white/20 backdrop-blur text-white px-8 py-4 rounded-full">
                                                            Ver categorías
                                                        </button>
                                                        -->
                </div>
            </div>
        </div>
    </section>
    <!-- BUSCADOR
        <section class="-mt-14 relative z-20">
            <div class="max-w-5xl mx-auto px-6">
                <div class="bg-white rounded-3xl shadow-xl p-8">
                    <div class="grid md:grid-cols-3 gap-5">
                        <input type="text" placeholder="Buscar especie..."
                            class="col-span-2 border rounded-xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-primary">

                                                           <select class="border rounded-xl px-5 py-4">
                                                                    <option>Todos</option>
                                                                    <option>Flora</option>
                                                                    <option>Fauna</option>
                                                                </select>
                                            
                        <button class="bg-primary rounded-xl text-white">
                            Buscar
                        </button>
                    </div>
                </div>
            </div>
        </section>
     CATEGORÍAS
                                    <section class="py-24">
                                        <div class="max-w-7xl mx-auto px-6">
                                            <div class="flex justify-between items-center mb-12">
                                                <div>
                                                    <h2 class="text-4xl font-extrabold">
                                                        Explora por categoría
                                                    </h2>
                                                    <p class="text-gray-500 mt-2">
                                                        Selecciona un grupo biológico.
                                                    </p>

                                                </div>
                                            </div>
                                            <div class="grid md:grid-cols-4 gap-8">
                                                <div class="bg-white rounded-3xl shadow-sm p-8 hover:shadow-xl transition">
                                                    <div class="text-5xl">🌿</div>
                                                    <h3 class="mt-5 font-bold text-xl">
                                                        Flora
                                                    </h3>
                                                    <p class="mt-3 text-gray-500">
                                                        Árboles, plantas, flores y helechos.
                                                    </p>
                                                </div>
                                                <div class="bg-white rounded-3xl shadow-sm p-8 hover:shadow-xl transition">
                                                    <div class="text-5xl">🦜</div>
                                                    <h3 class="mt-5 font-bold text-xl">
                                                        Aves
                                                    </h3>
                                                    <p class="mt-3 text-gray-500">
                                                        Especies terrestres y migratorias.
                                                    </p>
                                                </div>
                                                <div class="bg-white rounded-3xl shadow-sm p-8 hover:shadow-xl transition">
                                                    <div class="text-5xl">🦊</div>
                                                    <h3 class="mt-5 font-bold text-xl">
                                                        Mamíferos
                                                    </h3>
                                                    <p class="mt-3 text-gray-500">
                                                        Fauna silvestre y endémica.
                                                    </p>
                                                </div>
                                                <div class="bg-white rounded-3xl shadow-sm p-8 hover:shadow-xl transition">
                                                    <div class="text-5xl">🦋</div>
                                                    <h3 class="mt-5 font-bold text-xl">
                                                        Insectos
                                                    </h3>
                                                    <p class="mt-3 text-gray-500">
                                                        Polinizadores y artrópodos.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                -->
    <!-- ESPECIES -->

    <section class="pb-28 mt-5">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between items-center mb-10">

                <h2 class="text-4xl font-extrabold">
                    Especies destacadas
                </h2>

                <a href="{{ route('especies.index') }}" class="text-primary font-bold">
                    Ver todas →
                </a>

            </div>

            <div class="grid md:grid-cols-3 gap-10">

                @foreach ($especies as $item)
                    <div
                        class="card bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition duration-300 flex flex-col justify-between h-full border border-gray-100">

                        <div>
                            <div class="overflow-hidden relative group">
                                <img class="h-64 w-full object-cover transition duration-500 group-hover:scale-105"
                                    src="{{ $item->imagen }}">
                            </div>
                            <div class="p-7">
                                <div class="flex flex-wrap gap-2 justify-between items-center">
                                    <span
                                        class="italic bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-medium tracking-wide">
                                        {{ $item->cientifico }}
                                    </span>

                                    {{-- Intenta buscar si en tus Datos Rápidos guardaste el Origen o Familia para mostrarlo como tag --}}
                                    @if (isset($item->datos) && count($item->datos) > 0)
                                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">
                                            {{ $item->datos[0]['valor'] }}
                                        </span>
                                    @endif
                                </div>

                                <h3 class="text-2xl font-black text-gray-900 mt-4 leading-tight">
                                    {{ $item->nombre }}
                                </h3>

                                @if (isset($item->contenido) && count($item->contenido) > 0)
                                    <p class="mt-4 text-gray-500 text-sm leading-relaxed line-clamp-3">
                                        {{ Str::limit(strip_tags($item->contenido[0]['contenido']), 130, '...') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="p-7 pt-0 mt-auto">
                            <a href="{{ route('especies.show', $item->slug) }}"
                                class="inline-flex items-center text-forest hover:text-green-700 font-bold text-sm tracking-wide transition group">
                                Leer más
                                <span
                                    class="transform transition-transform duration-200 group-hover:translate-x-1 ml-1">→</span>
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>

    </section>
@endsection
