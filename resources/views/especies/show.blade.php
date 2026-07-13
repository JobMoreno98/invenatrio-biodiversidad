@php
    $title = $especie->nombre . ' - ESPECIES';
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
                url("{{ $especie->imagen }}");
            height: 80vh;
            background-size: cover;
            background-position: center;
        }

        .contenido img {
            margin: 0px 20px;
            border-radius: var(--radius-3xl);
            --tw-shadow: 0 20px 25px -5px var(--tw-shadow-color, #0000001a), 0 8px 10px -6px var(--tw-shadow-color, #0000001a);
            box-shadow: var(--tw-inset-shadow), var(--tw-inset-ring-shadow), var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow);
        }

        /* 1. El H1/H2 se mantiene como bloque completo (para respetar el flujo de los floats) */
        .contenido h1,
        .contenido h2 {
            display: block;
            /* Opcional: si quieres que los títulos siempre bajen y no se queden flotando al lado de una imagen */
        }

        /* 2. El truco real ocurre en el span */
        .contenido h1>span,
        .contenido h2>span {
            /* Mantiene el comportamiento de texto inline para que el borde abrace solo las letras */
            display: inline;

            /* El color base por defecto */
            color: oklch(39.3% .095 152.535);

            /* La magia que querías: el borde sigue al color del texto */
            border-bottom: 2px solid currentcolor;

            /* Un pequeño truco visual por si el borde queda muy pegado a las letras */
            padding-bottom: 2px;
        }

        @media(max-width:) {
            .contenido img {
                max-width: 300px;
                clear: both;
            }

            .contenido h1,
            .contenido h2 {
                clear: both;
                /* Opcional: si quieres que los títulos siempre bajen y no se queden flotando al lado de una imagen */
            }
        }
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <section class="hero flex items-end">
        <div class="max-w-7xl mx-auto px-8 pb-20 w-full">
            <h1 class="text-7xl font-black text-white mt-4">
                {{ $especie->nombre }}
            </h1>
            <p class="text-2xl mt-2 uppercase tracking-[5px] text-green-200">
                {{ $especie->cientifico }}
            </p>
        </div>
    </section>

    <!-- DATOS RÁPIDOS -->
    <section class="-mt-14 relative z-10 mx-auto">
        <div class="max-w-6xl mx-auto" style="width: fit-content;">
            <div class="flex flex-col md:flex-row bg-white rounded-3xl shadow-xl overflow-hidden">
                @foreach ($especie->datos as $item)
                    <div class="p-8 text-center  {{ !$loop->first && !$loop->last ? 'border-x border-gray-300' : '' }}">
                        <p class="text-gray-400 mt-4 capitalize " style="color: #00bdfc">
                            {{ mb_convert_case($item['label'], MB_CASE_TITLE, 'UTF-8') }}
                        </p>
                        <strong class="">{{ mb_convert_case($item['valor'], MB_CASE_TITLE, 'UTF-8') }}</strong>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CONTENIDO EDITORIAL DESDE BD -->
    @isset($especie->contenido)
        <section class="my-20 mx-4 md:mx-auto contenido">
            @foreach ($especie->contenido as $key => $item)
                <div class="max-w-6xl mx-auto contenido leading-9 text-lg text-gray-600">
                    {!! $item['contenido'] !!}
                </div>
            @endforeach
        </section>
    @endisset

    <!-- CARACTERÍSTICAS Y CURIOSIDAD -->
    <section class="py-12 bg-cream mx-3">
        <div class="max-w-7xl mx-auto px-4 md:px-8 justify-center grid lg:grid-cols-3 gap-12 items-start">

            <!-- Columna de Características Dinámicas (Ocupa 2 de 3 columnas en pantallas grandes) -->
            <div class="lg:col-span-2 contenido">
                <h2 class="text-4xl mb-12">
                    Características
                </h2>

                <div class="grid md:grid-cols-2 gap-8">
                    @isset($especie->caracteristicas)
                        @foreach ($especie->caracteristicas as $caracteristica)
                            <div class="bg-white rounded-3xl p-4 shadow-sm">
                                <div class="text-5xl">
                                    {{ $caracteristica['icono'] ?? '🌿' }}
                                </div>
                                <h3 class="font-bold mt-6 text-xl">
                                    {{ $caracteristica['titulo'] }}
                                </h3>
                                <p class="text-gray-500 mt-3 leading-relaxed">
                                    {{ $caracteristica['texto'] }}
                                </p>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>

            <!-- Columna de Curiosidad (Ocupa 1 columna) -->
            @isset($especie->sabias)
                <div class="bg-gradient-to-br from-green-600 to-emerald-500 rounded-3xl text-white p-4 md:p-8 shadow-xl lg:mt-24"
                    style="height: fit-content">
                    <h2 class="font-black text-2xl">
                        ¿Sabías que?
                    </h2>
                    <div class="mt-4 leading-7 text-green-50">
                        {!! $especie->sabias !!}
                    </div>
                </div>
            @endisset

        </div>
    </section>
@endsection
