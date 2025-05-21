<nav class="navbar navbar-expand-sm">
    <div class="container-fluid">
        <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
            </span>
        </button>
        <div class=" navbar-collapse" id="navbarNav">
            <a class="navbar-brand me-auto" href="#">
                <img src="{{ asset('images/logo-JT.png') }}" alt="logo Java Travelline" class="" width="110" height="90">
            </a>
            <ul class="navbar-nav fw-medium">
                <li class="nav-item me-5">
                    <a class="nav-link text-black hover-bg" aria-current="page" href="#">Cari Tour Guide</a>
                </li>
                <li class="nav-item me-5">
                    <a class="nav-link text-black hover-bg" href="{{ route('tour-guide.create') }}">Daftar Sebagai Tour Guide</a>
                </li>
                <li class="nav-item me-5">
                    <a class="nav-link text-black hover-bg" href="{{ route('register') }}">Login</a>
                </li>
            </ul>
        </div>
        </div>
    </div>
</nav>