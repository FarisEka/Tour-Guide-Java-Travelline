@extends('layouts.main')

@section('content')
<div class="container py-4">
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
                        <img src="{{ $guide->photo_url }}" alt="{{ $guide->name }}" class="rounded-circle me-3" width="56" height="56" style="object-fit: cover;">
                        <div>
                            <h5 class="mb-0">{{ $guide->name }}</h5>
                            <small class="text-muted">{{ $guide->city }}</small>
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