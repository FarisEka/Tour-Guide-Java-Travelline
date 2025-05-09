<!-- Sekilas Cara Kerja -->
<section class="text-center py-5" style="background-color: #f8f9fa;">
  <div class="container">
    <h5 class="fw-bold mb-4 fs-5">Sekilas Cara Kerja</h5>
    <div class="row justify-content-center mb-4">
      <div class="col-6 col-md-3 mb-3 mb-md-0">
        <div role="button" data-bs-toggle="modal" data-bs-target="#modalGuide">
          <i class="fa-solid fa-user fa-2x text-info mb-2"></i>
          <p class="mb-0 fw-medium">1. Tour Guide Daftar</p>
        </div>
      </div>

      <div class="col-6 col-md-3 mb-3 mb-md-0">
        <div role="button" data-bs-toggle="modal" data-bs-target="#modalTraveller">
          <i class="fa-solid fa-magnifying-glass fa-2x text-info mb-2"></i>
          <p class="mb-0 fw-medium">2. Traveller Mencari</p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div role="button" data-bs-toggle="modal" data-bs-target="#modalAdmin">
          <i class="fa-solid fa-gears fa-2x text-info mb-2"></i>
          <p class="mb-0 fw-medium">3. Kelola Perusahaan</p>
        </div>
      </div>
    </div>

    <div class="d-inline-flex align-items-center px-4 py-3 border rounded-pill" style="background-color: #ffffff;">
      <span class="me-3">Sudah 50+ guide bergabung bersama Java</span>
      <a href="#" class="btn btn-info btn-sm text-white rounded-pill px-3 fw-medium">Lihat Tour Guide</a>
    </div>
  </div>
</section>

<div class="modal fade" id="modalGuide" aria-labelledby="modalGuideLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalGuideLabel">1. Tour Guide Daftar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Tour guide dapat mendaftar melalui formulir pendaftaran yang tersedia. Setelah itu, data akan diverifikasi oleh admin sebelum akun aktif.
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalTraveller" aria-labelledby="modalTravellerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTravellerLabel">2. Traveller Mencari</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Traveller bisa mencari dan memfilter tour guide berdasarkan bahasa, wilayah, dan gender tanpa perlu login.
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAdmin" aria-labelledby="modalAdminLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAdminLabel">3. Kelola Perusahaan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Admin Java Travelline mengelola seluruh data tour guide dan booking, termasuk verifikasi dan laporan statistik.
      </div>
    </div>
  </div>
</div>
