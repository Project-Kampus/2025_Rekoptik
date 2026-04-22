# 📘 Panduan Pengguna - Rekoptik (OMS Rekoptik)

Panduan lengkap penggunaan aplikasi Rekoptik (Optical Management System Rekoptik) untuk setiap level pengguna.

---

## 📑 Daftar Isi

1. [Panduan Superadmin](#panduan-superadmin)
2. [Panduan Admin](#panduan-admin)
3. [Panduan Admin BPJS](#panduan-admin-bpjs)

---

# PANDUAN SUPERADMIN

## 🔐 Deskripsi Peran Superadmin

Superadmin adalah pengguna dengan akses tertinggi dalam sistem Rekoptik. Superadmin memiliki wewenang untuk mengelola semua aspek aplikasi termasuk data master, pengguna, dan konfigurasi sistem.

## ✅ Hak Akses & Fitur Utama

Superadmin memiliki akses penuh ke:

- ✓ Dashboard dengan analitik lengkap
- ✓ Manajemen pengguna (User Management)
- ✓ Manajemen data master (Master Data)
    - Dokumen
    - Aksesoris / Frame / Lensa
    - Supplier
- ✓ Manajemen klinik / pengaturan
- ✓ Rekam medis pasien
- ✓ Laporan dan rekapitulasi data
- ✓ Pengaturan sistem

## 🚀 Cara Login

1. Buka aplikasi Rekoptik di browser
2. Masukkan **Email** dan **Password**
3. Klik tombol **Login**
4. Sistem akan mengarahkan ke Dashboard Superadmin

## 📊 Dashboard Superadmin

Dashboard menampilkan ringkasan lengkap operasional klinik:

- **Total Pasien**: Jumlah seluruh pasien terdaftar
- **Data Medis Minggu Ini**: Jumlah rekam medis terbaru
- **Pendapatan**: Ringkasan pembayaran masuk
- **Aktivitas Terbaru**: Log aktivitas sistem

### Fitur di Dashboard:

- Grafik statistik kunjungan pasien
- Data pemeriksaan terkini
- Alert dan notifikasi penting

---

## 📋 Menu Utama Superadmin

### 1. 🏥 Data Master

Menu untuk mengelola data referensi aplikasi.

#### a) Kelola Dokumen

**Lokasi Menu:** Data Master → Dokumen

**Fungsi:**

- Menambah jenis dokumen baru
- Mengedit data dokumen
- Menghapus dokumen
- Melihat daftar lengkap dokumen

**Cara Menambah Dokumen:**

1. Klik menu **Data Master** → **Dokumen**
2. Klik tombol **Tambah Dokumen** (hijau)
3. Isi formulir:
    - **Nama Dokumen**: Contoh: "KTP", "Kartu Kesehatan"
    - **Deskripsi**: Penjelasan singkat
4. Klik **Simpan**

#### b) Kelola Aksesoris, Frame & Lensa

**Lokasi Menu:** Data Master → Aksesoris / Frame / Lensa

**Fungsi:**

- Menambah item produk (aksesoris, frame, lensa)
- Mengedit harga dan spesifikasi
- Memantau stok tersedia
- Menghapus item yang tidak digunakan

**Cara Menambah Produk:**

1. Klik **Data Master** → pilih **Aksesoris** / **Frame** / **Lensa**
2. Klik **Tambah [Produk]** (hijau)
3. Isi detail:
    - **Nama Produk**: Nama lengkap item
    - **Harga**: Harga jual
    - **Stok**: Jumlah stok awal
    - **Deskripsi/Spesifikasi**: Detail teknis (opsional)
    - **Supplier**: Pilih supplier penyedia
4. Klik **Simpan**

#### c) Kelola Supplier

**Lokasi Menu:** Data Master → Supplier

**Fungsi:**

- Menambah supplier / vendor baru
- Mengedit data kontak supplier
- Mengelola aksesoris dari supplier
- Menghapus supplier

**Cara Menambah Supplier:**

1. Klik **Data Master** → **Supplier**
2. Klik **Tambah Supplier** (hijau)
3. Isi formulir:
    - **Nama Supplier**: Nama perusahaan
    - **Alamat**: Alamat lengkap
    - **No Telepon**: Nomor kontak utama
    - **Email**: Email supplier
    - **PIC (Person In Charge)**: Nama contact person
4. Klik **Simpan**

### 2. 👥 Manajemen Pengguna

Menu untuk mengelola akun pengguna sistem.

**Lokasi Menu:** Pengaturan → Manajemen Pengguna

**Fitur Utama:**

- Tambah pengguna baru
- Ubah role pengguna (Admin, Admin BPJS, Petugas)
- Deaktifkan/aktifkan akun
- Reset password pengguna

**Cara Menambah Pengguna:**

1. Klik **Pengaturan** → **Manajemen Pengguna**
2. Klik **Tambah Pengguna Baru** (hijau)
3. Isi data:
    - **Nama**: Nama lengkap
    - **Email**: Email unik untuk login
    - **Password**: Password awal (pengguna bisa ubah)
    - **Role**: Pilih role sesuai tugasnya
        - **Admin**: Akses lengkap untuk admin
        - **Admin BPJS**: Khusus pengelolaan BPJS
        - **Petugas**: Akses terbatas untuk input data
4. Klik **Simpan**

**Cara Mengubah Role Pengguna:**

1. Di halaman Manajemen Pengguna, cari pengguna
2. Klik tombol **Edit** (pensil)
3. Ubah **Role** sesuai kebutuhan
4. Klik **Simpan**

### 3. ⚙️ Pengaturan Sistem

Menu untuk konfigurasi umum aplikasi.

**Lokasi Menu:** Pengaturan → Pengaturan Sistem

**Opsi yang Dapat Dikonfigurasi:**

- Nama Aplikasi
- Nama Klinik / Optik
- Logo Klinik / Optik
- Nomor HP/WhatsApp
- Nomor Telepon
- Email
- Alamat

**Cara Mengubah Pengaturan:**

1. Klik **Pengaturan** → **Pengaturan Sistem**
2. Edit field yang diperlukan
3. Klik **Simpan Perubahan**

### 4. 📁 Rekam Medis

Menu untuk melihat semua rekam medis pasien (referensi).

**Lokasi Menu:** Rekam Medis → Data Medis

**Fitur:**

- Melihat semua data medis
- Filter berdasarkan tanggal/pasien
- Ekspor data ke Excel/PDF
- Audit log riwayat perubahan

### 5. 📊 Rekap Pemeriksaan

Menu untuk membuat rekapitulasi data pemeriksaan.

**Lokasi Menu:** Laporan → Rekap Pemeriksaan

**Fungsi:**

- Data pemeriksaan per tanggal/periode
- Jumlah pasien yang diperiksa
- Total pemeriksaan

**Cara Membuat Rekap Pemeriksaan:**

1. Klik menu **Laporan** → **Rekap Pemeriksaan**
2. Pilih tanggal awal - akhir
3. Klik **Generate Rekap**
4. Ekspor format:
    - **Excel**: Untuk analisis dan dokumentasi

---

## 📱 Profil Pengguna

**Lokasi Menu:** Ikon Profil (pojok atas kanan) → Profil Saya

**Fungsi:**

- Ubah nama penampilan
- Ubah password

**Cara Mengubah Nama:**

1. Klik profil → **Profil Saya**
2. Edit **Nama**
3. Klik **Simpan**

**Cara Mengubah Password:**

1. Klik profil → **Profil Saya**
2. Scroll ke bagian **Ubah Password**
3. Masukkan:
    - **Password Saat Ini**: Password lama
    - **Password Baru**: Password baru
    - **Konfirmasi Password**: Ulangi password baru
4. Klik **Perbarui Password**

---

## ⚠️ Tips Keamanan untuk Superadmin

1. **Jaga Kerahasiaan Akun**: Password hanya untuk Superadmin
2. **Audit Log Rutin**: Periksa aktivitas user secara berkala
3. **Update Password**: Ubah password setiap 90 hari
4. **Jangan Share Akun**: Setiap user harus punya akun sendiri

---

---

# PANDUAN ADMIN

## 🔐 Deskripsi Peran Admin

Admin adalah pengguna dengan akses menyeluruh untuk mengelola data klinik. Admin dapat mengelola data pasien, rekam medis, pembayaran, dan laporan operasional. Admin tidak memiliki akses ke manajemen pengguna atau pengaturan sistem.

## ✅ Hak Akses & Fitur Utama

Admin memiliki akses ke:

- ✓ Dashboard dengan statistik operasional
- ✓ Manajemen data pasien
- ✓ Input dan kelola rekam medis
- ✓ Manajemen pemesanan kacamata
- ✓ Kelola pembayaran/invoice
- ✓ Lihat laporan data
- ✗ Tidak bisa ubah pengguna/admin
- ✗ Tidak bisa ubah pengaturan sistem

## 🚀 Cara Login

1. Buka aplikasi Rekoptik di browser
2. Masukkan **Email** dan **Password** yang diberikan
3. Klik tombol **Login**
4. Sistem akan mengarahkan ke Dashboard Admin

---

## 📊 Dashboard Admin

Dashboard menampilkan ringkasan operasional harian:

- **Total Pasien**: Jumlah pasien terdaftar
- **Kunjungan Hari Ini**: Data pemeriksaan hari ini
- **Pendapatan Hari Ini**: Pembayaran masuk hari ini
- **Pesanan Terbaru**: Daftar pesanan kacamata
- **Quick Actions**: Tombol akses cepat untuk fungsi utama

---

## 📋 Menu Utama Admin

### 1. 👥 Identitas Pasien

Menu untuk mengelola data demografi pasien.

**Lokasi Menu:** Rekam Medis → Identitas Pasien

#### a) Melihat Daftar Pasien

1. Klik **Rekam Medis** → **Identitas Pasien**
2. Tampil daftar pasien dengan kolom:
    - Nama pasien
    - NIK / No Identitas
    - Nomor Telepon
    - Alamat
    - Tanggal Daftar

#### b) Menambah Pasien Baru

1. Klik tombol **Tambah Pasien Baru** (hijau)
2. Isi form:
    - **Nama Lengkap**: Nama sesuai identitas
    - **NIK / No ID**: Nomor identitas (KTP, SIM, Passport)
    - **Nomor Telepon**: Nomor HP yang aktif
    - **Alamat Lengkap**: Alamat tempat tinggal
    - **Jenis Kelamin**: Pilih M/F
    - **Tanggal Lahir**: Tanggal lahir pasien
    - **Status BPJS**: Ya/Tidak (jika ada)
    - **Nomor BPJS** (jika ada): Nomor kartu BPJS
3. Klik **Simpan**

#### c) Mengedit Data Pasien

1. Cari nama pasien di daftar
2. Klik tombol **Edit** (pensil)
3. Ubah data yang diperlukan
4. Klik **Simpan**

#### d) Melihat Riwayat Pasien

1. Di daftar, klik **Lihat Detail** atau nama pasien
2. Tampil halaman profil dengan:
    - Data identitas lengkap
    - Riwayat pemeriksaan
    - Riwayat pesanan
    - Riwayat pembayaran

### 2. 📝 Input Pemeriksaan & Pesanan

Menu untuk membuat rekam medis baru (pemeriksaan + pesanan kacamata).

**Lokasi Menu:** Rekam Medis → Tambah Pemeriksaan

Proses ini dibagi menjadi beberapa tahap:

#### Langkah 1: Identifikasi Pasien

1. Klik **Rekam Medis** → **Tambah Pemeriksaan**
2. Cari pasien:
    - **Opsi A**: Ketik nama pasien (sistem akan auto-complete)
    - **Opsi B**: Klik "Pasien Baru" jika pasien belum terdaftar
3. Klik **Lanjut**

#### Langkah 2: Data Pemeriksaan

Isi data pemeriksaan mata:

**A. Keluhan Pasien:**

- **Keluhan Utama**: Deskripsi keluhan pasien
- **Riwayat Penyakit**: Riwayat penyakit mata sebelumnya

**B. Data Pemeriksaan Mata Kiri & Kanan:**
Untuk masing-masing mata (OD - Kanan, OS - Kiri), isi:

- **Visus (Tajam Penglihatan)**: Contoh: 6/6, 6/12, 6/60
- **Sfera (SPH)**: Nilai koreksi bola (+/-)
- **Silinder (CYL)**: Nilai silinder (+/-)
- **Axis**: Sudut kemiringan (0-180)
- **Kat. Rencana**: Jenis resep (kacamata, softlens, dll)

**C. Kelanjutan Pemeriksaan:**

- **Lanjut Optometri?**: Ya/Tidak
- **Catatan Tambahan**: Catatan hasil pemeriksaan

3. Klik **Lanjut**

#### Langkah 3: Pesanan Kacamata (Opsional)

Jika pasien pesan kacamata:

1. Klik **Tambah Pesanan**
2. Isi detail:
    - **Jenis Frame**: Pilih frame dari daftar
    - **Jenis Lensa**: Pilih lensa dari daftar
    - **Aksesoris**: Pilih aksesoris tambahan (opsional)
    - **Jumlah**: Berapa pasang/unit
    - **Harga Satuan**: Harga per unit
    - **Total Harga**: Otomatis dihitung
    - **Catatan**: Catatan khusus untuk pesanan

3. Klik **Lanjut**

#### Langkah 4: Pembayaran

Proses pembayaran pemeriksaan & pesanan:

1. **Metode Pembayaran**: Pilih:
    - Tunai
    - Transfer Bank
    - E-wallet
    - BPJS

2. **Rincian Biaya:**
    - Pemeriksaan: Rp XXX.XXX
    - Pesanan: Rp XXX.XXX
    - **Total**: Rp XXX.XXX

3. **Status Pembayaran:**
    - **Lunas**: Pembayaran lengkap
    - **Cicilan**: Pembayaran bertahap
    - **Belum Bayar**: Pencatatan saja, bayar nanti

4. Jika sudah bayar, masukkan **Bukti Pembayaran** (foto struk atau nomor referensi)

5. Klik **Selesai**

### 3. 📊 Data Medis (Lihat & Edit)

Menu untuk melihat daftar rekam medis yang sudah dibuat.

**Lokasi Menu:** Rekam Medis → Data Medis

#### a) Melihat Daftar Data Medis

1. Tampil daftar dengan kolom:
    - Nama pasien
    - Tanggal pemeriksaan
    - Status pesanan
    - Status pembayaran
    - Aksi (lihat, edit, cetak)

#### b) Filter Data Medis

Gunakan filter untuk mencari data:

- **Berdasarkan Tanggal**: Dari - Sampai
- **Berdasarkan Nama Pasien**: Ketik nama
- **Berdasarkan Status**: Belum Lunas, Lunas, Pesanan Proses, dll

#### c) Melihat Detail Pemeriksaan

1. Klik tombol **Lihat** atau nama pasien
2. Tampil halaman detail dengan:
    - Data pasien
    - Hasil pemeriksaan (sfera, silinder, axis, etc)
    - Detail pesanan (jika ada)
    - Riwayat pembayaran

#### d) Edit Data Pemeriksaan

1. Klik tombol **Edit** (pensil)
2. Ubah data sesuai kebutuhan:
    - Data pemeriksaan
    - Pesanan
    - Pembayaran
3. Klik **Simpan Perubahan**

#### e) Cetak Resep/Struk

1. Di halaman detail, klik **Cetak Resep**
2. Pilih template:
    - Resep Kacamata (untuk optik lain)
    - Struk Pembayaran
3. Dokumen akan otomatis diunduh dalam format PDF

### 4. � Rekap Pemeriksaan

Menu untuk membuat rekapitulasi data pemeriksaan.

**Lokasi Menu:** Laporan → Rekap Pemeriksaan

**Fungsi:**

- Data pemeriksaan per tanggal/periode
- Jumlah pasien yang diperiksa
- Total pemeriksaan

**Cara Membuat Rekap Pemeriksaan:**

1. Klik **Laporan** → **Rekap Pemeriksaan**
2. Pilih tanggal awal - akhir
3. Klik **Generate Rekap**
4. Ekspor format:
    - **Excel**: Untuk analisis dan dokumentasi

---

## 📱 Profil & Pengaturan Personal

**Lokasi Menu:** Ikon Profil (pojok atas kanan)

#### Ubah Nama

1. Klik profil → **Profil Saya**
2. Edit **Nama Tampilan**
3. Klik **Simpan**

#### Ubah Password

1. Klik profil → **Profil Saya**
2. Scroll ke **Ubah Password**
3. Masukkan:
    - Password lama
    - Password baru
    - Konfirmasi password baru
4. Klik **Perbarui**

---

## 🎯 Workflow Umum Admin Sehari-hari

### Pagi (Persiapan):

1. ✓ Login ke sistem
2. ✓ Lihat dashboard untuk aktivitas terbaru
3. ✓ Persiapkan data pasien hari ini

### Siang (Operasional):

1. ✓ Input pemeriksaan pasien baru
2. ✓ Catat pesanan kacamata
3. ✓ Proses pembayaran
4. ✓ Cetak struk/resep

### Sore (Penutupan):

1. ✓ Rekon pembayaran hari ini
2. ✓ Lihat laporan harian
3. ✓ Logout sistem

---

## ⚠️ Tips Penting untuk Admin

1. **Verifikasi Data Pasien**: Pastikan data NIK dan nomor telepon valid
2. **Catatan Lengkap**: Isi semua field pemeriksaan dengan akurat
3. **Simpan Bukti**: Simpan foto struk pembayaran untuk referensi
4. **Backup Rutin**: Minta backup data ke Superadmin
5. **Komunikasi**: Jika ada error, laporkan ke Superadmin

---

---

# PANDUAN ADMIN BPJS

## 🏥 Deskripsi Peran Admin BPJS

Admin BPJS adalah pengguna khusus yang menangani pengelolaan data dan billing pasien BPJS (Badan Penyelenggara Jaminan Sosial). Admin BPJS memiliki akses terbatas hanya untuk transaksi dan laporan BPJS.

## ✅ Hak Akses & Fitur Utama

Admin BPJS memiliki akses ke:

- ✓ Dashboard BPJS
- ✓ Daftar pasien dengan BPJS
- ✓ Input pemeriksaan pasien BPJS
- ✓ Kelola billing BPJS
- ✓ Rekap dan laporan BPJS
- ✓ Cetak klaim BPJS
- ✗ Tidak bisa mengelola pasien non-BPJS
- ✗ Tidak bisa ubah data master
- ✗ Tidak bisa manajemen pengguna

## 🚀 Cara Login

1. Buka aplikasi Rekoptik di browser
2. Masukkan **Email** dan **Password** (akun Admin BPJS)
3. Klik tombol **Login**
4. Sistem akan mengarahkan ke Dashboard BPJS

---

## 📊 Dashboard Admin BPJS

Dashboard menampilkan ringkasan BPJS:

- **Total Pasien BPJS**: Jumlah pasien dengan kartu BPJS
- **Kunjungan BPJS Hari Ini**: Pemeriksaan pasien BPJS hari ini
- **Billing Belum Diklaim**: Total biaya yang belum dikirim ke BPJS
- **Retensi Klaim**: Persentase klaim yang berhasil
- **Status Klaim Terbaru**: Daftar klaim terbaru

---

## 📋 Menu Utama Admin BPJS

### 1. 👥 Pasien BPJS

Menu khusus untuk mengelola data pasien BPJS.

**Lokasi Menu:** BPJS → Pasien BPJS

#### a) Melihat Daftar Pasien BPJS

1. Klik **BPJS** → **Pasien BPJS**
2. Tampil daftar pasien BPJS dengan kolom:
    - Nama pasien
    - Nomor BPJS
    - Jenis Kepesertaan (PBI/Non-PBI)
    - Nama Keluarga Pengguna (NIK Peserta Utama)
    - Tanggal Terdaftar

#### b) Filter Pasien BPJS

Gunakan filter:

- **Berdasarkan Nama**: Ketik nama pasien
- **Berdasarkan Nomor BPJS**: Ketik nomor kartu
- **Berdasarkan Status**: Aktif / Tidak Aktif
- **Berdasarkan Jenis**: PBI / Non-PBI / Mandiri

#### c) Tambah Data Pasien BPJS Baru

1. Klik **Tambah Pasien BPJS** (hijau)
2. Isi data:
    - **Nama Lengkap**: Sesuai identitas
    - **NIK**: Nomor Induk Kependudukan
    - **Nomor BPJS**: Nomor kartu BPJS
    - **Jenis Kepesertaan**:
        - PBI (Penerima Bantuan Iuran)
        - Non-PBI (Peserta Mandiri)
        - PJPS (Pekerja Jasa Konstruksi)
    - **Nama Keluarga Pengguna** (jika peserta tambahan): Nama peserta utama
    - **Nomor Identitas Peserta Utama**: NIK peserta utama
    - **Status Kepesertaan**: Aktif / Tidak Aktif
    - **Nomor Telepon**: Kontak pasien
    - **Alamat**: Alamat tinggal

3. Klik **Simpan**

#### d) Edit Data Pasien BPJS

1. Cari pasien di daftar
2. Klik **Edit** (pensil)
3. Ubah data yang diperlukan (biasanya: status, nomor BPJS)
4. Klik **Simpan**

#### e) Lihat Riwayat Kunjungan Pasien

1. Di daftar, klik nama pasien atau **Lihat Detail**
2. Tampil halaman profil dengan:
    - Data identitas BPJS lengkap
    - Riwayat kunjungan
    - Riwayat klaim
    - Total billing

### 2. 📝 Input Pemeriksaan BPJS

Menu untuk membuat rekam medis pasien BPJS.

**Lokasi Menu:** BPJS → Input Pemeriksaan

#### Langkah 1: Identifikasi Pasien BPJS

1. Klik **BPJS** → **Input Pemeriksaan**
2. Cari pasien BPJS:
    - Ketik nama pasien
    - Atau ketik nomor BPJS
3. Sistem akan menampilkan data pasien BPJS
4. Klik **Lanjut**

#### Langkah 2: Data Pemeriksaan

Isi data pemeriksaan seperti di Admin biasa:

**Keluhan Pasien:**

- Keluhan utama
- Riwayat penyakit

**Data Pemeriksaan (OD & OS):**

- Visus (tajam penglihatan)
- Sfera (SPH)
- Silinder (CYL)
- Axis
- Diagnosis (jika ada)

**Tindakan/Catatan:**

- Jenis tindakan dilakukan
- Catatan diagnostik

3. Klik **Lanjut**

#### Langkah 3: Billing BPJS

Pengisian data billing untuk BPJS:

1. **Jenis Layanan**:
    - Pemeriksaan Mata Dasar
    - Pemeriksaan Mata Lengkap
    - Tindakan Tertentu (jika ada)

2. **Tarif BPJS** (otomatis dari sistem):
    - Sistem akan menampilkan tarif resmi BPJS
    - Biaya sudah termasuk dalam paket BPJS

3. **Kode Diagnosis ICD-10**:
    - Pilih dari dropdown diagnosis
    - Contoh: H52.0 (Myopia), H52.1 (Hyperopia)
    - Jika tidak ada, bisa custom tambah

4. **Nomor Rujukan** (jika ada):
    - Nomor surat rujukan dari fasilitas kesehatan lain
    - Opsional

5. **Peserta Utama** (jika berbeda):
    - Jika pasien adalah peserta tanggungan, masukkan data peserta utama

6. Klik **Lanjut**

#### Langkah 4: Pesanan (Jika Ada)

Jika pasien pesan kacamata/lensa:

1. Klik **Tambah Pesanan**
2. Isi detail:
    - Frame, Lensa, Aksesoris
    - Jumlah & harga
3. **PENTING**: Untuk BPJS:
    - Pesanan TIDAK diganti BPJS
    - Pasien bayar mandiri
    - Terpisah dari klaim BPJS

#### Langkah 5: Finalisasi & Verifikasi Data

1. Verifikasi data pemeriksaan & billing
2. Cek:
    - ✓ Data pasien benar
    - ✓ Nomor BPJS valid
    - ✓ Diagnosis sesuai
    - ✓ Jenis layanan benar
3. Klik **Selesai**

### 3. 💳 Kelola Billing BPJS

Menu untuk mengelola data tagihan yang siap dikirim ke BPJS.

**Lokasi Menu:** BPJS → Billing

#### a) Melihat Daftar Billing

1. Klik **BPJS** → **Billing**
2. Tampil daftar billing dengan:
    - Nomor billing (otomatis)
    - Nama pasien
    - Nomor BPJS
    - Tanggal layanan
    - Biaya layanan
    - **Status Billing**:
        - Draft (belum final)
        - Final (siap klaim)
        - Diklaim (sudah dikirim ke BPJS)
        - Ditolak (ada perbaikan)

#### b) Filter Billing BPJS

1. Berdasarkan **Tanggal Layanan**: Dari - Sampai
2. Berdasarkan **Status**: Draft, Final, Diklaim, Ditolak
3. Berdasarkan **Pasien**: Ketik nama

#### c) Ubah Status Billing dari Draft ke Final

1. Cari billing yang status **Draft**
2. Klik **Edit** atau tombol aksi
3. Verifikasi data:
    - Data pasien benar
    - Kode diagnosis sesuai
    - Tarif BPJS benar
4. Jika sudah benar, klik **Finalize Billing**
5. Status berubah menjadi **Final**

#### d) Lihat Detail Billing

1. Klik nama pasien atau tombol **Lihat Detail**
2. Tampil halaman detail dengan:
    - Identitas pasien & BPJS
    - Jenis layanan & biaya
    - Kode diagnosis
    - Tanggal layanan
    - Catatan

#### e) Cetak Billing untuk Arsip

1. Di halaman detail, klik **Cetak Billing**
2. Dokumen PDF akan diunduh (untuk arsip lokal)

### 4. 📊 Rekap Klaim BPJS

Menu untuk membuat dan mengirim rekapitulasi klaim ke BPJS.

**Lokasi Menu:** BPJS → Rekap Klaim

#### a) Melihat Daftar Rekap Klaim

1. Klik **BPJS** → **Rekap Klaim**
2. Tampil daftar rekapitulasi dengan:
    - No Rekap (otomatis)
    - Periode Klaim (Bulan/Tahun)
    - Jumlah Peserta
    - Total Biaya Klaim
    - **Status Rekap**:
        - Belum Terkirim
        - Terkirim
        - Diproses BPJS
        - Diterima BPJS
        - Ditolak

#### b) Buat Rekap Klaim Baru

1. Klik **Buat Rekap Klaim Baru** (hijau)
2. Isi:
    - **Periode Klaim**: Pilih bulan & tahun
    - **Tanggal Mulai - Akhir**: Rentang periode
3. Sistem akan otomatis mengumpulkan semua billing **Final** di periode tersebut
4. Review data:
    - Daftar pasien
    - Jumlah layanan per pasien
    - Total biaya
5. Klik **Buat Rekap**

#### c) Edit & Validasi Rekap Sebelum Kirim

1. Cari rekap dengan status **Belum Terkirim**
2. Klik **Edit Rekap**
3. Verifikasi:
    - Data pasien lengkap & benar
    - Setiap layanan punya kode diagnosis
    - Total biaya sesuai
4. Jika ada yang salah:
    - Klik **Kembali ke Billing** untuk perbaikan
    - Edit di menu Billing
    - Kembali ke Rekap
5. Jika sudah benar, klik **Selesai Validasi**

#### d) Kirim Rekap ke BPJS

1. Rekap status **Belum Terkirim** siap dikirim
2. Klik **Kirim Rekap ke BPJS**
3. Sistem akan:
    - Generate file format BPJS (.txt / .xml)
    - Siapkan dokumen pendukung
4. Klik **Konfirmasi Pengiriman**
5. Status berubah menjadi **Terkirim**
6. **Unduh Bukti Pengiriman** untuk arsip

#### e) Tracking Status Klaim

1. Setelah rekap terkirim, sistem akan tracking status
2. Status berubah menjadi:
    - **Diproses BPJS**: Sedang di-review
    - **Diterima BPJS**: Klaim disetujui
    - **Ditolak**: Ada kekurangan/error
3. Jika ditolak, lihat pesan error & perbaiki di Billing

### 5. � Rekap Pemeriksaan BPJS

Menu untuk membuat rekapitulasi data pemeriksaan pasien BPJS.

**Lokasi Menu:** BPJS → Rekap Pemeriksaan

**Fungsi:**

- Data pemeriksaan pasien BPJS per periode
- Jumlah pasien BPJS yang diperiksa
- Total pemeriksaan BPJS

**Cara Membuat Rekap Pemeriksaan BPJS:**

1. Klik **BPJS** → **Rekap Pemeriksaan**
2. Pilih tanggal awal - akhir
3. Klik **Generate Rekap**
4. Ekspor format:
    - **Excel**: Untuk analisis dan dokumentasi

---

## 🔍 Panduan Troubleshooting BPJS

### Problem: "Nomor BPJS Tidak Valid"

**Solusi:**

- Periksa nomor BPJS (harus 13 digit)
- Verifikasi nomor BPJS dengan kartu fisik pasien
- Hubungi Admin untuk update data

### Problem: "Kode Diagnosis Tidak Ditemukan"

**Solusi:**

- Gunakan kode ICD-10 standar
- Cari di dropdown yang tersedia
- Jika tidak ada, minta Admin untuk tambah kode baru

### Problem: "Billing Ditolak BPJS"

**Solusi:**

- Cek pesan error dari BPJS
- Perbaiki data di menu Billing
- Validasi ulang diagnosis & tarif
- Kirim ulang

### Problem: "Laporan BPJS Tidak Muncul"

**Solusi:**

- Pastikan ada billing dengan status **Final**
- Cek filter periode tanggal
- Refresh browser

---

## 📱 Profil & Pengaturan Personal

**Lokasi Menu:** Ikon Profil (pojok atas kanan)

#### Ubah Nama

1. Klik profil → **Profil Saya**
2. Edit **Nama Tampilan**
3. Klik **Simpan**

#### Ubah Password

1. Klik profil → **Profil Saya**
2. Scroll ke **Ubah Password**
3. Masukkan password lama & baru
4. Klik **Perbarui**

---

## 🎯 Workflow Admin BPJS Sehari-hari

### Pagi:

1. ✓ Login sistem
2. ✓ Cek Dashboard BPJS
3. ✓ Review status klaim terbaru

### Siang (Operasional):

1. ✓ Input pemeriksaan pasien BPJS
2. ✓ Isi billing BPJS dengan akurat
3. ✓ Finalize billing yang sudah lengkap

### Sore (Penutupan):

1. ✓ Buat Rekap Klaim (jika ada billing baru)
2. ✓ Validasi Rekap sebelum kirim
3. ✓ Kirim Rekap ke BPJS (per periode)
4. ✓ Logout

---

## ⚠️ Tips Penting untuk Admin BPJS

1. **Verifikasi Nomor BPJS**: Pastikan nomor BPJS valid & aktif
2. **Kode Diagnosis Akurat**: Gunakan ICD-10 yang tepat sesuai diagnosis
3. **Jangan Campur Pesanan**: Pesanan kacamata terpisah dari BPJS (pasien bayar mandiri)
4. **Kirim Tepat Waktu**: Kirim Rekap Klaim sesuai deadline BPJS
5. **Simpan Bukti**: Simpan bukti pengiriman untuk audit
6. **Komunikasi Admin**: Jika ada masalah billing, laporkan ke Admin utama

---

## 📞 Kontak Dukungan

- **Pertanyaan Teknis**: Hubungi Admin
- **Pertanyaan Data BPJS**: Hubungi Superadmin
- **Masalah Sistem**: Hubungi Tim IT/Support

---

---

## 📌 Kesimpulan

Panduan ini mencakup penggunaan lengkap Rekoptik untuk setiap role pengguna. Untuk pertanyaan lebih lanjut atau klarifikasi, silakan hubungi Superadmin atau Admin sistem.

**Terima kasih telah menggunakan Rekoptik!**

---

_Dokumen ini terakhir diperbarui: April 2026_
_Versi: 1.0_
