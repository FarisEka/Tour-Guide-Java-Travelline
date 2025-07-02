@extends('layouts.main')

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

        <div class="d-flex justify-content-between align-items-center mb-1">
            <h2>Detail Verifikasi</h2>

            <div>
                <form action="{{ route('admin.tour-guides.verify', $guide->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Verifikasi</button>
                </form>
                <!-- Tombol Tolak -->
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                    Tolak
                </button>

                <!-- Modal Penolakan -->
                <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('admin.tour-guides.reject', $guide->id) }}" method="POST"
                            class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="rejectModalLabel">Alasan Penolakan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="keterangan_penolakan" class="form-label">Tuliskan alasan penolakan</label>
                                    <textarea name="keterangan_penolakan" class="form-control" rows="4"
                                        placeholder="Contoh: Tidak memenuhi kriteria..." required></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="mb-4">
            <p><strong>Status Verifikasi:</strong> {{ ucfirst($guide->status_verifikasi) }}</p>
        </div>

        <div class="card p-4 shadow-sm">
            <div class="row mb-4">
                <div class="col-md-2">
                    <img src="{{ asset('storage/' . $guide->foto) }}" alt="{{ $guide->user->nama_lengkap }}"
                        class="img-fluid rounded-circle">
                </div>
                <div class="col-md-10">
                    <h4><strong>{{ $guide->user->nama_lengkap }}</strong></h4>
                    <p><strong>Alamat:</strong> {{ $guide->alamat }}</p>
                    <p><strong>Usia:</strong> {{ \Carbon\Carbon::parse($guide->usia)->age }} tahun</p>
                    <p><strong>Tempat, Tanggal Lahir:</strong> {{ $guide->tempat_lahir }},
                        {{ \Carbon\Carbon::parse($guide->tanggal_lahir)->format('d M Y') }}
                    </p>
                    <p><strong>Nomor Telepon:</strong> {{ $guide->no_telepon }}</p>
                    <p><strong>Domisili HPI:</strong> {{ $guide->domisili_hpi }}</p>
                    <p><strong>Nomor Lisensi:</strong> {{ $guide->no_lisensi }}</p>
                    <p><strong>Tanggal Aktif Lisensi:</strong>
                        {{ \Carbon\Carbon::parse($guide->tanggal_aktif_lisensi)->format('d M Y') }}</p>
                    <p><strong>Waktu Guiding:</strong> {{ $guide->waktu_guiding }}</p>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Bidang Keahlian:</strong> {{ $guide->bidangKeahlian->pluck('nama_bidang')->join(', ') }}</p>
                    <p><strong>Tipe Keahlian:</strong> {{ $guide->tipeKeahlian->pluck('nama_tipe')->join(', ') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Jumlah tamu max yang pernah dibawa:</strong> {{ $guide->jumlah_tamu_max }} Orang</p>
                    <p><strong>Pengalaman:</strong> {{ $guide->lama_bertugas }} tahun</p>
                </div>
            </div>

            <hr>

            <p><strong>Destinasi wisata paling sering dikunjungi:</strong> {{ $guide->destinasi_sering }}</p>
            <p><strong>Alasan memilih profesi Tour Guide:</strong> {{ $guide->alasan_profesi }}</p>
            <p><strong>Pernah mengikuti pelatihan Pemandu Wisata? tolong sebutkan!:</strong> {{ $guide->pelatihan }}</p>
            <p><strong>Sebutkan Travel agensi yang pernah bekerja sama:</strong> {{ $guide->travel_agency }}</p>
            <p><strong>Pengalaman paling berkesan selama menjadi tour guide:</strong> {{ $guide->pengalaman_berkesan }}</p>
            <p><strong>Apakah Anda pernah memiliki pengalaman membawa tamu yang memiliki banyak permintaan dan selalu
                    komplain?:</strong> {{ $guide->pengalaman_komplain }}</p>
            <p><strong>Bagaimana Anda menyikapi komplain dari tamu tersebut?:</strong> {{ $guide->menyikapi_komplain }}</p>
            <p><strong>Bagaimana Anda menyiasati agar tour tetap berjalan dengan lancar meskipun sudah terdeteksi potensi
                    hambatan sejak awal?:</strong> {{ $guide->menyiasati_hambatan }}</p>
            <p><strong>Di masa depan rencana apa yang telah Anda siapkan untuk meningkatkan layanan Anda sebagai tour
                    guide?:</strong> {{ $guide->rencana_meningkatkan_layanan }}</p>

        </div>
    </div>
@endsection