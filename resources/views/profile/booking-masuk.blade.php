@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        

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
                        <a href="#"
                            class="nav-link text-dark d-flex align-items-center {{ request()->routeIs('profile.edit-biodata') ? 'active fw-bold bg-light rounded' : '' }}">
                            <i class="bi bi-pencil me-2"></i> Edit Biodata
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('booking.masuk') }}"
                            class="nav-link text-dark d-flex align-items-center {{ request()->routeIs('booking.masuk') ? 'active fw-bold bg-light rounded' : '' }}">
                            <i class="bi bi-journal-text me-2"></i> Booking Masuk
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Main Content --}}
            <div class="col-md-9 p-5">
                <h2 class="fw-bold mb-3">Booking Masuk</h2>
                <p class="text-muted mb-4">Kelola dan konfirmasi permintaan booking dari traveller di halaman ini.</p>

                {{-- Tabel Booking --}}
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Traveller</th>
                                <th>Tanggal</th>
                                <th>Durasi</th>
                                <th>No hp</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $index => $booking)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $booking->nama_traveller }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d-m-Y') }}</td>
                                    <td>{{ $booking->durasi_hari }} hari</td>
                                    <td>{{ $booking->no_hp }}</td> {{-- Catatan belum tersedia di tabel, bisa ditambahkan nanti
                                    --}}
                                    <td class="d-flex">
                                        <form action="{{ route('booking.setujui', $booking->id) }}" method="POST" class="me-2">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm"
                                                onclick="return confirm('Yakin ingin menyetujui booking ini?')">Terima</button>
                                        </form>

                                        <form action="{{ route('booking.tolak', $booking->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menolak booking ini?')">Tolak</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada booking masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection