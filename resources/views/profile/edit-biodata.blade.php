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
                    <li class="nav-item">
                        <a href="{{ route('booking.masuk') }}"
                            class="nav-link text-dark d-flex align-items-center {{ request()->routeIs('booking.masuk') ? 'active fw-bold bg-light rounded' : '' }}">
                            <i class="bi bi-journal-text me-2"></i> Booking Masuk
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Form Biodata --}}
            <div class="col-md-9 p-5">
                <h2 class="fw-bold mb-4">Edit Biodata</h2>

                <form action="{{ route('profile.update-biodata') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" value="{{ $profile->user->nama_lengkap }}">
                        </div>
                        <div class="col-md-6">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $profile->tanggal_lahir }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{ $profile->alamat }}">
                        </div>
                        <div class="col-md-6">
                            <label>Domisili HPI</label>
                            <input type="text" name="domisili_hpi" class="form-control" value="{{ $profile->domisili_hpi }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ $profile->tempat_lahir }}">
                        </div>
                        <div class="col-md-6">
                            <label>Lisensi</label>
                            <input type="text" name="lisensi" class="form-control" value="{{ $profile->no_lisensi }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Bahasa</label>
                            <input type="text" name="bahasa" class="form-control" value="{{ $profile->bahasa }}">
                        </div>
                        <div class="col-md-6">
                            <label>Sertifikasi Bahasa</label>
                            <input type="text" name="sertifikasi_bahasa" class="form-control" value="{{ $profile->sertifikasi_bahasa }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Alasan Profesi Tour Guide</label>
                        <textarea name="alasan_profesi" class="form-control" rows="3">{{ $profile->alasan_profesi }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label>Foto Profil</label>
                        <input type="file" name="foto" class="form-control">
                        @if ($profile->foto)
                            <small class="d-block mt-1">Foto saat ini: <img src="{{ asset('storage/' . $profile->foto) }}" width="100"></small>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
