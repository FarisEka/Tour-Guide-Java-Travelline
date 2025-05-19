<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipeKeahlian;

class TipeKeahlianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Group', 'Private', 'Luxury', 'Family', 'Couple'];

        foreach ($data as $nama) {
            TipeKeahlian::create(['nama_tipe' => $nama]);
        }
    }
}
