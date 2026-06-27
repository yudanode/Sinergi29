@extends('layouts.app')

@section('title', $portfolio->title . ' — LDII Sumedang')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-10">

    <nav class="text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary-600">Beranda</a>
        <span class="mx-2">/</span>
        <a href="{{ route('portfolio.index') }}" class="hover:text-primary-600">Portfolio</a>
        <span class="mx-2">/</span>
        <span class="text-gray-600">{{ $portfolio->title }}</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm p-8">
        @if($portfolio->category)
        <span class="text-xs bg-primary-100 text-primary-700 px-3 py-1 rounded-full font-medium">
            {{ $portfolio->category->category_name }}
        </span>
        @endif

        <h1 class="text-3xl font-bold text-gray-900 mt-3 mb-4">{{ $portfolio->title }}</h1>

        @if($portfolio->description)
        <p class="text-gray-600 leading-relaxed mb-8">{{ $portfolio->description }}</p>
        @endif

        {{-- FILE GALLERY --}}
        @if($portfolio->files->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
            @foreach($portfolio->files as $file)
            @if($file->file_type == 'image')
            <a href="{{ asset('storage/'.$file->file_path) }}" target="_blank">
                <img src="{{ asset('storage/'.$file->file_path) }}"
                    alt="File portfolio"
                    class="w-full h-40 object-cover rounded-xl hover:opacity-90 transition">
            </a>
            @else
            <a href="{{ asset('storage/'.$file->file_path) }}" target="_blank"
                class="flex flex-col items-center justify-center h-40 bg-gray-50 rounded-xl hover:bg-primary-50 transition border border-gray-200">
                <i class="fas fa-file-pdf text-red-400 text-3xl mb-2"></i>
                <span class="text-sm text-gray-600">Lihat Dokumen</span>
            </a>
            @endif
            @endforeach
        </div>
        @endif

        {{-- LIKE --}}
        @auth
        <form action="{{ route('like.toggle', ['type' => 'portfolio', 'id' => $portfolio->id]) }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center gap-2 px-5 py-2 rounded-full border-2
                    {{ $portfolio->likes->where('user_id', auth()->id())->count() ? 'bg-red-50 border-red-400 text-red-500' : 'border-gray-200 text-gray-500 hover:border-red-400 hover:text-red-500' }}
                    transition">
                <i class="fas fa-heart"></i>
                <span>{{ $portfolio->likes->count() }} Suka</span>
            </button>
        </form>
        @endauth
    </div>

    <div class="mt-6">
        <a href="{{ route('portfolio.index') }}" class="text-primary-600 hover:text-primary-700 font-medium">
            ← Kembali ke Portfolio
        </a>
    </div>
</div>

@endsection