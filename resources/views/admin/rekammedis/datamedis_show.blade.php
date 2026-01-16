<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Data Medis
        </h2>
    </x-slot>

    <x-slot name="headerAction">
        <a href="{{ route('datamedis.index') }}"
            class="px-4 py-2 bg-gray-600 text-white rounded text-sm hover:bg-gray-700">
            ← Kembali
        </a>

        <a href="" class="px-4 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
            Edit Data
        </a>

        <a href="" target="_blank" class="px-4 py-2 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700">
            Lihat Struk
        </a>

        <a href="" target="_blank" class="px-4 py-2 bg-teal-600 text-white rounded text-sm hover:bg-teal-700">
            Surat Balasan
        </a>
        <a href="" target="_blank" class="px-4 py-2 bg-green-600 text-white rounded text-sm hover:bg-green-700">
            Pengambilan
        </a>

    </x-slot>

    <div class="space-y-6">
        <!-- PESANAN -->
        @if ($RmPemeriksaan->pesanan)
            <div class="bg-white rounded-xl border p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Pesanan</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <x-detail label="Frame" :value="$RmPemeriksaan->pesanan->frame->merk .
                        ' - ' .
                        $RmPemeriksaan->pesanan->frame->kode_frame" />
                    <x-detail label="Lensa" :value="$RmPemeriksaan->pesanan->lensa->nama_lensa" />
                    <x-detail label="Biaya" :value="'Rp ' . number_format($RmPemeriksaan->pesanan->biaya_kacamata, 0, ',', '.')" />
                    <x-detail label="Status" :value="$RmPemeriksaan->pesanan->status" />

                    <x-detail label="Tanggal Dipesan" :value="$RmPemeriksaan->pesanan->tanggal_dipesan" />
                    <x-detail label="Tanggal Pengambilan" :value="$RmPemeriksaan->pesanan->tanggal_pengambilan ?? '-'" />
                </div>
            </div>
        @endif

        <!-- INFORMASI PASIEN -->
        <div class="bg-white rounded-xl border p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pasien</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <x-detail label="Nama Pasien" :value="$RmPemeriksaan->pasien->nama_pasien" />
                <x-detail label="No HP" :value="$RmPemeriksaan->pasien->no_hp" />
                <x-detail label="Email" :value="$RmPemeriksaan->pasien->email" />
                <x-detail label="Alamat" :value="$RmPemeriksaan->pasien->alamat" />
                <x-detail label="Umur" :value="$RmPemeriksaan->pasien->umur . ' Tahun'" />
                <x-detail label="Kategori" :value="strtoupper($RmPemeriksaan->pasien->kategori)" />
                <x-detail label="No Kartu" :value="$RmPemeriksaan->pasien->no_kartu" />
                <x-detail label="Kelas" :value="$RmPemeriksaan->pasien->kelas" />
            </div>
        </div>

        <!-- DETAIL PEMERIKSAAN -->
        <div class="bg-white rounded-xl border p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Pemeriksaan</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border border-gray-200 rounded-lg overflow-hidden">
                    <tbody class="divide-y divide-gray-200">

                        <tr class="">
                            <th class="w-1/4 px-4 py-1 font-medium text-gray-700"> No SEP </th>
                            <td class="px-4 py-1 text-gray-900"> {{ $RmPemeriksaan->no_sep ?? '-' }} </td>
                        </tr>

                        <tr>
                            <th class="px-4 py-1 font-medium text-gray-700"> Keluhan Utama </th>
                            <td class="px-4 py-1 text-gray-900"> {{ $RmPemeriksaan->keluhan_utama ?? '-' }} </td>
                        </tr>

                        <tr class="">
                            <th class="px-4 py-1 font-medium text-gray-700"> Riwayat Penyakit </th>
                            <td class="px-4 py-1 text-gray-900"> {{ $RmPemeriksaan->riwayat_penyakit ?? '-' }} </td>
                        </tr>

                        <tr>
                            <th class="px-4 py-1 font-medium text-gray-700"> Penyakit Sekarang </th>
                            <td class="px-4 py-1 text-gray-900"> {{ $RmPemeriksaan->penyakit_sekarang ?? '-' }} </td>
                        </tr>

                        <tr class="">
                            <th class="px-4 py-1 font-medium text-gray-700"> Penyakit Keluarga </th>
                            <td class="px-4 py-1 text-gray-900"> {{ $RmPemeriksaan->penyakit_keluarga ?? '-' }} </td>
                        </tr>

                        <tr>
                            <th class="px-4 py-1 font-medium text-gray-700"> Kebiasaan </th>
                            <td class="px-4 py-1 text-gray-900"> {{ $RmPemeriksaan->kebiasaan ?? '-' }} </td>
                        </tr>

                        <tr class="">
                            <th class="px-4 py-1 font-medium text-gray-700"> Pengobatan </th>
                            <td class="px-4 py-1 text-gray-900"> {{ $RmPemeriksaan->pengobatan ?? '-' }} </td>
                        </tr>

                        <tr>
                            <th class="px-4 py-1 font-medium text-gray-700"> Diagnosa </th>
                            <td class="px-4 py-1 font-semibold text-gray-900"> {{ $RmPemeriksaan->diagnosa ?? '-' }}
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

                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="border px-4 py-2 text-left w-1/3">Parameter</th>
                                    <th class="border px-4 py-2 text-center">Mata Kanan (OD)</th>
                                    <th class="border px-4 py-2 text-center">Mata Kiri (OS)</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800">
                                <tr>
                                    <td class="border px-4 py-2">Sferis</td>
                                    <td class="border px-4 py-2 text-center">
                                        {{ $RmPemeriksaan->resep->od_sferis ?? '-' }}
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        {{ $RmPemeriksaan->resep->os_sferis ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">Silindris</td>
                                    <td class="border px-4 py-2 text-center">
                                        {{ $RmPemeriksaan->resep->od_silindris ?? '-' }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        {{ $RmPemeriksaan->resep->os_silindris ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">Axis</td>
                                    <td class="border px-4 py-2 text-center">
                                        {{ $RmPemeriksaan->resep->od_axis ?? '-' }}
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        {{ $RmPemeriksaan->resep->os_axis ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">Add</td>
                                    <td class="border px-4 py-2 text-center">
                                        {{ $RmPemeriksaan->resep->od_add_lensa ?? '-' }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        {{ $RmPemeriksaan->resep->os_add_lensa ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">PD</td>
                                    <td class="border px-4 py-2 text-center">{{ $RmPemeriksaan->resep->pd_od ?? '-' }}
                                    </td>
                                    <td class="border px-4 py-2 text-center">{{ $RmPemeriksaan->resep->pd_os ?? '-' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        @endif

        <!-- RIWAYAT PEMBAYARAN -->
        @if ($RmPemeriksaan->pesanan && $RmPemeriksaan->pesanan->pembayarans->count())
            <div class="bg-white rounded-xl border p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Pembayaran</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border border-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="border px-4 py-2">Tanggal Bayar</th>
                                <th class="border px-4 py-2">Metode</th>
                                <th class="border px-4 py-2">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($RmPemeriksaan->pesanan->pembayarans as $pembayaran)
                                <tr>
                                    <td class="border px-4 py-2">{{ $pembayaran->tanggal_bayar->format('d/m/Y') }}</td>
                                    <td class="border px-4 py-2">{{ $pembayaran->metode }}</td>
                                    <td class="border px-4 py-2">Rp
                                        {{ number_format($pembayaran->jumlah, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- PENGAMBILAN -->
        @if (strtolower($RmPemeriksaan->pesanan->status) == 'diambil' && $RmPemeriksaan->pesanan->pengambilan)
            <div class="bg-white rounded-xl border p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Pengambilan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <x-detail label="Nama Pengambil" :value="$RmPemeriksaan->pesanan->pengambilan->nama_pengambil" />
                    <x-detail label="Hubungan Pengambil" :value="$RmPemeriksaan->pesanan->pengambilan->hub_pengambil" />
                    <x-detail label="Bukti Pengambil" :value="$RmPemeriksaan->pesanan->pengambilan->bukti_pengambil" />
                </div>
            </div>
        @endif

        <!-- DOKUMEN -->
        @if ($RmPemeriksaan->dokumens->count())
            <div class="bg-white rounded-xl border p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Dokumen Pendukung</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($RmPemeriksaan->dokumens as $dokumen)
                        <div class="space-y-1">
                            <p class="text-gray-600 font-medium">
                                {{ $dokumen->dokumen->nama }}
                            </p>

                            @php
                                $filePath = 'storage/' . $dokumen->url;
                            @endphp

                            @if (file_exists(public_path($filePath)))
                                <a href="{{ asset($filePath) }}" target="_blank"
                                    class="text-blue-600 hover:underline text-sm">
                                    Lihat Dokumen
                                </a>
                            @else
                                <span class="text-sm text-red-500 italic">
                                    File tidak tersedia
                                </span>
                            @endif
                        </div>
                    @endforeach

                </div>
            </div>
        @endif

    </div>
</x-app-layout>
