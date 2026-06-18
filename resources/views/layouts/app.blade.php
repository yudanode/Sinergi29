<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Website LDII Sumedang')</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-800">

    {{-- NAVBAR --}}
    <nav class="bg-primary-700 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-white rounded-full flex items-center justify-center">
                        <span class="text-primary-700 font-bold text-sm">LD</span>
                    </div>
                    <span class="text-white font-bold text-lg hidden sm:block">LDII Sumedang</span>
                </a>

                {{-- Menu Desktop --}}
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-white hover:text-primary-100 transition text-sm font-medium">Beranda</a>
                    <a href="{{ route('posts.index') }}" class="text-white hover:text-primary-100 transition text-sm font-medium">Berita</a>
                    <a href="{{ route('events.index') }}" class="text-white hover:text-primary-100 transition text-sm font-medium">Event</a>
                    <a href="{{ route('portfolio.index') }}" class="text-white hover:text-primary-100 transition text-sm font-medium">Portfolio</a>
                    <a href="{{ route('feedback.create') }}" class="text-white hover:text-primary-100 transition text-sm font-medium">Kritik & Saran</a>
                </div>

                {{-- Auth --}}
                <div class="flex items-center gap-3">
                    @auth
                    <span class="text-primary-100 text-sm hidden sm:block">{{ auth()->user()->full_name }}</span>
                    @if(auth()->user()->hasAnyRole(['admin','editor']))
                    <a href="{{ route('admin.dashboard') }}"
                        class="bg-white text-primary-700 text-sm font-semibold px-3 py-1.5 rounded-lg hover:bg-primary-50 transition">
                        Dashboard
                    </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-white text-sm border border-white px-3 py-1.5 rounded-lg hover:bg-primary-600 transition">
                            Logout
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}"
                        class="text-white text-sm border border-white px-3 py-1.5 rounded-lg hover:bg-primary-600 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-white text-primary-700 text-sm font-semibold px-3 py-1.5 rounded-lg hover:bg-primary-50 transition">
                        Daftar
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg flex items-center gap-2">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    </div>
    @endif

    {{-- CONTENT --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-primary-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="font-bold text-lg mb-3">LDII Sumedang</h3>
                    <p class="text-primary-100 text-sm leading-relaxed">
                        Lembaga Dakwah Islam Indonesia Kabupaten Sumedang.
                        Bersama membangun umat yang berilmu dan berakhlak mulia.
                    </p>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-3">Menu</h3>
                    <ul class="space-y-2 text-sm text-primary-100">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('posts.index') }}" class="hover:text-white transition">Berita</a></li>
                        <li><a href="{{ route('events.index') }}" class="hover:text-white transition">Event</a></li>
                        <li><a href="{{ route('portfolio.index') }}" class="hover:text-white transition">Portfolio</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-3">Kontak</h3>
                    <ul class="space-y-2 text-sm text-primary-100">
                        <li><i class="fas fa-envelope mr-2"></i>info@ldiisumedang.or.id</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i>Sumedang, Jawa Barat</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-primary-600 mt-8 pt-6 text-center text-sm text-primary-200">
                &copy; {{ date('Y') }} LDII Sumedang. All rights reserved.
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>