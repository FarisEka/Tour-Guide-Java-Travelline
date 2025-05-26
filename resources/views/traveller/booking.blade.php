@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0"><i class="bi bi-calendar2-check"></i> Booking Tour Guide</h4>
                </div>

                <div class="card-body p-4">
                    <h5 class="mb-4 text-muted">Anda akan mengajukan booking ke: <strong>{{ $tourGuide->user->nama_lengkap }}</strong></h5>

                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tour_guide_id" value="{{ $tourGuide->id }}">

                        <div class="mb-3">
                            <label for="nama_traveller" class="form-label">Nama Anda</label>
                            <input type="text" name="nama_traveller" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor HP</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tour Guide</label>
                            <input type="text" class="form-control bg-light" value="{{ $tourGuide->user->nama_lengkap }}" readonly>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_booking" class="form-label">Tanggal Booking</label>
                                <input type="date" name="tanggal_booking" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="durasi" class="form-label">Durasi (hari)</label>
                                <input type="number" name="durasi" class="form-control" min="1" required>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                                Kirim Permintaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
