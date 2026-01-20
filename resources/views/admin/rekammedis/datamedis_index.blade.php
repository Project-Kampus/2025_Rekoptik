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
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    Tabel Medis
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola data medis
                </p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                            Tanggal Pemeriksaan
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
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($data as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                {{ $item->resep->tanggal }}
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
                            <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">
                                Data dokumen belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
