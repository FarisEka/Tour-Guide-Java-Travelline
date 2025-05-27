<?php

namespace App\Http\Controllers;

use App\Models\TourGuideProfiles;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create($id)
    {
        $tourGuide = TourGuideProfiles::with('user')->findOrFail($id);
        return view('traveller.booking', compact('tourGuide'));
    }

    // Simpan data booking
    public function store(Request $request)
    {
        $request->validate([
            'id_guide' => 'required|exists:tour_guide_profiles,id',
            'nama_traveller' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
            'tanggal_booking' => 'required|date',
            'durasi_hari' => 'required|numeric|min:1',
        ]);

        Booking::create([
            'id_guide' => $request->id_guide,
            'user_id' => Auth::id(),
            'nama_traveller' => $request->nama_traveller,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'tanggal_booking' => $request->tanggal_booking,
            'durasi_hari' => $request->durasi_hari,
        ]);

        return redirect()->route('cari.guide')->with('success', 'Permintaan booking berhasil dikirim! Tunggu verifikasi dari tour guide');
    }
}
