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

}
