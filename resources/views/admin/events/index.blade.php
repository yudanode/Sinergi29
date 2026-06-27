@extends('layouts.admin')

@section('title', 'Kelola Event')
@section('page-title', 'Kelola Event')

@section('breadcrumb')
<li class="breadcrumb-item active">Event</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Daftar Event</h3>
        <a href="{{ route('admin.event.create') }}" class="btn btn-success btn-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Event
        </a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Lokasi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $event->title }}</strong></td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->start_date->format('d M Y H:i') }}</td>
                    <td>{{ $event->end_date->format('d M Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.event.edit', $event->id) }}"
                            class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.event.destroy', $event->id) }}"
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Hapus event ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-xs">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada event.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">{{ $events->links() }}</div>
    </div>
</div>
@endsection