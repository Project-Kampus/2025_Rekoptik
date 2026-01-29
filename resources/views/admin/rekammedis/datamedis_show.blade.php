<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Data Medis
        </h2>
    </x-slot>

    <x-slot name="headerAction">
        <div class="flex gap-2 flex-wrap">
            <a href="{{ route('datamedis.index') }}"
                class="px-4 py-2 bg-gray-600 text-white rounded-lg text-sm hover:bg-gray-700 transition">
                Kembali
            </a>

            <a href="{{ route('datamedis.edit', $RmPemeriksaan->id) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition">
                Edit Data
            </a>

            @php
                $pembayaran = $RmPemeriksaan->pesanan->pembayarans->last();
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

            <a href="{{ route('datamedis.cetakSuratBalasan', $RmPemeriksaan->id) }}" target="_blank"
                class="px-4 py-2 bg-teal-600 text-white rounded-lg text-sm hover:bg-teal-700 transition">
                Surat Balasan
            </a>
            @if ($RmPemeriksaan->pesanan->status !== 'diambil')
                <button type="button" onclick="openPengambilanModal({{ $RmPemeriksaan->id }})"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700 transition">
                    Pengambilan
                </button>
            @endif

        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- PESANAN -->
            @if ($RmPemeriksaan->pesanan)
                <div class="bg-white rounded-lg border border-gray-200 p-5 shadow-sm">
                    <h3 class="text-base font-bold text-gray-800 mb-4 pb-3 border-b border-gray-200">Detail Pesanan
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600 w-1/3">Frame</td>
                                    <td class="px-3 py-2 text-gray-900 font-semibold">
                                        {{ $RmPemeriksaan->pesanan->frame->merk }} -
                                        {{ $RmPemeriksaan->pesanan->frame->kode_frame }}</td>
                                </tr>
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600">Lensa</td>
                                    <td class="px-3 py-2 text-gray-900 font-semibold">
                                        {{ $RmPemeriksaan->pesanan->lensa->nama_lensa }}</td>
                                </tr>
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600">Aksesoris</td>
                                    <td class="px-3 py-2 text-gray-900 font-semibold">
                                        @if ($RmPemeriksaan->pesanan && $RmPemeriksaan->pesanan->aksesoris->count())
                                            <ul class="list-disc ml-4">
                                                @foreach ($RmPemeriksaan->pesanan->aksesoris as $aks)
                                                    <li>{{ $aks->nama }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600">Biaya</td>
                                    <td class="px-3 py-2 text-purple-600 font-bold">Rp
                                        {{ number_format($RmPemeriksaan->pesanan->biaya_kacamata, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600">Sisa Pembayaran</td>
                                    @php
                                        $sisaPembayaran =
                                            $RmPemeriksaan->pesanan->biaya_kacamata -
                                            $RmPemeriksaan->pesanan->pembayarans->sum('jumlah');
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
                                            {{ $RmPemeriksaan->pesanan->status }}
                                        </span>
                                        @if ($RmPemeriksaan->pesanan->status == 'diambil')
                                            {{ $RmPemeriksaan->pesanan->tanggal_pengambilan?->format('d F Y') }}
                                        @else
                                            {{ $RmPemeriksaan->pesanan->updated_at->format('d F Y') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600">Tgl Dipesan</td>
                                    <td class="px-3 py-2 text-gray-900">
                                        {{ $RmPemeriksaan->pesanan->tanggal_dipesan?->format('d F Y') }}
                                    </td>
                                </tr>
                                <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600">Tgl Pengambilan</td>
                                    <td class="px-3 py-2 text-gray-900">
                                        {{ $RmPemeriksaan->pesanan->tanggal_pengambilan?->format('d F Y') ?? '-' }}
                                    </td>
                                </tr>
                                {{-- <tr class="hover:bg-blue-50">
                                    <td class="px-3 py-2 font-medium text-gray-600">Tgl Diambilan</td>
                                    <td class="px-3 py-2 text-gray-900">
                                        {{ $RmPemeriksaan->pesanan->pengambilan?->created_at->format('d F Y') ?? '-' }}
                                    </td>
                                </tr> --}}
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
                                    {{ $RmPemeriksaan->pasien->nama_pasien }}</td>
                            </tr>
                            <tr class="hover:bg-indigo-50">
                                <td class="px-3 py-2 font-medium text-gray-600">No HP</td>
                                <td class="px-3 py-2 text-gray-900">{{ $RmPemeriksaan->pasien->no_hp }}</td>
                            </tr>
                            <tr class="hover:bg-indigo-50">
                                <td class="px-3 py-2 font-medium text-gray-600">Email</td>
                                <td class="px-3 py-2 text-gray-900">{{ $RmPemeriksaan->pasien->email }}</td>
                            </tr>
                            <tr class="hover:bg-indigo-50">
                                <td class="px-3 py-2 font-medium text-gray-600">Alamat</td>
                                <td class="px-3 py-2 text-gray-900">{{ $RmPemeriksaan->pasien->alamat }}</td>
                            </tr>
                            <tr class="hover:bg-indigo-50">
                                <td class="px-3 py-2 font-medium text-gray-600">Umur</td>
                                <td class="px-3 py-2 text-gray-900">{{ $RmPemeriksaan->pasien->umur }} Tahun</td>
                            </tr>
                            <tr class="hover:bg-indigo-50">
                                <td class="px-3 py-2 font-medium text-gray-600">Kategori</td>
                                <td class="px-3 py-2"><span
                                        class="px-2 py-1 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded">{{ strtoupper($RmPemeriksaan->pasien->kategori) }}</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-indigo-50">
                                <td class="px-3 py-2 font-medium text-gray-600">No Kartu</td>
                                <td class="px-3 py-2 text-gray-900">{{ $RmPemeriksaan->pasien->no_kartu ?? '-' }}</td>
                            </tr>
                            <tr class="hover:bg-indigo-50">
                                <td class="px-3 py-2 font-medium text-gray-600">Kelas</td>
                                <td class="px-3 py-2 text-gray-900">{{ $RmPemeriksaan->pasien->kelas ?? '-' }}</td>
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
                            <td class="px-3 py-2 text-gray-900">{{ $RmPemeriksaan->no_sep ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-green-50">
                            <td class="px-3 py-2 font-medium text-gray-600">Keluhan Utama</td>
                            <td class="px-3 py-2 text-gray-900">{{ $RmPemeriksaan->keluhan_utama ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-green-50">
                            <td class="px-3 py-2 font-medium text-gray-600">Riwayat Penyakit</td>
                            <td class="px-3 py-2 text-gray-900">{{ $RmPemeriksaan->riwayat_penyakit ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-green-50">
                            <td class="px-3 py-2 font-medium text-gray-600">Penyakit Sekarang</td>
                            <td class="px-3 py-2 text-gray-900">{{ $RmPemeriksaan->penyakit_sekarang ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-green-50">
                            <td class="px-3 py-2 font-medium text-gray-600">Penyakit Keluarga</td>
                            <td class="px-3 py-2 text-gray-900">{{ $RmPemeriksaan->penyakit_keluarga ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-green-50">
                            <td class="px-3 py-2 font-medium text-gray-600">Kebiasaan</td>
                            <td class="px-3 py-2 text-gray-900">{{ $RmPemeriksaan->kebiasaan ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-green-50">
                            <td class="px-3 py-2 font-medium text-gray-600">Pengobatan</td>
                            <td class="px-3 py-2 text-gray-900">{{ $RmPemeriksaan->pengobatan ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-green-50">
                            <td class="px-3 py-2 font-medium text-gray-600">Diagnosa</td>
                            <td class="px-3 py-2 font-semibold text-green-700">{{ $RmPemeriksaan->diagnosa ?? '-' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- RESEP -->
        @if ($RmPemeriksaan->resep)
            <!-- DETAIL RESEP -->
            <div class="bg-white rounded-xl border p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Detail Resep</h3>
                <div class="mb-8">
                    <h4 class="font-semibold text-gray-700 mb-3">
                        Resep dri {{ $RmPemeriksaan->resep->resep_dari }}
                        <span class="text-sm text-gray-500">
                            ({{ $RmPemeriksaan->resep->tanggal }})
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
                                    <td class="px-4 py-3">{{ $RmPemeriksaan->resep->od_sferis ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $RmPemeriksaan->resep->od_silindris ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $RmPemeriksaan->resep->od_axis ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $RmPemeriksaan->resep->od_add_lensa ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $RmPemeriksaan->resep->pd_od ?? '-' }}</td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-3 font-semibold text-gray-700">Mata Kiri (OS)</td>
                                    <td class="px-4 py-3">{{ $RmPemeriksaan->resep->os_sferis ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $RmPemeriksaan->resep->os_silindris ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $RmPemeriksaan->resep->os_axis ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $RmPemeriksaan->resep->os_add_lensa ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $RmPemeriksaan->resep->pd_os ?? '-' }}</td>
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
                <button onclick="openPembayaranModal()"
                    class="px-3 py-1.5 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition">
                    + Pembayaran
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gradient-to-r from-green-100 to-green-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal Bayar</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Metode</th>
                            <th class="px-4 py-3 text-right font-semibold text-gray-700">Jumlah</th>
                            <th class="px-4 py-3 w-1/6 text-center font-semibold text-gray-700"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($RmPemeriksaan->pesanan->pembayarans as $pembayaran)
                            <tr class="hover:bg-green-50 transition">
                                <td class="px-4 py-3 text-gray-900">
                                    {{ $pembayaran->tanggal_bayar->format('d F Y') }}</td>
                                {{-- <td class="px-4 py-3 text-gray-900">
                                    {{ $pembayaran->id }}</td> --}}
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
                                <td class="px-4 py-3 text-center font-bold">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('datamedis.cetatakStruk', $pembayaran->id) }}"
                                            target="_blank"
                                            class="px-2 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700">
                                            Struk
                                        </a>
                                        <button type="button"
                                            class="px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700"
                                            onclick="window.dispatchEvent(
                                        new CustomEvent('open-modal', {
                                            detail: 'delete-pembayaran-{{ $pembayaran->id }}'
                                        })
                                        )">
                                            Hapus
                                        </button>
                                    </div>

                                    <x-danger-modal id="delete-pembayaran-{{ $pembayaran->id }}"
                                        title="Hapus Dokumen">
                                        <p class="text-sm text-gray-600">
                                            Apakah Anda yakin ingin menghapus pembayaran seharga
                                            {{ number_format($pembayaran->jumlah, 0, ',', '.') }}
                                            <strong class="text-gray-900">{{ $pembayaran->nama }}</strong>?
                                            <br>
                                            Tindakan ini tidak dapat dibatalkan.
                                        </p>

                                        <x-slot name="actions">
                                            <form action="{{ route('datamedis.destroyPembayaran', $pembayaran->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
                                                    Ya, Hapus
                                                </button>
                                            </form>
                                        </x-slot>
                                    </x-danger-modal>

                                </td>
                            </tr>
                        @endforeach
                        <tr class="bg-gray-50 font-bold">
                            <td colspan="2" class="px-4 py-3 text-gray-800">Total Pembayaran</td>
                            <td class="px-4 py-3 text-right text-green-600">Rp
                                {{ number_format($RmPemeriksaan->pesanan->pembayarans->sum('jumlah'), 0, ',', '.') }}
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PENGAMBILAN -->
        @if (strtolower($RmPemeriksaan->pesanan->status) == 'diambil' && $RmPemeriksaan->pesanan->pengambilan)
            <div class="bg-white rounded-xl border p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Pengambilan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <x-detail label="Nama Pengambil" :value="$RmPemeriksaan->pesanan->pengambilan->nama_pengambil" />
                    <x-detail label="Hubungan Pengambil" :value="$RmPemeriksaan->pesanan->pengambilan->hub_pengambil" />

                    <!-- Bukti Pengambil (Signature Image) -->
                    <div class="border rounded-lg p-4 bg-gray-50">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Tanda Tangan Penerima</p>
                        @if ($RmPemeriksaan->pesanan->pengambilan->bukti_pengambil)
                            @if (strpos($RmPemeriksaan->pesanan->pengambilan->bukti_pengambil, 'storage/') === 0)
                                <img src="{{ asset($RmPemeriksaan->pesanan->pengambilan->bukti_pengambil) }}"
                                    alt="Tanda Tangan"
                                    class="w-full h-32 border-2 border-gray-300 rounded bg-white object-contain p-2">
                            @else
                                <img src="{{ asset('storage/' . $RmPemeriksaan->pesanan->pengambilan->bukti_pengambil) }}"
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
                        {{ $RmPemeriksaan->pesanan->pengambilan->created_at?->format('d F Y H:i') }}</p>
                </div>
            </div>
        @endif

        <!-- DOKUMEN -->
        <div class="bg-white rounded-lg border border-gray-200 p-5 shadow-sm">
            <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-200">
                <h3 class="text-base font-bold text-gray-800">Dokumen Pendukung</h3>
                <button onclick="openDokumenModal()"
                    class="px-3 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition">
                    + Lengkapi
                </button>
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
                @foreach ($RmPemeriksaan->dokumens as $dokumen)
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

    <!-- MODAL LENGKAPI/PERBAIKI DOKUMEN -->
    <div id="dokumenModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
            <!-- Header -->
            <div
                class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 flex justify-between items-center rounded-t-xl">
                <h3 class="text-lg font-bold flex items-center">
                    <span id="modalTitle">Lengkapi Dokumen</span>
                </h3>
                <button onclick="closeDokumenModal()"
                    class="text-white hover:text-blue-100 text-2xl transition">&times;</button>
            </div>

            <!-- Form -->
            <form action="{{ route('datamedis.storeDokumnet', [$RmPemeriksaan->id]) }}" method="POST"
                enctype="multipart/form-data" class="px-6 pb-6 pt-2 space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2">Pilih Dokumen</label>
                    <select name="dokumen_id" id="dokumenSelect" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white">
                        <option value="">-- Pilih Dokumen --</option>
                        @foreach ($allDokumens as $dokumen)
                            @php
                                $uploaded = $uploadedDokumens->get($dokumen->id);
                            @endphp
                            <option value="{{ $dokumen->id }}" data-status="{{ $uploaded ? 'exist' : 'empty' }}">
                                {{ $dokumen->nama }}
                                @if ($uploaded)
                                    (Perbaiki)
                                @else
                                    (Lengkapi)
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2">Upload File</label>
                    <div class="relative">
                        <input type="file" name="file" id="fileInput" required
                            accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition cursor-pointer file:mr-3 file:py-2 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200" />
                    </div>
                    <p class="text-xs text-gray-500 mt-2 flex items-center">
                        <span class="mr-1">ℹ️</span>
                        Format: PDF, JPG, PNG, DOC, DOCX (Max 1MB)
                    </p>
                </div>

                <!-- File Preview -->
                <div id="filePreview" class="hidden bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <p class="text-xs font-semibold text-gray-600 mb-2">Preview File:</p>
                    <p id="previewName" class="text-sm text-gray-800 font-medium truncate"></p>
                    <p id="previewSize" class="text-xs text-gray-500"></p>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 justify-end pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeDokumenModal()"
                        class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition flex items-center">
                        <span id="submitBtnText">Upload</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Handle modal open
        function openDokumenModal() {
            document.getElementById('dokumenModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Handle modal close
        function closeDokumenModal() {
            document.getElementById('dokumenModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            resetForm();
        }

        // Close when clicking outside
        document.getElementById('dokumenModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDokumenModal();
            }
        });

        // Update button text and title based on selection
        const dokumenSelect = document.getElementById('dokumenSelect');
        const modalTitle = document.getElementById('modalTitle');
        const submitBtnText = document.getElementById('submitBtnText');

        dokumenSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const status = selectedOption.dataset.status;

            if (status === 'exist') {
                modalTitle.textContent = 'Perbaiki Dokumen';
                submitBtnText.textContent = 'Perbarui';
            } else {
                modalTitle.textContent = 'Lengkapi Dokumen';
                submitBtnText.textContent = 'Upload';
            }
        });

        // File preview
        document.getElementById('fileInput').addEventListener('change', function() {
            const file = this.files[0];
            const preview = document.getElementById('filePreview');
            const previewName = document.getElementById('previewName');
            const previewSize = document.getElementById('previewSize');

            if (file) {
                previewName.textContent = file.name;
                previewSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                preview.classList.remove('hidden');
            } else {
                preview.classList.add('hidden');
            }
        });

        // Reset form
        function resetForm() {
            document.querySelector('form').reset();
            document.getElementById('filePreview').classList.add('hidden');
            dokumenSelect.value = '';
        }
    </script>

    <!-- MODAL TAMBAH PEMBAYARAN -->
    <div id="pembayaranModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
            <!-- Header -->
            <div
                class="bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-4 flex justify-between items-center rounded-t-xl">
                <h3 class="text-lg font-bold flex items-center">
                    Tambah Pembayaran
                </h3>
                <button onclick="closePembayaranModal()"
                    class="text-white hover:text-green-100 text-2xl transition">&times;</button>
            </div>

            <!-- Form -->
            <form action="{{ route('datamedis.storePembayaran', [$RmPemeriksaan->id]) }}" method="POST"
                enctype="multipart/form-data" class="pt-2 px-6 pb-6 space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2">Tanggal Pembayaran</label>
                    <input type="date" name="tanggal_bayar" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition bg-white" />
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2">Metode Pembayaran</label>
                    <select name="metode" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition bg-white">
                        <option value="">-- Pilih Metode --</option>
                        @if ($RmPemeriksaan->pasien->kategori === 'bpjs')
                            <option value="bpjs">BPJS</option>
                        @elseif ($RmPemeriksaan->pasien->kategori === 'asuransi')
                            <option value="asuransi">Asuransi</option>
                        @endif
                        <option value="non-tunai">Non Tunai</option>
                        <option value="tunai">Tunai</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2">Jumlah Pembayaran (Rp)</label>
                    <input type="number" name="jumlah" required min="1" placeholder="0"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition bg-white" />
                </div>

                <!-- Summary -->
                <div id="summaryBox" class="hidden bg-green-50 border border-green-200 rounded-lg p-3">
                    <p class="text-xs text-gray-600 mb-1">Ringkasan Pembayaran:</p>
                    <p class="text-sm font-semibold text-green-700" id="summaryText"></p>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 justify-end pt-4 border-t border-gray-100">
                    <button type="button" onclick="closePembayaranModal()"
                        class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition flex items-center">
                        Simpan Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Handle pembayaran modal
        function openPembayaranModal() {
            document.getElementById('pembayaranModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closePembayaranModal() {
            document.getElementById('pembayaranModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            resetPembayaranForm();
        }

        document.getElementById('pembayaranModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePembayaranModal();
            }
        });

        // Update summary
        const jumlahInput = document.querySelector('input[name="jumlah"]');
        const metodeSelect = document.querySelector('select[name="metode"]');
        const summaryBox = document.getElementById('summaryBox');
        const summaryText = document.getElementById('summaryText');

        function updateSummary() {
            const jumlah = parseInt(jumlahInput.value) || 0;
            const metode = metodeSelect.value;

            if (jumlah > 0 && metode) {
                summaryText.textContent = `${metode} - Rp ${jumlah.toLocaleString('id-ID')}`;
                summaryBox.classList.remove('hidden');
            } else {
                summaryBox.classList.add('hidden');
            }
        }

        jumlahInput.addEventListener('input', updateSummary);
        metodeSelect.addEventListener('change', updateSummary);

        function resetPembayaranForm() {
            document.querySelector('#pembayaranModal form').reset();
            summaryBox.classList.add('hidden');
        }
    </script>

    @include('admin.rekammedis.pengambilan_modal')
</x-app-layout>
