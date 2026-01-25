<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Medis
        </h2>
    </x-slot>

    <x-slot name="headerAction">
        <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
            + Tambah Data
        </a>
    </x-slot>

    <div class="bg-white rounded-lg border p-6">
        <div class="flex flex-col lg:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    Tabel Medis
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola data medis
                </p>
                @if (count($filterSummary) > 0)
                    <p class="mt-2 text-sm text-blue-700">
                        {!! implode(' | ', $filterSummary) !!}
                    </p>
                @endif
            </div>
            <form method="GET" action="{{ route('datamedis.index') }}" class="flex flex-wrap gap-2">
                <input type="text" name="search" placeholder="Cari nama pasien, nomor kartu, diagnosa..."
                    value="{{ $search }}"
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">

                <input type="date" name="tanggal_awal" value="{{ $tanggal_awal }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">

                <input type="date" name="tanggal_akhir" value="{{ $tanggal_akhir }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">

                <select name="kategori"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Semua Kategori --</option>
                    <option value="bpjs" @selected($kategori === 'bpjs')>BPJS</option>
                    <option value="asuransi" @selected($kategori === 'asuransi')>Asuransi</option>
                    <option value="umum" @selected($kategori === 'umum')>Umum</option>
                </select>

                <select name="status"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Semua Status --</option>
                    <option value="dipesan" @selected($status === 'dipesan')>Dipesan</option>
                    <option value="diambil" @selected($status === 'diambil')>Diambil</option>
                </select>

                <button type="submit" class="px-6 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                    Cari
                </button>
                @if ($search || $kategori || $status || $tanggal_awal || $tanggal_akhir)
                    <a href="{{ route('datamedis.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-400">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                            Tanggal
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                            Nama
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                            Kategori
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                            Dokter
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                            Diagnosa
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                            Frame
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                            Lensa
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                            Status
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                            Pembayaran
                        </th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($data as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                {{ $item->pesanan->created_at->format('d/F/Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                {{ $item->pasien->nama_pasien }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                {{ $item->pasien->kategori }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                {{ $item->resep->resep_dari }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                {{ $item->diagnosa }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                {{ $item->pesanan?->frame?->merk ?? '-' }}
                                {{ $item->pesanan?->frame?->kode_frame ? ' - ' . $item->pesanan->frame->kode_frame : '' }}
                            </td>

                            <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                {{ $item->pesanan?->lensa?->nama_lensa ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                {{ $item->pesanan->status }}
                            </td>

                            @php
                                $totalBayar = $item->pesanan->pembayarans->sum('jumlah') ?? 0;
                                $totalBiaya = $item->pesanan->biaya_kacamata ?? 0;

                                if ($totalBiaya == 0) {
                                    $statusPembayaran = 'Belum Ada Biaya';
                                    $badgeClass = 'bg-gray-100 text-gray-700';
                                } elseif ($totalBayar == 0) {
                                    $statusPembayaran = 'Belum Bayar';
                                    $badgeClass = 'bg-red-100 text-red-700';
                                } elseif ($totalBayar >= $totalBiaya) {
                                    $statusPembayaran = 'Lunas';
                                    $badgeClass = 'bg-green-100 text-green-700';
                                } else {
                                    $statusPembayaran = 'Belum Lunas';
                                    $badgeClass = 'bg-yellow-100 text-yellow-700';
                                }
                            @endphp

                            <td class="px-4 py-3 text-sm font-medium">
                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $badgeClass }}">
                                    {{ $statusPembayaran }}
                                </span>
                                <div class="text-xs text-gray-600 mt-1">
                                    Rp {{ number_format($totalBayar, 0, ',', '.') }} / Rp
                                    {{ number_format($totalBiaya, 0, ',', '.') }}
                                </div>
                            </td>

                            <td class="px-4 py-3 text-sm text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="#"
                                        class="px-3 py-1 text-xs bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                        Edit
                                    </a>
                                    <a href="{{ route('datamedis.show', [$item->id]) }}"
                                        class="px-2 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700">
                                        Detail
                                    </a>

                                    <button type="button"
                                        class="px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700"
                                        onclick="window.dispatchEvent(
                           new CustomEvent('open-modal', {
                              detail: 'delete-document-{{ $item->id }}'
                           })
                        )">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <x-danger-modal id="delete-document-{{ $item->id }}" title="Hapus Dokumen">
                            <p class="text-sm text-gray-600">
                                Apakah Anda yakin ingin menghapus rekam medis
                                <strong class="text-gray-900">{{ $item->pasien->nama_pasien }} -
                                    {{ $item->resep->tanggal }}</strong>?
                                <br>
                                Tindakan ini tidak dapat dibatalkan.
                            </p>

                            <x-slot name="actions">
                                <form action="#" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
                                        Ya, Hapus
                                    </button>
                                </form>
                            </x-slot>
                        </x-danger-modal>

                    @empty
                        <tr>
                            <td colspan="10" class="px-4 py-6 text-center text-sm text-gray-500">
                                Data dokumen belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $data->links() }}
        </div>
    </div>
</x-app-layout>
