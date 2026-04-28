<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Dokumen
        </h2>
    </x-slot>

    <x-slot name="headerAction">
        <a href="{{ route('document.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
            + Tambah Dokumen
        </a>
    </x-slot>

    <div class="bg-white rounded-lg border p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    Tabel Dokumen
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola data dokumen dan keterangannya.
                </p>
            </div>
        </div>

        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full">
                <thead class="bg-blue-700 text-white font-bold text-sm">
                    <tr>
                        <th class="px-4 py-3 w-12 whitespace-nowrap">
                            No
                        </th>
                        <th class="px-4 py-3">
                            Nama Dokumen
                        </th>
                        <th class="px-4 py-3">
                            kategori
                        </th>
                        <th class="px-4 py-3">
                            Keterangan
                        </th>
                        <th class="px-4 py-3 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($documents as $dokumen)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ $loop->iteration + ($documents->currentPage() - 1) * $documents->perPage() }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                {{ $dokumen->nama }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                @php
                                    $kategori = $dokumen->kategori;
                                    $kategoriColor = match ($kategori) {
                                        'bpjs' => 'bg-blue-100 text-blue-700',
                                        'asuransi' => 'bg-amber-100 text-amber-700',
                                        'umum' => 'bg-green-100 text-green-700',
                                        default => 'bg-gray-100 text-gray-700',
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $kategoriColor }}">
                                    {{ ucfirst($kategori) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ $dokumen->keterangan ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('document.edit', $dokumen) }}"
                                        class="px-3 py-1 text-xs bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                        Edit
                                    </a>

                                    <button type="button"
                                        class="px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700"
                                        onclick="window.dispatchEvent(
                           new CustomEvent('open-modal', {
                              detail: 'delete-document-{{ $dokumen->id }}'
                           })
                        )">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <x-danger-modal id="delete-document-{{ $dokumen->id }}" title="Hapus Dokumen">
                            <p class="text-sm text-gray-600">
                                Apakah Anda yakin ingin menghapus dokumen
                                <strong class="text-gray-900">{{ $dokumen->nama }}</strong>?
                                <br>
                                Tindakan ini tidak dapat dibatalkan.
                            </p>

                            <x-slot name="actions">
                                <form action="{{ route('document.destroy', $dokumen) }}" method="POST">
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

        {{-- <p class="text-sm text-gray-500 mt-1">
            Menampilkan {{ $documents->count() }} dari {{ $documents->total() }} frame
        </p> --}}

        <div class="mt-4">
            {{ $documents->links() }}
        </div>
    </div>
</x-app-layout>
