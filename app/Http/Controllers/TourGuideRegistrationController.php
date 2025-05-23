<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\TourGuideProfiles;
use App\Models\BidangKeahlian;
use App\Models\TipeKeahlian;

class TourGuideRegistrationController extends Controller
{
    public function create()
    {
        $bidangKeahlian = BidangKeahlian::all();
        $tipeKeahlian = TipeKeahlian::all();

        return view('tour_guide.daftar', compact('bidangKeahlian', 'tipeKeahlian'));
    }

    public function store(Request $request)
    {
        // Cegah user mendaftar dua kali
        if (TourGuideProfiles::where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('error', 'Anda sudah mendaftar sebagai tour guide.');
        }

        $validated = $request->validate([
            'alamat' => 'required|string',
        'usia' => 'required|integer',
        'tempat_lahir' => 'required|string',
        'tanggal_lahir' => 'required|date',
        'bahasa' => 'required|string',
        'no_telepon' => 'required|string',
        'domisili_hpi' => 'required|string',
        'no_lisensi' => 'required|string',
        'tanggal_aktif_lisensi' => 'required|date',
        'sertifikasi_bahasa' => 'required|string',
        'waktu_guiding' => 'required|in:penuh waktu,setiap weekend',
        'destinasi_sering' => 'required|string',
        'jumlah_tamu_max' => 'required|integer',
        'lama_bertugas' => 'required|integer',
        'alasan_profesi' => 'required|string',
        'pelatihan' => 'required|string',
        'travel_agency' => 'required|string',
        'pengalaman_berkesan' => 'required|string',
        'pengalaman_komplain' => 'required|string',
        'menyikapi_komplain' => 'required|string',
        'menyiasati_hambatan' => 'required|string',
        'rencana_meningkatkan_layanan' => 'required|string',
        'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'bidang_keahlian' => 'required|array',
        'tipe_keahlian' => 'required|array',
        ]);

        DB::beginTransaction();
        try {
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
        'sertifikasi_bahasa' => $validated['sertifikasi_bahasa'],
        'waktu_guiding' => $validated['waktu_guiding'],
        'destinasi_sering' => $validated['destinasi_sering'],
        'jumlah_tamu_max' => $validated['jumlah_tamu_max'],
        'lama_bertugas' => $validated['lama_bertugas'],
        'alasan_profesi' => $validated['alasan_profesi'],
        'pelatihan' => $validated['pelatihan'],
        'travel_agency' => $validated['travel_agency'],
        'pengalaman_berkesan' => $validated['pengalaman_berkesan'],
        'pengalaman_komplain' => $validated['pengalaman_komplain'],
        'menyikapi_komplain' => $validated['menyikapi_komplain'],
        'menyiasati_hambatan' => $validated['menyiasati_hambatan'],
        'rencana_meningkatkan_layanan' => $validated['rencana_meningkatkan_layanan'],
        'foto' => $fotoPath,
        'status_verifikasi' => 'menunggu',
            ]);

            // Simpan relasi many-to-many
            $profile->bidangKeahlian()->attach($validated['bidang_keahlian']);
            $profile->tipeKeahlian()->attach($validated['tipe_keahlian']);

            DB::commit();

            return redirect()->route('home')->with('success', 'Pendaftaran tour guide berhasil dikirim! Tunggu datamu diverifikasi oleh admin.');
        } catch (\Exception $e) {
            DB::rollback();

            // Hapus foto jika sudah terupload
            if (isset($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }

            \Log::error('Gagal mendaftar tour guide: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }
}
