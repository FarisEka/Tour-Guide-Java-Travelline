@extends('layouts.main')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Detail Verifikasi</h2>
        <div>
            <form action="{{ route('admin.tour-guides.verify', $guide->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success">Verifikasi</button>
            </form>
            <form action="{{ route('admin.tour-guides.reject', $guide->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-secondary">Tolak</button>
            </form>
        </div>
    </div>

    <div class="card p-4 shadow-sm">
        <div class="row mb-4">
            <div class="col-md-2">
                <img src="{{ asset('storage/' . $guide->foto) }}" alt="{{ $guide->user->nama_lengkap }}" class="img-fluid rounded-circle">
            </div>
            <div class="col-md-10">
                <h4><strong>{{ $guide->user->nama_lengkap }}</strong></h4>
                <p><strong>Alamat:</strong> {{ $guide->alamat }}</p>
                <p><strong>Usia:</strong> {{ \Carbon\Carbon::parse($guide->tanggal_lahir)->age }} tahun</p>
                <p><strong>Tempat, Tanggal Lahir:</strong> {{ $guide->tempat_lahir }}, {{ \Carbon\Carbon::parse($guide->tanggal_lahir)->format('d M Y') }}</p>
                <p><strong>Nomor Telepon:</strong> {{ $guide->user->telepon }}</p>
                <p><strong>Domisili HPI:</strong> {{ $guide->domisili_hpi }}</p>
                <p><strong>Nomor Lisensi:</strong> {{ $guide->nomor_lisensi }}</p>
                <p><strong>Tanggal Aktif Lisensi:</strong> {{ \Carbon\Carbon::parse($guide->tanggal_aktif_lisensi)->format('d M Y') }}</p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6">
                <p><strong>Waktu Guiding:</strong> {{ $guide->waktu_guiding }}</p>
                <p><strong>Bidang Keahlian:</strong> {{ $guide->bidangKeahlian->pluck('nama')->join(', ') }}</p>
                <p><strong>Destinasi Sering Dikunjungi:</strong> {{ $guide->destinasi_sering_dikunjungi }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Tipe Keahlian:</strong> {{ $guide->tipeKeahlian->pluck('nama')->join(', ') }}</p>
                <p><strong>Pengalaman:</strong> {{ $guide->tahun_pengalaman }} tahun</p>
            </div>
        </div>
    </div>
</div>
@endsection
