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
            'tour_guide_id' => 'required|exists:tour_guide_profiles,id',
            'nama_traveller' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
            'tanggal_booking' => 'required|date',
            'durasi' => 'required|numeric|min:1',
        ]);

        Booking::create([
            'tour_guide_id' => $request->tour_guide_id,
            'user_id' => Auth::id(),
            'nama_traveller' => $request->nama_traveller,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'tanggal_booking' => $request->tanggal_booking,
            'durasi' => $request->durasi,
        ]);

        return redirect()->route('cari.guide')->with('success', 'Permintaan booking berhasil dikirim!');
    }
}
