@php
    $title = $adopcion->folio . ' - Adopciones';
    $foto = $foto = $adopcion->foto
        ? asset('storage/' . $adopcion->foto)
        : $adopcion->especie?->imagen ?? asset('images/default.jpg');
@endphp
@extends('layouts.app')
@push('css')
    <style>
        body {
            font-family: Manrope, sans-serif;
        }

        .hero {
            background:
                linear-gradient(to right, rgba(0, 0, 0, .45), rgba(0, 0, 0, .2)),
                url("{{ $foto }}");
            height: 70vh;
            background-size: cover;
            background-position: center;
        }

        .contenido img {
            margin: 0px 20px;
            border-radius: var(--radius-3xl);
        }
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <section class="hero flex items-end">
        <div class="max-w-7xl mx-auto px-8 pb-20 w-full">
            <span class="bg-green-500/90 text-white px-4 py-1 rounded-xs text-sm font-semibold uppercase">
                {{ $adopcion->adoptante }}
            </span>
            <h1 class="text-6xl font-black text-white mt-4">
                {{ $adopcion->especie->nombre }}
            </h1>
            <p class="text-2xl mt-2 uppercase tracking-[5px] text-green-200">
                {{ $adopcion->especie->cientifico }}
            </p>
        </div>
    </section>

    <!-- DATOS DE LA ADOPCIÓN -->
    <section class="-mt-14 relative z-10 mx-auto">
        <div class="max-w-6xl mx-auto" style="width: fit-content;">
            <div class="flex flex-col md:flex-row bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="p-8 text-center border-x border-gray-300">
                    <p class="text-gray-400 mt-4" style="color: #00bdfc">Folio</p>
                    <strong class="font-mono">{{ $adopcion->folio }}</strong>
                </div>
                <div class="p-8 text-center border-x border-gray-300">
                    <p class="text-gray-400 mt-4" style="color: #00bdfc">Adoptante</p>
                    <strong class="uppercase">{{ $adopcion->adoptante }}</strong>
                </div>
                <div class="p-8 text-center">
                    <p class="text-gray-400 mt-4" style="color: #00bdfc">Fecha</p>
                    <strong>{{ $adopcion->created_at->translatedFormat('d M Y')}}</strong>
                </div>
            </div>
        </div>
    </section>

    <!-- HISTORIA DE LA ADOPCIÓN -->
    <section class="my-20 mx-4 md:mx-auto contenido">
        <div class="max-w-4xl mx-auto prose prose-lg prose-green leading-9 text-lg text-gray-600">
            {!! $adopcion->contenido !!}
        </div>
    </section>

    <!-- SOBRE LA ESPECIE ADOPTADA -->
    <section class="py-12 bg-cream mx-3">
        <div class="max-w-5xl mx-auto px-4 md:px-8">
            <h2 class="text-3xl font-bold mb-6">
                Sobre esta familia
            </h2>
            <div class="bg-white rounded-3xl shadow-sm p-8 flex flex-col md:flex-row gap-8 items-center">
                <img src="{{ $adopcion->especie->imagen }}" class="w-full md:w-64 h-64 object-cover rounded-2xl">
                <div>
                    <h3 class="text-2xl font-bold">{{ $adopcion->especie->nombre }}</h3>
                    <p class="italic text-gray-500">{{ $adopcion->especie->cientifico }}</p>
                    <a href="{{ route('especies.show', $adopcion->especie) }}"
                        class="mt-4 inline-block text-primary font-bold">
                        Ver ficha completa de la especie →
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
