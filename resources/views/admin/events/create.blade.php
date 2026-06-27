@extends('layouts.admin')

@section('title', 'Tambah Event')
@section('page-title', 'Tambah Event')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.event.index') }}">Event</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Judul Event <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="form-control @error('title') is-invalid @enderror" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="description" rows="5"
                            class="form-control @error('description') is-invalid @enderror"
                            required>{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Lokasi <span class="text-danger">*</span></label>
                        <input type="text" name="location" value="{{ old('location') }}"
                            class="form-control @error('location') is-invalid @enderror" required>
                        @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="start_date" value="{{ old('start_date') }}"
                            class="form-control @error('start_date') is-invalid @enderror" required>
                        @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="end_date" value="{{ old('end_date') }}"
                            class="form-control @error('end_date') is-invalid @enderror" required>
                        @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Poster</label>
                        <input type="file" name="poster" class="form-control-file" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG. Maks 2MB</small>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save mr-1"></i> Simpan
            </button>
            <a href="{{ route('admin.event.index') }}" class="btn btn-secondary ml-2">Batal</a>
        </form>
    </div>
</div>
@endsection