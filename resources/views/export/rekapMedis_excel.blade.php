<table border="1">
   <thead>
      <tr style="background:#f3f4f6; font-weight:bold;">
         <th>No</th>
         <th>Tanggal Pemeriksaan</th>
         <th>Nama Pasien</th>
         <th>Resep Asal Kacamata</th>
         <th>No. Kartu Peserta</th>
         <th>No. SEP</th>
         <th>No HP</th>

         <th>OD Sph</th>
         <th>OD Cyl</th>
         <th>OD Axis</th>
         <th>OD Add</th>

         <th>OS Sph</th>
         <th>OS Cyl</th>
         <th>OS Axis</th>
         <th>OS Add</th>

         <th>PD</th>
         <th>Diagnosa </th>
      </tr>
   </thead>

   <tbody>
      @foreach ($pasiens as $i => $pasien)
      <tr>
         <td>{{ $i + 1 }}</td>

         <td>
            {{ optional($pasien->tanggal_pemeriksaan)->format('d-m-Y') }}
         </td>

         <td>{{ $pasien->nama_pasien }}</td>

         <td>{{ $pasien->resep_dari ?? '-' }}</td>

         <td>{{ $pasien->no_kartu ?? '-' }}</td>

         <td>{{ $pasien->no_sep ?? '-' }}</td>

         <td>{{ $pasien->no_hp ?? '-' }}</td>

         <!-- OD -->
         <td>{{ $pasien->od_sferis }}</td>
         <td>{{ $pasien->od_silindris }}</td>
         <td>{{ $pasien->od_axis }}</td>
         <td>{{ $pasien->od_add_lensa }}</td>

         <!-- OS -->
         <td>{{ $pasien->os_sferis }}</td>
         <td>{{ $pasien->os_silindris }}</td>
         <td>{{ $pasien->os_axis }}</td>
         <td>{{ $pasien->os_add_lensa }}</td>

         <td>{{ $pasien->pd }}</td>

         <td>
            {{ $pasien->diagnosa ?? '-' }}
         </td>
      </tr>
      @endforeach
   </tbody>
</table>