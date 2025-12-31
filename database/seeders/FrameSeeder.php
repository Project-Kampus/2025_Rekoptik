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
                'kode_frame' => 'VPL 715K COL 0428',
                'merk' => 'POLICE',
                'warna' => '0428',
                'bahan' => 'Metal',
                'kategori' => 'non_bpjs',
                'harga' => 3000000,
            ],
            [
                'kode_frame' => 'VPL 556 COL 04GF',
                'merk' => 'POLICE',
                'warna' => '04GF',
                'bahan' => 'Metal',
                'kategori' => 'non_bpjs',
                'harga' => 2500000,
            ],
            [
                'kode_frame' => 'IDOL 1 SPL 495 COL 0531',
                'merk' => 'POLICE',
                'warna' => '0531',
                'bahan' => 'Metal',
                'kategori' => 'non_bpjs',
                'harga' => 3375000,
            ],
            [
                'kode_frame' => 'ENEMY SPL 369K COL 700P',
                'merk' => 'POLICE',
                'warna' => '700P',
                'bahan' => 'Metal',
                'kategori' => 'non_bpjs',
                'harga' => 3250000,
            ],
            [
                'kode_frame' => 'SPEED JR4 SK 544 COL 08H5',
                'merk' => 'POLICE',
                'warna' => '08H5',
                'bahan' => 'Metal',
                'kategori' => 'non_bpjs',
                'harga' => 2375000,
            ],
            [
                'kode_frame' => 'SB 299K COL 583',
                'merk' => 'POLICE',
                'warna' => '583',
                'bahan' => 'Metal',
                'kategori' => 'non_bpjs',
                'harga' => 2875000,
            ],
            [
                'kode_frame' => 'AFFAIR 2 SPL 621 56 0978',
                'merk' => 'POLICE',
                'warna' => '0978',
                'bahan' => 'Metal',
                'kategori' => 'non_bpjs',
                'harga' => 3500000,
            ],
            [
                'kode_frame' => 'SPEED 4 SPL 353 COL 0173',
                'merk' => 'POLICE',
                'warna' => '0173',
                'bahan' => 'Metal',
                'kategori' => 'non_bpjs',
                'harga' => 4000000,
            ],
            [
                'kode_frame' => 'EMPIRE SPL 376 COL 08F2',
                'merk' => 'POLICE',
                'warna' => '08F2',
                'bahan' => 'Metal',
                'kategori' => 'non_bpjs',
                'harga' => 3125000,
            ],
            [
                'kode_frame' => 'AFFAIR SPL 738 COL 0909',
                'merk' => 'POLICE',
                'warna' => '0909',
                'bahan' => 'Metal',
                'kategori' => 'non_bpjs',
                'harga' => 3750000,
            ],
            [
                'kode_frame' => 'SPEED JR 4 COL 08HS',
                'merk' => 'POLICE',
                'warna' => '08HS',
                'bahan' => 'Metal',
                'kategori' => 'non_bpjs',
                'harga' => 2375000,
            ],
        ];

        foreach ($frames as $frame) {
            Frame::create($frame);
        }
    }
}
