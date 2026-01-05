# Analisis Masalah pada ERD Saat Ini

## 1. Tabel Pasien Terlalu Besar (God Table)

Tabel Pasien saat ini mencampur:

- Data identitas pasien
- Data rekam medis
- Data resep kacamata
- Data transaksi & pembayaran
- Data pengambilan kacamata
- Data dokumen

Ini melanggar prinsip Single Responsibility dan 3rd Normal Form (3NF).

## 2. Redundansi Data Pemeriksaan

Field seperti:

- tanggal_pemeriksaan
- diagnosa
- od_sferis, os_sferis, dll

Seharusnya bisa lebih dari satu pemeriksaan per pasien, tapi sekarang hanya bisa satu.

## 3. Pembayaran Tidak Fleksibel

Kolom:

- dibayar_bpjs
- dibayar_asuransi
- dibayar_pasien

Ini tidak fleksibel:

- Bagaimana kalau metode bertambah?
- Bagaimana kalau cicilan?

## 4. Dokumen Pasien Menumpuk di Satu Tabel

Field:

- doc_ktp
- doc_legalitas
- doc_rujukan

Sulit dikembangkan jika dokumen bertambah.

## 5. Role Sudah Benar (Many-to-Many)

users, roles, role_user

Ini sudah profesional, tinggal pembatasan akses via middleware.
