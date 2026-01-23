# Seeder & Factory Documentation

## Mengubah Jumlah Data

Seeder sekarang menggunakan factory dan foreach untuk membuat data dinamis. Untuk mengubah jumlah data, buka [database/seeders/RekamMedisSeeder.php](database/seeders/RekamMedisSeeder.php) dan ubah nilai di bawah:

```php
/**
 * Jumlah data yang akan dibuat
 * Ubah nilai ini untuk menambah/mengurangi jumlah data
 */
private int $jumlahPasien = 20;              // Ubah jumlah pasien
private int $pemeriksaanPerPasien = 2;       // Ubah jumlah pemeriksaan per pasien
```

### Contoh:

- **20 pasien × 2 pemeriksaan** = 40 pemeriksaan, 40 resep, 40 pesanan, 40 pembayaran, 80+ dokumen
- Untuk membuat 50 pasien dengan 3 pemeriksaan each:
    ```php
    private int $jumlahPasien = 50;
    private int $pemeriksaanPerPasien = 3;
    ```

## Factories Yang Tersedia

### 1. RmPasienFactory

File: [database/factories/RmPasienFactory.php](database/factories/RmPasienFactory.php)

Membuat pasien dengan data random. Supports 3 kategori:

```php
// Pasien random (umum/bpjs/asuransi)
RmPasien::factory()->create();

// Pasien BPJS
RmPasien::factory()->bpjs()->create();

// Pasien Asuransi
RmPasien::factory()->asuransi()->create();

// Pasien Umum
RmPasien::factory()->umum()->create();

// Buat 10 pasien
RmPasien::factory(10)->create();
```

**Fields yang di-generate:**

- nama_pasien (random name)
- no_hp (random phone)
- email (unique email)
- alamat (random address)
- umur (18-75 tahun)
- kategori (umum/bpjs/asuransi)
- no_kartu (jika bpjs/asuransi, else null)
- kelas (jika bpjs/asuransi, else null)

### 2. RmPemeriksaanFactory

File: [database/factories/RmPemeriksaanFactory.php](database/factories/RmPemeriksaanFactory.php)

Membuat pemeriksaan medis dengan data realistis.

```php
// Pemeriksaan random
RmPemeriksaan::factory()->create();

// Pemeriksaan untuk pasien tertentu
RmPemeriksaan::factory()
    ->state(['pasien_id' => $pasien->id])
    ->create();
```

**Fields yang di-generate:**

- pasien_id (null, set via state)
- user_id (default ke 1)
- no_sep (30% chance, else null)
- keluhan_utama (random dari preset list)
- riwayat_penyakit (50% chance random, else "Tidak ada")
- penyakit_sekarang (random dari preset list)
- penyakit_keluarga (40% chance random, else "Tidak diketahui")
- kebiasaan (random sentence)
- pengobatan (50% chance random, else "Belum ada")
- diagnosa (random dari preset list)

### 3. RmResepFactory

File: [database/factories/RmResepFactory.php](database/factories/RmResepFactory.php)

Membuat resep kacamata dengan data optik yang realistis.

```php
// Resep random
RmResep::factory()->create();

// Resep untuk pemeriksaan tertentu
RmResep::factory()
    ->state(['pemeriksaan_id' => $pemeriksaan->id])
    ->create();
```

**Fields yang di-generate:**

- pemeriksaan_id (null, set via state)
- resep_dari (Optometris/Dokter Mata)
- tanggal (sekarang)
- od_sferis (Mata Kanan Sferis) (-3 s/d 2)
- od_silindris (Mata Kanan Silindris) (-1.5 s/d 0)
- od_axis (0-180 derajat)
- od_add_lensa (40% chance, 1.00-2.00)
- pd_od (Pupillary Distance, 29.5-32.5)
- os_sferis (Mata Kiri Sferis)
- os_silindris (Mata Kiri Silindris)
- os_axis (0-180 derajat)
- os_add_lensa (40% chance, 1.00-2.00)
- pd_os (Pupillary Distance)

### 4. RmPesananFactory

File: [database/factories/RmPesananFactory.php](database/factories/RmPesananFactory.php)

Membuat pesanan kacamata dengan status berbeda.

```php
// Pesanan random
RmPesanan::factory()->create();

// Pesanan dengan status dipesan
RmPesanan::factory()->dipesan()->create();

// Pesanan dengan status sedang diproses
RmPesanan::factory()->sedangDiproses()->create();

// Pesanan dengan status diambil
RmPesanan::factory()->diambil()->create();
```

**Fields yang di-generate:**

- pemeriksaan_id (null, set via state)
- resep_id (null, set via state)
- frame_id (1-5 random)
- lensa_id (1-5 random)
- aksesoris_id (50% chance, 1-5 else null)
- biaya_kacamata (500000-2000000)
- status (dipesan/sedang diproses/diambil)
- tanggal_dipesan (random dalam 30 hari terakhir)
- tanggal_pengambilan (jika status diambil, else null)

### 5. RmPembayaranFactory

File: [database/factories/RmPembayaranFactory.php](database/factories/RmPembayaranFactory.php)

Membuat pembayaran dengan berbagai metode.

```php
// Pembayaran random
RmPembayaran::factory()->create();

// Pembayaran tunai
RmPembayaran::factory()->tunai()->create();

// Pembayaran transfer
RmPembayaran::factory()->transfer()->create();

// Pembayaran BPJS
RmPembayaran::factory()->bpjs()->create();
```

**Fields yang di-generate:**

- pesanan_id (null, set via state)
- metode (tunai/transfer/kartu kredit/bpjs)
- jumlah (0, set dari pesanan->biaya_kacamata)
- tanggal_bayar (sekarang)

## Menjalankan Seeder

```bash
# Jalankan semua seeder
php artisan db:seed

# Jalankan hanya RekamMedisSeeder
php artisan db:seed --class=RekamMedisSeeder

# Reset database dan jalankan seeder
php artisan migrate:fresh --seed

# Reset dan jalankan seeder tertentu
php artisan migrate:fresh --seed --seeder=RekamMedisSeeder
```

## Struktur Data yang Dibuat

Seeder membuat data dengan struktur berikut:

```
1 Pasien
├── Pemeriksaan 1
│   ├── Resep 1
│   ├── Pesanan 1
│   │   └── Pembayaran 1
│   ├── Dokumen 1 (1-3 docs)
│   └── ...
├── Pemeriksaan 2
│   ├── Resep 2
│   ├── Pesanan 2
│   │   └── Pembayaran 2
│   ├── Dokumen 2 (1-3 docs)
│   └── ...
└── ...

Diulang untuk setiap pasien (default: 20 pasien × 2 pemeriksaan)
```

## Tips & Tricks

### Menggunakan Seeder di Testing

```php
use Database\Seeders\RekamMedisSeeder;

class MedicalRecordTest extends TestCase
{
    public function test_something()
    {
        $this->seed(RekamMedisSeeder::class);

        // Sekarang ada data untuk ditest
        $this->assertDatabaseHas('rm_pasiens', []);
    }
}
```

### Membuat Custom Data di Seeder

Jika butuh data spesifik, tambahkan sebelum factory loop:

```php
// Buat pasien khusus
RmPasien::create([
    'nama_pasien' => 'Patient Khusus',
    'email' => 'khusus@test.com',
    'umur' => 40,
    'kategori' => 'umum',
    'no_hp' => '081234567890',
    'alamat' => 'Jl. Test No. 1',
]);

// Lalu jalankan factory untuk data random
RmPasien::factory(20)->create()->each(function ($pasien) {
    // ... rest of logic
});
```
