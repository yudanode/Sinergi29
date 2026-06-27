@extends('layouts.admin')

@section('title', 'Edit Event')
@section('page-title', 'Edit Event')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.event.index') }}">Event</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Judul Event</label>
                        <input type="text" name="title" value="{{ old('title', $event->title) }}"
                            class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" rows="5" class="form-control" required>{{ old('description', $event->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $event->location) }}"
                            class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="datetime-local" name="start_date"
                            value="{{ old('start_date', $event->start_date->format('Y-m-d\TH:i')) }}"
                            class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="datetime-local" name="end_date"
                            value="{{ old('end_date', $event->end_date->format('Y-m-d\TH:i')) }}"
                            class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Poster</label>
                        @if($event->poster)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$event->poster) }}"
                                class="img-thumbnail" style="max-height:120px">
                        </div>
                        @endif
                        <input type="file" name="poster" class="form-control-file" accept="image/*">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save mr-1"></i> Update
            </button>
            <a href="{{ route('admin.event.index') }}" class="btn btn-secondary ml-2">Batal</a>
        </form>
    </div>
</div>
@endsection