<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: middle;
        }

        th {
            text-align: center;
            font-weight: bold;
        }

        td {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>

    {{-- JUDUL --}}
    <table>
        <tr>
            <td colspan="13">DAFTAR BUKTI PELAYANAN KACAMATA PESERTA BPJS KESEHATAN</td>
        </tr>
        <tr>
            <td colspan="13">OPTIK UTAMA JAMBI</td>
        </tr>
        <tr>
            <td colspan="13"></td>
        </tr>

        {{-- HEADER UTAMA --}}
        <tr>
            <td>No</td>
            <td>Tanggal Pengambilan</td>
            <td>Umur</td>
            <td>No BPJS</td>
            <td>Resep Dokter</td>
            <td></td>
            <td>Ukuran Lensa</td>
            <td></td>
            <td>ADD</td>
            <td></td>
            <td>Biaya Kacamata</td>
            <td>Dibayar BPJS</td>
            <td>Selisih Biaya</td>
        </tr>

        {{-- SUB HEADER --}}
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Nama</td>
            <td>Tanggal</td>
            <td>OD</td>
            <td>OS</td>
            <td>OD</td>
            <td>OS</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        {{-- DATA --}}
        @foreach ($pasiens as $i => $p)
            @php
                $biaya = $p->biaya_kacamata ?? 0;
                $bpjs = $p->dibayar_bpjs ?? 0;
            @endphp
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>
                    {{ $p->tanggal_pengambilan ? \Carbon\Carbon::parse($p->tanggal_pengambilan)->toDateString() : '' }}
                </td>
                <td>{{ $p->umur }}</td>
                <td>{{ $p->no_kartu }}</td>
                <td>{{ $p->resep_dari }}</td>
                <td>
                    {{ $p->tanggal_pemeriksaan ? \Carbon\Carbon::parse($p->tanggal_pemeriksaan)->toDateString() : '' }}
                </td>
                <td>{{ $p->od_sferis }}</td>
                <td>{{ $p->os_sferis }}</td>
                <td>{{ $p->od_add_lensa }}</td>
                <td>{{ $p->os_add_lensa }}</td>
                <td>{{ $biaya }}</td>
                <td>{{ $bpjs }}</td>
                <td>{{ $biaya - $bpjs }}</td>
            </tr>
        @endforeach
    </table>


</body>

</html>
