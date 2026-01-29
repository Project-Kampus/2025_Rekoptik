<?php

namespace Database\Seeders;

use App\Models\Aksesoris;
use Illuminate\Database\Seeder;

class AksesorisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Lensa Kotak',
                'material' => 'Plastik Keras',
                'keterangan' => 'Kotak penyimpanan lensa kontak',
                'supplier_id' => 1,
            ],
            [
                'nama' => 'Lap Kacamata Microfiber',
                'material' => 'Microfiber',
                'keterangan' => 'Untuk membersihkan lensa tanpa goresan',
                'supplier_id' => 1,
            ],
            [
                'nama' => 'Tali Kacamata',
                'material' => 'Karet & Nylon',
                'keterangan' => 'Mencegah kacamata jatuh',
                'supplier_id' => 2,
            ],
            [
                'nama' => 'Cairan Pembersih Lensa',
                'material' => 'Larutan Alkohol Rendah',
                'keterangan' => 'Membersihkan debu dan minyak pada lensa',
                'supplier_id' => 2,
            ],
            [
                'nama' => 'Case Kacamata',
                'material' => 'Plastik & Kulit Sintetis',
                'keterangan' => 'Pelindung kacamata saat disimpan',
                'supplier_id' => 1,
            ],
        ];

        foreach ($data as $item) {
            Aksesoris::create($item);
        }
    }
}
