<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=figtree:wght@400;500;600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            #sidebar-nav {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                transition: all 0.3s ease-in-out;
            }

            #main-content {
                margin-left: 16rem; /* Lebar awal sidebar w-64 */
                transition: all 0.3s ease-in-out;
            }

            /* === KELAS BARU UNTUK MENGHILANGKAN SIDEBAR === */
            #sidebar-nav.hidden {
                transform: translateX(-100%); /* Geser sidebar ke kiri hingga hilang */
            }

            #main-content.sidebar-hidden {
                margin-left: 0; /* Konten mengisi seluruh layar */
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <aside id="sidebar-nav" class="w-64 bg-white shadow-md z-20">
                @include('layouts.navigation')
            </aside>

            <div id="main-content">
                <main>
                    @if (isset($header))
                        <header class="bg-white shadow relative z-10">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center">
                                <button id="full-sidebar-toggle" class="p-2 mr-4 text-gray-500 hover:bg-gray-100 rounded">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                                </button>
                                
                                {{ $header }}
                            </div>
                        </header>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>

        <script>
            const sidebar = document.getElementById('sidebar-nav');
            const mainContent = document.getElementById('main-content');
            const fullSidebarToggle = document.getElementById('full-sidebar-toggle');

            if (fullSidebarToggle) {
                fullSidebarToggle.addEventListener('click', () => {
                    // Toggle class .hidden pada sidebar
                    sidebar.classList.toggle('hidden');
                    // Toggle class .sidebar-hidden pada konten utama
                    mainContent.classList.toggle('sidebar-hidden');
                });
            }
        </script>
    </body>
</html>