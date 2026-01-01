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
            <a href="{{ route('rekam-medis.index') }}"
                class="px-4 py-2 bg-gray-600 text-white rounded text-sm hover:bg-gray-700">
                ← Kembali
            </a>

            <a href="{{ route('rekam-medis.edit', $pasien->id) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                Edit Data
            </a>

            <a href="{{ route('rekam-medis.struk', $pasien->id) }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700">
                Lihat Struk
            </a>

            <a href="{{ route('rekam-medis.surat', $pasien->id) }}"
                class="px-4 py-2 bg-teal-600 text-white rounded text-sm hover:bg-teal-700">
                Surat Balasan
            </a>

            @if ($pasien->tanggal_pengambilan === null)
            <button onclick="openPengambilanModal()"
                class="px-4 py-2 bg-green-600 text-white rounded text-sm hover:bg-green-700">
                Pengambilan
            </button>
            @endif
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
                <div>Tanggal Pemesanan: <strong>{{ $pasien->tanggal_dipesan ?? '-' }}</strong></div>
                @if($pasien->tanggal_pengambilan)
                <div>Tanggal Pengambilan: <strong>{{ $pasien->tanggal_pengambilan ?? '-' }}</strong></div>
                <div>Nama-hub Pengambilan: <strong>{{ $pasien->nama_pengambil ?? '-' }} - {{ $pasien->hub_pengambil ?? '-' }}</strong></div>
                @endif
            </div>
        </div>
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Pembayaran</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>Biaya: <strong>Rp {{ number_format($pasien->biaya_kacamata, 0, ',', '.') }}</strong></div>
                @if ($pasien->kategori === 'bpjs')
                <div class="flex"> Dibayar BPJS:
                    <div>
                        <strong>Rp {{ number_format($pasien->dibayar_bpjs ?? 0, 0, ',', '.') }}</strong><br>
                        <strong class="text-sm">{{ $pasien->kelas ? 'Kelas '.$pasien->kelas : '-' }}</strong>
                    </div>
                </div>
                @elseif ($pasien->kategori === 'asuransi')
                <div>
                    Dibayar Asuransi:
                    <strong>Rp {{ number_format($pasien->dibayar_asuransi ?? 0, 0, ',', '.') }}</strong>
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

    <!-- MODAL PENGAMBILAN -->
    <div id="modalPengambilan"
        class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">

        <div class="bg-white w-full max-w-lg rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Form Pengambilan Kacamata
            </h3>

            <form action="{{ route('rekam-medis.pengambilan', $pasien->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Tanggal Pengambilan -->
                <div>
                    <label class="text-sm text-gray-600">Tanggal Pengambilan</label>
                    <input type="date" name="tanggal_pengambilan" class="w-full mt-1 rounded border-gray-300"
                        required>
                </div>

                <!-- Nama Pengambil -->
                <div>
                    <label class="text-sm text-gray-600">Nama Pengambil</label>
                    <input type="text" name="nama_pengambil" class="w-full mt-1 rounded border-gray-300"
                        placeholder="Nama pengambil" required>
                </div>

                <!-- Hubungan Pengambil -->
                <div>
                    <label class="text-sm text-gray-600">Hubungan dengan Pasien</label>
                    <input type="text" name="hub_pengambil" class="w-full mt-1 rounded border-gray-300"
                        placeholder="Pasien / Keluarga / Lainnya" required>
                </div>

                <!-- Bukti Pengambilan -->
                <div>
                    <label class="text-sm text-gray-600">Bukti Pengambilan</label>
                    <input type="file" name="bukti_pengambil" class="w-full mt-1 rounded border-gray-300"
                        accept="image/*,application/pdf" required>
                    <small class="text-xs text-gray-500">
                        JPG, PNG, atau PDF (maks 2MB)
                    </small>
                </div>

                <!-- BUTTON -->
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closePengambilanModal()"
                        class="px-4 py-2 bg-gray-300 rounded text-sm hover:bg-gray-400">
                        Batal
                    </button>

                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded text-sm hover:bg-green-700">
                        Simpan Pengambilan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openPengambilanModal() {
            document.getElementById('modalPengambilan').classList.remove('hidden');
        }

        function closePengambilanModal() {
            document.getElementById('modalPengambilan').classList.add('hidden');
        }
    </script>

</x-app-layout>