<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidangKeahlian extends Model
{
    protected $table = 'bidang_keahlian';
    protected $fillable = ['nama_bidang'];
    public function tourGuides()
{
    return $this->belongsToMany(TourGuideProfiles::class, 'tour_guide_bidang', 'id_bidang', 'id_guide');
}
}
