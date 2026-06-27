@extends('layouts.admin')

@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.berita.index') }}">Berita</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.berita.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}"
                            class="form-control @error('title') is-invalid @enderror" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Konten</label>
                        <textarea name="content" id="content" class="form-control" rows="10">{{ old('content', $post->content) }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category_id" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $post->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Thumbnail</label>
                        @if($post->thumbnail)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$post->thumbnail) }}"
                                class="img-thumbnail" style="max-height:120px">
                        </div>
                        @endif
                        <input type="file" name="thumbnail" class="form-control-file" accept="image/*">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah</small>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save mr-1"></i> Update
                </button>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary ml-2">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
<script>
    $('#content').summernote({
        height: 300
    });
</script>
@endsection