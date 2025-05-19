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
            (object) ['name' => 'Agus Santoso', 'city' => 'Surabaya', 'photo_url' => 'https://i.pravatar.cc/150?img=1'],
            (object) ['name' => 'Rina Putri', 'status' => 'Menunggu Verifikasi', 'photo_url' => 'https://i.pravatar.cc/150?img=2'],
            (object) ['name' => 'Dewi Kartika', 'status' => 'Terverifikasi', 'photo_url' => 'https://i.pravatar.cc/150?img=3'],
        ];

        return view('admin.tour-guides.index', compact('tourGuides'));
    }

    public function pending()
    {
        // Data dummy manual
    $pendingGuides = [
        (object)[
            'id' => 1,
            'name' => 'Fajar Rahman',
            'city' => 'Malang',
            'photo_url' => 'https://i.pravatar.cc/150?img=1' // gambar random
        ],
        (object)[
            'id' => 2,
            'name' => 'Dewi Lestari',
            'city' => 'Bandung',
            'photo_url' => 'https://i.pravatar.cc/150?img=2'
        ],
    ];
    return view('admin.tour-guides.pending', compact('pendingGuides'));
        // $pendingGuides = TourGuideProfiles::where('status_verifikasi', 'menunggu')->get();
        // return view('admin.tour-guides.pending', compact('pendingGuides'));
    }

    // public function detail()
    // {
    //     return view('admin.tour-guides.detail', compact('detailGuides'));
    // }

    public function show($id)
{
    $guide = TourGuideProfiles::with(['user', 'bidangKeahlian', 'tipeKeahlian'])->findOrFail($id);
    return view('admin.tour-guides.detail', compact('guide'));
}


}
