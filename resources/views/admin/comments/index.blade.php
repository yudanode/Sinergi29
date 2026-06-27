@extends('layouts.admin')
@section('title', 'Kelola Komentar')
@section('page-title', 'Kelola Komentar')
@section('breadcrumb')
<li class="breadcrumb-item active">Komentar</li>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Berita</th>
                    <th>Komentar</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $comment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $comment->user->full_name ?? '-' }}</td>
                    <td>{{ Str::limit($comment->post->title ?? '-', 40) }}</td>
                    <td>{{ $comment->comment_text }}</td>
                    <td>{{ $comment->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.komentar.destroy', $comment->id) }}"
                            method="POST" onsubmit="return confirm('Hapus komentar?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-xs">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada komentar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $comments->links() }}
    </div>
</div>
@endsection