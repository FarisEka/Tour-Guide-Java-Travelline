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
                        <li class="nav-item mb-3">
                            <a href="{{ route('riwayat') }}"
                                class="nav-link text-dark d-flex align-items-center {{ request()->routeIs('riwayat') ? 'active fw-bold bg-light rounded' : '' }}">
                                <i class="bi bi-clock-history me-2"></i> Riwayat
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
                                <input type="text" name="nama_lengkap" class="form-control"
                                    value="{{ $profile->user->nama_lengkap }}">
                            </div>
                            <div class="col-md-6">
                                <label>Usia</label>
                                <input type="number" name="usia" class="form-control" value="{{ $profile->usia }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control"
                                    value="{{ $profile->tanggal_lahir }}">
                            </div>
                            <div class="col-md-6">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control"
                                    value="{{ $profile->tempat_lahir }}">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control" value="{{ $profile->alamat }}">
                            </div>
                            <div class="col-md-6">
                                <label>Domisili HPI</label>
                                <input type="text" name="domisili_hpi" class="form-control"
                                    value="{{ $profile->domisili_hpi }}">
                            </div>
                        </div>



                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>No Lisensi</label>
                                <input type="text" name="lisensi" class="form-control" value="{{ $profile->no_lisensi }}">
                            </div>
                            <div class="col-md-6">
                                <label>Tanggal Aktif Lisensi</label>
                                <input type="date" name="tanggal_aktif_lisensi" class="form-control"
                                    value="{{ $profile->tanggal_aktif_lisensi }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Bahasa</label>
                                <input type="text" name="bahasa" class="form-control" value="{{ $profile->bahasa }}">
                            </div>
                            <div class="col-md-6">
                                <label>Sertifikasi Bahasa</label>
                                <input type="text" name="sertifikasi_bahasa" class="form-control"
                                    value="{{ $profile->sertifikasi_bahasa }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>No Telepon</label>
                                <input type="text" name="no_telepon" class="form-control"
                                    value="{{ $profile->no_telepon }}">
                            </div>
                            <div class="col-md-6">
                                <label class="d-block">Waktu Guiding</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="waktu_guiding" id="penuh_waktu"
                                        value="penuh waktu" {{ $profile->waktu_guiding == 'penuh waktu' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="penuh_waktu">Penuh Waktu</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="waktu_guiding" id="setiap_weekend"
                                        value="setiap weekend" {{ $profile->waktu_guiding == 'setiap weekend' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="setiap_weekend">Setiap Weekend</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Alasan Profesi Tour Guide</label>
                            <textarea name="alasan_profesi" class="form-control"
                                rows="3">{{ $profile->alasan_profesi }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label>Foto Profil</label>
                            <input type="file" name="foto" class="form-control">
                            @if ($profile->foto)
                                <small class="d-block mt-1">Foto saat ini: <img src="{{ asset('storage/' . $profile->foto) }}"
                                        width="100"></small>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
@endsection