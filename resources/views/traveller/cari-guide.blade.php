@extends('layouts.app')

@section('content')
    <div class="container my-5">
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
        <h2 class="mb-4 text-center fw-bold fs-2">Cari Tour Guide</h2>

        <!-- Form Filter -->
        <form method="GET" action="{{ route('cari.guide') }}" class="row g-3 mb-5 justify-content-center">
            <div class="row g-3 mb-4">
                {{-- Domisili --}}
                <div class="col-md-4">
                    <label for="domisili" class="form-label">Domisili</label>
                    <input type="text" name="domisili_hpi" id="domisili_hpi" class="form-control shadow-sm"
                        placeholder="Cari domisili..." value="{{ request('domisili') }}">
                </div>

                {{-- Bidang Keahlian --}}
                <div class="col-md-3">
                    <label for="bidang_keahlian" class="form-label">Bidang Keahlian</label>
                    <select name="bidang_keahlian" id="bidang_keahlian" class="form-select shadow-sm">
                        <option value="">-- Semua Bidang --</option>
                        @foreach ($bidangs as $bidang)
                            <option value="{{ $bidang->id }}" {{ request('bidang_keahlian') == $bidang->id ? 'selected' : '' }}>
                                {{ $bidang->nama_bidang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tipe Keahlian --}}
                <div class="col-md-3">
                    <label for="tipe_keahlian" class="form-label">Tipe Keahlian</label>
                    <select name="tipe_keahlian" id="tipe_keahlian" class="form-select shadow-sm">
                        <option value="">-- Semua Tipe --</option>
                        @foreach ($tipes as $tipe)
                            <option value="{{ $tipe->id }}" {{ request('tipe_keahlian') == $tipe->id ? 'selected' : '' }}>
                                {{ $tipe->nama_tipe }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol Filter --}}
                <div class="col-md-2 d-grid align-self-end">
                    <button type="submit" class="btn btn-primary shadow-sm">Cari</button>
                </div>
            </div>

        </form>

        <!-- Kartu Tour Guide -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse ($tourGuides as $tourGuide)
                <div class="col">
                    <div class="card h-100 text-center border-0 shadow-lg rounded-4 p-4  hover-shadow">
                        <div class="d-flex justify-content-center mb-3">
                            <img src="{{ asset('storage/' . $tourGuide->foto) }}" class="rounded-circle shadow"
                                style="width: 130px; height: 130px; object-fit: cover; border: 5px solid #e9ecef;"
                                alt="Foto {{ $tourGuide->user->nama_lengkap }}">
                        </div>

                        <div class="card-body p-0">
                            <h5 class="fw-bold fs-4">{{ $tourGuide->user->nama_lengkap }}</h5>
                            <p class="mb-1 text-muted fs-6">{{ $tourGuide->usia ?? '-' }} tahun &bullet;
                                {{ $tourGuide->domisili_hpi }}</p>
                            <p class="small text-secondary fst-italic mt-2">{{ $tourGuide->alasan_profesi }}</p>
                        </div>

                        <div class="mt-4">
                            @auth
                                <a href="{{ route('booking.form', $tourGuide->id) }}"
                                    class="btn btn-primary w-100 rounded-pill fw-semibold shadow-sm">
                                    Ajukan Permintaan
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="btn btn-outline-secondary w-100 rounded-pill fw-semibold shadow-sm">
                                    Login untuk Booking
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">Tidak ada tour guide yang cocok dengan pencarian.</div>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .hover-shadow:hover {
            transform: translateY(-5px);
            transition: 0.3s ease;
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection