@extends('layouts.app')

@section('title', 'Portfolio — LDII Sumedang')

@section('content')

<div class="bg-primary-700 text-white py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold">Portfolio & Prestasi</h1>
        <p class="text-primary-100 mt-1">Dokumentasi prestasi dan pencapaian LDII Sumedang</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-10">

    {{-- FILTER KATEGORI --}}
    <div class="flex gap-2 flex-wrap mb-8">
        <a href="{{ route('portfolio.index') }}"
            class="px-4 py-1.5 rounded-full text-sm font-medium
           {{ !request('category') ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-primary-50' }}">
            Semua
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('portfolio.index', ['category' => $cat->id]) }}"
            class="px-4 py-1.5 rounded-full text-sm font-medium
           {{ request('category') == $cat->id ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-primary-50' }}">
            {{ $cat->category_name }}
        </a>
        @endforeach
    </div>

    {{-- GRID PORTFOLIO --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($portfolios as $portfolio)
        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group">
            {{-- PREVIEW FILE PERTAMA --}}
            @if($portfolio->files->first() && $portfolio->files->first()->file_type == 'image')
            <img src="{{ asset('storage/'.$portfolio->files->first()->file_path) }}"
                alt="{{ $portfolio->title }}"
                class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
            @else
            <div class="w-full h-48 bg-primary-50 flex items-center justify-center">
                <i class="fas fa-folder-open text-primary-300 text-5xl"></i>
            </div>
            @endif

            <div class="p-5">
                @if($portfolio->category)
                <span class="text-xs bg-primary-100 text-primary-700 px-2 py-0.5 rounded-full font-medium">
                    {{ $portfolio->category->category_name }}
                </span>
                @endif
                <h3 class="font-semibold text-gray-800 mt-2 mb-2">{{ $portfolio->title }}</h3>
                @if($portfolio->description)
                <p class="text-gray-500 text-sm line-clamp-2 mb-4">{{ $portfolio->description }}</p>
                @endif

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 text-sm text-gray-400">
                        <span><i class="fas fa-heart mr-1 text-red-400"></i>{{ $portfolio->likes->count() }}</span>
                        <span><i class="fas fa-file mr-1 text-blue-400"></i>{{ $portfolio->files->count() }} file</span>
                    </div>
                    <a href="{{ route('portfolio.show', $portfolio->id) }}"
                        class="text-primary-600 text-sm font-medium hover:text-primary-700">
                        Lihat →
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-16 text-gray-400">
            <i class="fas fa-folder-open text-5xl mb-4"></i>
            <p>Belum ada portfolio.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-8">{{ $portfolios->links() }}</div>
</div>

@endsection