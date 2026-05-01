@php
    $no = 1;
@endphp
<table border="1" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th colspan="1" rowspan="2">NO</th>
            <th colspan="1" rowspan="2">Tanggal Pengambilan</th>
            <th colspan="1" rowspan="2">Nama Peserta</th>
            <th colspan="1" rowspan="2">Umur</th>
            <th colspan="1" rowspan="2">No.Kartu Asuransi</th>
            <th colspan="1" rowspan="2">No.Hp</th>
            <th colspan="2" rowspan="1">Resep Dokter</th>
            <th colspan="2" rowspan="1">Ukuran Lensa</th>
            <th colspan="2" rowspan="1">Add</th>

            <th colspan="1" rowspan="2">Bayar Real</th>
            <th colspan="1" rowspan="2">Besar Penggantian</th>
            <th colspan="1" rowspan="2">Selisih</th>
        </tr>
        <tr>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Kanan (OD)</th>
            <th>Kiri (OS)</th>
            <th>OD</th>
            <th>OS</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rekamMedis as $index => $rm)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $rm->tanggal_pengambilan }}</td>
                <td>{{ $rm->pemeriksaan->pasien->nama_pasien ?? '-' }}</td>
                <td>{{ $rm->pemeriksaan->pasien->umur ?? '-' }}</td>
                <td>{{ $rm->pemeriksaan->pasien->no_kartu ?? '-' }}</td>
                <td>{{ $rm->pemeriksaan->pasien->no_hp ?? '-' }}</td>
                <td>{{ $rm->pemeriksaan->resep->resep_dari ?? '-' }}</td>
                <td>{{ $rm->pemeriksaan->resep->tanggal ?? '-' }}</td>
                <td>
                    {{ $rm->pemeriksaan->resep->od_sferis ?? '-' }},
                    {{ $rm->pemeriksaan->resep->od_silindris ?? '-' }},
                    {{ $rm->pemeriksaan->resep->od_axis ?? '-' }},
                    {{ $rm->pemeriksaan->resep->pd_od ?? '-' }}
                </td>
                <td>{{ $rm->pemeriksaan->resep->os_sferis ?? '-' }},
                    {{ $rm->pemeriksaan->resep->os_silindris ?? '-' }},
                    {{ $rm->pemeriksaan->resep->os_axis ?? '-' }},
                    {{ $rm->pemeriksaan->resep->pd_os ?? '-' }}
                </td>
                <td>{{ $rm->pemeriksaan->resep->od_add_lensa ?? '-' }}</td>
                <td>{{ $rm->pemeriksaan->resep->os_add_lensa ?? '-' }}</td>
                <td>{{ $rm->biaya_kacamata ?? 0 }}</td>
                <td>{{ $rm->pembayarans->where('kategori', 'asuransi')->sum('jumlah') ?? 0 }}</td>
                <td>{{ ($rm->biaya_kacamata ?? 0) - ($rm->pembayarans->where('kategori', 'asuransi')->sum('jumlah') ?? 0) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
