<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusVerifikasiEnumInTourGuideProfiles extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE tour_guide_profiles MODIFY status_verifikasi ENUM('menunggu', 'terverifikasi', 'ditolak') DEFAULT 'menunggu'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE tour_guide_profiles MODIFY status_verifikasi ENUM('menunggu', 'terverifikasi') DEFAULT 'menunggu'");
    }
}
