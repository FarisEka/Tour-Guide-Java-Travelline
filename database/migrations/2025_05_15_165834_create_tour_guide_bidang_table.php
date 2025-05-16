<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourGuideBidangTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tour_guide_bidang', function (Blueprint $table) {
             $table->unsignedBigInteger('id_guide');
            $table->unsignedBigInteger('id_bidang');

            $table->primary(['id_guide', 'id_bidang']);

            $table->foreign('id_guide')->references('id')->on('tour_guide_profiles')->onDelete('cascade');
            $table->foreign('id_bidang')->references('id')->on('bidang_keahlian')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_guide_bidang');
    }
};
