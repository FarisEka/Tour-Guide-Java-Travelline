<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourGuideProfilesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tour_guide_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('alamat');
            $table->integer('usia');
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->string('bahasa',100);
            $table->string('no_telepon',20);
            $table->string('domisili_hpi', 100);
            $table->string('no_lisensi', 100);
            $table->date('tanggal_aktif_lisensi');
            $table->text('sertifikasi_bahasa');
            $table->enum('waktu_guiding', ['penuh waktu', 'setiap weekend']);
            $table->text('destinasi_sering');
            $table->integer('jumlah_tamu_max');
            $table->integer('lama_bertugas');
            $table->text('alasan_profesi');
            $table->text('pelatihan');
            $table->text('travel_agency');
            $table->text('pengalaman_berkesan');
            $table->text('pengalaman_komplain');
            $table->text('menyikapi_komplain');
            $table->text('menyiasati_hambatan');
            $table->text('rencana_meningkatkan_layanan');
            $table->string('foto', 255);
            $table->enum('status_verifikasi', ['menunggu', 'terverifikasi'])->default('menunggu');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_guide_profiles');
    }
};
