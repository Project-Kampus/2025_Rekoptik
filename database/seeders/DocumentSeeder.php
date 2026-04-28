<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $documents = [
            [
                'nama' => 'Resep',
                'kategori' => 'bpjs',
                'keterangan' => 'Resep kacamata dari hasil pemeriksaan optometri',
            ],
            [
                'nama' => 'Elegilitas',
                'kategori' => 'bpjs',
                'keterangan' => 'Dokumen kelayakan/keabsahan peserta BPJS untuk mendapatkan pelayanan',
            ],
            [
                'nama' => 'Legalitas',
                'kategori' => 'bpjs',
                'keterangan' => 'Dokumen legalitas/keaslian status kepesertaan BPJS',
            ],
            [
                'nama' => 'Pengantar/Rujukan/Faskes',
                'kategori' => 'bpjs',
                'keterangan' => 'Surat pengantar dari fasilitas kesehatan atau surat rujukan untuk pelayanan',
            ],
            [
                'nama' => 'Surat Pernyataan Pembayaran Lebih',
                'kategori' => 'bpjs',
                'keterangan' => 'Surat pernyataan peserta bersedia membayar lebih untuk standar/kualitas yang melebihi standar BPJS',
            ],
        ];

        foreach ($documents as $document) {
            Document::create($document);
        }
    }
}
