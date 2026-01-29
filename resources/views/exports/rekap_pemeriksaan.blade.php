@php $no = 1; @endphp
<table border="1" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th rowspan="2" colspan="1">NO</th>
            <th rowspan="2" colspan="1">Tanggal</th>
            <th rowspan="2" colspan="1">Nama Pasien</th>
            <th rowspan="2" colspan="1">Umur</th>
            <th rowspan="2" colspan="1">No. HP</th>
            <th rowspan="2" colspan="1">Diagnosa</th>
            <th rowspan="1" colspan="2">Resep dokter</th>
            <th rowspan="1" colspan="2">Ukuran Lensa</th>
            <th rowspan="1" colspan="2">Add</th>
        </tr>
        <tr>
            <th rowspan="1" colspan="1">Nama</th>
            <th rowspan="1" colspan="1">Tanggal</th>
            <th rowspan="1" colspan="1">Kanan (OD)</th>
            <th rowspan="1" colspan="1">Kiri (OS)</th>
            <th rowspan="1" colspan="1">OD</th>
            <th rowspan="1" colspan="1">OS</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ optional($row->created_at)->format('d-m-Y') ?? '-' }}</td>
                <td>{{ $row->pasien->nama_pasien ?? '-' }}</td>
                <td>{{ $row->pasien->umur ?? '-' }}</td>
                <td>{{ $row->pasien->no_hp ?? '-' }}</td>
                <td>{{ $row->diagnosa ?? '-' }}</td>
                <td>{{ $row->resep->resep_dari ?? '-' }}</td>
                <td>{{ optional($row->resep->tanggal)->format('d-m-Y') ?? '-' }}</td>
                <td> {{ $row->resep->od_sferis ?? '-' }},
                    {{ $row->resep->od_silindris ?? '-' }},
                    {{ $row->resep->od_axis ?? '-' }},
                    {{ $row->resep->pd_od ?? '-' }}</td>
                <td> {{ $row->resep->os_sferis ?? '-' }},
                    {{ $row->resep->os_silindris ?? '-' }},
                    {{ $row->resep->os_axis ?? '-' }},
                    {{ $row->resep->pd_os ?? '-' }}
                </td>
                <td>{{ $row->resep->od_add_lensa ?? '-' }}</td>
                <td>{{ $row->resep->os_add_lensa ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
