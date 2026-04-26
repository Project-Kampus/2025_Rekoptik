<?php

namespace Database\Seeders;

use App\Models\Pasien;
use App\Models\RmPasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $kategori = ['umum', 'bpjs', 'asuransi'];
        $kelas = ['1', '2', '3'];

        for ($i = 1; $i <= 10; $i++) {
            $selectedKategori = $faker->randomElement($kategori);

            RmPasien::create([
                'nama_pasien' => $faker->name(),
                'no_hp' => $faker->phoneNumber(),
                'email' => $faker->unique()->safeEmail(),
                'alamat' => $faker->address(),
                'tanggal_lahir' => $faker->date(),
                'kategori' => $selectedKategori,
                'no_kartu' => 'KT' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'kelas' => in_array($selectedKategori, ['bpjs', 'asuransi'])
                    ? $faker->randomElement($kelas)
                    : null
            ]);
        }
    }
}
