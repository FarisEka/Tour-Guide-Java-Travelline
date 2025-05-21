@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Form Pendaftaran Tour Guide</h2>

    <form action="{{ route('tour-guide.store') }}" method="POST" enctype="multipart/form-data" class="card p-4">
        @csrf

        {{-- INFORMASI PRIBADI --}}
        <h5 class="mb-3">Informasi Pribadi</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required>
            </div>
            <div class="col-md-6">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat" required>
            </div>
            <div class="col-md-6">
                <label for="usia" class="form-label">Usia</label>
                <input type="number" class="form-control" name="usia" id="usia" required>
            </div>
            <div class="col-md-6">
                <label for="tempat_tanggal_lahir" class="form-label">Tempat, Tanggal Lahir</label>
                <input type="text" class="form-control" name="tempat_tanggal_lahir" id="tempat_tanggal_lahir" required>
            </div>
            <div class="col-md-6">
                <label for="bahasa" class="form-label">Bahasa</label>
                <input type="text" class="form-control" name="bahasa" id="bahasa" required>
            </div>
            <div class="col-md-6">
                <label for="no_telp" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" name="no_telp" id="no_telp" required>
            </div>
            <div class="col-md-6">
                <label for="foto" class="form-label">Upload Foto (.jpg/.jpeg/.png, maks 2MB)</label>
                <input type="file" class="form-control" name="foto" id="foto" accept="image/jpeg,image/png" required>
                @error('foto')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr class="my-4" />

        {{-- DOMISILI & JADWAL --}}
        <h5 class="mb-3">Domisili & Jadwal</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="nomor_lisensi" class="form-label">Nomor Lisensi</label>
                <input type="text" class="form-control" name="nomor_lisensi" id="nomor_lisensi" required>
            </div>
            <div class="col-md-6">
                <label class="form-label d-block">Waktu Aktif</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="waktu_aktif" id="penuh" value="Penuh Waktu" checked>
                    <label class="form-check-label" for="penuh">Penuh Waktu</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="waktu_aktif" id="weekend" value="Setiap Weekend">
                    <label class="form-check-label" for="weekend">Setiap Weekend</label>
                </div>
            </div>
            <div class="col-12">
                <label for="sertifikasi_bahasa" class="form-label">Sertifikasi Bahasa Asing</label>
                <textarea name="sertifikasi_bahasa" id="sertifikasi_bahasa" rows="3" class="form-control"></textarea>
            </div>
        </div>

        <hr class="my-4" />

        {{-- KEAHLIAN --}}
        <h5 class="mb-3">Bidang & Tipe Keahlian</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Bidang Keahlian Tour</label>
                @foreach (['Cultural', 'Adventure', 'Culinary', 'Religious', 'Eco'] as $field)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="bidang_keahlian[]" value="{{ $field }}" id="field-{{ $field }}">
                        <label class="form-check-label" for="field-{{ $field }}">{{ $field }} Tour</label>
                    </div>
                @endforeach
            </div>
            <div class="col-md-6">
                <label class="form-label">Tipe Keahlian</label>
                @foreach (['Group', 'Private', 'Luxury', 'Family', 'Couple'] as $type)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tipe_keahlian[]" value="{{ $type }}" id="tipe-{{ $type }}">
                        <label class="form-check-label" for="tipe-{{ $type }}">{{ $type }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <hr class="my-4" />

        {{-- INFORMASI TAMBAHAN --}}
        <h5 class="mb-3">Informasi Tambahan</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="destinasi_sering_dikunjungi" class="form-label">Destinasi wisata paling sering dikunjungi</label>
                <input type="text" class="form-control" name="destinasi_sering_dikunjungi" id="destinasi_sering_dikunjungi">
            </div>
            <div class="col-md-6">
                <label for="jumlah_tamu_maksimal" class="form-label">Jumlah tamu maksimal</label>
                <input type="number" class="form-control" name="jumlah_tamu_maksimal" id="jumlah_tamu_maksimal">
            </div>
            <div class="col-md-6">
                <label for="lama_bertugas" class="form-label">Lama bertugas sebagai tour guide</label>
                <input type="text" class="form-control" name="lama_bertugas" id="lama_bertugas">
            </div>
            <div class="col-md-6">
                <label for="alasan_profesi" class="form-label">Alasan memilih profesi</label>
                <input type="text" class="form-control" name="alasan_profesi" id="alasan_profesi">
            </div>
            <div class="col-md-6">
                <label for="pelatihan_terkait" class="form-label">Pelatihan terkait Pemandu Wisata</label>
                <input type="text" class="form-control" name="pelatihan_terkait" id="pelatihan_terkait">
            </div>
            <div class="col-md-6">
                <label for="travel_agency" class="form-label">Travel agensi yang pernah bekerja sama</label>
                <input type="text" class="form-control" name="travel_agency" id="travel_agency">
            </div>
            <div class="col-md-12">
                <label for="pengalaman_terbaik" class="form-label">Pengalaman paling tak terlupakan</label>
                <input type="text" class="form-control" name="pengalaman_terbaik" id="pengalaman_terbaik">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                Kirim Formulir
            </button>
        </div>
    </form>
</div>
@endsection
