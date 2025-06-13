<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourGuideProfiles;
use App\Models\User;
use App\Models\Booking;
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

        return redirect()->route('admin.tour-guides.pending')->with('success', 'Tour guide berhasil diverifikasi.');
    }

    public function rejectGuide($id)
    {
        $guide = TourGuideProfiles::findOrFail($id);
        $guide->status_verifikasi = 'ditolak';
        $guide->save();

        return redirect()->route('admin.tour-guides.pending')->with('success', 'Tour guide telah ditolak.');
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
            ->when($request->nama, function ($q) use ($request) {
                $q->whereHas('user', function ($subQuery) use ($request) {
                    $subQuery->where('nama_lengkap', 'like', '%' . $request->nama . '%');
                });
            })
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

    public function totalBooking(Request $request)
    {
        $bookings = Booking::with(['tourGuide.user'])
            ->when($request->traveller, function ($query, $traveller) {
                $query->where('nama_traveller', 'like', '%' . $traveller . '%');
            })
            ->when($request->guide, function ($query, $guide) {
                $query->whereHas('tourGuide.user', function ($q) use ($guide) {
                    $q->where('nama_lengkap', 'like', '%' . $guide . '%');
                });
            })
            ->when($request->tanggal, function ($query, $tanggal) {
                $query->whereDate('tanggal_booking', $tanggal);
            })
            ->latest()
            ->get();

        return view('admin.tour-guides.total-booking', compact('bookings'));
    }

    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);

        // Hapus relasi profile, bidang & tipe keahlian
        if ($user->tourGuideProfile) {
            $profile = $user->tourGuideProfile;

            // Hapus foto jika ada
            if ($profile->foto) {
                Storage::delete('public/' . $profile->foto);
            }

            // Hapus pivot bidang_keahlian dan tipe_keahlian
            $profile->bidangKeahlian()->detach();
            $profile->tipeKeahlian()->detach();

            // Hapus profile
            $profile->delete();
        }

        // Hapus akun user
        $user->delete();

        return redirect()->route('admin.tour-guides.terverifikasi')->with('success', 'Tour guide berhasil dihapus.');
    }


}
