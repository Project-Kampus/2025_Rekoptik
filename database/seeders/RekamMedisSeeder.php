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
    public function run(): void
    {
        RmPasien::create([
            'nama_pasien' => 'Ahmad Fauzi',
            'no_hp' => '081234567890',
            'email' => 'ahmad@example.com',
            'alamat' => 'Jl. Merdeka No. 10',
            'umur' => 35,
            'kategori' => 'umum',
            'no_kartu' => null,
            'kelas' => null,
        ]);
        RmPasien::create([
            'nama_pasien' => 'Siti Aminah',
            'no_hp' => '082345678901',
            'email' => 'siti@example.com',
            'alamat' => 'Jl. Sudirman No. 22',
            'umur' => 52,
            'kategori' => 'bpjs',
            'no_kartu' => '0001234567890',
            'kelas' => '2',
        ]);

        RmPemeriksaan::create([
            'pasien_id' => 1,
            'user_id' => 1,
            'no_sep' => null,
            'keluhan_utama' => 'Pandangan buram saat membaca',
            'riwayat_penyakit' => 'Tidak ada',
            'penyakit_sekarang' => 'Presbiopia',
            'penyakit_keluarga' => 'Tidak diketahui',
            'kebiasaan' => 'Sering bekerja di depan komputer',
            'pengobatan' => 'Belum ada',
            'diagnosa' => 'Presbiopia ringan',
        ]);

        RmPemeriksaan::create([
            'pasien_id' => 2,
            'user_id' => 1,
            'no_sep' => 'SEP-2025-001',
            'keluhan_utama' => 'Penglihatan jauh kabur',
            'riwayat_penyakit' => 'Hipertensi',
            'penyakit_sekarang' => 'Miopia',
            'penyakit_keluarga' => 'Miopia',
            'kebiasaan' => 'Membaca jarak dekat',
            'pengobatan' => 'Obat darah tinggi',
            'diagnosa' => 'Miopia sedang',
        ]);

        RmResep::create([
            'pemeriksaan_id' => 1,
            'resep_dari' => 'Optometris',

            'od_sferis' => 0.00,
            'od_silindris' => -0.50,
            'od_axis' => 90,
            'od_add_lensa' => 1.50,
            'pd_od' => 31,

            'os_sferis' => 0.00,
            'os_silindris' => -0.75,
            'os_axis' => 85,
            'os_add_lensa' => 1.50,
            'pd_os' => 31,
        ]);

        RmResep::create([
            'pemeriksaan_id' => 2,
            'resep_dari' => 'Dokter Mata',

            'od_sferis' => -2.00,
            'od_silindris' => -0.50,
            'od_axis' => 100,
            'od_add_lensa' => null,
            'pd_od' => 30.5,

            'os_sferis' => -1.75,
            'os_silindris' => -0.25,
            'os_axis' => 95,
            'os_add_lensa' => null,
            'pd_os' => 30.5,
        ]);

        RmPesanan::create([
            'pemeriksaan_id' => 1,
            'resep_id' => 1,
            'frame_id' => 1,
            'lensa_id' => 1,
            'biaya_kacamata' => 750000,
            'status' => 'dipesan',
            'tanggal_dipesan' => now(),
        ]);

        RmPesanan::create([
            'pemeriksaan_id' => 2,
            'resep_id' => 2,
            'frame_id' => 1,
            'lensa_id' => 1,
            'biaya_kacamata' => 1200000,
            'status' => 'diambil',
            'tanggal_dipesan' => now()->subDays(5),
            'tanggal_pengambilan' => now(),
        ]);

        RmPembayaran::create([
            'pesanan_id' => 1,
            'metode' => 'tunai',
            'jumlah' => 750000,
            'tanggal_bayar' => now(),
        ]);

        RmPembayaran::create([
            'pesanan_id' => 2,
            'metode' => 'bpjs',
            'jumlah' => 1200000,
            'tanggal_bayar' => now(),
        ]);

        RmDokument::create([
            'dokumens_id' => 1,
            'pemeriksaan_id' => 1,
            'url' => 'https://morth.nic.in/sites/default/files/dd12-13_0.pdf',
        ]);

        RmDokument::create([
            'dokumens_id' => 2,
            'pemeriksaan_id' => 1,
            'url' => 'https://morth.nic.in/sites/default/files/dd12-13_0.pdf',
        ]);

        RmDokument::create([
            'dokumens_id' => 1,
            'pemeriksaan_id' => 2,
            'url' => 'https://morth.nic.in/sites/default/files/dd12-13_0.pdf',
        ]);

        RmDokument::create([
            'dokumens_id' => 2,
            'pemeriksaan_id' => 2,
            'url' => 'https://morth.nic.in/sites/default/files/dd12-13_0.pdf',
        ]);
    }
}
