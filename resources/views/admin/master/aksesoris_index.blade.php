<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Aksesoris
        </h2>
    </x-slot>

    <x-slot name="headerAction">
        <a href="{{ route('aksesoris.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
            + Tambah Aksesoris
        </a>
    </x-slot>

    <div class="bg-white rounded-lg border p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    Tabel Aksesoris
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola data aksesoris dan keterangannya.
                </p>
            </div>
            <div>
                <form method="GET" action="{{ route('aksesoris.index') }}" class="flex gap-2">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama"
                        class="w-64 rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">

                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                        Cari
                    </button>

                    @if (request('q'))
                        <a href="{{ route('aksesoris.index') }}"
                            class="px-4 py-2 border rounded-md text-sm text-gray-600 hover:bg-gray-100">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full  ">
                <thead class="bg-blue-700 text-white text-sm font-bold">
                    <tr>
                        <th class="px-4 py-3 w-12 whitespace-nowrap">No</th>
                        <th class="px-4 py-3 ">Nama</th>
                        <th class="px-4 py-3 ">Supplier</th>
                        <th class="px-4 py-3 ">Material</th>
                        @if (auth()->user()->hasRole('superadmin'))
                            <th class="px-4 py-3 ">Harga Modal </th>
                        @endif
                        <th class="px-4 py-3 ">Harga Jual</th>
                        <th class="px-4 py-3">Keterangan</th>
                        <th class="px-4 py-3 text-center "> Aksi </th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm text-gray-700">
                    @forelse ($aksesoris as $item)
                        <tr class="hover:bg-blue-50">
                            <td class="px-4 py-3">
                                {{ $loop->iteration + ($aksesoris->currentPage() - 1) * $aksesoris->perPage() }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                {{ $item->nama }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $item->supplier->nama ?? '-' }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $item->material ?? '-' }}
                            </td>
                            @if (auth()->user()->hasRole('superadmin'))
                                <td class="px-4 py-3 text-right">
                                    @if ($item->modal && $item->modal > 0)
                                        Rp {{ number_format($item->modal, 0, ',', '.') }}
                                    @else
                                        <button type="button"
                                            class="px-3 py-1.5 text-xs bg-orange-500 text-white rounded hover:bg-orange-600 font-medium"
                                            onclick="window.dispatchEvent(
                                            new CustomEvent('open-modal', {
                                                detail: 'verify-modal-{{ $item->id }}'
                                            })
                                            )">
                                            Verifikasi Harga Modal
                                        </button>

                                        <x-danger-modal id="verify-modal-{{ $item->id }}"
                                            title="Verifikasi Harga Modal">
                                            <p class="text-sm text-gray-600">
                                                Aksesoris <strong class="text-gray-900">{{ $item->nama }}</strong>
                                                belum memiliki harga modal.
                                                <br>
                                                Silakan atur harga modal dengan mengedit item ini.
                                            </p>

                                            <x-slot name="actions">
                                                <a href="{{ route('aksesoris.edit', $item) }}"
                                                    class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                                                    Edit & Atur Harga Modal
                                                </a>
                                            </x-slot>
                                        </x-danger-modal>
                                    @endif
                                </td>
                            @endif
                            <td class="px-4 py-3 text-green-600 text-right">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $item->keterangan ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    @if (auth()->user()->hasRole('superadmin'))
                                        <a href="{{ route('aksesoris.edit', $item) }}"
                                            class="px-3 py-1 text-xs bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                            Edit
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

                                        <x-danger-modal id="delete-document-{{ $item->id }}" title="Hapus Dokumen">
                                            <p class="text-sm text-gray-600">
                                                Apakah Anda yakin ingin menghapus dokumen
                                                <strong class="text-gray-900">{{ $item->nama }}</strong>?
                                                <br>
                                                Tindakan ini tidak dapat dibatalkan.
                                            </p>

                                            <x-slot name="actions">
                                                <form action="{{ route('aksesoris.destroy', $item) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
                                                        Ya, Hapus
                                                    </button>
                                                </form>
                                            </x-slot>
                                        </x-danger-modal>
                                    @else
                                        <span class="px-3 py-1 text-xs bg-gray-300 text-gray-700 rounded">
                                            Tidak ada aksi
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>

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

        {{-- <p class="text-sm text-gray-500 mt-1">
            Menampilkan {{ $aksesoris->count() }} dari {{ $aksesoris->total() }} frame
        </p> --}}

        <div class="mt-4">
            {{ $aksesoris->links() }}
        </div>
    </div>
</x-app-layout>
