@extends('layouts.main')

@section('content')
    <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-4 fw-bold">Total Booking</h2>
        <a href="{{ route ('admin.dashboard') }}" class="text-decoration-none">&larr; Kembali</a>
        </div>

        <!-- Filter -->
        <form method="GET" class="row g-2 mb-4">
            <div class="col-md-4">
                <input type="text" name="traveller" value="{{ request('traveller') }}" class="form-control" placeholder="Cari nama traveller...">
            </div>
            <div class="col-md-4">
                <input type="text" name="guide" value="{{ request('guide') }}" class="form-control" placeholder="Cari nama tour guide...">
            </div>
            <div class="col-md-3">
                <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="form-control">
            </div>
            <div class="col-md-1">
        <button class="btn btn-primary w-100" type="submit">Cari</button>
    </div>
        </form>

        <!-- Table -->
        <div class="table-responsive rounded shadow-sm bg-white">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Traveller</th>
                        <th>Tour Guide</th>
                        <th>Tanggal</th>
                        <th>Durasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $booking->nama_traveller }}</div>
                                <div class="text-muted small">{{ $booking->email }}</div>
                            </td>
                            <td>{{ $booking->tourGuide->user->nama_lengkap ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->translatedFormat('F d, Y') }}</td>
                            <td>{{ $booking->durasi_hari }} hari</td>
                            <td>
                                @php
                                    $status = strtolower($booking->status);
                                    $badgeClass = match($status) {
                                        'pending' => 'bg-warning text-dark',
                                        'disetujui' => 'bg-success',
                                        'ditolak' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada data booking.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
