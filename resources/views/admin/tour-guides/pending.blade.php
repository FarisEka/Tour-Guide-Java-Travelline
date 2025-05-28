@extends('layouts.main')

@section('content')
<div class="container py-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 fw-bold text-dark">Menunggu Verifikasi</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-primary text-decoration-none">
            ← Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="list-group list-group-flush">
            @forelse ($pendingGuides as $guide)
    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
        <div class="d-flex align-items-center">
            <img src="{{ asset('storage/' . $guide->foto) }}" alt="{{ $guide->user->nama_lengkap }}" class="rounded-circle me-3" width="56" height="56" style="object-fit: cover;">
            <div>
                <h5 class="mb-0">{{ $guide->user->nama_lengkap }}</h5>
                <small class="text-muted">{{ $guide->domisili_hpi }}</small>
            </div>
        </div>
        <a href="{{ route('admin.tour-guides.detail', $guide->id) }}" class="btn btn-primary btn-sm">
            Detail
        </a>
    </div>
@empty
    <div class="list-group-item py-4 text-center text-muted">
        Tidak ada data tour guide yang menunggu verifikasi.
    </div>
@endforelse
        </div>
    </div>
</div>
@endsection