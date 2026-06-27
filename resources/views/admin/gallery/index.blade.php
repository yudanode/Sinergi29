@extends('layouts.admin')
@section('title', 'Galeri')
@section('page-title', 'Galeri')
@section('breadcrumb')
<li class="breadcrumb-item active">Galeri</li>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            @forelse($files as $file)
            <div class="col-md-2 mb-3 text-center">
                @if($file->file_type == 'image')
                <a href="{{ asset('storage/'.$file->file_path) }}" target="_blank">
                    <img src="{{ asset('storage/'.$file->file_path) }}"
                        class="img-thumbnail" style="height:100px;object-fit:cover;width:100%">
                </a>
                @else
                <div class="border rounded p-3">
                    <i class="fas fa-file-pdf text-danger fa-3x"></i>
                </div>
                @endif
                <small class="text-muted d-block mt-1">{{ $file->portfolio->title ?? '-' }}</small>
                <form action="{{ route('admin.galeri.destroy', $file->id) }}"
                    method="POST" onsubmit="return confirm('Hapus file?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-xs mt-1">Hapus</button>
                </form>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-4">Belum ada file.</div>
            @endforelse
        </div>
        {{ $files->links() }}
    </div>
</div>
@endsection