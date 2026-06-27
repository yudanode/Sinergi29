@extends('layouts.admin')

@section('title', 'Kelola Berita')
@section('page-title', 'Kelola Berita')

@section('breadcrumb')
<li class="breadcrumb-item active">Berita</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Daftar Berita</h3>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-success btn-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Berita
        </a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th width="5%">#</th>
                    <th>Judul</th>
                    <th width="15%">Kategori</th>
                    <th width="10%">Status</th>
                    <th width="15%">Tanggal</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <strong>{{ $post->title }}</strong>
                        <br><small class="text-muted">{{ Str::limit(strip_tags($post->content), 60) }}</small>
                    </td>
                    <td>{{ $post->category->category_name ?? '-' }}</td>
                    <td>
                        @if($post->status == 'published')
                        <span class="badge badge-success">Published</span>
                        @else
                        <span class="badge badge-warning">Draft</span>
                        @endif
                    </td>
                    <td>{{ $post->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.berita.edit', $post->id) }}"
                            class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.berita.destroy', $post->id) }}"
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Hapus berita ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-xs">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada berita.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">{{ $posts->links() }}</div>
    </div>
</div>
@endsection