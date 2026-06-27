@extends('layouts.app')

@section('title', $post->title . ' — LDII Sumedang')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-10">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- ARTIKEL --}}
        <article class="flex-1">
            {{-- BREADCRUMB --}}
            <nav class="text-sm text-gray-400 mb-4">
                <a href="{{ route('home') }}" class="hover:text-primary-600">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('posts.index') }}" class="hover:text-primary-600">Berita</a>
                <span class="mx-2">/</span>
                <span class="text-gray-600">{{ Str::limit($post->title, 40) }}</span>
            </nav>

            {{-- KATEGORI & TANGGAL --}}
            <div class="flex items-center gap-3 mb-3">
                @if($post->category)
                <span class="bg-primary-100 text-primary-700 text-xs px-3 py-1 rounded-full font-medium">
                    {{ $post->category->category_name }}
                </span>
                @endif
                <span class="text-gray-400 text-sm">
                    <i class="fas fa-calendar mr-1"></i>
                    {{ $post->published_at ? $post->published_at->format('d F Y') : $post->created_at->format('d F Y') }}
                </span>
            </div>

            {{-- JUDUL --}}
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

            {{-- PENULIS --}}
            <div class="flex items-center gap-3 mb-6 pb-6 border-b">
                <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-primary-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-800">{{ $post->user->full_name }}</p>
                    <p class="text-xs text-gray-400">Penulis</p>
                </div>
            </div>

            {{-- THUMBNAIL --}}
            @if($post->thumbnail)
            <div class="w-full bg-gray-50 rounded-xl mb-6 flex items-center justify-center max-h-[600px] overflow-hidden">
                <img src="{{ asset('storage/'.$post->thumbnail) }}"
                    alt="{{ $post->title }}"
                    class="max-w-full max-h-[600px] object-contain">
            </div>
            @endif

            {{-- KONTEN --}}
            <div class="prose prose-green max-w-none text-gray-700 leading-relaxed">
                {!! $post->content !!}
            </div>

            {{-- LIKE BUTTON --}}
            <div class="mt-8 pt-6 border-t flex items-center gap-4">
                @auth
                <form action="{{ route('like.toggle', ['type' => 'post', 'id' => $post->id]) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 px-5 py-2 rounded-full border-2
                            {{ $post->likes->where('user_id', auth()->id())->count() ? 'bg-red-50 border-red-400 text-red-500' : 'border-gray-200 text-gray-500 hover:border-red-400 hover:text-red-500' }}
                            transition">
                        <i class="fas fa-heart"></i>
                        <span>{{ $post->likes->count() }} Suka</span>
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}"
                    class="flex items-center gap-2 px-5 py-2 rounded-full border-2 border-gray-200 text-gray-500 hover:border-red-400 hover:text-red-500 transition">
                    <i class="fas fa-heart"></i>
                    <span>{{ $post->likes->count() }} Suka</span>
                </a>
                @endauth
            </div>

            {{-- KOMENTAR --}}
            <div class="mt-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6">
                    Komentar ({{ $post->comments->count() }})
                </h3>

                @auth
                <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-8">
                    @csrf
                    <textarea name="comment_text" rows="3"
                        placeholder="Tulis komentar kamu..."
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-primary-500 resize-none"
                        required></textarea>
                    <button type="submit"
                        class="mt-2 bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition text-sm font-medium">
                        Kirim Komentar
                    </button>
                </form>
                @else
                <div class="bg-gray-50 rounded-xl p-4 mb-8 text-center">
                    <p class="text-gray-500 text-sm">
                        <a href="{{ route('login') }}" class="text-primary-600 font-medium">Login</a>
                        untuk memberikan komentar.
                    </p>
                </div>
                @endauth

                <div class="space-y-4">
                    @forelse($post->comments()->with('user')->latest()->get() as $comment)
                    <div class="flex gap-3">
                        <div class="w-9 h-9 bg-primary-100 rounded-full flex-shrink-0 flex items-center justify-center">
                            <i class="fas fa-user text-primary-600 text-sm"></i>
                        </div>
                        <div class="flex-1 bg-gray-50 rounded-xl px-4 py-3">
                            <div class="flex justify-between items-start">
                                <p class="font-medium text-sm text-gray-800">{{ $comment->user->full_name }}</p>
                                <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">{{ $comment->comment_text }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-gray-400 py-4">Belum ada komentar.</p>
                    @endforelse
                </div>
            </div>
        </article>

        {{-- SIDEBAR --}}
        <aside class="lg:w-64 space-y-6">
            <div class="bg-white rounded-xl shadow-sm p-5 sticky top-20">
                <h3 class="font-semibold text-gray-800 mb-4">Berita Lainnya</h3>
                <div class="space-y-4">
                    @foreach($relatedPosts as $related)
                    <a href="{{ route('posts.show', $related->slug) }}" class="flex gap-3 group">
                        @if($related->thumbnail)
                        <img src="{{ asset('storage/'.$related->thumbnail) }}"
                            class="w-14 h-14 object-cover rounded-lg flex-shrink-0">
                        @else
                        <div class="w-14 h-14 bg-primary-50 rounded-lg flex-shrink-0 flex items-center justify-center">
                            <i class="fas fa-newspaper text-primary-300 text-sm"></i>
                        </div>
                        @endif
                        <p class="text-sm text-gray-700 group-hover:text-primary-600 line-clamp-3">
                            {{ $related->title }}
                        </p>
                    </a>
                    @endforeach
                </div>
            </div>
        </aside>

    </div>
</div>

@endsection