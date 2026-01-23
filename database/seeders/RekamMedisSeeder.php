<?php

namespace Database\Seeders;

use App\Models\RmDokument;
use App\Models\RmPasien;
use App\Models\RmPembayaran;
use App\Models\RmPemeriksaan;
use App\Models\RmPesanan;
use App\Models\RmResep;
use Illuminate\Database\Seeder;

class RekamMedisSeeder extends Seeder
{
    /**
     * Jumlah data yang akan dibuat
     * Ubah nilai ini untuk menambah/mengurangi jumlah data
     */
    private int $jumlahPasien = 20;
    private int $pemeriksaanPerPasien = 2;

    public function run(): void
    {
        // Create patients dan related data
        RmPasien::factory($this->jumlahPasien)->create()->each(function ($pasien) {
            // Create medical examinations untuk setiap pasien
            RmPemeriksaan::factory($this->pemeriksaanPerPasien)
                ->state(['pasien_id' => $pasien->id])
                ->create()
                ->each(function ($pemeriksaan) {
                    // Create resep untuk setiap pemeriksaan
                    $resep = RmResep::factory()
                        ->state(['pemeriksaan_id' => $pemeriksaan->id])
                        ->create();

                    // Create pesanan untuk setiap pemeriksaan
                    $pesanan = RmPesanan::factory()
                        ->state([
                            'pemeriksaan_id' => $pemeriksaan->id,
                            'resep_id' => $resep->id,
                        ])
                        ->create();

                    // Create pembayaran untuk setiap pesanan
                    RmPembayaran::factory()
                        ->state([
                            'pesanan_id' => $pesanan->id,
                            'jumlah' => $pesanan->biaya_kacamata,
                        ])
                        ->create();

                    // Create dokumen untuk setiap pemeriksaan
                    $this->attachDokumen($pemeriksaan->id);
                });
        });
    }

    /**
     * Attach dokumen ke pemeriksaan
     */
    private function attachDokumen($pemeriksaanId): void
    {
        // Attach 1-3 dokumen per pemeriksaan
        $jumlahDokumen = rand(1, 3);

        for ($i = 1; $i <= $jumlahDokumen; $i++) {
            RmDokument::create([
                'dokumens_id' => rand(1, 2), // Assuming ada minimal 2 dokumen tipe
                'pemeriksaan_id' => $pemeriksaanId,
                'url' => 'https://example.com/dokumen/' . uniqid() . '.pdf',
            ]);
        }
    }
}
