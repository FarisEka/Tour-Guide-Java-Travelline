<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourGuideProfiles extends Model
{
    use HasFactory;

    protected $table = 'tour_guide_profiles';

    protected $fillable = [
        'user_id',
        'alamat',
        'usia',
        'tempat_lahir',
        'tanggal_lahir',
        'bahasa',
        'no_telepon',
        'domisili_hpi',
        'no_lisensi',
        'tanggal_aktif_lisensi',
        'sertifikasi_bahasa',
        'waktu_guiding',
        'destinasi_sering',
        'jumlah_tamu_max',
        'lama_bertugas',
        'alasan_profesi',
        'pelatihan',
        'travel_agency',
        'pengalaman_berkesan',
        'pengalaman_komplain',
        'menyikapi_komplain',
        'menyiasati_hambatan',
        'rencana_meningkatkan_layanan',
        'foto',
        'status_verifikasi',
        'keterangan_penolakan',
    ];

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
}