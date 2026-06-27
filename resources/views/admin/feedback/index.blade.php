@extends('layouts.admin')
@section('title', 'Kritik & Saran')
@section('page-title', 'Kritik & Saran')
@section('breadcrumb')
<li class="breadcrumb-item active">Kritik & Saran</li>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Pesan</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedbacks as $feedback)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $feedback->sender_name }}</td>
                    <td>{{ $feedback->sender_email }}</td>
                    <td>{{ Str::limit($feedback->message, 80) }}</td>
                    <td>{{ $feedback->created_at->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('admin.feedback.destroy', $feedback->id) }}"
                            method="POST" onsubmit="return confirm('Hapus feedback?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-xs">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada feedback.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $feedbacks->links() }}
    </div>
</div>
@endsection