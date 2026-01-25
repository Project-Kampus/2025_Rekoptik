<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Rekap Medis Pasien
        </h2>
    </x-slot>



    <div class="bg-white rounded-lg border p-6">

        <!-- Filter Tanggal -->
        <form method="GET" class="mb-4 flex flex-wrap items-end gap-4">
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
            <div>
                <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                    Filter
                </button>
            </div>
        </form>

        <!-- Tabel Laporan -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-2 py-1">NO</th>
                        <th class="border px-2 py-1">Tanggal Pengambilan</th>
                        <th class="border px-2 py-1">Nama Peserta</th>
                        <th class="border px-2 py-1">Umur</th>
                        <th class="border px-2 py-1">No.Kartu BPJS</th>
                        <th class="border px-2 py-1">No.Hp</th>
                        <th class="border px-2 py-1">Nama</th>
                        <th class="border px-2 py-1">Tanggal</th>
                        <th class="border px-2 py-1">Kanan (OD)</th>
                        <th class="border px-2 py-1">Kiri (OS)</th>
                        <th class="border px-2 py-1">OD</th>
                        <th class="border px-2 py-1">OS</th>
                        <th class="border px-2 py-1">Bayar Real</th>
                        <th class="border px-2 py-1">Besar Penggantian</th>
                        <th class="border px-2 py-1">Selisih</th>
                        <th class="border px-2 py-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekamMedis as $index => $rm)
                        <tr class="even:bg-gray-50">
                            <td class="border px-2 py-1">{{ $rekamMedis->firstItem() + $index }}</td>
                            <td class="border px-2 py-1">
                                {{ optional($rm->tanggal_pengambilan)->format('d-m-Y') ?? '-' }}
                            </td>
                            <td class="border px-2 py-1">{{ $rm->pemeriksaan->pasien->nama_pasien ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $rm->pemeriksaan->pasien->umur ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $rm->pemeriksaan->pasien->no_kartu ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $rm->pemeriksaan->pasien->no_hp ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $rm->pemeriksaan->resep->resep_dari ?? '-' }}</td>
                            <td class="border px-2 py-1">
                                {{-- {{ optional($rm->pemeriksaan->resep->tanggal)->format('d-m-Y') ?? '-' }}</td> --}}
                                {{ optional($rm->pemeriksaan->created_at)->format('d-m-Y') ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $rm->pemeriksaan->resep->od_sferis ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $rm->pemeriksaan->resep->os_sferis ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $rm->pemeriksaan->resep->od_add_lensa ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $rm->pemeriksaan->resep->os_add_lensa ?? '-' }}</td>
                            <td class="border px-2 py-1">Rp. {{ number_format($rm->biaya_kacamata ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="border px-2 py-1">Rp.
                                {{ number_format($rm->pembayarans->where('metode', 'bpjs')->sum('jumlah') ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="border px-2 py-1">Rp.
                                {{ number_format($rm->pembayarans->where('metode', '!=', 'bpjs')->sum('jumlah') ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="border px-2 py-1">
                                <a href="{{ route('mitra.bpjs.show', $rm->id) }}"
                                    class="px-2 py-1 bg-green-600 text-white rounded text-xs hover:bg-green-700">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="16" class="text-center py-2">Belum ada data</td>
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
