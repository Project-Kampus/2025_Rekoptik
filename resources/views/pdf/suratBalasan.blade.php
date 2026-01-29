<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Jawaban Pelayanan Refraksi & Optisi</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 13px;
            margin: 40px;
        }

        .container {
            width: 400px;
            margin: auto;
        }

        .kop {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-row {
            display: flex;
            align-items: flex-end;
        }

        .kop-logo {
            width: 60px;
        }

        .kop-logo img {
            width: 50px;
            height: auto;
        }

        .kop-text {
            flex: 1;
            text-align: center;
        }

        .kop-text h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .kop-text p {
            margin: 2px 0;
            font-size: 12px;
        }

        .kop-nomor {
            font-size: 12px;
            white-space: nowrap;
            text-align: right;
            padding-left: 10px;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            margin: 20px 0;
        }

        .content p {
            margin: 6px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 6px;
            text-align: center;
            font-size: 12px;
        }

        .ttd {
            width: 100%;
            margin-top: 20px;
        }

        .ttd .kanan {
            float: right;
            text-align: center;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- KOP + NOMOR -->
        <div class="kop">
            <div class="kop-row">
                <!-- LOGO KIRI -->
                <div class="kop-logo">
                    <img src="{{ asset('storage/' . $pengaturan->logo) }}" alt="Logo Optik">
                </div>

                <!-- TEKS TENGAH -->
                <div class="kop-text">
                    <h2>{{ $pengaturan['nama_toko'] ?? '-' }}</h2>
                    <p> {{ $pengaturan['alamat'] ?? '-' }}</p>
                    <p>Telp. {{ $pengaturan['telp'] }} | HP. {{ $pengaturan['no_hp'] }}</p>
                </div>

                <!-- NOMOR KANAN -->
                <div class="kop-nomor">
                    No. {{ str_pad($RmPemeriksaan->id, 6, '0', STR_PAD_LEFT) }}
                </div>
            </div>
        </div>

        <!-- JUDUL -->
        <div class="judul">
            Surat Jawaban Permintaan Pelayanan Refraksi dan Optisi
        </div>

        <!-- ISI -->
        <div class="content">
            <p>Yth. dr. {{ $RmPemeriksaan->resep->resep_dari }}</p>
            <p>PKM / KP / Dokter Praktek Perorangan</p>
            <p>di tempat</p>

            <br>

            <p>
                Berdasarkan hasil pemeriksaan Refraksi dan Optisi peserta atas nama:
            </p>

            <p>Nama : <strong>{{ $RmPemeriksaan->pasien->nama_pasien }}</strong></p>
            <p>No. Kartu JKN : {{ $RmPemeriksaan->no_kartu ?? '-' }}</p>
            @php
                $tanggal_lahir = \Carbon\Carbon::parse($RmPemeriksaan->pasien->tanggal_lahir);
                $umur = $tanggal_lahir->diffInYears(\Carbon\Carbon::parse($RmPemeriksaan->created_at));
                $umur = floor($umur);

            @endphp
            <p>Umur : {{ $umur }} Tahun</p>

            <br>

            <p>
                Didapatkan hasil bahwa peserta menderita gangguan Refraksi berupa,
                sehingga perlu ditatalaksana dengan pemberian kacamata sebagai berikut:
            </p>

            <!-- TABEL RESEP -->
            <table>
                <thead>
                    <tr>
                        <th colspan="3">R / OD (Kanan)</th>
                        <th colspan="3">L / OS (Kiri)</th>
                        <th colspan="2">Dekat</th>
                    </tr>
                    <tr>
                        <th>SPH</th>
                        <th>CYL</th>
                        <th>AXIS</th>
                        <th>SPH</th>
                        <th>CYL</th>
                        <th>AXIS</th>
                        <th>ADD</th>
                        <th>PD</th>
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
                Demikian disampaikan atas perhatian dan kerja sama yang baik diucapkan terima kasih.
            </p>
        </div>

        <!-- TTD -->
        <div class="ttd">
            <div class="kanan">
                <p>Jambi, {{ $RmPemeriksaan->created_at->format('d F Y') }}</p>
                <br><br><br>
                <p><strong>
                        {{ $RmPemeriksaan->user?->name ?? 'OPTIK UTAMA' }}
                    </strong></p>
            </div>
        </div>

        <div class="clear"></div>
    </div>


</body>

</html>
