<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'nama_traveller',
        'email',
        'no_hp',
        'id_guide',
        'tanggal_booking',
        'durasi_hari',
        'status',
    ];

    public function tourGuide()
    {
        return $this->belongsTo(TourGuideProfiles::class, 'id_guide');
    }
}
