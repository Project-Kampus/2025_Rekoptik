<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Ahmad Fauzi',
            'Siti Aisyah',
            'Muhammad Rizki',
            'Nur Hasanah',
            'Andi Saputra',
            'Dewi Lestari',
            'Rudi Hartono',
            'Fitriani',
            'Budi Santoso',
            'Intan Permata',
        ];

        foreach ($names as $index => $nama) {

            $biaya  = rand(350000, 700000);
            $bpjs   = rand(200000, 350000);
            $pasien = rand(0, $biaya - $bpjs);

            Pasien::create([
                // Data pasien
                'nama_pasien' => $nama,
                'no_hp' => '08' . rand(1111111111, 9999999999),
                'no_kartu' => '000' . rand(1000000000, 9999999999),
                'alamat' => 'Jambi',

                // Pemeriksaan
                'resep_dari' => 'Dokter Spesialis Mata',
                'no_sep' => 'SEP00' . ($index + 1),
                'tanggal_pemeriksaan' => Carbon::now()->subDays(rand(1, 7)),
                'diagnosa' => 'Miopi',
                'kategori' => 'BPJS',

                // Resep OD
                'od_sferis' => -1.00,
                'od_silindris' => -0.50,
                'od_axis' => 180,
                'od_add_lensa' => 1.00,

                // Resep OS
                'os_sferis' => -1.25,
                'os_silindris' => -0.75,
                'os_axis' => 170,
                'os_add_lensa' => 1.00,

                // Kacamata
                'frame_id' => 1,
                'lensa_id' => 1,
                'pd' => 62,

                // Biaya
                'biaya_kacamata' => $biaya,
                'dibayar_bpjs' => $bpjs,
                'dibayar_pasien' => $pasien,
                'sisa' => $biaya - ($bpjs + $pasien),

                // Tanggal
                'tanggal_dipesan' => Carbon::now()->subDays(rand(1, 5)),
                'tanggal_pengambilan' => Carbon::now()->addDays(rand(2, 5)),
            ]);
        }
    }
}
