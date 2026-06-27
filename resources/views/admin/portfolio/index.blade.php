@extends('layouts.admin')

@section('title', 'Kelola Portfolio')
@section('page-title', 'Kelola Portfolio')

@section('breadcrumb')
<li class="breadcrumb-item active">Portfolio</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Daftar Portfolio</h3>
        <a href="{{ route('admin.portfolio.create') }}" class="btn btn-success btn-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Portfolio
        </a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Jumlah File</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($portfolios as $portfolio)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $portfolio->title }}</strong></td>
                    <td>{{ $portfolio->category->category_name ?? '-' }}</td>
                    <td>{{ $portfolio->files->count() }} file</td>
                    <td>{{ $portfolio->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.portfolio.edit', $portfolio->id) }}"
                            class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.portfolio.destroy', $portfolio->id) }}"
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Hapus portfolio ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-xs">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada portfolio.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">{{ $portfolios->links() }}</div>
    </div>
</div>
@endsection