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
            'nama_lengkap' => 'required|string|max:255',
            'usia' => 'required|integer',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'domisili_hpi' => 'required|string|max:255',
            'lisensi' => 'required|string|max:255',
            'tanggal_aktif_lisensi' => 'required|date',
            'bahasa' => 'required|string|max:255',
            'sertifikasi_bahasa' => 'nullable|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'waktu_guiding' => 'required|in:penuh waktu,setiap weekend',
            'alasan_profesi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();
        $user->nama_lengkap = $request->nama_lengkap;
        $user->save();

        $profile = $user->tourGuideProfile;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($profile->foto) {
                Storage::delete('public/' . $profile->foto);
            }

            $path = $request->file('foto')->store('foto-profil', 'public');
            $profile->foto = $path;
        }

        $profile->update([
            'usia' => $request->usia,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat' => $request->alamat,
            'domisili_hpi' => $request->domisili_hpi,
            'no_lisensi' => $request->lisensi,
            'tanggal_aktif_lisensi' => $request->tanggal_aktif_lisensi,
            'bahasa' => $request->bahasa,
            'sertifikasi_bahasa' => $request->sertifikasi_bahasa,
            'no_telepon' => $request->no_telepon,
            'waktu_guiding' => $request->waktu_guiding,
            'alasan_profesi' => $request->alasan_profesi,
        ]);

        return redirect()->back()->with('success', 'Biodata berhasil diperbarui.');
    }


}
