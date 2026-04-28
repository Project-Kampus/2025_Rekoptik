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
                ->each(function ($pemeriksaan) use ($pasien) {
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

                    // Create dokumen untuk setiap pemeriksaan (hanya untuk BPJS)
                    $this->attachDokumen($pemeriksaan->id, $pasien->kategori);
                });
        });
    }

    /**
     * Attach dokumen ke pemeriksaan sesuai kategori pasien
     */
    private function attachDokumen($pemeriksaanId, $kategoriPasien): void
    {
        // Hanya attach dokumen jika kategori pasien adalah BPJS
        if ($kategoriPasien !== 'bpjs') {
            return;
        }

        // Dokumen BPJS: IDs 1-5 (Resep, Elegilitas, Legalitas, Pengantar/Rujukan, Surat Pernyataan)
        $dokumenBpjsIds = [1, 2, 3, 4, 5];

        // Attach 2-5 dokumen per pemeriksaan
        $jumlahDokumen = rand(2, 5);
        $selectedDokumen = array_rand(array_flip($dokumenBpjsIds), min($jumlahDokumen, count($dokumenBpjsIds)));

        foreach ((array) $selectedDokumen as $dokumenId) {
            RmDokument::create([
                'dokumens_id' => $dokumenId,
                'pemeriksaan_id' => $pemeriksaanId,
                'url' => 'https://example.com/dokumen/' . uniqid() . '.pdf',
            ]);
        }
    }
}
