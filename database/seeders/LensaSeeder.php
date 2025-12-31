<?php

namespace Database\Seeders;

use App\Models\lensa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LensaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_lensa' => 'Single Vision Standar',
                'kategori' => 'single vision',
                'material' => 'CR-39',
                'coating' => null,
                'harga' => 150000,
            ],
            [
                'nama_lensa' => 'Single Vision Blue Cut',
                'kategori' => 'single vision',
                'material' => 'CR-39',
                'coating' => 'Blue Cut',
                'harga' => 250000,
            ],
            [
                'nama_lensa' => 'Bifokal Standar',
                'kategori' => 'bifokal',
                'material' => 'CR-39',
                'coating' => null,
                'harga' => 300000,
            ],
            [
                'nama_lensa' => 'Kryptok HMC',
                'kategori' => 'kryptok',
                'material' => 'CR-39',
                'coating' => 'HMC',
                'harga' => 400000,
            ],
            [
                'nama_lensa' => 'Progresif Premium',
                'kategori' => 'progresif',
                'material' => 'High Index 1.67',
                'coating' => 'HMC',
                'harga' => 650000,
            ],
            [
                'nama_lensa' => 'Anti Radiasi',
                'kategori' => 'single vision',
                'material' => 'CR-39',
                'coating' => 'Anti Radiasi',
                'harga' => 220000,
            ],
            [
                'nama_lensa' => 'Photochromic',
                'kategori' => 'single vision',
                'material' => 'Polycarbonate',
                'coating' => 'Photochromic',
                'harga' => 500000,
            ],
            [
                'nama_lensa' => 'High Index 1.74',
                'kategori' => 'single vision',
                'material' => 'High Index 1.74',
                'coating' => 'Blue Cut',
                'harga' => 800000,
            ],
        ];

        foreach ($data as $item) {
            lensa::create($item);
        }
    }
}
