<?php

namespace Database\Seeders;

use App\Models\Pasien;
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

        $kategori = ['anak-anak', 'dewasa', 'lansia'];
        $kelas = ['gold', 'silver', 'bronze'];
        $resepDari = ['dokter mata', 'optometrisi', 'resep lama'];

        for ($i = 1; $i <= 10; $i++) {
            Pasien::create([
                // Data Pasien
                'nama_pasien' => $faker->name(),
                'no_hp' => $faker->phoneNumber(),
                'no_kartu' => 'KT' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'alamat' => $faker->address(),
                'umur' => $faker->numberBetween(5, 80),
                'email' => $faker->unique()->safeEmail(),

                // Riwayat
                'keluhan_utama' => $faker->randomElement(['Mata minus', 'Mata plus', 'Mata silinder', 'Mata kabur']),
                'riwayat_penyakit' => $faker->randomElement(['Hipertensi', 'Diabetes', 'Tidak ada', 'Asma']),
                'penyakit_sekarang' => $faker->randomElement(['Flu', 'Batuk', 'Tidak ada', 'Sakit kepala']),
                'penyakit_keluarga' => $faker->randomElement(['Diabetes', 'Hipertensi', 'Tidak ada']),
                'kebiasaan' => $faker->randomElement(['Merokok', 'Tidak merokok', 'Olahraga', 'Main gadget']),
                'pengobatan' => $faker->randomElement(['Obat tetes', 'Kacamata', 'Lensa kontak', 'Tidak ada']),

                // Pemeriksaan
                'resep_dari' => $faker->randomElement($resepDari),
                'no_sep' => $faker->optional(0.7)->numerify('SEP###########'),
                'tanggal_pemeriksaan' => $faker->dateTimeBetween('-30 days', 'now'),
                'diagnosa' => $faker->randomElement(['Myopia', 'Hyperopia', 'Astigmatism', 'Presbyopia']),
                'kategori' => $faker->randomElement($kategori),
                'kelas' => $faker->randomElement($kelas),

                // Resep OD
                'od_sferis' => $faker->randomElement([-6, -5, -4, -3, -2, -1, 0, 1, 2, 3]),
                'od_silindris' => $faker->randomElement([-2, -1.5, -1, -0.5, 0, 0.5, 1, 1.5]),
                'od_axis' => $faker->numberBetween(0, 180),
                'od_add_lensa' => $faker->randomElement([0, 1, 1.25, 1.5, 1.75, 2, 2.5, 3]),

                // Resep OS
                'os_sferis' => $faker->randomElement([-6, -5, -4, -3, -2, -1, 0, 1, 2, 3]),
                'os_silindris' => $faker->randomElement([-2, -1.5, -1, -0.5, 0, 0.5, 1, 1.5]),
                'os_axis' => $faker->numberBetween(0, 180),
                'os_add_lensa' => $faker->randomElement([0, 1, 1.25, 1.5, 1.75, 2, 2.5, 3]),
            ]);
        }
    }
}
