@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-md-3 bg-white p-4 border-end min-vh-100">
            <ul class="nav flex-column">
                <li class="nav-item mb-3">
                    <a href="{{ route('home') }}" class="nav-link text-dark d-flex align-items-center">
                        <i class="bi bi-house-door me-2"></i> Home
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a href="{{ route('profile.edit-biodata') }}"
                        class="nav-link text-dark d-flex align-items-center {{ request()->routeIs('profile.edit-biodata') ? 'active fw-bold bg-light rounded' : '' }}">
                        <i class="bi bi-pencil me-2"></i> Edit Biodata
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a href="{{ route('booking.masuk') }}"
                        class="nav-link text-dark d-flex align-items-center {{ request()->routeIs('booking.masuk') ? 'active fw-bold bg-light rounded' : '' }}">
                        <i class="bi bi-journal-text me-2"></i> Booking Masuk
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a href="{{ route('riwayat') }}"
                        class="nav-link text-dark d-flex align-items-center {{ request()->routeIs('riwayat') ? 'active fw-bold bg-light rounded' : '' }}">
                        <i class="bi bi-clock-history me-2"></i> Riwayat
                    </a>
                </li>
            </ul>
        </div>

        {{-- Main Content --}}
        <div class="col-md-9 p-5">
            <h3 class="fw-bold mb-4">Riwayat Penolakan</h3>

            {{-- Riwayat Pendaftaran --}}
            <h5 class="mb-3">Pendaftaran Tour Guide yang Ditolak</h5>
            <table class="table table-bordered mb-5">
                <thead class="table-light">
                    <tr>
                        <th>Status Verifikasi</th>
                        <th>Alasan Penolakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayatPendaftaran as $item)
                        <tr>
                            <td>{{ $item->status_verifikasi }}</td>
                            <td>{{ $item->keterangan_penolakan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center">Tidak ada riwayat penolakan pendaftaran.</td></tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Riwayat Booking --}}
            <h5 class="mb-3">Booking yang Ditolak</h5>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Nama Guide</th>
                        <th>Tanggal Booking</th>
                        <th>Durasi</th>
                        <th>Alasan Penolakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayatBooking as $booking)
                        <tr>
                            <td>{{ $booking->tourGuide->user->nama_lengkap ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d-m-Y') }}</td>
                            <td>{{ $booking->durasi_hari }} hari</td>
                            <td>{{ $booking->keterangan_penolakan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">Tidak ada riwayat booking ditolak.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
