<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourGuideProfiles;
use Illuminate\Http\Request;

class TourGuideController extends Controller
{
    public function index()
    {
        $tourGuides = TourGuideProfiles::with('user')->get();

        return view('admin.tour-guides.index', compact('tourGuides'));
    }

    public function pending()
    {
        $pendingGuides = TourGuideProfiles::with('user')
            ->where('status_verifikasi', 'menunggu')
            ->get();
        return view('admin.tour-guides.pending', compact('pendingGuides'));
        // $pendingGuides = TourGuideProfiles::where('status_verifikasi', 'menunggu')->get();
        // return view('admin.tour-guides.pending', compact('pendingGuides'));
    }


    public function show($id)
    {
        $guide = TourGuideProfiles::with(['user', 'bidangKeahlian', 'tipeKeahlian'])->findOrFail($id);
        return view('admin.tour-guides.detail', compact('guide'));
    }

    public function verifyGuide($id)
    {
        $guide = TourGuideProfiles::findOrFail($id);
    $guide->status_verifikasi = 'terverifikasi';
    $guide->save();

    return redirect()->back()->with('success', 'Tour guide berhasil diverifikasi.');
    }

    public function rejectGuide($id)
    {
        $guide = TourGuideProfiles::findOrFail($id);
    $guide->status_verifikasi = 'ditolak';
    $guide->save();

    return redirect()->back()->with('success', 'Tour guide telah ditolak.');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function bidangKeahlian()
    {
        return $this->belongsToMany(BidangKeahlian::class, 'tour_guide_bidang', 'id_guide', 'id_bidang');
    }

    public function tipeKeahlian()
    {
        return $this->belongsToMany(TipeKeahlian::class, 'tour_guide_tipe', 'id_guide', 'id_tipe');
    }


    public function terverifikasi(Request $request)
    {
        $guides = TourGuideProfiles::with(['user', 'bidangKeahlian', 'tipeKeahlian'])
            ->where('status_verifikasi', 'terverifikasi')
            ->when($request->domisili, function ($q) use ($request) {
                $q->where('domisili_hpi', 'like', '%' . $request->domisili . '%');
            })
            ->when($request->bidang_keahlian, function ($q) use ($request) {
                $q->whereHas('bidangKeahlian', function ($subQuery) use ($request) {
                    $subQuery->where('nama_bidang', 'like', '%' . $request->bidang_keahlian . '%');
                });
            })
            ->when($request->tipe_keahlian, function ($q) use ($request) {
                $q->whereHas('tipeKeahlian', function ($subQuery) use ($request) {
                    $subQuery->where('nama_tipe', $request->tipe_keahlian);
                });
            })
            ->with(['user', 'bidangKeahlian', 'tipeKeahlian'])
            ->get();

        return view('admin.tour-guides.terverifikasi', compact('guides'));
    }



}
