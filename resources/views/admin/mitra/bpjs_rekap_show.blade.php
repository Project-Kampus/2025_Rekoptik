<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Rekap Medis BPJS
        </h2>
    </x-slot>

    <x-slot name="headerAction">
        <div class="flex gap-2 flex-wrap">
            <a href="{{ route('mitra.bpjs.index') }}"
                class="px-4 py-2 bg-gray-600 text-white rounded-lg text-sm hover:bg-gray-700 transition">
                Kembali
            </a>

            @php
                $pembayaran = $pesanan->pembayarans->last();
            @endphp

            @if ($pembayaran)
                <a href="{{ route('datamedis.cetatakStruk', $pembayaran->id) }}" target="_blank"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700 transition">
                    Lihat Struk
                </a>
            @else
                <button disabled title="Pembayaran belum dicatat"
                    class="px-4 py-2 bg-gray-200 text-gray-500 rounded-lg text-sm cursor-not-allowed">
                    Lihat Struk
                </button>
            @endif

            <a href="{{ route('datamedis.cetakSuratBalasan', $pesanan->pemeriksaan->id) }}" target="_blank"
                class="px-4 py-2 bg-teal-600 text-white rounded-lg text-sm hover:bg-teal-700 transition">
                Surat Balasan
            </a>
            @if ($pesanan->status !== 'diambil')
                <button type="button" onclick="openPengambilanModal({{ $pesanan->pemeriksaan->id }})"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700 transition">
                    Pengambilan
                </button>
            @endif

        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- PESANAN -->
            @if ($pesanan)
                <div class="bg-white rounded-lg border border-gray-200 p-5 shadow-sm">
                    <h3 class="text-base font-bold text-gray-800 mb-4 pb-3 border-b border-gray-200">Detail Pesanan
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600 w-1/3">Frame</td>
                                    <td class="px-3 py-2 text-gray-900 font-semibold">
                                        {{ $pesanan->frame->merk ?? '-' }} -
                                        {{ $pesanan->frame->kode_frame ?? '-' }}</td>
                                </tr>
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600">Lensa</td>
                                    <td class="px-3 py-2 text-gray-900 font-semibold">
                                        {{ $pesanan->lensa->nama_lensa ?? '-' }}</td>
                                </tr>
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600">Aksesoris</td>
                                    <td class="px-3 py-2 text-gray-900 font-semibold">
                                        {{ $pesanan->aksesoris->nama ?? '-' }}</td>
                                </tr>
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600">Biaya</td>
                                    <td class="px-3 py-2 text-purple-600 font-bold">Rp
                                        {{ number_format($pesanan->biaya_kacamata, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600">Sisa Pembayaran</td>
                                    @php
                                        $sisaPembayaran =
                                            $pesanan->biaya_kacamata - $pesanan->pembayarans->sum('jumlah');
                                    @endphp
                                    <td class="px-3 py-2 text-purple-600 font-bold">Rp
                                        {{ number_format($sisaPembayaran, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600">Status</td>
                                    <td class="px-3 py-2">
                                        <span
                                            class="px-2 py-1 mr-2 bg-blue-100 text-blue-700 text-xs font-semibold rounded">
                                            {{ $pesanan->status }}
                                        </span>
                                        @if ($pesanan->status == 'diambil')
                                            {{ $pesanan->tanggal_pengambilan?->format('d F Y') }}
                                        @else
                                            {{ $pesanan->updated_at->format('d F Y') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600">Tgl Dipesan</td>
                                    <td class="px-3 py-2 text-gray-900">
                                        {{ $pesanan->tanggal_dipesan?->format('d F Y') }}
                                    </td>
                                </tr>
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600">Tgl Pengambilan</td>
                                    <td class="px-3 py-2 text-gray-900">
                                        {{ $pesanan->tanggal_pengambilan?->format('d F Y') ?? '-' }}
                                    </td>
                                </tr>
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600">Dokumen</td>
                                    <td class="px-3 py-2">
                                        @php
                                            $totalDokumen = $allDokumens->count();
                                            $uploadedCount = $uploadedDokumens->count();
                                            $isComplete = $totalDokumen > 0 && $uploadedCount >= $totalDokumen;
                                        @endphp
                                        @if ($isComplete)
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded">
                                                Lengkap {{ $uploadedCount }}/{{ $totalDokumen }}</span>
                                        @else
                                            <span
                                                class="px-2 py-1 bg-orange-100 text-orange-700 text-xs font-semibold rounded">
                                                Belum Lengkap {{ $uploadedCount }}/{{ $totalDokumen }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- INFORMASI PASIEN -->
            <div class="bg-white rounded-lg border border-gray-200 p-5 shadow-sm">
                <h3 class="text-base font-bold text-gray-800 mb-4 pb-3 border-b border-gray-200">Informasi Pasien
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-indigo-50">
                                <td class="px-3 py-2 font-medium text-gray-600 w-1/3">Nama</td>
                                <td class="px-3 py-2 text-gray-900 font-semibold">
                                    {{ $pesanan->pemeriksaan->pasien->nama_pasien }}</td>
                            </tr>
                            <tr class="hover:bg-indigo-50">
                                <td class="px-3 py-2 font-medium text-gray-600">No HP</td>
                                <td class="px-3 py-2 text-gray-900">{{ $pesanan->pemeriksaan->pasien->no_hp }}</td>
                            </tr>
                            <tr class="hover:bg-indigo-50">
                                <td class="px-3 py-2 font-medium text-gray-600">Email</td>
                                <td class="px-3 py-2 text-gray-900">{{ $pesanan->pemeriksaan->pasien->email }}</td>
                            </tr>
                            <tr class="hover:bg-indigo-50">
                                <td class="px-3 py-2 font-medium text-gray-600">Alamat</td>
                                <td class="px-3 py-2 text-gray-900">{{ $pesanan->pemeriksaan->pasien->alamat }}</td>
                            </tr>
                            <tr class="hover:bg-indigo-50">
                                <td class="px-3 py-2 font-medium text-gray-600">Umur</td>
                                <td class="px-3 py-2 text-gray-900">{{ $pesanan->pemeriksaan->pasien->umur }} Tahun
                                </td>
                            </tr>
                            <tr class="hover:bg-indigo-50">
                                <td class="px-3 py-2 font-medium text-gray-600">Kategori</td>
                                <td class="px-3 py-2"><span
                                        class="px-2 py-1 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded">{{ strtoupper($pesanan->pemeriksaan->pasien->kategori) }}</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-indigo-50">
                                <td class="px-3 py-2 font-medium text-gray-600">No Kartu</td>
                                <td class="px-3 py-2 text-gray-900">
                                    {{ $pesanan->pemeriksaan->pasien->no_kartu ?? '-' }}</td>
                            </tr>
                            <tr class="hover:bg-indigo-50">
                                <td class="px-3 py-2 font-medium text-gray-600">Kelas</td>
                                <td class="px-3 py-2 text-gray-900">{{ $pesanan->pemeriksaan->pasien->kelas ?? '-' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- DETAIL PEMERIKSAAN -->
        <div class="bg-white rounded-lg border border-gray-200 p-5 shadow-sm">
            <h3 class="text-base font-bold text-gray-800 mb-4 pb-3 border-b border-gray-200">Detail Pemeriksaan</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-green-50">
                            <td class="px-3 py-2 font-medium text-gray-600 w-1/5">No SEP</td>
                            <td class="px-3 py-2 text-gray-900">{{ $pesanan->pemeriksaan->no_sep ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-green-50">
                            <td class="px-3 py-2 font-medium text-gray-600">Keluhan Utama</td>
                            <td class="px-3 py-2 text-gray-900">{{ $pesanan->pemeriksaan->keluhan_utama ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-green-50">
                            <td class="px-3 py-2 font-medium text-gray-600">Riwayat Penyakit</td>
                            <td class="px-3 py-2 text-gray-900">{{ $pesanan->pemeriksaan->riwayat_penyakit ?? '-' }}
                            </td>
                        </tr>
                        <tr class="hover:bg-green-50">
                            <td class="px-3 py-2 font-medium text-gray-600">Penyakit Sekarang</td>
                            <td class="px-3 py-2 text-gray-900">{{ $pesanan->pemeriksaan->penyakit_sekarang ?? '-' }}
                            </td>
                        </tr>
                        <tr class="hover:bg-green-50">
                            <td class="px-3 py-2 font-medium text-gray-600">Penyakit Keluarga</td>
                            <td class="px-3 py-2 text-gray-900">{{ $pesanan->pemeriksaan->penyakit_keluarga ?? '-' }}
                            </td>
                        </tr>
                        <tr class="hover:bg-green-50">
                            <td class="px-3 py-2 font-medium text-gray-600">Kebiasaan</td>
                            <td class="px-3 py-2 text-gray-900">{{ $pesanan->pemeriksaan->kebiasaan ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-green-50">
                            <td class="px-3 py-2 font-medium text-gray-600">Pengobatan</td>
                            <td class="px-3 py-2 text-gray-900">{{ $pesanan->pemeriksaan->pengobatan ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-green-50">
                            <td class="px-3 py-2 font-medium text-gray-600">Diagnosa</td>
                            <td class="px-3 py-2 font-semibold text-green-700">
                                {{ $pesanan->pemeriksaan->diagnosa ?? '-' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- RESEP -->
        @if ($pesanan->pemeriksaan->resep)
            <!-- DETAIL RESEP -->
            <div class="bg-white rounded-xl border p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Detail Resep</h3>
                <div class="mb-8">
                    <h4 class="font-semibold text-gray-700 mb-3">
                        Resep dari {{ $pesanan->pemeriksaan->resep->resep_dari }}
                        <span class="text-sm text-gray-500">
                            ({{ $pesanan->pemeriksaan->resep->tanggal }})
                        </span>
                    </h4>

                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="w-full text-sm">
                            <thead class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold">Mata</th>
                                    <th class="px-4 py-3 text-left font-semibold">SPH</th>
                                    <th class="px-4 py-3 text-left font-semibold">CYL</th>
                                    <th class="px-4 py-3 text-left font-semibold">AXIS</th>
                                    <th class="px-4 py-3 text-left font-semibold">ADD</th>
                                    <th class="px-4 py-3 text-left font-semibold">PD</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-3 font-semibold text-gray-700">Mata Kanan (OD)</td>
                                    <td class="px-4 py-3">{{ $pesanan->pemeriksaan->resep->od_sferis ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $pesanan->pemeriksaan->resep->od_silindris ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $pesanan->pemeriksaan->resep->od_axis ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $pesanan->pemeriksaan->resep->od_add_lensa ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $pesanan->pemeriksaan->resep->pd_od ?? '-' }}</td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-3 font-semibold text-gray-700">Mata Kiri (OS)</td>
                                    <td class="px-4 py-3">{{ $pesanan->pemeriksaan->resep->os_sferis ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $pesanan->pemeriksaan->resep->os_silindris ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $pesanan->pemeriksaan->resep->os_axis ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $pesanan->pemeriksaan->resep->os_add_lensa ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $pesanan->pemeriksaan->resep->pd_os ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        @endif

        <!-- RIWAYAT PEMBAYARAN -->
        <div class="bg-white rounded-lg border border-gray-200 p-5 shadow-sm">
            <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-200">
                <h3 class="text-base font-bold text-gray-800">Riwayat Pembayaran</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gradient-to-r from-green-100 to-green-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal Bayar</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Metode</th>
                            <th class="px-4 py-3 text-right font-semibold text-gray-700">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($pesanan->pembayarans as $pembayaran)
                            <tr class="hover:bg-green-50 transition">
                                <td class="px-4 py-3 text-gray-900">
                                    {{ $pembayaran->tanggal_bayar->format('d F Y') }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 font-semibold rounded">
                                        @switch($pembayaran->metode)
                                            @case('bpjs')
                                                Dibayar dengan BPJS
                                            @break

                                            @case('asuransi')
                                                Dibayar dengan Asuransi
                                            @break

                                            @case('non-tunai')
                                                Dibayar dengan Non Tunai
                                            @break

                                            @case('tunai')
                                                Dibayar dengan Tunai
                                            @break

                                            @default
                                                -
                                        @endswitch
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right font-bold text-green-600">Rp
                                    {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr class="bg-gray-50 font-bold">
                            <td colspan="2" class="px-4 py-3 text-gray-800">Total Pembayaran</td>
                            <td class="px-4 py-3 text-right text-green-600">Rp
                                {{ number_format($pesanan->pembayarans->sum('jumlah'), 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PENGAMBILAN -->
        @if (strtolower($pesanan->status) == 'diambil' && $pesanan->pengambilan)
            <div class="bg-white rounded-xl border p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Pengambilan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="border rounded-lg p-4 bg-gray-50">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Nama Pengambil</p>
                        <p class="text-gray-900">{{ $pesanan->pengambilan->nama_pengambil }}</p>
                    </div>
                    <div class="border rounded-lg p-4 bg-gray-50">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Hubungan Pengambil</p>
                        <p class="text-gray-900">{{ $pesanan->pengambilan->hub_pengambil }}</p>
                    </div>

                    <!-- Bukti Pengambil (Signature Image) -->
                    <div class="border rounded-lg p-4 bg-gray-50">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Tanda Tangan Penerima</p>
                        @if ($pesanan->pengambilan->bukti_pengambil)
                            @if (strpos($pesanan->pengambilan->bukti_pengambil, 'storage/') === 0)
                                <img src="{{ asset($pesanan->pengambilan->bukti_pengambil) }}" alt="Tanda Tangan"
                                    class="w-full h-32 border-2 border-gray-300 rounded bg-white object-contain p-2">
                            @else
                                <img src="{{ asset('storage/' . $pesanan->pengambilan->bukti_pengambil) }}"
                                    alt="Tanda Tangan"
                                    class="w-full h-32 border-2 border-gray-300 rounded bg-white object-contain p-2">
                            @endif
                        @else
                            <p class="text-gray-500 text-sm italic">Tidak ada tanda tangan</p>
                        @endif
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t">
                    <p class="text-xs text-gray-500">Disimpan pada:
                        {{ $pesanan->pengambilan->created_at?->format('d F Y H:i') }}</p>
                </div>
            </div>
        @endif

        <!-- DOKUMEN -->
        <div class="bg-white rounded-lg border border-gray-200 p-5 shadow-sm">
            <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-200">
                <h3 class="text-base font-bold text-gray-800">Dokumen Pendukung</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                {{-- DOKUMEN WAJIB (MASTER) --}}
                @foreach ($allDokumens as $dokumen)
                    @php
                        $uploaded = $uploadedDokumens->get($dokumen->id);
                    @endphp

                    <div
                        class="border rounded-lg p-4 hover:shadow-md transition @if ($uploaded && file_exists(public_path('storage/' . $uploaded->url))) bg-green-50 @elseif($uploaded) bg-yellow-50 @else bg-orange-50 @endif">
                        <p class="font-semibold text-gray-800 mb-2">{{ $dokumen->nama }}</p>

                        @if ($uploaded)
                            @php
                                $filePath = 'storage/' . $uploaded->url;
                            @endphp
                            {{-- {{ $filePath }} --}}
                            @if (file_exists(public_path($filePath)))
                                <a href="{{ asset($filePath) }}" target="_blank"
                                    class="inline-block text-green-600 text-sm font-medium hover:underline">
                                    Lihat Dokumen
                                </a>
                            @else
                                <span class="inline-block text-red-500 text-sm font-medium italic">
                                    File rusak
                                </span>
                            @endif
                        @else
                            <span class="inline-block text-orange-600 text-sm font-medium">
                                Belum dilengkapi
                            </span>
                        @endif
                    </div>
                @endforeach


                {{-- DOKUMEN LIAR (ADA TAPI TIDAK DI MASTER) --}}
                @foreach ($pesanan->pemeriksaan->dokumens as $dokumen)
                    @if (!$allDokumens->contains('id', $dokumen->dokumens_id))
                        <div class="border-2 border-red-300 rounded-lg p-4 bg-red-50 hover:shadow-md transition">
                            <p class="font-semibold text-red-700 mb-2">
                                Tidak Terdaftar
                            </p>

                            @php
                                $filePath = 'storage/' . $dokumen->url;
                            @endphp

                            <a href="{{ asset($filePath) }}" target="_blank"
                                class="text-red-600 text-sm font-medium hover:underline">
                                Lihat File
                            </a>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>

    </div>

</x-app-layout>
