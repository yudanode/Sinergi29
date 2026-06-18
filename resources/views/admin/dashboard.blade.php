@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalPosts ?? 0 }}</h3>
                <p>Total Berita</p>
            </div>
            <div class="icon"><i class="fas fa-newspaper"></i></div>
            <a href="{{ route('admin.berita.index') }}" class="small-box-footer">
                Selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalEvents ?? 0 }}</h3>
                <p>Total Event</p>
            </div>
            <div class="icon"><i class="fas fa-calendar-alt"></i></div>
            <a href="{{ route('admin.event.index') }}" class="small-box-footer">
                Selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalPortfolios ?? 0 }}</h3>
                <p>Total Portfolio</p>
            </div>
            <div class="icon"><i class="fas fa-folder-open"></i></div>
            <a href="{{ route('admin.portfolio.index') }}" class="small-box-footer">
                Selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $totalComments ?? 0 }}</h3>
                <p>Total Komentar</p>
            </div>
            <div class="icon"><i class="fas fa-comments"></i></div>
            <a href="{{ route('admin.komentar.index') }}" class="small-box-footer">
                Selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
@endsection