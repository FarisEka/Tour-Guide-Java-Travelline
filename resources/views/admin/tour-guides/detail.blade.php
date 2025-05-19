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
                <img src="{{ $guide->photo_url }}" alt="{{ $guide->name }}" class="img-fluid rounded-circle">
            </div>
            <div class="col-md-10">
                <h4><strong>{{ $guide->name }}</strong></h4>
                <p><strong>Alamat:</strong> {{ $guide->address }}</p>
                <p><strong>Usia:</strong> {{ $guide->age }}</p>
                <p><strong>Tempat, Tanggal Lahir:</strong> {{ $guide->birth_place }}, {{ $guide->birth_date }}</p>
                <p><strong>Nomor Telepon:</strong> {{ $guide->phone }}</p>
                <p><strong>Domisili HPI:</strong> {{ $guide->domicile }}</p>
                <p><strong>Nomor Lisensi:</strong> {{ $guide->license_number }}</p>
                <p><strong>Tanggal Aktif Lisensi:</strong> {{ $guide->license_active_date }}</p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6">
                <p><strong>Waktu Guiding:</strong> {{ $guide->guiding_time }}</p>
                <p><strong>Bidang Keahlian:</strong> {{ $guide->bidangKeahlian->pluck('nama')->join(', ') }}</p>
                <p><strong>Destinasi Sering Dikunjungi:</strong> {{ $guide->frequent_destinations }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Tipe Keahlian:</strong> {{ $guide->tipeKeahlian->pluck('nama')->join(', ') }}</p>
                <p><strong>Pengalaman:</strong> {{ $guide->experience_years }} tahun</p>
            </div>
        </div>
    </div>
</div>
@endsection
