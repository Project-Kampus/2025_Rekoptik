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
                'harga'       => 250000,
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Single Vision Blue Cut',
                'kategori'    => 'single vision',
                'material'    => 'CR-39',
                'coating'     => 'Blue Cut',
                'harga'       => 300000,
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Bifokal Standar',
                'kategori'    => 'bifokal',
                'material'    => 'CR-39',
                'coating'     => null,
                'harga'       => 350000,
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Kryptok HMC',
                'kategori'    => 'kryptok',
                'material'    => 'CR-39',
                'coating'     => 'HMC',
                'harga'       => 400000,
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Progresif Premium',
                'kategori'    => 'progresif',
                'material'    => 'High Index 1.67',
                'coating'     => 'HMC',
                'harga'       => 800000,
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Anti Radiasi',
                'kategori'    => 'single vision',
                'material'    => 'CR-39',
                'coating'     => 'Anti Radiasi',
                'harga'       => 320000,
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Photochromic',
                'kategori'    => 'single vision',
                'material'    => 'Polycarbonate',
                'coating'     => 'Photochromic',
                'harga'       => 600000,
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'High Index 1.74',
                'kategori'    => 'single vision',
                'material'    => 'High Index 1.74',
                'coating'     => 'Blue Cut',
                'harga'       => 500000,
            ],
        ];

        foreach ($data as $item) {
            lensa::create($item);
        }
    }
}
