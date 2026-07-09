<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ filled($title ?? null) ? $title . ' - ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @stack('css')
</head>

<body class="bg-light text-dark">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap');

        * {
            font-family: "Geist", sans-serif;
        }
    </style>

    <nav class="bg-white px-6 md:px-16 lg:px-24 xl:px-32 py-4 flex items-center justify-between relative">
        <div class="flex items-center gap-20">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logo.png') }}" class="h-16" alt="">
            </a>
            <!-- Desktop Nav Items -->
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-sm text-zinc-500 hover:text-zinc-800"
                    style="font-size: 20px;">Inicio</a>
            </div>
        </div>

        <!-- Hamburger -->
        <button onclick="toggleMenu()"
            class="md:hidden flex flex-col gap-1.5 cursor-pointer bg-transparent border-0 p-1">
            <span id="bar1" class="block w-6 h-0.5 bg-zinc-800 transition-transform"></span>
            <span id="bar2" class="block w-6 h-0.5 bg-zinc-800 transition-opacity"></span>
            <span id="bar3" class="block w-6 h-0.5 bg-zinc-800 transition-transform"></span>
        </button>

        <!-- Mobile Menu -->
        <div id="mobileMenu"
            class="absolute top-full left-0 w-full bg-white border-t border-zinc-200 flex-col p-5 gap-1 md:hidden z-50 hidden">
            <a href="{{ route('home') }}" class="px-4 py-2.5 rounded-lg text-sm text-zinc-500 hover:bg-green-50">
                Inicio</a>
        </div>
    </nav>


    <div class="my-auto flex flex-col">
        @yield('content')

    </div>

    <!-- FOOTER -->

    <footer class="bg-dark text-gray-300">
        <div class="max-w-7xl mx-auto px-6 py-10">
            <div class="grid md:grid-cols-3 gap-10">
                <div>
                    <h2 class="text-3xl font-black text-white">
                        <img src="{{ asset('img/logo-blanco.png') }}" class="h-18" alt="">
                    </h2>
                    <p class="mt-5">
                        Una plataforma para explorar y aprender sobre la biodiversidad en CUCSH.
                    </p>
                </div>
                {{--  
                <div>
                    <h4 class="text-white font-bold mb-5">
                        Categorías
                    </h4>
                    <ul class="space-y-3">
                        <li>Flora</li>
                        <li>Fauna</li>
                        <li>Ecosistemas</li>
                    </ul>
                </div>
                --}}
                {{-- 
                <div>
                    <h4 class="text-white font-bold mb-5">
                        Contacto
                    </h4>
                    <p>info@.com</p>
                </div>
                 --}}
            </div>
        </div>
    </footer>
    <script>
        let menuOpen = false;

        function toggleMenu() {
            menuOpen = !menuOpen;
            const menu = document.getElementById('mobileMenu');
            const bar1 = document.getElementById('bar1');
            const bar2 = document.getElementById('bar2');
            const bar3 = document.getElementById('bar3');

            menu.classList.toggle('hidden', !menuOpen);
            menu.classList.toggle('flex', menuOpen);
            bar1.style.transform = menuOpen ? 'translateY(8px) rotate(45deg)' : '';
            bar2.style.opacity = menuOpen ? '0' : '1';
            bar3.style.transform = menuOpen ? 'translateY(-8px) rotate(-45deg)' : '';
        }

        function toggleDropdown(dropdownId, chevronId) {
            const dropdown = document.getElementById(dropdownId);
            const chevron = document.getElementById(chevronId);
            const isHidden = dropdown.classList.contains('hidden');

            dropdown.classList.toggle('hidden', !isHidden);
            dropdown.classList.toggle('flex', isHidden);
            chevron.style.transform = isHidden ? 'rotate(180deg)' : '';
        }
    </script>
    @livewireScripts
    @stack('js')
</body>

</html>
