@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Booking Tour Guide: {{ $tourGuide->nama_lengkap }}</h2>

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tour_guide_id" value="{{ $tourGuide->id }}">

        <div class="mb-3">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="keterangan">Keterangan (Opsional)</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
    </form>
</div>
@endsection
