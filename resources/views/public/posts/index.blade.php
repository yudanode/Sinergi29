@extends('layouts.app')

@section('title', 'Berita — LDII Sumedang')

@section('content')

{{-- PAGE HEADER --}}
<div class="bg-primary-700 text-white py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold">Berita & Informasi</h1>
        <p class="text-primary-100 mt-1">Update terkini dari LDII Sumedang</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- MAIN CONTENT --}}
        <div class="flex-1">

            {{-- FILTER KATEGORI --}}
            <div class="flex gap-2 flex-wrap mb-6">
                <a href="{{ route('posts.index') }}"
                    class="px-4 py-1.5 rounded-full text-sm font-medium
                   {{ !request('category') ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-primary-50' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('posts.index', ['category' => $cat->id]) }}"
                    class="px-4 py-1.5 rounded-full text-sm font-medium
                   {{ request('category') == $cat->id ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-primary-50' }}">
                    {{ $cat->category_name }}
                </a>
                @endforeach
            </div>

            {{-- DAFTAR BERITA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($posts as $post)
                <article class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group">
                    <a href="{{ route('posts.show', $post->slug) }}">
                        @if($post->thumbnail)
                        <img src="{{ asset('storage/'.$post->thumbnail) }}"
                            alt="{{ $post->title }}"
                            class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                        @else
                        <div class="w-full h-48 bg-primary-50 flex items-center justify-center">
                            <i class="fas fa-newspaper text-primary-300 text-4xl"></i>
                        </div>
                        @endif
                    </a>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            @if($post->category)
                            <span class="text-xs bg-primary-100 text-primary-700 px-2 py-0.5 rounded-full font-medium">
                                {{ $post->category->category_name }}
                            </span>
                            @endif
                            <span class="text-xs text-gray-400">
                                {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}
                            </span>
                        </div>
                        <h2 class="font-semibold text-gray-800 mb-2 line-clamp-2 hover:text-primary-700">
                            <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                        </h2>
                        <p class="text-gray-500 text-sm line-clamp-2 mb-4">
                            {{ Str::limit(strip_tags($post->content), 120) }}
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3 text-sm text-gray-400">
                                <span><i class="fas fa-heart mr-1 text-red-400"></i>{{ $post->likes->count() }}</span>
                                <span><i class="fas fa-comment mr-1 text-blue-400"></i>{{ $post->comments->count() }}</span>
                            </div>
                            <a href="{{ route('posts.show', $post->slug) }}"
                                class="text-primary-600 text-sm font-medium hover:text-primary-700">
                                Baca →
                            </a>
                        </div>
                    </div>
                </article>
                @empty
                <div class="col-span-2 text-center py-16 text-gray-400">
                    <i class="fas fa-newspaper text-5xl mb-4"></i>
                    <p class="text-lg">Belum ada berita.</p>
                </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>

        {{-- SIDEBAR --}}
        <aside class="lg:w-72 space-y-6">

            {{-- SEARCH --}}
            <div class="bg-white rounded-xl shadow-sm p-5">
                <h3 class="font-semibold text-gray-800 mb-3">Cari Berita</h3>
                <form action="{{ route('posts.index') }}" method="GET">
                    <div class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Kata kunci..."
                            class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-primary-500">
                        <button type="submit"
                            class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition">
                            <i class="fas fa-search text-sm"></i>
                        </button>
                    </div>
                </form>
            </div>

            {{-- BERITA TERPOPULER --}}
            <div class="bg-white rounded-xl shadow-sm p-5">
                <h3 class="font-semibold text-gray-800 mb-4">Berita Terpopuler</h3>
                <div class="space-y-4">
                    @foreach($popularPosts as $popular)
                    <a href="{{ route('posts.show', $popular->slug) }}" class="flex gap-3 group">
                        @if($popular->thumbnail)
                        <img src="{{ asset('storage/'.$popular->thumbnail) }}"
                            class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                        @else
                        <div class="w-16 h-16 bg-primary-50 rounded-lg flex-shrink-0 flex items-center justify-center">
                            <i class="fas fa-newspaper text-primary-300"></i>
                        </div>
                        @endif
                        <div>
                            <p class="text-sm font-medium text-gray-800 group-hover:text-primary-600 line-clamp-2">
                                {{ $popular->title }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
                                <i class="fas fa-heart mr-1 text-red-400"></i>{{ $popular->likes->count() }} likes
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

        </aside>
    </div>
</div>

@endsection