<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Jawaban Refraksi</title>

    <style>
        @page {
            size: A4;
            margin: 2.5cm 1.5cm 2.5cm 2cm;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            line-height: 1.6;
        }

        .container {
            width: 100%;
        }

        /* KOP */
        .kop {
            border-bottom: 2px solid black;
            margin-bottom: 20px;
            padding-bottom: 10px;

            /* border: none */
        }

        .kop-table {
            width: 100%;
        }

        .kop-logo img {
            width: 70px;
        }

        .kop-text {
            text-align: center;
        }

        .kop-text h2 {
            margin: 0;
            font-size: 16pt;
        }

        .kop-text p {
            margin: 2px 0;
            font-size: 11pt;
        }

        .kop-nomor {
            text-align: right;
            font-size: 11pt;
            vertical-align: top;
        }

        /* JUDUL */
        .judul {
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
            text-transform: uppercase;
        }

        /* ISI */
        .content p {
            margin: 6px 0;
            text-align: justify;
        }

        /* TABEL */
        table {
            width: 100%;
            border-collapse: collapse;
            /* margin-top: 15px; */
        }

        /* table,
        th,
        td {
            border: 1px solid black;
        } */

        .resep-table,
        .resep-table th,
        .resep-table td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        /* TTD */
        .ttd {
            margin-top: 40px;
            width: 100%;
        }

        .ttd-kanan {
            width: 250px;
            float: right;
            text-align: center;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="container">

        <!-- KOP -->
        <div class="kop">
            <table class="kop-table">
                <tr>
                    <td class="kop-logo" width="80">
                        {{-- <img src="{{ asset('storage/' . $pengaturan->logo) }}"> --}}
                        <img src="{{ public_path('storage/' . $pengaturan->logo) }}">
                    </td>

                    <td class="kop-text">
                        <h2>{{ $pengaturan['nama_toko'] }}</h2>
                        <p>{{ $pengaturan['alamat'] }}</p>
                        <p>Telp. {{ $pengaturan['telp'] }} | HP. {{ $pengaturan['no_hp'] }}</p>
                    </td>

                    <td class="kop-nomor" width="120">
                        No. {{ str_pad($RmPemeriksaan->id, 6, '0', STR_PAD_LEFT) }}
                    </td>
                </tr>
            </table>
        </div>

        <!-- JUDUL -->
        <div class="judul">
            Surat Jawaban Permintaan Pelayanan Refraksi dan Optisi
        </div>

        <!-- ISI -->
        <div class="content">
            <p>Yth. dr. {{ $RmPemeriksaan->resep->resep_dari }}</p>
            <p>Di tempat</p>

            <br>

            <p>
                Berdasarkan hasil pemeriksaan Refraksi dan Optisi peserta atas nama:
            </p>

            @php
                $umur = \Carbon\Carbon::parse($RmPemeriksaan->pasien->tanggal_lahir)->diffInYears(
                    $RmPemeriksaan->created_at,
                );
            @endphp

            <p>Nama : <strong>{{ $RmPemeriksaan->pasien->nama_pasien }}</strong></p>
            <p>No. Kartu JKN : {{ $RmPemeriksaan->no_kartu ?? '-' }}</p>
            <p>Umur : {{ $umur }} Tahun</p>

            <br>

            <p>
                Didapatkan hasil bahwa peserta memerlukan koreksi refraksi dengan resep sebagai berikut:
            </p>

            <!-- TABEL -->
            <table class="resep-table">
                <thead>
                    <tr>
                        <th colspan="3">R / OD</th>
                        <th colspan="3">L / OS</th>
                        <th>ADD</th>
                        <th>PD</th>
                    </tr>
                    <tr>
                        <th>SPH</th>
                        <th>CYL</th>
                        <th>AXIS</th>
                        <th>SPH</th>
                        <th>CYL</th>
                        <th>AXIS</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $RmPemeriksaan->resep->od_sferis ?? '-' }}</td>
                        <td>{{ $RmPemeriksaan->resep->od_silindris ?? '-' }}</td>
                        <td>{{ $RmPemeriksaan->resep->od_axis ?? '-' }}</td>
                        <td>{{ $RmPemeriksaan->resep->os_sferis ?? '-' }}</td>
                        <td>{{ $RmPemeriksaan->resep->os_silindris ?? '-' }}</td>
                        <td>{{ $RmPemeriksaan->resep->os_axis ?? '-' }}</td>
                        <td>{{ $RmPemeriksaan->resep->od_add_lensa ?? '-' }}</td>
                        <td>{{ $RmPemeriksaan->resep->pd_od ?? '-' }}/{{ $RmPemeriksaan->resep->pd_os ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>

            <br>

            <p>
                Demikian disampaikan, atas perhatian dan kerja sama yang baik diucapkan terima kasih.
            </p>
        </div>

        <!-- TTD -->
        <div class="ttd">
            <div class="ttd-kanan">
                <p>Jambi, {{ $RmPemeriksaan->created_at->format('d F Y') }}</p>
                <br><br><br>
                <p><strong>{{ $RmPemeriksaan->user?->name ?? 'OPTIK' }}</strong></p>
            </div>
        </div>

        <div class="clear"></div>

    </div>

</body>

</html>
