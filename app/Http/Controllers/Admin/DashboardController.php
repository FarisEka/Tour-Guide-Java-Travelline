<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TourGuideProfiles;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total semua tour guide yang mendaftar
        $totalGuides = TourGuideProfiles::count();

        // Jumlah yang status_verifikasi masih 'menunggu'
        $pendingGuides = TourGuideProfiles::where('status_verifikasi', 'menunggu')->count();

        // Jumlah yang sudah 'terverifikasi'
        $verifiedGuides = TourGuideProfiles::where('status_verifikasi', 'terverifikasi')->count();

        // Total booking
        $totalBookings = Booking::count();

        // 5 tour guide terbaru
        $latestGuides = TourGuideProfiles::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($guide) {
                return (object) [
                    'nama_lengkap' => $guide->user->nama_lengkap ?? '-',
                    'no_telepon' => $guide->no_telepon ?? '-',
                    'status_verifikasi' => $guide->status_verifikasi ?? '-',
                ];
            });

        return view('admin.dashboard', compact(
            'totalGuides',
            'pendingGuides',
            'verifiedGuides',
            'totalBookings',
            'latestGuides'
        ));
    }
}
