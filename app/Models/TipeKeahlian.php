<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeKeahlian extends Model
{
    protected $table = 'tipe_keahlian';
    protected $fillable = ['nama_tipe'];
    // app/Models/TipeKeahlian.php
public function tourGuides()
{
    return $this->belongsToMany(TourGuideProfiles::class, 'tour_guide_tipe', 'id_tipe', 'id_guide');
}

}
