<?php

namespace Database\Seeders;

use App\Models\Frame;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $frames = [
            [
                'kode_frame' => 'FR-BPJS-001',
                'nama_frame' => 'Frame BPJS Standar',
                'merk' => 'Optik Utama',
                'warna' => 'Hitam',
                'bahan' => 'Plastik',
                'kategori' => 'bpjs',
                'aktif' => true,
                'harga' => 0,
                'stok' => 50,
            ],
            [
                'kode_frame' => 'FR-BPJS-002',
                'nama_frame' => 'Frame BPJS Fleksibel',
                'merk' => 'Optik Utama',
                'warna' => 'Coklat',
                'bahan' => 'TR90',
                'kategori' => 'bpjs',
                'aktif' => true,
                'harga' => 0,
                'stok' => 30,
            ],
            [
                'kode_frame' => 'FR-NB-001',
                'nama_frame' => 'Frame Premium Metal',
                'merk' => 'RayBan',
                'warna' => 'Silver',
                'bahan' => 'Metal',
                'kategori' => 'non_bpjs',
                'aktif' => true,
                'harga' => 350000,
                'stok' => 10,
            ],
            [
                'kode_frame' => 'FR-NB-002',
                'nama_frame' => 'Frame Fashion',
                'merk' => 'Oakley',
                'warna' => 'Hitam',
                'bahan' => 'Plastik',
                'kategori' => 'non_bpjs',
                'aktif' => true,
                'harga' => 250000,
                'stok' => 15,
            ],
        ];

        foreach ($frames as $frame) {
            Frame::create($frame);
        }
    }
}
