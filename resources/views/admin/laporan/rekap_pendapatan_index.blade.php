<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Rekap Data Pendapatan
        </h2>
    </x-slot>

    <div class="bg-white rounded-lg border p-6">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    Tabel Rekap Pendapatan
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Tampilkan data pendapatan bulanan
                </p>
            </div>
            <form method="GET" class="flex flex-wrap gap-3 items-end">
                <div>
                    <label class="block text-xs text-gray-600 mb-1">Dari Tanggal</label>
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
                        <a href="{{ route('laporan.rekap-pendapatan.index') }}"
                            class="px-4 py-2 bg-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-400">
                            Reset
                        </a>
                    @endif
                    <a href="{{ route('laporan.rekap-pendapatan.export', ['tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir')]) }}"
                        class="px-3 py-2 bg-green-600 text-white rounded-md text-sm hover:bg-green-700 flex items-center"
                        target="_blank">
                        Download Excel
                    </a>
                </div>
            </form>
        </div>

        <!-- Summary Cards Section -->
        @if ($summary->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
                <!-- Harga Jual Total -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-6 border border-green-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-green-600">Harga Jual Total</p>
                            <p class="text-2xl font-bold text-green-900 mt-2">
                                Rp {{ number_format($totalHargaJual, 0, ',', '.') }}
                            </p>
                        </div>
                        <svg class="w-8 h-8 text-green-500 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.5 1.5H5.75A2.75 2.75 0 003 4.25v11.5A2.75 2.75 0 005.75 18.5h8.5A2.75 2.75 0 0017 15.75V8.5" />
                        </svg>
                    </div>
                </div>

                <!-- Total Modal -->
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg p-6 border border-orange-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-orange-600">Total Modal</p>
                            <p class="text-2xl font-bold text-orange-900 mt-2">
                                Rp {{ number_format($totalModalCost, 0, ',', '.') }}
                            </p>
                        </div>
                        <svg class="w-8 h-8 text-orange-500 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M8.5 10a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15.5 10a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Total Bersih -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6 border border-blue-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-blue-600">Total Bersih</p>
                            <p class="text-2xl font-bold text-blue-900 mt-2">
                                Rp {{ number_format($totalBersih, 0, ',', '.') }}
                            </p>
                        </div>
                        <svg class="w-8 h-8 text-blue-500 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm3.707 8.707l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L10 12.586l4.293-4.293a1 1 0 011.414 1.414z" />
                        </svg>
                    </div>
                </div>

                <!-- Sudah Dibayar -->
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-6 border border-purple-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-purple-600">Sudah Dibayar</p>
                            <p class="text-2xl font-bold text-purple-900 mt-2">
                                Rp {{ number_format($totalBayar, 0, ',', '.') }}
                            </p>
                        </div>
                        <svg class="w-8 h-8 text-purple-500 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                        </svg>
                    </div>
                </div>

                <!-- Sisa Bayar -->
                <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-6 border border-red-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-red-600">Sisa Bayar</p>
                            <p class="text-2xl font-bold text-red-900 mt-2">
                                Rp {{ number_format($totalSisa, 0, ',', '.') }}
                            </p>
                        </div>
                        <svg class="w-8 h-8 text-red-500 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M13.477 14.89A6 6 0 110 10a1 1 0 112 0 4 4 0 118 0 1 1 0 11-2 0 6 6 0 01-7.477 4.89" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Summary Bulanan Table -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Bulanan</h3>
                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="min-w-full">
                        <thead class="bg-blue-700 text-white text-sm font-bold">
                            <tr>
                                <th class="px-4 py-3 text-left">Bulan</th>
                                <th class="px-4 py-3 text-right">Pesanan</th>
                                <th class="px-4 py-3 text-right">Harga Jual</th>
                                <th class="px-4 py-3 text-right">Modal</th>
                                <th class="px-4 py-3 text-right">Bersih</th>
                                <th class="px-4 py-3 text-right">Sudah Bayar</th>
                                <th class="px-4 py-3 text-right">Sisa Bayar</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse($summary as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                        {{ \Carbon\Carbon::createFromFormat('Y-m', $item->bulan)->format('F Y') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-800 text-right">
                                        {{ $item->jumlah_pesanan }}
                                    </td>
                                    <td class="px-4 py-3 text-sm font-semibold text-green-600 text-right">
                                        Rp {{ number_format($item->total_harga_jual ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm font-semibold text-orange-600 text-right">
                                        Rp {{ number_format($item->total_modal ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm font-semibold text-blue-600 text-right">
                                        Rp {{ number_format($item->total_bersih ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm font-semibold text-purple-600 text-right">
                                        Rp {{ number_format($item->total_bayar ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm font-semibold text-red-600 text-right">
                                        Rp {{ number_format($item->total_sisa ?? 0, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-3 text-center text-sm text-gray-500">
                                        Tidak ada data
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Detail Pesanan Table -->
        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Pesanan</h3>
            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                <table class="min-w-full">
                    <thead class="bg-blue-700 text-white text-sm font-bold">
                        <tr>
                            <th class="px-2 py-3 text-left whitespace-nowrap">No.</th>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                            <th class="px-4 py-3 text-left">Nama Pasien</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-right">Harga Jual</th>
                            <th class="px-4 py-3 text-right">Modal</th>
                            <th class="px-4 py-3 text-right">Bersih</th>
                            <th class="px-4 py-3 text-right">Sudah Bayar</th>
                            <th class="px-4 py-3 text-right">Sisa Bayar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($data as $index => $row)
                            <tr class="hover:bg-gray-50">
                                <td class="px-2 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                    {{ $data->firstItem() + $index }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-800 whitespace-nowrap">
                                    {{ optional($row->tanggal_dipesan)->format('d-m-Y') ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap font-medium text-gray-800">
                                    {{ $row->pemeriksaan->pasien->nama_pasien ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                        @if ($row->status === 'dipesan') bg-yellow-100 text-yellow-800
                                        @else bg-green-100 text-green-800 @endif
                                    ">
                                        {{ ucfirst($row->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold text-green-600 text-right">
                                    Rp {{ number_format($row->harga_jual, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold text-orange-600 text-right">
                                    Rp {{ number_format($row->modal_cost ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold text-blue-600 text-right">
                                    Rp {{ number_format($row->total_bersih ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold text-purple-600 text-right">
                                    Rp {{ number_format($row->total_bayar ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold text-red-600 text-right">
                                    Rp {{ number_format($row->sisa_bayar ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-4 py-3 text-center text-sm text-gray-500">
                                    Tidak ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if ($data->count() > 0)
                        <tfoot class="bg-gray-50 font-bold border-t-2 border-gray-300">
                            <tr>
                                <td colspan="4" class="px-4 py-3 text-right text-sm">TOTAL:</td>
                                <td class="px-4 py-3 text-sm text-green-600 text-right">
                                    Rp {{ number_format($totalHargaJual, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-orange-600 text-right">
                                    Rp {{ number_format($totalModalCost, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-blue-600 text-right">
                                    Rp {{ number_format($totalBersih, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-purple-600 text-right">
                                    Rp {{ number_format($totalBayar, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-red-600 text-right">
                                    Rp {{ number_format($totalSisa, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>

            <!-- Pagination -->
            @if ($data->hasPages())
                <div class="mt-6">
                    {{ $data->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
