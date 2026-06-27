@extends('layouts.app')

@section('title', 'Kritik & Saran — LDII Sumedang')

@section('content')

<div class="bg-primary-700 text-white py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold">Kritik & Saran</h1>
        <p class="text-primary-100 mt-1">Sampaikan masukan Anda untuk LDII Sumedang</p>
    </div>
</div>

<div class="max-w-2xl mx-auto px-4 py-12">

    @if(session('success'))
    <div class="bg-green-50 border border-green-400 text-green-800 rounded-xl px-5 py-4 mb-6 flex items-center gap-3">
        <i class="fas fa-check-circle text-green-500 text-xl"></i>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-envelope text-primary-600 text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Kirim Pesan</h2>
            <p class="text-gray-500 mt-1 text-sm">Pendapat Anda sangat berarti bagi kami</p>
        </div>

        <form action="{{ route('feedback.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                <input type="text" name="sender_name" value="{{ old('sender_name') }}"
                    placeholder="Masukkan nama Anda"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 @error('sender_name') border-red-400 @enderror"
                    required>
                @error('sender_name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                <input type="email" name="sender_email" value="{{ old('sender_email') }}"
                    placeholder="nama@email.com"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 @error('sender_email') border-red-400 @enderror"
                    required>
                @error('sender_email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Pesan</label>
                <textarea name="message" rows="5"
                    placeholder="Tulis kritik, saran, atau masukan Anda..."
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 resize-none @error('message') border-red-400 @enderror"
                    required>{{ old('message') }}</textarea>
                @error('message')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-primary-600 text-white py-3 rounded-xl font-semibold hover:bg-primary-700 transition flex items-center justify-center gap-2">
                <i class="fas fa-paper-plane"></i>
                Kirim Pesan
            </button>
        </form>
    </div>
</div>

@endsection