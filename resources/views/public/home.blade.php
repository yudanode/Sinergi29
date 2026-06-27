@extends('layouts.app')

@section('title', 'Beranda — LDII Sumedang')

@section('content')

{{-- HERO --}}
<section class="bg-primary-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di<br>LDII PC CIBODAS</h1>
        <p class="text-primary-100 text-lg mb-8 max-w-2xl mx-auto">
            Lembaga Dakwah Islam Indonesia Kabupaten Sumedang — Bersama membangun umat yang berilmu dan berakhlak mulia.
        </p>
        <div class="flex gap-4 justify-center">
            <a href="{{ route('posts.index') }}"
                class="bg-white text-primary-700 font-semibold px-6 py-3 rounded-lg hover:bg-primary-50 transition">
                Baca Berita
            </a>
            <a href="{{ route('events.index') }}"
                class="border border-white text-white font-semibold px-6 py-3 rounded-lg hover:bg-primary-600 transition">
                Lihat Event
            </a>
        </div>
    </div>
</section>

{{-- BERITA TERBARU --}}
<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Berita Terbaru</h2>
        <a href="{{ route('posts.index') }}" class="text-primary-600 hover:text-primary-700 font-medium text-sm">
            Lihat Semua →
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($latestPosts ?? [] as $post)
        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition">
            @if($post->thumbnail)
            <img src="{{ asset('storage/'.$post->thumbnail) }}" alt="{{ $post->title }}"
                class="w-full h-48 object-cover">
            @else
            <div class="w-full h-48 bg-primary-100 flex items-center justify-center">
                <i class="fas fa-newspaper text-primary-400 text-4xl"></i>
            </div>
            @endif
            <div class="p-5">
                <span class="text-xs text-primary-600 font-medium">{{ $post->category->category_name ?? 'Umum' }}</span>
                <h3 class="font-semibold text-gray-800 mt-1 mb-2 line-clamp-2">{{ $post->title }}</h3>
                <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                <a href="{{ route('posts.show', $post->slug) }}"
                    class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                    Baca Selengkapnya →
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center text-gray-400 py-8">
            <i class="fas fa-newspaper text-4xl mb-3"></i>
            <p>Belum ada berita.</p>
        </div>
        @endforelse
    </div>
</section>

{{-- EVENT TERBARU --}}
<section class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Event Mendatang</h2>
            <a href="{{ route('events.index') }}" class="text-primary-600 hover:text-primary-700 font-medium text-sm">
                Lihat Semua →
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($upcomingEvents ?? [] as $event)
            <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition">
                <div class="flex gap-4 items-start">
                    <div class="bg-primary-100 text-primary-700 rounded-lg p-3 text-center min-w-[56px]">
                        <div class="text-2xl font-bold">{{ $event->start_date->format('d') }}</div>
                        <div class="text-xs font-medium">{{ $event->start_date->format('M') }}</div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">{{ $event->title }}</h3>
                        <p class="text-sm text-gray-500"><i class="fas fa-map-marker-alt mr-1"></i>{{ $event->location }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center text-gray-400 py-8">
                <i class="fas fa-calendar-alt text-4xl mb-3"></i>
                <p>Belum ada event.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection