@extends('layouts.admin')

@section('title', 'Edit Portfolio')
@section('page-title', 'Edit Portfolio')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.portfolio.index') }}">Portfolio</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Judul Portfolio</label>
                <input type="text" name="title" value="{{ old('title', $portfolio->title) }}"
                    class="form-control" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $portfolio->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->category_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description', $portfolio->description) }}</textarea>
            </div>
            {{-- FILE EXISTING --}}
            @if($portfolio->files->count() > 0)
            <div class="form-group">
                <label>File yang Ada</label>
                <div class="row">
                    @foreach($portfolio->files as $file)
                    <div class="col-md-2 mb-2 text-center">
                        @if($file->file_type == 'image')
                        <img src="{{ asset('storage/'.$file->file_path) }}"
                            class="img-thumbnail" style="height:80px;object-fit:cover">
                        @else
                        <i class="fas fa-file-pdf text-danger fa-2x"></i>
                        @endif
                        <form action="{{ route('admin.galeri.destroy', $file->id) }}"
                            method="POST" onsubmit="return confirm('Hapus file ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-xs mt-1">Hapus</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            <div class="form-group">
                <label>Tambah File Baru</label>
                <input type="file" name="files[]" class="form-control-file" multiple accept="image/*,.pdf">
            </div>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save mr-1"></i> Update
            </button>
            <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary ml-2">Batal</a>
        </form>
    </div>
</div>
@endsection