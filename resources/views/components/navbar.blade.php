<nav class="navbar navbar-expand-sm">
    <div class="container-fluid">
        <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
            </span>
        </button>
        <div class=" navbar-collapse" id="navbarNav">
            <a class="navbar-brand me-auto" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-JT.png') }}" alt="logo Java Travelline" class="" width="110" height="90">
            </a>
            <ul class="navbar-nav fw-medium">
                <li class="nav-item me-5">
        <a class="nav-link text-black hover-bg" aria-current="page" href="{{ route('cari.guide') }}">Cari Tour Guide</a>
    </li>
    <li class="nav-item me-5">
        <a class="nav-link text-black hover-bg" href="{{ route('tour-guide.create') }}">Daftar Sebagai Tour Guide</a>
    </li>

    @guest
        {{-- Jika belum login, tampilkan menu Login --}}
        <li class="nav-item me-5">
            <a class="nav-link text-black hover-bg" href="{{ route('register') }}">Login</a>
        </li>
    @else
        {{-- Jika sudah login, tampilkan foto profil --}}
        @php
            $foto = Auth::user()->tourGuideProfile->foto ?? 'default.jpg';
        @endphp
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                <img src="{{ asset('storage/' . $foto) }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; object-position: center; margin-top: -4px;">
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="">Profil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    @endguest
            </ul>
        </div>
        </div>
    </div>
</nav>