<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Rekam Medis</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 6px;
        }

        .header-logo {
            width: 50px;
        }

        .header-logo img {
            width: 100%;
            height: auto;
        }

        .header-text {
            flex: 1;
            text-align: center;
        }


        .container {
            width: 380px;
            margin: auto;
        }

        .judul1 {
            font-size: large;
            font-weight: bold;
        }

        .judul2 {
            font-size: medium;
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .line {
            border-bottom: 2px solid #000;
            margin: 6px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 3px;
            vertical-align: top;
        }

        .border td,
        .border th {
            border: 1px solid #000;
            text-align: center;
        }

        .small {
            font-size: 11px;
        }

        .mt {
            margin-top: 8px;
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- HEADER -->
        <div class="header">
            <div class="header-logo">
                <img src="{{ asset('storage/' . $pengaturan->logo) }}" alt="Logo Optik">
            </div>

            <div class="header-text">
                <div class="judul1">{{ $pengaturan['nama_toko'] ?? 'OPTIK' }}</div>
                <div class="bold">PERIKSA MATA GRATIS</div>

                <div class="small">
                    {{ $pengaturan['alamat'] ?? '-' }}
                </div>

                <div class="small">
                    @if (!empty($pengaturan['telp']))
                        Telp/WA. {{ $pengaturan['telp'] }}
                    @endif

                    @if (!empty($pengaturan['email']))
                        | {{ $pengaturan['email'] }}
                    @endif
                </div>
            </div>
            <div>
            </div>
        </div>


        <!-- NOTA -->
        <table>
            <tr>
                <td class="bold">NOTA PESANAN</td>
                <td class="bold" style="text-align:right;">
                    No. {{ str_pad($RmPembayaran->id, 6, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>

        <div class="line"></div>

        <!-- DATA PASIEN -->
        <table>
            <tr>
                <td width="90">Nama</td>
                <td>: {{ $RmPemeriksaan->pasien->nama_pasien }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $RmPemeriksaan->pasien->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <td>Gagang/Frame</td>
                <td>: {{ $RmPemeriksaan->pesanan->frame?->merk ?? '-' }} -
                    {{ $RmPemeriksaan->pesanan->frame?->kode_frame ?? '-' }}</td>
            </tr>
            <tr>
                <td>Lensa</td>
                <td>: {{ $RmPemeriksaan->pesanan->lensa->nama_lensa ?? '-' }}</td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>: {{ $RmPemeriksaan->diagnosa ?? '-' }} </td>
            </tr>
        </table>

        <!-- RESEP -->
        <table class="border mt">
            <thead>
                <tr>
                    <th colspan="4">OD</th>
                    <th colspan="4">OS</th>
                    <th rowspan="2">PD</th>
                </tr>
                <tr>
                    <th>SPH</th>
                    <th>CYL</th>
                    <th>AXIS</th>
                    <th>ADD</th>
                    {{-- <th>PD</th> --}}
                    <th>SPH</th>
                    <th>CYL</th>
                    <th>AXIS</th>
                    <th>ADD</th>
                    {{-- <th>PD</th> --}}
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $RmPemeriksaan->resep->od_sferis }}</td>
                    <td>{{ $RmPemeriksaan->resep->od_silindris }}</td>
                    <td>{{ $RmPemeriksaan->resep->od_axis }}</td>
                    <td>{{ $RmPemeriksaan->resep->od_add_lensa }}</td>
                    {{-- <td>{{ $RmPemeriksaan->resep->pd_od }}</td> --}}
                    <td>{{ $RmPemeriksaan->resep->os_sferis }}</td>
                    <td>{{ $RmPemeriksaan->resep->os_silindris }}</td>
                    <td>{{ $RmPemeriksaan->resep->os_axis }}</td>
                    <td>{{ $RmPemeriksaan->resep->os_add_lensa }}</td>
                    <td>{{ $RmPemeriksaan->resep->pd_od }} / {{ $RmPemeriksaan->resep->pd_os }} </td>
                </tr>
            </tbody>
        </table>

        <!-- PEMBAYARAN -->
        <table class="mt">
            <tr>
                <td width="90">Resep Dr</td>
                <td>: {{ $RmPemeriksaan->resep->resep_dari ?? '-' }}</td>
            </tr>
            @php
                $hg = $RmPemeriksaan->pesanan->biaya_kacamata;
                $dp3 = 0;
                $dp1 = $RmPemeriksaan->pesanan->pembayarans->sum('jumlah');
                $dt = $dp3 + $dp1;
                $ss = $hg - $dt;
            @endphp
            <tr>
                <td>Jumlah</td>
                <td>: Rp {{ number_format($hg, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Bayar</td>
                <td>: Rp {{ number_format($dp1, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Sisa</td>
                <td>: Rp {{ number_format($ss, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Dipesan tgl</td>
                <td>: {{ optional($RmPemeriksaan->pesanan->tanggal_dipesan)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td>Siap tgl</td>
                <td>: {{ optional($RmPemeriksaan->pesanan->tanggal_pengambilan)->format('d-m-Y') }}</td>
            </tr>
        </table>

        <div class="mt center">
            <div>Hormat dan Terima kasih kami,</div>
            <div id="ttd-online"></div>
            <div style="margin-top:60px;" class="bold mt">
                {{ $RmPemeriksaan->user?->name ?? 'OPTIK UTAMA' }}
            </div>
        </div>

    </div>

</body>

</html>
