<!DOCTYPE html>
<html>

<head>
    <title>Cetak Struk</title>
    <style>
        body {
            font-family: "Courier New", monospace;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body onload="window.print()">

    <pre>
{{ strtoupper($pengaturan['nama_toko'] ?? 'OPTIK') }}
{{ $pengaturan['alamat'] ?? '-' }}
Telp: {{ $pengaturan['telp'] ?? '-' }}
==================================================
NOTA PESANAN
No   : {{ str_pad($RmPembayaran->id, 6, '0', STR_PAD_LEFT) }}
Tgl  : {{ \Carbon\Carbon::now()->format('d-m-Y') }}
--------------------------------------------------
Nama   : {{ $RmPemeriksaan->pasien->nama_pasien }}
Alamat : {{ $RmPemeriksaan->pasien->alamat ?? '-' }}
--------------------------------------------------
ITEM
--------------------------------------------------
Frame : {{ $RmPemeriksaan->pesanan->frame?->merk ?? '-' }}
        {{ $RmPemeriksaan->pesanan->frame?->kode_frame ?? '-' }}
        Rp {{ number_format($RmPemeriksaan->pesanan->frame->harga ?? 0, 0, ',', '.') }}
Lensa : {{ $RmPemeriksaan->pesanan->lensa->nama_lensa ?? '-' }}
        Rp {{ number_format($RmPemeriksaan->pesanan->lensa->harga ?? 0, 0, ',', '.') }}

@foreach ($RmPemeriksaan->pesanan->aksesoris as $a)
Aks   : {{ $a->nama }}
        Rp {{ number_format($a->harga, 0, ',', '.') }}
@endforeach
--------------------------------------------------
TOTAL
--------------------------------------------------
@php
    $total = $RmPemeriksaan->pesanan->biaya_kacamata;
    $bayar = $RmPemeriksaan->pesanan->pembayarans->sum('jumlah');
    $sisa = $total - $bayar;
@endphp
Total : Rp {{ number_format($total, 0, ',', '.') }}
Bayar : Rp {{ number_format($bayar, 0, ',', '.') }}
Sisa  : Rp {{ number_format($sisa, 0, ',', '.') }}
--------------------------------------------------
RESEP
--------------------------------------------------
R : Sph {{ $RmPemeriksaan->resep->od_sferis ?? '-' }}
    Cyl {{ $RmPemeriksaan->resep->od_silindris ?? '-' }}
    Axis {{ $RmPemeriksaan->resep->od_axis ?? '-' }}
L : Sph {{ $RmPemeriksaan->resep->os_sferis ?? '-' }}
    Cyl {{ $RmPemeriksaan->resep->os_silindris ?? '-' }}
    Axis {{ $RmPemeriksaan->resep->os_axis ?? '-' }}
--------------------------------------------------
Note : {{ $RmPemeriksaan->diagnosa ?? '-' }}
Siap Tgl : {{ optional($RmPemeriksaan->pesanan->tanggal_pengambilan)->format('d-m-Y') }}
==================================================
Barang tidak diambil 3 bulan bukan tanggung jawab
==================================================
{{ $RmPemeriksaan->user?->name ?? ($pengaturan['nama_toko'] ?? 'OPTIK') }}
</pre>

</body>

</html>
