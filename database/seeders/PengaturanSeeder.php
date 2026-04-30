<?php

namespace Database\Seeders;

use App\Models\Document;
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
        Pengaturan::create(
            [
                'nama_toko'     => 'OPTIK ARSY',
                'nama_aplikasi' => 'OMS ARSY',
                'alamat'        => 'Jl. Ir. H. Juanda',
                'telp'          => '(0741) 307 3466',
                'no_hp'         => '0800',
                'email'         => 'utamajambioptima@gmail.com',
                'logo'          => null, // isi manual lewat menu pengaturan
            ]
        );
    }
}
