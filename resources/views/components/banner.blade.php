<div class="container-fluid py-5">
    <div class="container">
    <div class="row align-items-center">
        <div class="col-sm-12 col-lg-7">
            <img src="{{ asset('images/banner.png') }}" alt="gambar tour guide">
        </div>
        <div class=" col-sm-12 col-lg-5 text-center">
            <h1 class="fw-bold fs-3 mb-1">Satu Platform untuk Koneksi<br>Tour Guide & Traveller</h1>
            <p class="fw-medium ">
            Bergabunglah sebagai Tour Guide Profesional atau<br>
            temukan guide terbaik sesuai kebutuhan Anda
            </p>
            <div class="d-flex justify-content-center gap-2 mt-3">
        <a href="{{ route('tour-guide.create') }}">
            <button type="button" class="btn btn-info fw-medium">Daftar Sekarang</button>
        </a>
        <a href="{{ route('cari.guide') }}">
            <button type="button" class="btn btn-outline-info fw-medium">Cari Tour Guide</button>
        </a>
            </div>
        </div>
    </div>
    </div>
</div>