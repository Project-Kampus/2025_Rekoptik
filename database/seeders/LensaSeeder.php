<?php

namespace Database\Seeders;

use App\Models\Lensa;
use Illuminate\Database\Seeder;

class LensaSeeder extends Seeder
{
    public function run(): void
    {
        $supplierId = 2; // pastikan supplier ini ada

        $data = [
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Single Vision Standar',
                'kategori'    => 'single vision',
                'material'    => 'CR-39',
                'coating'     => null,
                'od'          => 0,
                'os'          => 0,
                'harga'       => 250000,
                'modal'       => 150000,
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Single Vision Blue Cut',
                'kategori'    => 'single vision',
                'material'    => 'CR-39',
                'coating'     => 'Blue Cut',
                'od'          => 0,
                'os'          => 0,
                'harga'       => 300000,
                'modal'       => 180000,
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Bifokal Standar',
                'kategori'    => 'bifokal',
                'material'    => 'CR-39',
                'coating'     => null,
                'od'          => 0,
                'os'          => 0,
                'harga'       => 350000,
                'modal'       => 210000,
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Kryptok HMC',
                'kategori'    => 'kryptok',
                'material'    => 'CR-39',
                'coating'     => 'HMC',
                'od'          => 0,
                'os'          => 0,
                'harga'       => 400000,
                'modal'       => 240000,
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Progresif Premium',
                'kategori'    => 'progresif',
                'material'    => 'High Index 1.67',
                'coating'     => 'HMC',
                'od'          => 0,
                'os'          => 0,
                'harga'       => 800000,
                'modal'       => 480000,
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Anti Radiasi',
                'kategori'    => 'single vision',
                'material'    => 'CR-39',
                'coating'     => 'Anti Radiasi',
                'od'          => 0,
                'os'          => 0,
                'harga'       => 320000,
                'modal'       => 192000,
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Photochromic',
                'kategori'    => 'single vision',
                'material'    => 'Polycarbonate',
                'coating'     => 'Photochromic',
                'od'          => 0,
                'os'          => 0,
                'harga'       => 600000,
                'modal'       => 360000,
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'High Index 1.74',
                'kategori'    => 'single vision',
                'material'    => 'High Index 1.74',
                'coating'     => 'Blue Cut',
                'od'          => 0,
                'os'          => 0,
                'harga'       => 500000,
                'modal'       => 300000,
            ],
        ];

        foreach ($data as $item) {
            Lensa::create($item);
        }
    }
}
