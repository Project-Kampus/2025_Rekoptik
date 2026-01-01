<?php

namespace Database\Seeders;

use App\Models\lensa;
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
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Single Vision Blue Cut',
                'kategori'    => 'single vision',
                'material'    => 'CR-39',
                'coating'     => 'Blue Cut',
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Bifokal Standar',
                'kategori'    => 'bifokal',
                'material'    => 'CR-39',
                'coating'     => null,
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Kryptok HMC',
                'kategori'    => 'kryptok',
                'material'    => 'CR-39',
                'coating'     => 'HMC',
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Progresif Premium',
                'kategori'    => 'progresif',
                'material'    => 'High Index 1.67',
                'coating'     => 'HMC',
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Anti Radiasi',
                'kategori'    => 'single vision',
                'material'    => 'CR-39',
                'coating'     => 'Anti Radiasi',
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'Photochromic',
                'kategori'    => 'single vision',
                'material'    => 'Polycarbonate',
                'coating'     => 'Photochromic',
            ],
            [
                'supplier_id' => $supplierId,
                'nama_lensa'  => 'High Index 1.74',
                'kategori'    => 'single vision',
                'material'    => 'High Index 1.74',
                'coating'     => 'Blue Cut',
            ],
        ];

        foreach ($data as $item) {
            lensa::create($item);
        }
    }
}
