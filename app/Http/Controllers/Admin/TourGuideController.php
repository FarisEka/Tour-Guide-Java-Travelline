<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourGuideProfiles;
use Illuminate\Http\Request;

class TourGuideController extends Controller
{
    public function index()
    {
        $tourGuides = [
            (object) ['name' => 'Agus Santoso', 'city' => 'Surabaya'],
            (object) ['name' => 'Rina Putri', 'status' => 'Menunggu Verifikasi'],
            (object) ['name' => 'Dewi Kartika', 'status' => 'Terverifikasi'],
        ];

        return view('admin.tour-guides.index', compact('tourGuides'));
    }

    public function pending()
    {
        $pendingGuides = TourGuideProfiles::where('status_verifikasi', 'menunggu')->get();
        return view('admin.tour-guides.pending', compact('pendingGuides'));
    }

}
