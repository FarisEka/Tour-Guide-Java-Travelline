@extends('layouts.main')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Tour Guide Terverifikasi</h3>
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">&larr; Kembali</a>
        </div>

        <form method="GET" action="{{ route('admin.tour-guides.terverifikasi') }}" class="flex flex-wrap gap-2 mb-4">
            {{-- Input cari domisili --}}
            <div class="row">
                <div class="col-md-3">
                    <label for="domisili" class="form-label">Domisili</label>
                    <input type="text" name="domisili" id="domisili" placeholder="Cari domisili..."
                        value="{{ request('domisili') }}" class="form-control" />
                </div>

                {{-- Bidang Keahlian --}}
                <div class="col-md-3">
                    <label for="bidang_keahlian" class="form-label">Bidang Keahlian</label>
                    <select name="bidang_keahlian" id="bidang_keahlian" class="form-select">
                        <option value="">Pilih</option>
                        <option value="Cultural Tour" {{ request('bidang_keahlian') == 'Cultural Tour' ? 'selected' : '' }}>
                            Cultural Tour</option>
                        <option value="Culinary Tour" {{ request('bidang_keahlian') == 'Culinary Tour' ? 'selected' : '' }}>
                            Culinary Tour</option>
                        <option value="Adventure Tour" {{ request('bidang_keahlian') == 'Adventure Tour' ? 'selected' : '' }}>
                            Adventure Tour</option>
                        <option value="Eco Tour" {{ request('bidang_keahlian') == 'Eco Tour' ? 'selected' : '' }}>Eco Tour
                        </option>
                        <option value="Religious and Pilgrimage Tour" {{ request('bidang_keahlian') == 'Religious and Pilgrimage Tour' ? 'selected' : '' }}>Religious and Pilgrimage Tour</option>
                        <option value="Educational Tour" {{ request('bidang_keahlian') == 'Educational Tour' ? 'selected' : '' }}>Educational Tour
                        </option>
                        <option value="Shopping Tour" {{ request('bidang_keahlian') == 'Shopping Tour' ? 'selected' : '' }}>
                            Shopping Tour
                        </option>
                    </select>
                </div>

                {{-- Tipe Keahlian --}}
                <div class="col-md-3">
                    <label for="tipe_keahlian" class="form-label">Tipe Keahlian</label>
                    <select name="tipe_keahlian" id="tipe_keahlian" class="form-select">
                        <option value="">Pilih</option>
                        <option value="Group" {{ request('tipe_keahlian') == 'Group' ? 'selected' : '' }}>Group</option>
                        <option value="Family" {{ request('tipe_keahlian') == 'Family' ? 'selected' : '' }}>Family</option>
                        <option value="Private" {{ request('tipe_keahlian') == 'Private' ? 'selected' : '' }}>Private</option>
                        <option value="Luxury" {{ request('tipe_keahlian') == 'Luxury' ? 'selected' : '' }}>Luxury</option>
                        <option value="Couple" {{ request('tipe_keahlian') == 'Couple' ? 'selected' : '' }}>Couple</option>
                    </select>
                </div>

                {{-- Tombol Filter --}}
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>

    {{-- List Tour Guide --}}
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telepon</th>
                    <th>Domisili</th>
                    <th>Bidang Keahlian</th>
                    <th>Tipe Keahlian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($guides as $guide)
                    <tr>
                        <td>{{ $guide->user->nama_lengkap ?? '-' }}</td>
                        <td>{{ $guide->user->email }}</td>
                        <td>{{ $guide->no_telepon }}</td>
                        <td>
                            {{ $guide->domisili_hpi }}
                        </td>
                        <td>
                            @foreach ($guide->bidangKeahlian as $bidang)
                                <span class="badge bg-secondary">{{ $bidang->nama_bidang }}</span>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($guide->tipeKeahlian as $tipe)
                                <span class="badge bg-info text-dark">{{ $tipe->nama_tipe }}</span>
                            @endforeach
                        </td>
                        <td>
                            <form action="{{ route('admin.tour-guides.destroy', $guide->user_id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus tour guide ini beserta akun user-nya?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada tour guide ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    </div>
@endsection