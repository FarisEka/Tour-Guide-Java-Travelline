<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRoleEnumOnUsersTable extends Migration
{
    public function up(): void
    {
        // Ubah enum menjadi 'admin' dan 'pengguna' saja
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'pengguna') NOT NULL");
    }

    public function down(): void
    {
        // Rollback: kembalikan ke enum sebelumnya
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'tour_guide') NOT NULL");
    }
};
