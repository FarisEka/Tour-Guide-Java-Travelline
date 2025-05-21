<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourGuideProfiles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TourGuideRegistrationController extends Controller
{
    public function create()
    {
        return view('tour_guide.daftar');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat' => 'required|string',
            'usia' => 'required|integer',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'bahasa' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:20',
            'domisili_hpi' => 'required|string|max:100',
            'no_lisensi' => 'required|string|max:100',
            'tanggal_aktif_lisensi' => 'required|date',
            'sertifikasi_bahasa' => 'nullable|string',
            'waktu_guiding' => 'required|in:penuh waktu,setiap weekend',
            'destinasi_sering' => 'required|string',
            'jumlah_tamu_max' => 'required|integer',
            'lama_bertugas' => 'required|integer',
            'alasan_profesi' => 'required|string',
            'pelatihan' => 'nullable|string',
            'travel_agency' => 'nullable|string',
            'pengalaman_berkesan' => 'nullable|string',
            'pengalaman_komplain' => 'nullable|string',
            'menyikapi_komplain' => 'nullable|string',
            'menyiasati_hambatan' => 'nullable|string',
            'rencana_meningkatkan_layanan' => 'nullable|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'bidang_keahlian' => 'required|array',
            'bidang_keahlian.*' => 'integer|exists:bidang_keahlian,id',
            'tipe_keahlian' => 'required|array',
            'tipe_keahlian.*' => 'integer|exists:tipe_keahlian,id',
        ]);

        // Simpan foto ke storage
        $fotoPath = $request->file('foto')->store('tour-guide/foto', 'public');

        // Simpan data ke tabel tour_guide_profiles
        $profile = TourGuideProfiles::create([
            'user_id' => Auth::id(),
            'alamat' => $validated['alamat'],
            'usia' => $validated['usia'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'bahasa' => $validated['bahasa'],
            'no_telepon' => $validated['no_telepon'],
            'domisili_hpi' => $validated['domisili_hpi'],
            'no_lisensi' => $validated['no_lisensi'],
            'tanggal_aktif_lisensi' => $validated['tanggal_aktif_lisensi'],
            'sertifikasi_bahasa' => $validated['sertifikasi_bahasa'] ?? null,
            'waktu_guiding' => $validated['waktu_guiding'],
            'destinasi_sering' => $validated['destinasi_sering'],
            'jumlah_tamu_max' => $validated['jumlah_tamu_max'],
            'lama_bertugas' => $validated['lama_bertugas'],
            'alasan_profesi' => $validated['alasan_profesi'],
            'pelatihan' => $validated['pelatihan'] ?? null,
            'travel_agency' => $validated['travel_agency'] ?? null,
            'pengalaman_berkesan' => $validated['pengalaman_berkesan'] ?? null,
            'pengalaman_komplain' => $validated['pengalaman_komplain'] ?? null,
            'menyikapi_komplain' => $validated['menyikapi_komplain'] ?? null,
            'menyiasati_hambatan' => $validated['menyiasati_hambatan'] ?? null,
            'rencana_meningkatkan_layanan' => $validated['rencana_meningkatkan_layanan'] ?? null,
            'foto' => $fotoPath,
            'status_verifikasi' => 'menunggu',
        ]);

        // Simpan relasi many-to-many
        $profile->bidangKeahlian()->attach($validated['bidang_keahlian']);
        $profile->tipeKeahlian()->attach($validated['tipe_keahlian']);

        return redirect()->route('dashboard')->with('success', 'Pendaftaran tour guide berhasil dikirim!');
    }
}
