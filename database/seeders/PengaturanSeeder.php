<?php

namespace Database\Seeders;

use App\Models\pengaturan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        pengaturan::create(
            [
                'nama_aplikasi' => 'OPTIMA',
                'alamat'        => 'Jl. Rd. Mattaher No. 83 Pasar Jambi',
                'no_hp'       => '(0741) 20483',
                'email'         => '0852 6452 4577',
                'logo'          => null, // isi manual lewat menu pengaturan
            ]
        );
    }
}
