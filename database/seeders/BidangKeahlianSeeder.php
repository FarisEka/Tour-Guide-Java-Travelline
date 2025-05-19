<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BidangKeahlian;

class BidangKeahlianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Cultural Tour',
            'Adventure Tour',
            'Culinary Tour',
            'Religious and Pilgrimage Tour',
            'Eco Tour',
            'Educational Tour',
            'Shopping Tour',
        ];

        foreach ($data as $nama) {
            BidangKeahlian::create(['nama_bidang' => $nama]);
        }
    }
}
