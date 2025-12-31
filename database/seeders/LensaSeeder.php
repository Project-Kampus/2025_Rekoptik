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
            ],
            [
                'nama_lensa' => 'Single Vision Blue Cut',
                'kategori' => 'single vision',
                'material' => 'CR-39',
                'coating' => 'Blue Cut',
            ],
            [
                'nama_lensa' => 'Bifokal Standar',
                'kategori' => 'bifokal',
                'material' => 'CR-39',
                'coating' => null,
            ],
            [
                'nama_lensa' => 'Kryptok HMC',
                'kategori' => 'kryptok',
                'material' => 'CR-39',
                'coating' => 'HMC',
            ],
            [
                'nama_lensa' => 'Progresif Premium',
                'kategori' => 'progresif',
                'material' => 'High Index 1.67',
                'coating' => 'HMC',
            ],
            [
                'nama_lensa' => 'Anti Radiasi',
                'kategori' => 'single vision',
                'material' => 'CR-39',
                'coating' => 'Anti Radiasi',
            ],
            [
                'nama_lensa' => 'Photochromic',
                'kategori' => 'single vision',
                'material' => 'Polycarbonate',
                'coating' => 'Photochromic',
            ],
            [
                'nama_lensa' => 'High Index 1.74',
                'kategori' => 'single vision',
                'material' => 'High Index 1.74',
                'coating' => 'Blue Cut',
            ],
        ];

        foreach ($data as $item) {
            lensa::create($item);
        }
    }
}
