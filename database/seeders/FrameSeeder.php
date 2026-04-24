<?php

namespace Database\Seeders;

use App\Models\Frame;
use Illuminate\Database\Seeder;

class FrameSeeder extends Seeder
{
    public function run(): void
    {
        $supplierId = 1; // pastikan supplier ini ada

        $frames = [
            [
                'supplier_id' => $supplierId,
                'kode_frame'  => 'VPL 715K COL 0428',
                'merk'        => 'POLICE',
                'warna'       => '0428',
                'bahan'       => 'Metal',
                'harga'       => 350000,
            ],
            [
                'supplier_id' => $supplierId,
                'kode_frame'  => 'VPL 556 COL 04GF',
                'merk'        => 'POLICE',
                'warna'       => '04GF',
                'bahan'       => 'Metal',
                'harga'       => 375000,
            ],
            [
                'supplier_id' => $supplierId,
                'kode_frame'  => 'IDOL 1 SPL 495 COL 0531',
                'merk'        => 'POLICE',
                'warna'       => '0531',
                'bahan'       => 'Metal',
                'harga'       => 360000,
            ],
            [
                'supplier_id' => $supplierId,
                'kode_frame'  => 'ENEMY SPL 369K COL 700P',
                'merk'        => 'POLICE',
                'warna'       => '700P',
                'bahan'       => 'Metal',
                'harga'       => 380000,
            ],
            [
                'supplier_id' => $supplierId,
                'kode_frame'  => 'SPEED JR4 SK 544 COL 08H5',
                'merk'        => 'POLICE',
                'warna'       => '08H5',
                'bahan'       => 'Metal',
                'harga'       => 355000,
            ],
            [
                'supplier_id' => $supplierId,
                'kode_frame'  => 'SB 299K COL 583',
                'merk'        => 'POLICE',
                'warna'       => '583',
                'bahan'       => 'Metal',
                'harga'       => 340000,
            ],
            [
                'supplier_id' => $supplierId,
                'kode_frame'  => 'AFFAIR 2 SPL 621 56 0978',
                'merk'        => 'POLICE',
                'warna'       => '0978',
                'bahan'       => 'Metal',
                'harga'       => 365000,
            ],
            [
                'supplier_id' => $supplierId,
                'kode_frame'  => 'SPEED 4 SPL 353 COL 0173',
                'merk'        => 'POLICE',
                'warna'       => '0173',
                'bahan'       => 'Metal',
                'harga'       => 370000,
            ],
            [
                'supplier_id' => $supplierId,
                'kode_frame'  => 'EMPIRE SPL 376 COL 08F2',
                'merk'        => 'POLICE',
                'warna'       => '08F2',
                'bahan'       => 'Metal',
                'harga'       => 385000,
            ],
            [
                'supplier_id' => $supplierId,
                'kode_frame'  => 'AFFAIR SPL 738 COL 0909',
                'merk'        => 'POLICE',
                'warna'       => '0909',
                'bahan'       => 'Metal',
                'harga'       => 390000,
            ],
            [
                'supplier_id' => $supplierId,
                'kode_frame'  => 'SPEED JR 4 COL 08HS',
                'merk'        => 'POLICE',
                'warna'       => '08HS',
                'bahan'       => 'Metal',
                'harga'       => 395000,
            ],
        ];

        foreach ($frames as $frame) {
            Frame::create($frame);
        }
    }
}
