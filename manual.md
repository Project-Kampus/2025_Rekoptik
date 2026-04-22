# MANUAL APLIKASI REKOPTIK

## 📋 Daftar Isi

1. [Pengenalan Aplikasi](#pengenalan-aplikasi)
2. [Sistem Role & Akses](#sistem-role--akses)
3. [Fitur Data Medis](#fitur-data-medis)
4. [Fitur Master Data](#fitur-master-data)
5. [Fitur Laporan](#fitur-laporan)
6. [Pengaturan & Profil](#pengaturan--profil)

---

## 🏥 Pengenalan Aplikasi

### Tentang Rekoptik

Rekoptik adalah aplikasi manajemen rekam medis terintegrasi untuk optik/klinik mata yang membantu:

- Mengelola data pasien dan riwayat pemeriksaan
- Mengelola inventori frame, lensa, dan aksesoris
- Mencatat resep mata dan pesanan kacamata
- Memproses pembayaran (BPJS, Asuransi, Tunai, Non-Tunai)
- Membuat laporan pemeriksaan dan pembayaran
- Menyimpan dokumen pendukung

### Fitur Utama

- ✅ Manajemen Data Medis (Pemeriksaan, Resep, Pesanan)
- ✅ Sistem Master Data (Frame, Lensa, Aksesoris, Supplier)
- ✅ Manajemen Pembayaran Multi-Metode
- ✅ Pembuatan Laporan & Cetak Struk
- ✅ Sistem Role-Based Access Control
- ✅ Profil User & Pengaturan Sistem

---

## 👥 Sistem Role & Akses

### Daftar Role yang Tersedia

#### 1. **Super Admin / Administrator**

- **Akses Penuh ke Seluruh Sistem**
- **Fungsi Utama:**
    - Mengelola user dan role
    - Mengakses semua menu aplikasi
    - Mengatur pengaturan aplikasi (nama toko, alamat, kontak, logo)
    - Mengelola master data (frame, lensa, aksesoris, supplier, dokumen)
    - Melihat laporan lengkap

#### 2. **Staf Medis / Optikal**

- **Akses ke Data Medis & Pesanan**
- **Fungsi Utama:**
    - Membuat data pemeriksaan pasien (step 1 & step 2)
    - Input data medis pasien:
        - Identitas pasien
        - Riwayat penyakit
        - Data pemeriksaan & resep
    - Membuat pesanan kacamata
    - Melakukan pembayaran
    - Melihat riwayat pasien
    - Mencetak struk pembayaran dan surat balasan

#### 3. **Resepsionis / Kasir**

- **Akses Terbatas ke Pembayaran & Pesanan**
- **Fungsi Utama:**
    - Mencatat pembayaran
    - Melihat data pasien
    - Mencetak struk pembayaran
    - Input pengambilan pesanan

#### 4. **BPJS**

- **Akses untuk Validasi BPJS**
- **Fungsi Utama:**
    - Melihat data peserta BPJS
    - Validasi pesanan BPJS
    - Mencetak laporan BPJS

### Cara Mengelola User & Role

1. **Menambah User Baru:**
    - Menu Admin → Tambah User
    - Isi nama, email, password
    - Pilih role yang sesuai
    - Simpan

2. **Mengubah Role User:**
    - Menu Admin → Edit User
    - Ubah role sesuai kebutuhan
    - Simpan perubahan

3. **Menghapus User:**
    - Menu Admin → Hapus User
    - Konfirmasi penghapusan

---

## 📋 Fitur Data Medis

### Alur Pembuatan Data Medis (2 Langkah)

#### **STEP 1: Input Data Pasien**

Menu: **Rekam Medis → Data Medis → Buat Data Medis (Langkah 1)**

**Data yang Diisi:**

- **Identitas Pasien:**
    - Nama Pasien _(required)_
    - No. HP _(optional)_
    - Email _(optional)_
    - Alamat _(optional)_
    - Umur _(optional)_
- **Kategori Pasien:**
    - BPJS
    - Asuransi
    - Umum
- **Data Asuransi:**
    - No. Kartu _(optional)_
    - Kelas (1, 2, 3) _(untuk BPJS)_

**Tombol Aksi:**

- **Cari Pasien Lama**: Jika pasien sudah pernah berkunjung
- **Buat Pasien Baru**: Untuk pasien pertama kali

---

#### **STEP 2: Input Data Medis & Pesanan**

Menu: **Rekam Medis → Data Medis → Buat Data Medis (Langkah 2)**

##### **Bagian 1: Data Pemeriksaan**

- **No. SEP** _(required)_ - Nomor rujukan/SEP dari BPJS
- **Kebiasaan/Pekerjaan** _(required)_ - Pekerjaan/kebiasaan pasien
- **Keluhan Utama** _(required)_ - Keluhan pasien saat berkunjung
- **Diagnosa** _(required)_ - Hasil diagnosa pemeriksaan
- **Riwayat Penyakit** _(required)_ - Riwayat penyakit sebelumnya
- **Penyakit Sekarang** _(required)_ - Kondisi kesehatan saat ini
- **Penyakit Keluarga** _(required)_ - Riwayat penyakit keluarga
- **Pengobatan** _(required)_ - Riwayat pengobatan/alergi

##### **Bagian 2: Resep Kacamata**

- **Resep Dari** _(required)_ - Nama dokter/optometris pemeriksa
- **Tanggal Resep** _(required)_ - Tanggal pemeriksaan

**Tabel Resep (Mata Kanan & Kiri):**
| Parameter | Satuan | Contoh |
|-----------|--------|---------|
| SPH (Sferis) | Diopter | -1.25, +2.00 |
| CYL (Silindris) | Diopter | -0.50, -1.00 |
| AXIS | Derajat | 0-180 |
| ADD (Add Lensa) | Diopter | 1.00, 1.50 |
| PD (Pupil Distance) | mm | 60, 65 |

##### **Bagian 3: Pesanan**

- **Frame** _(required)_
    - Pilih dari dropdown (menampilkan: Merk - Kode Frame - Harga)
    - Contoh: "Ray-Ban - RB001 - 500000"

- **Lensa** _(required)_
    - Pilih dari dropdown (menampilkan: Nama Lensa - Harga)
    - Contoh: "Lensa Anti Radiasi - 750000"

- **Aksesoris** _(optional)_
    - Bisa pilih lebih dari satu
    - Contoh: Hard Case, Cleaning Kit

- **Biaya Total** _(required)_
    - Total biaya kacamata dalam Rp
    - Otomatis terhitung dari frame + lensa + aksesoris

- **Tanggal Pemesanan** _(required)_
    - Tanggal order diajukan

- **Tanggal Pengambilan** _(required)_
    - Target tanggal pengambilan pesanan

**Tombol Aksi:**

- **Kembali**: Kembali ke halaman sebelumnya
- **Simpan Pemesanan**: Simpan semua data

---

### Mengelola Data Medis yang Sudah Dibuat

Menu: **Rekam Medis → Data Medis**

#### **Fitur Penelusuran & Filter:**

- **Search**: Cari berdasarkan nama pasien, no kartu, atau diagnosa
- **Filter Kategori**: BPJS, Asuransi, Umum
- **Filter Status**: Dipesan, Diambil
- **Filter Tanggal**: Rentang tanggal pemeriksaan

#### **Aksi pada Data Medis:**

**1. Lihat Detail (View)**

- Tampilkan semua data pemeriksaan, resep, pesanan
- Lihat riwayat pembayaran
- Lihat dokumen yang telah diupload

**2. Edit Data Medis**

- Menu: Rekam Medis → Data Medis → Edit
- Bisa mengubah:
    - Data pemeriksaan
    - Data resep
    - Data pesanan
    - Biaya

**3. Tambah Pembayaran**

- Mencatat pembayaran dari pasien
- Input:
    - Tanggal Bayar
    - Metode: BPJS, Asuransi, Tunai, Non-Tunai
    - Jumlah Bayar (Rp)
- Sistem otomatis hitung sisa pembayaran

**4. Hapus Pembayaran**

- Menghapus pembayaran yang salah/duplikat

**5. Cetak Struk Pembayaran**

- Mencetak struk pembayaran (format PDF)
- Berisi:
    - No. Pesanan & Tanggal
    - Nama & Alamat Pasien
    - Detail Frame & Lensa
    - Resep Kacamata
    - Jumlah - Bayar - Sisa
    - TTD & Nama Staf

**6. Cetak Surat Balasan**

- Mencetak surat balasan ke dokter/rujukan
- Berisi:
    - Data pemeriksaan pasien
    - Hasil diagnosa
    - Rekomendasi lensa

**7. Input Pengambilan Pesanan**

- Saat pasien mengambil pesanan
- Input:
    - Nama Pengambil
    - Hubungan dengan Pasien
    - Bukti Tanda Tangan (digital)
- Status otomatis berubah menjadi "Diambil"

---

### 📄 Dokumen Pendukung

Menu: **Rekam Medis → Data Medis → Lihat → Upload Dokumen**

**Jenis Dokumen yang Bisa Diupload:**

- KTP Pasien
- Kartu BPJS / Asuransi
- Surat Rujukan
- Foto Resep
- Hasil Pemeriksaan Mata
- Dokumen Lainnya

**Batasan File:**

- Format: PDF, JPG, JPEG, PNG
- Ukuran Max: 2 MB per file

---

## 🗂️ Fitur Master Data

Master data adalah data referensi yang digunakan dalam sistem. Hanya Super Admin yang bisa mengelola master data.

### 1. **Master Frame (Gagang Kacamata)**

Menu: **Master → Frame**

**Informasi Frame:**

- **Kode Frame** _(required, unique)_ - ID unik frame, contoh: RB001
- **Merk** _(required)_ - Brand frame, contoh: Ray-Ban, Oakley
- **Warna** _(optional)_ - Warna frame, contoh: Hitam, Bening
- **Bahan** _(optional)_ - Material, contoh: Acetate, Metal
- **Supplier** _(required)_ - Supplier yang menyediakan
- **Harga** _(required)_ - Harga jual per unit (Rp)

**Aksi:**

- **Tambah Frame Baru** - Input frame baru
- **Edit Frame** - Ubah data frame
- **Hapus Frame** - Hapus frame (jika belum digunakan)
- **Filter/Cari** - Cari berdasarkan merk atau kode

---

### 2. **Master Lensa**

Menu: **Master → Lensa**

**Informasi Lensa:**

- **Nama Lensa** _(required)_ - Contoh: Lensa Anti Radiasi, Progressive, Bifocal
- **Kategori** _(required)_ - Jenis: Single Vision, Progressive, Bifocal, dll
- **Material** _(optional)_ - Bahan lensa: Polycarbonate, Trivex, Glass
- **Coating** _(optional)_ - Lapisan pelindung: Anti-glare, Anti-scratch, UV
- **OD (Mata Kanan)** _(optional)_ - Kekuatan OD
- **OS (Mata Kiri)** _(optional)_ - Kekuatan OS
- **Supplier** _(required)_ - Supplier penyedia
- **Harga** _(required)_ - Harga per unit (Rp)

**Aksi:**

- **Tambah Lensa Baru**
- **Edit Lensa**
- **Hapus Lensa**
- **Cari/Filter**

---

### 3. **Master Aksesoris**

Menu: **Master → Aksesoris**

**Informasi Aksesoris:**

- **Nama Aksesoris** _(required)_ - Contoh: Hard Case, Cleaning Kit, Carabiner
- **Supplier** _(required)_ - Supplier penyedia
- **Harga** _(optional)_ - Harga per unit (Rp)

**Aksi:**

- **Tambah Aksesoris Baru**
- **Edit Aksesoris**
- **Hapus Aksesoris**
- **Cari/Filter**

---

### 4. **Master Supplier**

Menu: **Master → Supplier**

**Informasi Supplier:**

- **Nama Supplier** _(required)_ - Nama perusahaan, contoh: PT. Optik Jaya
- **Kontak** _(required)_ - No. Telepon/WA
- **Alamat** _(optional)_ - Alamat supplier

**Aksi:**

- **Tambah Supplier Baru**
- **Edit Supplier**
- **Hapus Supplier** - Jika belum memiliki frame/lensa
- **Cari/Filter**

---

### 5. **Master Dokumen**

Menu: **Master → Dokumen**

**Informasi Dokumen:**

- **Nama Dokumen** _(required)_ - Contoh: KTP, Kartu BPJS, Surat Rujukan
- **Tipe** _(optional)_ - Kategori dokumen

**Aksi:**

- **Tambah Tipe Dokumen Baru**
- **Edit Dokumen**
- **Hapus Dokumen**

---

## 📊 Fitur Laporan

Menu: **Laporan**

### **Jenis-Jenis Laporan**

#### **1. Rekap Pemeriksaan**

- **Akses**: Super Admin, Staff Medis
- **Informasi:**
    - Total pemeriksaan per periode
    - Breakdown by kategori pasien (BPJS, Asuransi, Umum)
    - Breakdown by status pesanan (Dipesan, Diambil)
- **Filter:**
    - Rentang Tanggal
    - Kategori Pasien
    - Status Pesanan
- **Export:**
    - Download Excel
    - Cetak PDF

#### **2. Rekap Pembayaran (BPJS)**

- **Akses**: Super Admin, BPJS Staff
- **Informasi:**
    - Total pembayaran BPJS
    - Detail pesanan BPJS
    - Pasien yang belum terbayar
- **Format Export:**
    - File Excel untuk rekonsiliasi BPJS

---

## ⚙️ Pengaturan & Profil

Menu: **Pengaturan & Profil**

### **1. Profil Pengguna**

Menu: **Profil → Edit Profil**

**Data yang Bisa Diubah:**

- **Nama** - Nama lengkap pengguna
- **Email** - Email akun (unique)
- **Password** _(optional)_ - Ubah password (min 6 karakter)

**Informasi Pengguna:**

- Role yang dimiliki
- Tanggal akun dibuat
- Status aktif

---

### **2. Pengaturan Sistem (Super Admin Only)**

Menu: **Admin → Pengaturan Sistem**

#### **Informasi Toko/Optik:**

- **Nama Toko** _(required)_ - Contoh: "Optik Utama"
- **Nama Aplikasi** _(required)_ - Judul aplikasi
- **Alamat** _(required)_ - Alamat lengkap toko
- **No. Telepon** _(required)_ - Nomor telepon
- **No. WA / HP** _(optional)_ - Nomor WhatsApp/mobile
- **Email** _(optional)_ - Email toko
- **Logo** _(required)_ - Upload logo toko (JPG, PNG)
    - Digunakan di: Struk pembayaran, Laporan, Surat

**Fungsi Pengaturan:**

- Edit informasi toko
- Update logo (otomatis replace yang lama)
- Simpan perubahan

**Format File Logo:**

- Type: JPG, PNG
- Ukuran Max: 2 MB
- Resolusi Min: 100x100 px (rekomendasi 200x200 px)

---

### **3. Manajemen User & Admin**

Menu: **Admin → User Management**

#### **Daftar User:**

- Lihat semua user terdaftar
- Filter by role
- Cari by nama/email

#### **Tambah User Baru:**

- Nama _(required)_
- Email _(required, unique)_
- Password _(required, min 6 karakter)_
- Role _(required)_

#### **Edit User:**

- Ubah nama
- Ubah email
- Ubah password _(optional)_
- Ubah role

#### **Hapus User:**

- Konfirmasi penghapusan
- Riwayat user akan tetap tersimpan

---

## 🔐 Keamanan & Tips Penggunaan

### **Praktik Terbaik:**

1. **Password:**
    - Gunakan password yang kuat (min 6 karakter)
    - Tidak boleh password yang mudah ditebak
    - Ganti password secara berkala

2. **Data Pasien:**
    - Jaga kerahasiaan data medis pasien
    - Hanya share data dengan yang berwenang
    - Backup data secara berkala

3. **Dokumen:**
    - Upload dokumen dengan label yang jelas
    - Hapus dokumen yang tidak perlu
    - Simpan backup fisik dokumen penting

4. **Role Management:**
    - Berikan role sesuai kebutuhan pekerjaan
    - Review akses secara berkala
    - Hapus user yang sudah tidak aktif

---

## 📞 Dukungan & Bantuan

### **Troubleshooting Umum:**

| Masalah              | Solusi                         |
| -------------------- | ------------------------------ |
| Tidak bisa login     | Reset password di menu login   |
| Data tidak tersimpan | Periksa internet connection    |
| File upload error    | Periksa ukuran file (max 2 MB) |
| Page loading slow    | Coba refresh atau clear cache  |

### **Kontak Support:**

- Email: support@optik.local
- WhatsApp: +62-xxx-xxxx-xxxx
- Jam Kerja: Senin-Jumat, 09:00-17:00

---

## 📅 Versi Dokumen

- **Versi**: 1.0
- **Tanggal**: January 2026
- **Author**: Rekoptik Team
- **Last Updated**: 30 January 2026

---

## 📝 Catatan Penting

- Aplikasi ini dirancang untuk optik/klinik mata
- Semua data pasien bersifat RAHASIA dan terlindungi
- Backup data dilakukan setiap hari otomatis
- Untuk informasi lebih lanjut, hubungi administrator sistem
