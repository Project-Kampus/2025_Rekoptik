
# Prinsip Perbaikan ERD

Perbaikan dilakukan dengan:

- Memisahkan master data
- Memisahkan transaksi
- Memisahkan rekam medis
- Memisahkan pembayaran
- Memisahkan dokumen

Target:

- Lebih rapi
- Mudah dikembangkan
- Aman untuk data medis
- Cocok untuk Laravel (Eloquent-friendly)

# Rancangan ERD yang Direkomendasikan

## A. User & Role (Tetap)

**users**

- id: BigInt
- name: String
- email: String
- password: String
- email_verified_at: Timestamp
- remember_token: String

**roles**

- id: BigInt
- name: String (super_admin, admin, bpjs)

**role_user**

- user_id: BigInt
- role_id: BigInt

## B. Pengaturan (Single Record)

**pengaturan**

- id: BigInt
- nama_aplikasi: String
- nama_toko: String
- alamat: Text
- no_hp: String
- telp: String
- email: String
- logo: String

Karena hanya 1 optik, tabel ini cukup 1 row.

## C. Master Supplier, Lensa, Frame

**suppliers**

- id: BigInt
- nama: String
- kontak: String
- alamat: String

**lensas**

- id: BigInt
- nama_lensa: String
- kategori: String
- material: String
- coating: String
- supplier_id: BigInt

**frames**

- id: BigInt
- kode_frame: String
- merk: String
- warna: String
- bahan: String
- supplier_id: BigInt

od dan os tidak disimpan di master lensa, tapi di resep.

## D. Pasien (Hanya Identitas)

**pasiens**

- id: BigInt
- nama: String
- no_hp: String
- email: String
- alamat: Text
- umur: Integer
- kategori: Enum(bpjs, asuransi, umum)
- no_kartu: String
- no_sep: String

Pasien tidak tahu pemeriksaan & transaksi

## E. Rekam Medis / Pemeriksaan

**pemeriksaans**

- id: BigInt
- pasien_id: BigInt
- user_id: BigInt (petugas)
- tanggal_pemeriksaan: Date
- keluhan_utama: Text
- diagnosa: String
- riwayat_penyakit: Text
- penyakit_sekarang: Text
- penyakit_keluarga: Text
- kebiasaan: Text
- pengobatan: Text
- resep_dari: String

1 pasien bisa banyak pemeriksaan

## F. Resep Kacamata

**resep_kacamatas**

- id: BigInt
- pemeriksaan_id: BigInt
- frame_id: BigInt
- lensa_id: BigInt
- od_sferis: Decimal
- od_silindris: Decimal
- od_axis: Integer
- od_add: Decimal
- os_sferis: Decimal
- os_silindris: Decimal
- os_axis: Integer
- os_add: Decimal
- pd: String

Resep terikat ke pemeriksaan, bukan langsung pasien.

## G. Transaksi & Status Pesanan

**pesanans**

- id: BigInt
- pemeriksaan_id: BigInt
- biaya_kacamata: BigInt
- status: Enum(dipesan, diambil)
- tanggal_dipesan: Date
- tanggal_pengambilan: Date

## H. Pembayaran (Fleksibel & Profesional)

**pembayarans**

- id: BigInt
- pesanan_id: BigInt
- metode: Enum(bpjs, asuransi, tunai)
- jumlah: BigInt
- tanggal_bayar: Date

Bisa:

- Multi metode
- Cicilan
- Audit-friendly

## I. Pengambilan Kacamata

**pengambilans**

- id: BigInt
- pesanan_id: BigInt
- nama_pengambil: String
- hubungan: String
- bukti_pengambil: String

## J. Dokumen Pasien

**dokumens**

- id: BigInt
- pasien_id: BigInt
- jenis: Enum(ktp, rujukan, legalitas)
- file: String

# 4. Hak Akses Role (Sesuai Kebutuhan Anda)

| Role       | Akses                          |
|------------|--------------------------------|
| Super Admin| Semua data + pengaturan       |
| Admin / Staf| Pasien, pemeriksaan, transaksi |
| BPJS       | Read-only rekap (laporan, export) |

Implementasi via middleware + policy Laravel

# 5. Manfaat Rancangan Ini

- Tidak ada data ganda
- Bisa banyak pemeriksaan per pasien
- Mudah dikembangkan
- Cocok untuk laporan BPJS
- Aman & profesional
- Siap untuk skripsi / produksi
