<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\TourGuideProfiles;
use App\Models\BidangKeahlian;
use App\Models\TipeKeahlian;

class TourGuidePublicController extends Controller
{
    public function cari(Request $request)
    {
        $query = TourGuideProfiles::with('user');

        if ($request->filled('domisili_hpi')) {
            $query->where('domisili_hpi', 'like', '%' . $request->domisili_hpi . '%');
        }

        if ($request->filled('bidang_keahlian')) {
            $query->whereHas('bidangKeahlian', function ($q) use ($request) {
                $q->where('id_bidang', $request->bidang_keahlian);
            });
        }

        if ($request->filled('tipe_keahlian')) {
            $query->whereHas('tipeKeahlian', function ($q) use ($request) {
                $q->where('id_tipe', $request->tipe_keahlian);
            });
        }

        $tourGuides = $query->where('status_verifikasi', 'terverifikasi')->get();
        $bidangs = BidangKeahlian::all();
        $tipes = TipeKeahlian::all();

        return view('traveller.cari-guide', compact('tourGuides', 'bidangs', 'tipes'));
    }

    public function edit()
{
    $user = Auth::user();
    $profile = $user->tourGuideProfile;

    return view('profile.edit-biodata', compact('profile'));
}

public function update(Request $request)
{
    $request->validate([
        'alamat' => 'required|string',
        'usia' => 'required|integer|min:17|max:100',
        'tempat_lahir' => 'required|string|max:100',
        'tanggal_lahir' => 'required|date',
        'bahasa' => 'nullable|string|max:100',
        'no_telepon' => 'nullable|string|max:20',
        'domisili_hpi' => 'required|string|max:100',
        'no_lisensi' => 'nullable|string|max:100',
        'tanggal_aktif_lisensi' => 'nullable|date',
        'sertifikasi_bahasa' => 'nullable|string',
        'waktu_guiding' => 'nullable|in:penuh waktu,setiap weekend',
        'destinasi_sering' => 'nullable|string',
        'jumlah_tamu_max' => 'nullable|integer',
        'lama_bertugas' => 'nullable|integer',
        'alasan_profesi' => 'nullable|string',
        'pelatihan' => 'nullable|string',
        'travel_agency' => 'nullable|string',
        'pengalaman_berkesan' => 'nullable|string',
        'pengalaman_komplain' => 'nullable|string',
        'menyikapi_komplain' => 'nullable|string',
        'menyiasati_hambatan' => 'nullable|string',
        'rencana_meningkatkan_layanan' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $user = Auth::user();
    $profile = $user->tourGuideProfile;

    if ($request->hasFile('foto')) {
        if ($profile->foto) {
            Storage::delete('public/foto/' . $profile->foto);
        }

        $file = $request->file('foto');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/foto', $filename);
        $profile->foto = $filename;
    }

    $profile->update($request->except('foto'));

    return redirect()->route('profile.edit-biodata')->with('success', 'Biodata berhasil diperbarui.');
}


}
