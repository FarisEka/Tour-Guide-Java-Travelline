@extends('layouts.main')

@section('content')
<div class="container py-4">

    {{-- Ringkasan --}}
    <div class="row mb-5">
        <div class="col-md-3 mb-3">
            <a href="{{ route('admin.tour-guides.index') }}" class="text-decoration-none">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="small">Total Tour Guide</div>
                        <div class="h4 fw-bold">{{ $totalGuides }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('admin.tour-guides.pending') }}" class="text-decoration-none">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <div class="small">Menunggu Verifikasi</div>
                    <div class="h4 fw-bold">{{ $pendingGuides }}</div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('admin.tour-guides.terverifikasi') }}" class="text-decoration-none">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="small">Terverifikasi</div>
                    <div class="h4 fw-bold">{{ $verifiedGuides }}</div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('admin.tour-guides.total-booking') }}" class="text-decoration-none">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <div class="small">Total Booking</div>
                    <div class="h4 fw-bold">{{ $totalBookings }}</div>
                </div>
            </div>
            </a>
        </div>
    </div>

    {{-- Tour Guide Terbaru --}}
    <div class="card">
        <div class="card-header fw-semibold">Tour Guide Terbaru</div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-light">
                    <tr class="small text-muted">
                        <th>No</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestGuides as $index => $guide)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $guide->nama_lengkap }}</td>
                        <td>{{ $guide->no_telepon }}</td>
                        <td>
                            @if ($guide->status_verifikasi === 'terverifikasi')
                                <span class="badge bg-success">Terverifikasi</span>
                            @else
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Belum ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
