@extends('layouts.app')

@section('title', $event->title . ' — LDII Sumedang')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-10">

    <nav class="text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary-600">Beranda</a>
        <span class="mx-2">/</span>
        <a href="{{ route('events.index') }}" class="hover:text-primary-600">Event</a>
        <span class="mx-2">/</span>
        <span class="text-gray-600">{{ Str::limit($event->title, 40) }}</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        @if($event->poster)
        <img src="{{ asset('storage/'.$event->poster) }}"
            alt="{{ $event->title }}"
            class="w-full max-h-96 object-cover">
        @endif

        <div class="p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ $event->title }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-primary-50 rounded-xl p-4 text-center">
                    <i class="fas fa-calendar-alt text-primary-600 text-2xl mb-2"></i>
                    <p class="text-xs text-gray-500 mb-1">Tanggal Mulai</p>
                    <p class="font-semibold text-gray-800">{{ $event->start_date->format('d F Y') }}</p>
                    <p class="text-sm text-gray-500">{{ $event->start_date->format('H:i') }} WIB</p>
                </div>
                <div class="bg-primary-50 rounded-xl p-4 text-center">
                    <i class="fas fa-calendar-check text-primary-600 text-2xl mb-2"></i>
                    <p class="text-xs text-gray-500 mb-1">Tanggal Selesai</p>
                    <p class="font-semibold text-gray-800">{{ $event->end_date->format('d F Y') }}</p>
                    <p class="text-sm text-gray-500">{{ $event->end_date->format('H:i') }} WIB</p>
                </div>
                <div class="bg-primary-50 rounded-xl p-4 text-center">
                    <i class="fas fa-map-marker-alt text-primary-600 text-2xl mb-2"></i>
                    <p class="text-xs text-gray-500 mb-1">Lokasi</p>
                    <p class="font-semibold text-gray-800">{{ $event->location }}</p>
                </div>
            </div>

            <div class="prose max-w-none text-gray-700 leading-relaxed mb-8">
                {!! nl2br(e($event->description)) !!}
            </div>

            {{-- LIKE --}}
            @auth
            <form action="{{ route('like.toggle', ['type' => 'event', 'id' => $event->id]) }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 px-5 py-2 rounded-full border-2
                        {{ $event->likes->where('user_id', auth()->id())->count() ? 'bg-red-50 border-red-400 text-red-500' : 'border-gray-200 text-gray-500 hover:border-red-400 hover:text-red-500' }}
                        transition">
                    <i class="fas fa-heart"></i>
                    <span>{{ $event->likes->count() }} Suka</span>
                </button>
            </form>
            @endauth

        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('events.index') }}" class="text-primary-600 hover:text-primary-700 font-medium">
            ← Kembali ke Event
        </a>
    </div>
</div>

@endsection