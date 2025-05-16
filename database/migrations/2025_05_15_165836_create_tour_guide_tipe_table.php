<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourGuideTipeTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tour_guide_tipe', function (Blueprint $table) {
            $table->unsignedBigInteger('id_guide');
            $table->unsignedBigInteger('id_tipe');

            $table->primary(['id_guide', 'id_tipe']);

            $table->foreign('id_guide')->references('id')->on('tour_guide_profiles')->onDelete('cascade');
            $table->foreign('id_tipe')->references('id')->on('tipe_keahlian')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_guide_tipe');
    }
};
