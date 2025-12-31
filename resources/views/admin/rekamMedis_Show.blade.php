<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Detail Rekam Medis: {{ $pasien->nama_pasien }}
        </h2>
    </x-slot>

    <div class="space-y-6">

        <a href="{{ route('rekam-medis.index') }}"
            class="inline-block px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 text-sm">← Kembali</a>

        <!-- Card: Data Pasien -->
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Data Pasien</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ([
                'Nama Pasien' => $pasien->nama_pasien,
                'No HP' => $pasien->no_hp ?? '-',
                'Kategori' => ucfirst($pasien->kategori),
                'No Kartu' => $pasien->no_kartu ?? '-',
                'No SEP' => $pasien->no_sep ?? '-',
                'Alamat' => $pasien->alamat ?? '-',
                ] as $label => $value)
                <div class="flex flex-col">
                    <span class="text-gray-500 text-sm">{{ $label }}</span>
                    <span class="bg-gray-50 p-2 rounded text-gray-700 font-medium">{{ $value }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Card: Riwayat Pasien -->
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Riwayat Pasien</h3>
            <div class="space-y-4">
                @foreach ([
                'Keluhan Utama' => $pasien->keluhan_utama,
                'Riwayat Penyakit' => $pasien->riwayat_penyakit,
                'Penyakit Sekarang' => $pasien->penyakit_sekarang,
                'Penyakit Keluarga' => $pasien->penyakit_keluarga,
                'Kebiasaan' => $pasien->kebiasaan,
                'Pengobatan / Konsumsi Obat' => $pasien->pengobatan,
                ] as $label => $value)
                <div class="flex flex-col">
                    <span class="text-gray-500 text-sm">{{ $label }}</span>
                    <span class="bg-blue-50 p-3 rounded text-gray-700 font-medium">{{ $value ?? '-' }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Card: Pembayaran & Frame -->
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Pembayaran & Frame</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ([
                'Tanggal Pemeriksaan' => $pasien->tanggal_pemeriksaan?->format('d-m-Y'),
                'Frame' => $pasien->frame?->kode_frame ?? '-',
                'Lensa' => $pasien->lensa->nama_lensa ?? '-',
                'PD' => $pasien->pd ?? '-',
                'Biaya Kacamata' => 'Rp ' . number_format($pasien->biaya_kacamata, 0, ',', '.'),
                'Dibayar BPJS' => 'Rp ' . number_format($pasien->dibayar_bpjs, 0, ',', '.'),
                'Dibayar Asuransi' => 'Rp ' . number_format($pasien->dibayar_asuransi, 0, ',', '.'),
                'Dibayar Pasien' => 'Rp ' . number_format($pasien->dibayar_pasien, 0, ',', '.'),
                'Sisa' => 'Rp ' . number_format($pasien->sisa, 0, ',', '.'),
                ] as $label => $value)
                <div class="flex flex-col">
                    <span class="text-gray-500 text-sm">{{ $label }}</span>
                    <span class="bg-green-50 p-2 rounded text-gray-700 font-medium">{{ $value }}</span>
                </div>
                @endforeach
            </div>
        </div>



    </div>
</x-app-layout>