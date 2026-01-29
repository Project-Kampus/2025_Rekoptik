<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Rekap Medis Pasien
        </h2>
    </x-slot>



    <div class="bg-white rounded-lg border p-6">
        <div class="flex flex-col lg:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    Tabel Pemeriksaan
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola data pemeriksaan
                </p>
            </div>
            <!-- Filter Tanggal -->
            <form method="GET" class="flex flex-wrap gap-3 items-end">
                <div>
                    <label class="block text-xs text-gray-600 mb-1">Dari Tanggal</label>
                    <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}"
                        class="rounded border-gray-300 text-sm">
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1">Sampai</label>
                    <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}"
                        class="rounded border-gray-300 text-sm">
                </div>
                <div class="flex gap-2">
                    <button type="submit"
                        class="px-3 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                        Filter
                    </button>
                    <a href="{{ route('mitra.bpjs.rekap.export', ['tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir')]) }}"
                        class="px-3 py-2 bg-green-600 text-white rounded-md text-sm hover:bg-green-700 flex items-center"
                        target="_blank">
                        Download Excel
                    </a>
                </div>
            </form>
        </div>

        <!-- Tabel Laporan -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th rowspan="2" colspan="1"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">NO
                        </th>
                        <th rowspan="2" colspan="1"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">
                            Tanggal Pengambilan</th>
                        <th rowspan="2" colspan="1"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">
                            Nama Peserta</th>
                        <th rowspan="2" colspan="1"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700">Umur</th>
                        <th rowspan="2" colspan="1"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700">No.Kartu BPJS</th>
                        <th rowspan="2" colspan="1"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700">No.Hp</th>
                        <th rowspan="1" colspan="2"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">
                            Resep dokter</th>
                        <th rowspan="1" colspan="2"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">
                            Ukuran Lensa</th>
                        <th rowspan="1" colspan="2"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Add
                        </th>
                        <th rowspan="2" colspan="1"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700">Bayar Real</th>
                        <th rowspan="2" colspan="1"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700">Besar Penggantian
                        </th>
                        <th rowspan="2" colspan="1"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700">Selisih</th>
                        <th rowspan="2" colspan="1"
                            class="border px-2 py-1 text-center text-sm font-semibold text-gray-700">TTD</th>
                        <th rowspan="2" colspan="1"
                            class="border px-2 py-1 text-center text-sm font-semibold text-gray-700 whitespace-nowrap">
                            Aksi</th>
                    </tr>
                    <tr>
                        <th rowspan="1" colspan="1"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700">Nama</th>
                        <th rowspan="1" colspan="1"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                        <th rowspan="1" colspan="1"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">
                            Kanan (OD)</th>
                        <th rowspan="1" colspan="1"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">
                            Kiri (OS)</th>
                        <th rowspan="1" colspan="1"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700">OD</th>
                        <th rowspan="1" colspan="1"
                            class="border px-2 py-1 text-left text-sm font-semibold text-gray-700">OS</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($rekamMedis as $index => $rm)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                {{ $rekamMedis->firstItem() + $index }}</td>
                            <td class="border px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                {{ optional($rm->tanggal_pengambilan)->format('d-m-Y') ?? '-' }}
                            </td>
                            <td class="border px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                {{ $rm->pemeriksaan->pasien->nama_pasien ?? '-' }}</td>
                            <td class="border px-4 py-3 text-sm font-medium text-gray-800">
                                {{ $rm->pemeriksaan->pasien->umur ?? '-' }}</td>
                            <td class="border px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                {{ $rm->pemeriksaan->pasien->no_kartu ?? '-' }}</td>
                            <td class="border px-4 py-3 text-sm font-medium text-gray-800  whitespace-nowrap">
                                {{ $rm->pemeriksaan->pasien->no_hp ?? '-' }}</td>
                            <td class="border px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                {{ $rm->pemeriksaan->resep->resep_dari ?? '-' }}</td>
                            <td class="border px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                {{ optional($rm->pemeriksaan->resep->tanggal)->format('d-m-Y') ?? '-' }}</td>
                            <td class="border px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                {{ $rm->pemeriksaan->resep->od_sferis ?? '-' }},
                                {{ $rm->pemeriksaan->resep->od_silindris ?? '-' }},
                                {{ $rm->pemeriksaan->resep->od_axis ?? '-' }},
                                {{ $rm->pemeriksaan->resep->pd_od ?? '-' }}
                            </td>
                            <td class="border px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                {{ $rm->pemeriksaan->resep->os_sferis ?? '-' }},
                                {{ $rm->pemeriksaan->resep->os_silindris ?? '-' }},
                                {{ $rm->pemeriksaan->resep->os_axis ?? '-' }},
                                {{ $rm->pemeriksaan->resep->pd_os ?? '-' }}
                            </td>
                            <td class="border px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                {{ $rm->pemeriksaan->resep->od_add_lensa ?? '-' }}</td>
                            <td class="border px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                {{ $rm->pemeriksaan->resep->os_add_lensa ?? '-' }}</td>
                            <td class="border px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                Rp. {{ number_format($rm->biaya_kacamata ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="border px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                Rp.
                                {{ number_format($rm->pembayarans->where('metode', 'bpjs')->sum('jumlah') ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="border px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                Rp.
                                {{ number_format(($rm->biaya_kacamata ?? 0) - ($rm->pembayarans->where('metode', 'bpjs')->sum('jumlah') ?? 0), 0, ',', '.') }}
                            </td>
                            <td class="border px-4 py-3 text-sm text-center">
                                @if (!empty($rm->pengambilan->bukti_pengambil))
                                    <img src="{{ asset($rm->pengambilan->bukti_pengambil) }}" alt="TTD"
                                        style="height:40px;max-width:100px;object-fit:contain;">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="border px-4 py-1 text-sm text-center">
                                <a href="{{ route('mitra.bpjs.show', $rm->id) }}"
                                    class="px-2 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="16" class="border px-4 py-3 text-center py-2 text-sm">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $rekamMedis->links() }}
        </div>

    </div>
</x-app-layout>
