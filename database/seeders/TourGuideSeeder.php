<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\TourGuideProfiles;
use Faker\Factory as Faker;

class TourGuideSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 3; $i++) {
            $tanggal_lahir = $faker->dateTimeBetween('-45 years', '-25 years');
            $tanggal_aktif_lisensi = (clone $tanggal_lahir)->modify('+10 years');

            $user = User::create([
                'nama_lengkap' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => 'tour_guide',
            ]);

            TourGuideProfiles::create([
                'user_id' => $user->id,
                'alamat' => $faker->address,
                'usia' => $faker->numberBetween(25, 45),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $tanggal_lahir,
                'bahasa' => 'Indonesia, Inggris',
                'no_telepon' => $faker->phoneNumber,
                'domisili_hpi' => $faker->city,
                'no_lisensi' => $faker->uuid,
                'tanggal_aktif_lisensi' => $tanggal_aktif_lisensi,
                'sertifikasi_bahasa' => 'TOEFL, JLPT N3',
                'waktu_guiding' => $faker->randomElement(['penuh waktu', 'setiap weekend']),
                'destinasi_sering' => 'Bromo, Ijen, Malang City Tour',
                'jumlah_tamu_max' => $faker->numberBetween(5, 20),
                'lama_bertugas' => $faker->numberBetween(1, 10),
                'alasan_profesi' => $faker->paragraph,
                'pelatihan' => $faker->sentence,
                'travel_agency' => $faker->company,
                'pengalaman_berkesan' => $faker->paragraph,
                'pengalaman_komplain' => $faker->paragraph,
                'menyikapi_komplain' => $faker->paragraph,
                'menyiasati_hambatan' => $faker->paragraph,
                'rencana_meningkatkan_layanan' => $faker->paragraph,
                'foto' => 'https://via.placeholder.com/150',
                'status_verifikasi' => 'menunggu',
            ]);

            $tourGuide = TourGuideProfiles::where('user_id', $user->id)->first();

            // Ambil 1–3 bidang secara acak
            $bidangIds = \App\Models\BidangKeahlian::inRandomOrder()->limit(rand(1, 3))->pluck('id');
            // Ambil 1–2 tipe secara acak
            $tipeIds = \App\Models\TipeKeahlian::inRandomOrder()->limit(rand(1, 2))->pluck('id');

            // Hubungkan tour guide ke bidang & tipe
            $tourGuide->bidangKeahlian()->attach($bidangIds);
            $tourGuide->tipeKeahlian()->attach($tipeIds);

        }
    }
}
