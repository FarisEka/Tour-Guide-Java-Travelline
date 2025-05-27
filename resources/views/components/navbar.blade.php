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
                    <img src="{{ asset('images/logo-JT.png') }}" alt="logo Java Travelline" class="" width="110"
                        height="90">
                </a>
                <ul class="navbar-nav fw-medium">
                    <li class="nav-item me-5">
                        <a class="nav-link text-black hover-bg" aria-current="page"
                            href="{{ route('cari.guide') }}">Cari Tour Guide</a>
                    </li>
                    <li class="nav-item me-5">
                        <a class="nav-link text-black hover-bg" href="{{ route('tour-guide.create') }}">Daftar Sebagai
                            Tour Guide</a>
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
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                data-bs-toggle="dropdown">
                                @php
                                    $foto = Auth::user()->tourGuideProfile->foto ?? 'default.jpg';
                                @endphp
                                <img src="{{ asset('storage/' . $foto) }}"
                                    style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; object-position: center; margin-top: -4px;">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if (Auth::user()->tourGuideProfile)
                                    <li>
                                        <a class="dropdown-item"
                                            href="#">
                                            Edit Biodata
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('booking.masuk') }}">
                                            Booking Masuk
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                @else
                                    <li class="dropdown-item text-muted">Belum mendaftar sebagai tour guide</li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                @endif

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
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