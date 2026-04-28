<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Rekap Data Pemeriksaan Medis
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
            <form method="GET" class="flex flex-wrap gap-3 items-end">
                <div>
                    <label class="block text-xs text-gray-600 mb-1">Resep Dari Tanggal</label>
                    <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-xs text-gray-600 mb-1">Sampai</label>
                    <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                        Filter
                    </button>
                    @if (request('tanggal_awal') || request('tanggal_akhir'))
                        <a href="{{ route('laporan.rekap-pemeriksaan.index') }}"
                            class="px-4 py-2 bg-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-400">
                            Reset
                        </a>
                    @endif
                    <a href="{{ route('laporan.rekap-pemeriksaan.export', ['tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir')]) }}"
                        class="px-3 py-2 bg-green-600 text-white rounded-md text-sm hover:bg-green-700 flex items-center"
                        target="_blank">
                        Download Excel
                    </a>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full  ">
                <thead class="bg-blue-700 text-white text-sm font-bold">
                    <tr>
                        <th rowspan="2" colspan="1" class="px-2 py-1 whitespace-nowrap">No.
                        </th>
                        <th rowspan="2" colspan="1" class="px-2 py-1  whitespace-nowrap">
                            Tanggal
                        </th>
                        <th rowspan="2" colspan="1" class="px-2 py-1 whitespace-nowrap">
                            Nama</th>
                        <th rowspan="2" colspan="1" class="px-2 py-1">Umur</th>
                        <th rowspan="2" colspan="1" class="px-2 py-1">No. HP</th>
                        <th rowspan="2" colspan="1" class="px-2 py-1">Diagnosa</th>
                        <th rowspan="1" colspan="2" class="px-2 py-1 whitespace-nowrap">
                            Resep
                            Dokter
                        </th>
                        <th rowspan="1" colspan="2" class="px-2 py-1 whitespace-nowrap">
                            Ukuran
                            Kacamata
                        </th>
                        <th rowspan="1" colspan="2" class="px-2 py-1 whitespace-nowrap">Add
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="1" colspan="1" class="px-2 py-1 ">
                            Nama</th>
                        <th rowspan="1" colspan="1" class="px-2 py-1 ">
                            Tanggal</th>
                        <th rowspan="1" colspan="1" class="whitespace-nowrap px-2 py-1 ">Kanan (OD)
                        </th>
                        <th rowspan="1" colspan="1" class="whitespace-nowrap px-2 py-1 ">Kiri (OS)
                        </th>
                        <th rowspan="1" colspan="1" class="px-2 py-1 ">
                            OD</th>
                        <th rowspan="1" colspan="1" class="px-2 py-1 ">
                            OS</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($data as $index => $row)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                {{ $data->firstItem() + $index }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                {{ optional($row->created_at)->format('d-m-Y') ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap font-medium text-gray-800">
                                {{ $row->pasien->nama_pasien ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $row->pasien->umur ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm font-medium whitespace-nowrap text-gray-800">
                                {{ $row->pasien->no_hp ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium whitespace-nowrap text-gray-800">
                                {{ $row->diagnosa ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm font-medium whitespace-nowrap text-gray-800">
                                {{ $row->resep->resep_dari ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm font-medium whitespace-nowrap text-gray-800">
                                {{ optional($row->resep->tanggal)->format('d-m-Y') ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm font-medium whitespace-nowrap text-gray-800">
                                {{ $row->resep->od_sferis ?? '-' }},
                                {{ $row->resep->od_silindris ?? '-' }},
                                {{ $row->resep->od_axis ?? '-' }},
                                {{ $row->resep->pd_od ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium whitespace-nowrap text-gray-800">
                                {{ $row->resep->os_sferis ?? '-' }},
                                {{ $row->resep->os_silindris ?? '-' }},
                                {{ $row->resep->os_axis ?? '-' }},
                                {{ $row->resep->pd_os ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium whitespace-nowrap text-gray-800">
                                {{ $row->resep->od_add_lensa ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm font-medium whitespace-nowrap text-gray-800">
                                {{ $row->resep->os_add_lensa ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center py-2">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $data->links() }}</div>
    </div>
</x-app-layout>
