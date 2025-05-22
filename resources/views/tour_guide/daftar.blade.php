@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-5 text-center fw-bold fs-3">Form Pendaftaran Tour Guide</h2>

    <form action="{{ route('tour-guide.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-lg border-0 rounded-4">
        @csrf

        {{-- Nama Lengkap --}}
        <div class="mb-4">
            <label for="nama_lengkap" class="form-label fw-semibold ">Nama Lengkap</label>
            <input type="text" class=" bg-light" name="nama_lengkap" id="nama_lengkap" 
                   value="{{ Auth::user()->name }}" readonly>
        </div>

        {{-- INFORMASI PRIBADI --}}
        <div class="mb-4">
            <h5 class="fw-bold mb-3 border-bottom pb-2 text-primary">Informasi Pribadi</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="alamat" class="form-label fw-semibold">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
                </div>
                <div class="col-md-3">
                    <label for="usia" class="form-label fw-semibold">Usia</label>
                    <input type="number" class="form-control" name="usia" min="18" max="100" id="usia" required>
                </div>
                <div class="col-md-3">
                    <label for="no_telepon" class="form-label fw-semibold">Nomor Telepon</label>
                    <input type="text" class="form-control" placeholder="08xxxxxxxxxx"  name="no_telepon" id="no_telepon" required>
                </div>
                <div class="col-md-4">
                    <label for="tempat_lahir" class="form-label fw-semibold">Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" required>
                </div>
                <div class="col-md-4">
                    <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required>
                </div>
                <div class="col-md-4">
                    <label for="bahasa" class="form-label fw-semibold">Bahasa yang dikuasai</label>
                    <input type="text" class="form-control" name="bahasa" id="bahasa" placeholder="Contoh: Inggris, Jerman, Mandarin" required>
                </div>
                <div class="col-md-6">
                    <label for="domisili_hpi" class="form-label fw-semibold">Domisili HPI</label>
                    <input type="text" class="form-control fw-semibold" name="domisili_hpi" id="domisili_hpi" required>
                </div>
                <div class="col-md-6">
                    <label for="foto" class="form-label fw-semibold">Upload Foto (.jpg/.jpeg/.png, maks 2MB)</label>
                    <input type="file" class="form-control" name="foto" id="foto" accept="image/jpeg,image/png" required>
                    @error('foto')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- LISENSI & SERTIFIKASI --}}
        <div class="mb-4">
            <h5 class="fw-bold mb-3 border-bottom pb-2 text-primary">Lisensi & Sertifikasi</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="no_lisensi" class="form-label fw-semibold">Nomor Lisensi</label>
                    <input type="text" class="form-control" name="no_lisensi" id="no_lisensi" placeholder="Contoh: HPI-000123-DIY-2023" required>
                </div>
                <div class="col-md-6">
                    <label for="tanggal_aktif_lisensi" class="form-label fw-semibold">Tanggal Aktif Lisensi</label>
                    <input type="date" class="form-control" name="tanggal_aktif_lisensi" id="tanggal_aktif_lisensi" required>
                </div>
                <div class="col-md-12">
                    <label for="sertifikasi_bahasa" class="form-label fw-semibold">Sertifikasi Bahasa Asing</label>
                    <textarea class="form-control" name="sertifikasi_bahasa" id="sertifikasi_bahasa" rows="3" placeholder="(sebutkan tempat anda belajar bahasa tersebut dan dibutuhkan waktu berapa lama Anda menguasai bahasa tersebut"></textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label d-block fw-semibold">Waktu Guiding Yang Disediakan</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="waktu_guiding" value="penuh waktu" id="penuh" checked>
                        <label class="form-check-label" for="penuh">Penuh Waktu</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="waktu_guiding" value="setiap weekend" id="weekend">
                        <label class="form-check-label" for="weekend">Setiap Weekend</label>
                    </div>
                </div>
            </div>
        </div>

        {{-- INFORMASI TAMBAHAN --}}
        <div class="mb-4">
            <h5 class="fw-bold mb-3 border-bottom pb-2 text-primary">Informasi Tambahan</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="destinasi_sering" class="form-label fw-semibold">Destinasi wisata paling sering dikunjungi</label>
                    <textarea class="form-control" name="destinasi_sering" id="destinasi_sering" rows="2"></textarea>
                </div>
                <div class="col-md-3">
                    <label for="jumlah_tamu_max" class="form-label fw-semibold">Jumlah tamu yang pernah dibawa</label>
                    <input type="number" class="form-control" name="jumlah_tamu_max" id="jumlah_tamu_max">
                </div>
                <div class="col-md-3">
                    <label for="lama_bertugas" class="form-label fw-semibold">Lama bertugas (tahun)</label>
                    <input type="number" class="form-control" name="lama_bertugas" id="lama_bertugas">
                </div>
                <div class="col-md-6">
                    <label for="alasan_profesi" class="form-label fw-semibold">Alasan memilih profesi Tour Guide</label>
                    <textarea class="form-control" name="alasan_profesi" id="alasan_profesi" rows="2"></textarea>
                </div>
                <div class="col-md-6">
                    <label for="pelatihan" class="form-label fw-semibold">Pernah mengikuti pelatihan Pemandu Wisata? tolong sebutkan!</label>
                    <textarea class="form-control" name="pelatihan" id="pelatihan" rows="2"></textarea>
                </div>
                <div class="col-md-12">
                    <label for="travel_agency" class="form-label fw-semibold">Sebutkan Travel agensi yang pernah bekerja sama</label>
                    <textarea class="form-control" name="travel_agency" id="travel_agency" rows="2"></textarea>
                </div>
                <div class="col-md-12">
                    <label for="pengalaman_berkesan" class="form-label fw-semibold">Pengalaman paling berkesan selama menjadi tour guide</label>
                    <textarea class="form-control" name="pengalaman_berkesan" id="pengalaman_berkesan" rows="2"></textarea>
                </div>
                <div class="col-md-12">
                    <label for="pengalaman_komplain" class="form-label fw-semibold">Apakah Anda pernah memiliki pengalaman membawa tamu yang memiliki banyak permintaan dan selalu komplain?</label>
                    <textarea class="form-control" name="pengalaman_komplain" id="pengalaman_komplain" rows="2"></textarea>
                </div>
                <div class="col-md-12">
                    <label for="menyikapi_komplain" class="form-label fw-semibold">Bagaimana Anda menyikapi komplain dari tamu tersebut?</label>
                    <textarea class="form-control" name="menyikapi_komplain" id="menyikapi_komplain" rows="2"></textarea>
                </div>
                <div class="col-md-12">
                    <label for="menyiasati_hambatan" class="form-label fw-semibold">Bagaimana Anda menyiasati agar tour tetap berjalan dengan lancar meskipun sudah terdeteksi potensi hambatan sejak awal?</label>
                    <textarea class="form-control" name="menyiasati_hambatan" id="menyiasati_hambatan" rows="2"></textarea>
                </div>
                <div class="col-md-12">
                    <label for="rencana_meningkatkan_layanan" class="form-label fw-semibold">Di masa depan rencana apa yang telah Anda siapkan untuk meningkatkan layanan Anda sebagai tour guide?</label>
                    <textarea class="form-control" name="rencana_meningkatkan_layanan" id="rencana_meningkatkan_layanan" rows="2"></textarea>
                </div>
            </div>
        </div>

        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill shadow fw-semibold">
                Kirim Formulir
            </button>
        </div>
    </form>
</div>
@endsection
