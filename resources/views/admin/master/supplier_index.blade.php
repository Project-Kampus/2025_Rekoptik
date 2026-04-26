<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Supplier
        </h2>
    </x-slot>

    <x-slot name="headerAction">
        <a href="{{ route('supplier.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
            + Tambah Supplier
        </a>
    </x-slot>

    <div class="bg-white rounded-lg border p-6">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    Tabel Supplier
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola data supplier lensa dan frame.
                </p>
            </div>

            <form method="GET" action="{{ route('supplier.index') }}" class="flex gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / kontak"
                    class="w-64 rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                    Cari
                </button>

                @if (request('q'))
                    <a href="{{ route('supplier.index') }}"
                        class="px-4 py-2 border rounded-md text-sm text-gray-600 hover:bg-gray-100">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-md">
                <thead class="bg-gray-50">
                    <tr class="text-left text-sm text-gray-600">
                        <th class="px-4 py-3 border">Nama Supplier</th>
                        <th class="px-4 py-3 border">Kontak</th>
                        <th class="px-4 py-3 border">Alamat</th>
                        <th class="px-4 py-3 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">

                    @forelse ($suppliers as $supplier)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">
                                {{ $supplier->nama }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $supplier->kontak ?? '-' }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $supplier->alamat ?? '-' }}
                            </td>
                            <td class="px-4 py-2 border text-center">
                                <div class="flex justify-center gap-2">
                                    @if (auth()->user()->hasRole('superadmin'))
                                        <a href="{{ route('supplier.edit', $supplier->id) }}"
                                            class="px-2 py-1 text-xs bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                            Edit
                                        </a>

                                        <a href="{{ route('supplier.show', $supplier->id) }}"
                                            class="px-2 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700">
                                            Detail
                                        </a>

                                        <button type="button"
                                            class="px-2 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700"
                                            onclick="window.dispatchEvent(
                              new CustomEvent('open-modal', {
                                 detail: 'delete-supplier-{{ $supplier->id }}'
                              })
                           )">
                                            Hapus
                                        </button>
                                        <x-danger-modal id="delete-supplier-{{ $supplier->id }}"
                                            title="Hapus Supplier">
                                            <p>
                                                Apakah Anda yakin ingin menghapus supplier
                                                <strong>{{ $supplier->nama_supplier }}</strong>?
                                                <br>
                                                Tindakan ini tidak dapat dibatalkan.
                                            </p>

                                            <x-slot name="actions">
                                                <form action="{{ route('supplier.destroy', $supplier->id) }}"
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
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                Data supplier belum tersedia
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <p class="text-sm text-gray-500 mt-1">
            Menampilkan {{ $suppliers->count() }} dari {{ $suppliers->total() }} supplier
        </p>

        <div class="mt-2">
            {{ $suppliers->links() }}
        </div>

    </div>
</x-app-layout>
