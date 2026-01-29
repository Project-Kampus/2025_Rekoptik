<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'nama' => 'PT Optik Nusantara',
                'kontak'        => '081234567890',
                'alamat'        => 'Jakarta',
            ],
            [
                'nama' => 'CV Lensa Sejahtera',
                'kontak'        => '082345678901',
                'alamat'        => 'Bandung',
            ],
            [
                'nama' => 'UD Frame Jaya',
                'kontak'        => '083456789012',
                'alamat'        => 'Surabaya',
            ],
            [
                'nama' => 'PT Vision Optik Indonesia',
                'kontak'        => '084567890123',
                'alamat'        => 'Medan',
            ],
        ];

        foreach ($suppliers as $supplier) {
            supplier::create($supplier);
        }
    }
}
