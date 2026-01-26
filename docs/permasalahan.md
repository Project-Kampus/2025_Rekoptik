# Analisis Masalah pada ERD Versi 3

## 1. Pesanan Tidak Fleksibel (Hanya Satu Item per Pesanan)

Setiap pesanan saat ini hanya bisa memesan 1 kacamata, frame, atau aksesoris. Ini tidak fleksibel karena:

- Tidak memungkinkan pesanan kombinasi item (misalnya kacamata + aksesoris).
- Sulit mengelola pesanan kompleks.

## 2. Pengecekan BPJS Tidak Tepat

Pengecekan apakah pesanan menggunakan BPJS dilakukan melalui pembayaran, bukan dari data rekam medis pasien. Ini menyebabkan:

- Inkonsistensi data.
- Kesulitan dalam pelacakan dan audit.

## 3. Pasien Hanya Bisa Memiliki Satu Kartu

Pasien hanya memiliki 1 kartu, sehingga jika pasien memiliki kartu BPJS dan asuransi, sistem akan rusak. Ini kurang fleksibel karena:

- Tidak mendukung multiple asuransi per pasien.
- Membatasi opsi pembayaran.

## 4. Kolom Umur Tidak Statis di Tabel Pasien

Dalam tabel pasien, ada kolom umur yang datanya tidak statis dan bisa berubah. Seharusnya menyimpan tanggal lahir, yang secara otomatis menghitung umur sesuai tanggal pesanan.

## 5. Kurangnya Tanggal Pemeriksaan di Tabel Resep

Dalam tabel resep perlu ditambahkan kolom tanggal pemeriksaan untuk melacak kapan resep dibuat.

## 6. Menu Transaksi Terbatas

Saat ini hanya ada menu untuk tambah pemeriksaan saat pasien membuat kacamata. Perlu penambahan menu untuk customer yang datang hanya untuk ganti frame atau beli aksesoris, sehingga tidak perlu form pemeriksaan dan resep.

## 7. Struktur Tabel Perlu Diubah untuk Dua Jenis Transaksi

Struktur tabel perlu diubah karena ada 2 jenis transaksi: pembuatan kacamata dan pembelian biasa. Ini memerlukan:

- Pemisahan tabel untuk jenis transaksi berbeda.
- Dukungan untuk transaksi tanpa pemeriksaan/resep.

perbiki isi permasalahan sesuai denan versi-3 saya, juga buatkan saya rancanagn red baru untuk versi3 saya
