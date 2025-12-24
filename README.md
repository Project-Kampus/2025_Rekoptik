# Rekoptik

> **Mulai Dikembangkan:** Desember 2025

## Deskripsi Proyek

**Rekoptik** adalah aplikasi web berbasis **Laravel 12** yang dirancang untuk melakukan rekapitulasi dan pengelolaan data medis optik secara terstruktur, aman, dan mudah digunakan. Aplikasi ini membantu klinik optik atau tenaga kesehatan mata dalam mencatat, menyimpan, serta menganalisis data pemeriksaan pasien secara digital sehingga proses administrasi menjadi lebih efisien dan minim kesalahan.

Aplikasi ini dikembangkan dengan pendekatan modern Laravel serta memanfaatkan paket autentikasi bawaan untuk menjamin keamanan akses data.

Pengembangan aplikasi Rekoptik mulai dilakukan pada tahun 2025 sebagai bagian dari upaya digitalisasi pencatatan dan rekap data medis optik. Proses pengembangan difokuskan pada pembuatan sistem yang stabil, mudah dikembangkan, serta sesuai dengan kebutuhan operasional klinik optik dan tenaga kesehatan mata.

## Teknologi yang Digunakan

* **Framework**: Laravel 12
* **Bahasa Pemrograman**: PHP
* **Database**: MySQL / MariaDB (dapat disesuaikan)
* **Frontend**: Blade Template Engine
* **Authentication Package**: Laravel Breeze

## Package Utama

### Laravel Breeze

Laravel Breeze digunakan sebagai solusi autentikasi sederhana dan ringan yang menyediakan:

* Login dan Logout
* Registrasi pengguna
* Reset dan verifikasi password
* Struktur autentikasi yang rapi dan mudah dikembangkan

Dengan Breeze, sistem Rekoptik memiliki fondasi keamanan yang baik untuk membatasi akses data medis hanya kepada pengguna yang berwenang.

## Fitur Utama Aplikasi

* Autentikasi pengguna (Admin / Petugas)
* Manajemen data pasien optik
* Rekap data pemeriksaan medis mata
* Penyimpanan riwayat pemeriksaan
* Pengelolaan data secara terpusat dan terdokumentasi
* Antarmuka sederhana dan mudah dipahami

## Tujuan Pengembangan

Pengembangan aplikasi Rekoptik bertujuan untuk:

1. Meningkatkan efisiensi pengelolaan data medis optik
2. Mengurangi pencatatan manual yang rawan kesalahan
3. Mempermudah proses rekap dan pelaporan data pasien
4. Mendukung transformasi digital pada layanan kesehatan optik

## Instalasi Singkat

1. Clone repository proyek
2. Jalankan perintah instalasi dependency:

   ```bash
   composer install
   ```
3. Salin file environment:

   ```bash
   cp .env.example .env
   ```
4. Generate application key:

   ```bash
   php artisan key:generate
   ```
5. Konfigurasi database pada file `.env`
6. Jalankan migrasi database:

   ```bash
   php artisan migrate
   ```
7. Jalankan server aplikasi:

   ```bash
   php artisan serve
   ```


