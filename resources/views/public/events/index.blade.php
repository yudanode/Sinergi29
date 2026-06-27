@extends('layouts.app')

@section('title', 'Event — LDII Sumedang')

@section('content')

<div class="bg-primary-700 text-white py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold">Event & Kegiatan</h1>
        <p class="text-primary-100 mt-1">Jadwal kegiatan LDII Sumedang</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-10">

    {{-- UPCOMING EVENTS --}}
    <h2 class="text-xl font-bold text-gray-800 mb-6">Event Mendatang</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        @forelse($upcomingEvents as $event)
        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition">
            @if($event->poster)
            <img src="{{ asset('storage/'.$event->poster) }}"
                alt="{{ $event->title }}"
                class="w-full h-48 object-cover">
            @else
            <div class="w-full h-48 bg-primary-50 flex items-center justify-center">
                <i class="fas fa-calendar-alt text-primary-300 text-5xl"></i>
            </div>
            @endif
            <div class="p-5">
                <div class="flex items-center gap-2 mb-3">
                    <div class="bg-primary-600 text-white rounded-lg px-3 py-1 text-center">
                        <div class="text-xl font-bold leading-none">{{ $event->start_date->format('d') }}</div>
                        <div class="text-xs">{{ $event->start_date->format('M Y') }}</div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">
                            <i class="fas fa-clock mr-1"></i>{{ $event->start_date->format('H:i') }} WIB
                        </p>
                        <p class="text-xs text-gray-400">
                            <i class="fas fa-map-marker-alt mr-1"></i>{{ Str::limit($event->location, 30) }}
                        </p>
                    </div>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">{{ $event->title }}</h3>
                <p class="text-gray-500 text-sm line-clamp-2">{{ Str::limit($event->description, 100) }}</p>
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center gap-2 text-sm text-gray-400">
                        <span><i class="fas fa-heart mr-1 text-red-400"></i>{{ $event->likes->count() }}</span>
                    </div>
                    <a href="{{ route('events.show', $event->id) }}"
                        class="text-primary-600 text-sm font-medium hover:text-primary-700">
                        Detail →
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-16 text-gray-400">
            <i class="fas fa-calendar-alt text-5xl mb-4"></i>
            <p>Belum ada event mendatang.</p>
        </div>
        @endforelse
    </div>

    {{-- PAST EVENTS --}}
    @if($pastEvents->count() > 0)
    <h2 class="text-xl font-bold text-gray-800 mb-6">Event Sebelumnya</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($pastEvents as $event)
        <div class="bg-white rounded-xl shadow-sm overflow-hidden opacity-75 hover:opacity-100 transition">
            @if($event->poster)
            <img src="{{ asset('storage/'.$event->poster) }}"
                alt="{{ $event->title }}"
                class="w-full h-40 object-cover grayscale">
            @else
            <div class="w-full h-40 bg-gray-100 flex items-center justify-center">
                <i class="fas fa-calendar-check text-gray-300 text-4xl"></i>
            </div>
            @endif
            <div class="p-4">
                <span class="text-xs text-gray-400">{{ $event->start_date->format('d M Y') }}</span>
                <h3 class="font-medium text-gray-700 mt-1">{{ $event->title }}</h3>
                <p class="text-xs text-gray-400 mt-1">
                    <i class="fas fa-map-marker-alt mr-1"></i>{{ $event->location }}
                </p>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

@endsection