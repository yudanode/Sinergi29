@extends('layouts.admin')

@section('title', 'Tambah Portfolio')
@section('page-title', 'Tambah Portfolio')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.portfolio.index') }}">Portfolio</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Judul Portfolio <span class="text-danger">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="form-control @error('title') is-invalid @enderror" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->category_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label>Upload File <small class="text-muted">(Bisa lebih dari satu)</small></label>
                <input type="file" name="files[]" class="form-control-file" multiple accept="image/*,.pdf,.doc,.docx">
                <small class="text-muted">Format: JPG, PNG, PDF, DOC. Maks 5MB per file</small>
            </div>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save mr-1"></i> Simpan
            </button>
            <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary ml-2">Batal</a>
        </form>
    </div>
</div>
@endsection