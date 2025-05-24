@extends('layouts.main') <!-- Layout utama dengan navbar & footer -->

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Total Tour Guide</h3>
        <a href="{{ route ('admin.dashboard') }}" class="text-decoration-none">&larr; Kembali</a>
    </div>

    <div class="card p-3">
        @foreach ($tourGuides as $guide)
    <div class="d-flex align-items-center py-3 border-bottom">
        <img src="{{ asset('storage/' . $guide->foto) }}" class="rounded-circle me-3" width="60" height="60" alt="Foto">
        <div>
            <h5 class="mb-0 fw-semibold">{{ $guide->user->nama_lengkap }}</h5>
            <small class="text-muted">
                {{ ucfirst($guide->status_verifikasi) }} &mdash; {{ $guide->domisili_hpi }}
            </small>
        </div>
    </div>
@endforeach
    </div>

</div>
@endsection
