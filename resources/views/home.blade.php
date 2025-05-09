@extends('layouts.app')
@section('content')

    <x-banner />
    <div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3 align-items-center">
      
      <div class="col">
        <div class="d-flex align-items-start">
          <i class="fas fa-check-circle fa-2x text-info me-3"></i>
          <div>
            <div class="fw-bold">Data Tour Guide Tersentralisasi</div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="d-flex align-items-start">
          <i class="fas fa-search fa-2x text-info me-3"></i>
          <div>
            <div class="fw-bold">Pencarian Guide Berdasarkan Kriteria</div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="d-flex align-items-start">
          <i class="fas fa-calendar-check fa-2x text-info me-3"></i>
          <div>
            <div class="fw-bold">Booking Guide Langsung</div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="d-flex align-items-start">
          <i class="fas fa-shield-alt fa-2x text-info me-3"></i>
          <div>
            <div class="fw-bold">Verifikasi & Notifikasi Otomatis</div>
          </div>
        </div>
      </div>

    </div>
  </div>
    
@endsection