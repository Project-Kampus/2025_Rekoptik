<x-app-layout>
   <x-slot name="header">
      <div class="flex items-center justify-between">
         <h2 class="font-semibold text-xl text-gray-800 flex items-center gap-3">
            Detail Rekam Medis: {{ $pasien->nama_pasien }}

            {{-- STATUS --}}
            @php
            if ($pasien->tanggal_pengambilan) {
            $status = 'Sudah Diambil';
            $color = 'green';
            } elseif ($pasien->tanggal_dipesan) {
            $status = 'Dipesan';
            $color = 'blue';
            } else {
            $status = 'Proses Pemeriksaan';
            $color = 'yellow';
            }
            @endphp

            <span
               class="px-3 py-1 rounded-full text-sm font-semibold
                bg-{{ $color }}-100 text-{{ $color }}-800">
               {{ $status }}
            </span>
         </h2>
      </div>
   </x-slot>

   <div class="space-y-6">

      <!-- ACTION BUTTON -->
      <div class="flex flex-wrap gap-2">
         <a href="{{ route('rekapMedis.Struk', $pasien->id) }}"
            class="px-4 py-2 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700">
            Lihat Struk
         </a>

         <a href="{{ route('rekapMedis.surat', $pasien->id) }}"
            class="px-4 py-2 bg-teal-600 text-white rounded text-sm hover:bg-teal-700">
            Surat Balasan
         </a>

      </div>

      <!-- ================= DATA PASIEN ================= -->
      <div class="bg-white shadow-sm rounded-lg p-6">
         <h3 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Data Pasien</h3>
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ([
            'Nama Pasien' => $pasien->nama_pasien,
            'No HP' => $pasien->no_hp ?? '-',
            'Kategori' => ucfirst($pasien->kategori),
            'No Kartu' => $pasien->no_kartu ?? '-',
            'Alamat' => $pasien->alamat ?? '-',
            'Umur' => $pasien->umur ? $pasien->umur . ' tahun' : '-',
            ] as $label => $value)
            <div class="flex flex-col">
               <span class="text-gray-500 text-sm">{{ $label }}</span>
               <span class="bg-gray-50 p-2 rounded text-gray-700 font-medium">{{ $value }}</span>
            </div>
            @endforeach
         </div>
      </div>

      <!-- ================= PEMERIKSAAN ================= -->
      <div class="bg-white shadow-sm rounded-lg p-6">
         <h3 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Data Pemeriksaan</h3>
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ([
            'Resep Dari' => $pasien->resep_dari,
            'No SEP' => $pasien->no_sep ?? '-',
            'Tanggal Pemeriksaan' => $pasien->tanggal_pemeriksaan?->format('d-m-Y'),
            'Diagnosa' => $pasien->diagnosa ?? '-',
            ] as $label => $value)
            <div class="flex flex-col">
               <span class="text-gray-500 text-sm">{{ $label }}</span>
               <span class="bg-gray-50 p-2 rounded text-gray-700 font-medium">{{ $value }}</span>
            </div>
            @endforeach
         </div>
      </div>

      <!-- ================= RIWAYAT ================= -->
      <div class="bg-white shadow-sm rounded-lg p-6">
         <h3 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Riwayat Pasien</h3>
         <div class="space-y-4">
            @foreach ([
            'Keluhan Utama' => $pasien->keluhan_utama,
            'Riwayat Penyakit' => $pasien->riwayat_penyakit,
            'Penyakit Sekarang' => $pasien->penyakit_sekarang,
            'Penyakit Keluarga' => $pasien->penyakit_keluarga,
            'Kebiasaan' => $pasien->kebiasaan,
            'Pengobatan' => $pasien->pengobatan,
            ] as $label => $value)
            <div class="flex flex-col">
               <span class="text-gray-500 text-sm">{{ $label }}</span>
               <span class="bg-blue-50 p-3 rounded text-gray-700 font-medium">{{ $value ?? '-' }}</span>
            </div>
            @endforeach
         </div>
      </div>

      <!-- ================= RESEP KACAMATA ================= -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

         <div class="bg-white shadow-sm rounded-lg p-6">
            <h4 class="font-semibold mb-3 text-gray-700">Mata Kanan (OD)</h4>
            <ul class="text-sm space-y-1">
               <li>Sferis: {{ $pasien->od_sferis ?? '-' }}</li>
               <li>Silindris: {{ $pasien->od_silindris ?? '-' }}</li>
               <li>Axis: {{ $pasien->od_axis ?? '-' }}</li>
               <li>Add: {{ $pasien->od_add_lensa ?? '-' }}</li>
            </ul>
         </div>

         <div class="bg-white shadow-sm rounded-lg p-6">
            <h4 class="font-semibold mb-3 text-gray-700">Mata Kiri (OS)</h4>
            <ul class="text-sm space-y-1">
               <li>Sferis: {{ $pasien->os_sferis ?? '-' }}</li>
               <li>Silindris: {{ $pasien->os_silindris ?? '-' }}</li>
               <li>Axis: {{ $pasien->os_axis ?? '-' }}</li>
               <li>Add: {{ $pasien->os_add_lensa ?? '-' }}</li>
            </ul>
         </div>

      </div>

      <!-- ================= KACAMATA & PEMBAYARAN ================= -->
      <div class="bg-white shadow-sm rounded-lg p-6">
         <h3 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Kacamata & Pembayaran</h3>
         <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>Frame: <strong>{{ $pasien->frame?->kode_frame ?? '-' }}</strong></div>
            <div>Lensa: <strong>{{ $pasien->lensa?->nama_lensa ?? '-' }}</strong></div>
            <div>PD: <strong>{{ $pasien->pd ?? '-' }}</strong></div>

            <div>Biaya: <strong>Rp {{ number_format($pasien->biaya_kacamata, 0, ',', '.') }}</strong></div>
            @if ($pasien->kategori === 'bpjs')
            <div>
               Dibayar BPJS:
               <strong>
                  Rp {{ number_format($pasien->dibayar_bpjs ?? 0, 0, ',', '.') }}
               </strong>
            </div>
            @elseif ($pasien->kategori === 'asuransi')
            <div>
               Dibayar Asuransi:
               <strong>
                  Rp {{ number_format($pasien->dibayar_asuransi ?? 0, 0, ',', '.') }}
               </strong>
            </div>
            @endif
            <div>Dibayar Pasien: <strong>Rp {{ number_format($pasien->dibayar_pasien, 0, ',', '.') }}</strong></div>
            <div>Sisa Pembayaran: <strong>Rp {{ number_format($pasien->sisa, 0, ',', '.') }}</strong></div>
         </div>
      </div>

      <!-- ================= DOKUMEN ================= -->
      <div class="bg-white shadow-sm rounded-lg p-6">
         <h3 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Dokumen</h3>
         <ul class="space-y-2">
            @foreach ([
            'KTP' => $pasien->doc_ktp,
            'Legalitas' => $pasien->doc_legalitas,
            'Rujukan' => $pasien->doc_rujukan,
            'Bukti' => $pasien->bukti_pengambil,
            ] as $label => $file)
            <li>
               {{ $label }} :
               @if ($file)
               <a href="{{ asset('storage/' . $file) }}" target="_blank"
                  class="text-blue-600 hover:underline">Lihat</a>
               @else
               -
               @endif
            </li>
            @endforeach
         </ul>
      </div>
   </div>


</x-app-layout>