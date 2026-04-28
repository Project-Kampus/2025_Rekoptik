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
                'harga' => 25000,
                'modal' => 15000,
            ],
            [
                'nama' => 'Lap Kacamata Microfiber',
                'material' => 'Microfiber',
                'keterangan' => 'Untuk membersihkan lensa tanpa goresan',
                'supplier_id' => 1,
                'harga' => 15000,
                'modal' => 8000,
            ],
            [
                'nama' => 'Tali Kacamata',
                'material' => 'Karet & Nylon',
                'keterangan' => 'Mencegah kacamata jatuh',
                'supplier_id' => 2,
                'harga' => 20000,
                'modal' => 10000,
            ],
            [
                'nama' => 'Cairan Pembersih Lensa',
                'material' => 'Larutan Alkohol Rendah',
                'keterangan' => 'Membersihkan debu dan minyak pada lensa',
                'supplier_id' => 2,
                'harga' => 30000,
                'modal' => 18000,
            ],
            [
                'nama' => 'Case Kacamata',
                'material' => 'Plastik & Kulit Sintetis',
                'keterangan' => 'Pelindung kacamata saat disimpan',
                'supplier_id' => 1,
                'harga' => 50000,
                'modal' => 28000,
            ],
        ];

        foreach ($data as $item) {
            Aksesoris::create($item);
        }
    }
}
