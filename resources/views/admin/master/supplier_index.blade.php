<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Supplier
        </h2>
    </x-slot>

    <x-slot name="headerAction">
        <a href="{{ route('supplier.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition">
            Tambah Supplier
        </a>
    </x-slot>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">

        <!-- Header Section -->
        <div class="px-8 py-6 bg-gray-50 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        Daftar Supplier
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Kelola data supplier lensa, frame, dan aksesoris optik.
                    </p>
                </div>

                <form method="GET" action="{{ route('supplier.index') }}" class="flex gap-2">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / kontak"
                        class="px-3 py-2 rounded-md border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">

                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                        Cari
                    </button>

                    @if (request('q'))
                        <a href="{{ route('supplier.index') }}"
                            class="px-4 py-2 border border-gray-300 text-sm text-gray-600 rounded-md hover:bg-gray-100 transition">
                            ↺ Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Nama Supplier
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">

                    @forelse ($suppliers as $supplier)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                <a href="{{ route('supplier.show', $supplier->id) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium">
                                    {{ $supplier->nama }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $supplier->kontak ?? '—' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ Str::limit($supplier->alamat ?? '—', 40) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-center">
                                <div class="flex justify-center gap-2">
                                    @if (auth()->user()->hasRole('superadmin'))
                                        <a href="{{ route('supplier.show', $supplier->id) }}"
                                            class="px-3 py-1.5 text-xs bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition font-medium">
                                            Lihat
                                        </a>

                                        <a href="{{ route('supplier.edit', $supplier->id) }}"
                                            class="px-3 py-1.5 text-xs bg-yellow-100 text-yellow-700 rounded-md hover:bg-yellow-200 transition font-medium">
                                            Edit
                                        </a>

                                        <button type="button"
                                            class="px-3 py-1.5 text-xs bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition font-medium"
                                            onclick="window.dispatchEvent(
                                                    new CustomEvent('open-modal', {
                                                        detail: 'delete-supplier-{{ $supplier->id }}'
                                                    })
                                                )">
                                            Hapus
                                        </button>
                                        <x-danger-modal id="delete-supplier-{{ $supplier->id }}"
                                            title="Hapus Supplier">
                                            <p class="text-sm text-gray-600">
                                                Apakah Anda yakin ingin menghapus supplier
                                                <strong class="text-gray-900">{{ $supplier->nama }}</strong>?
                                                <br>
                                                Tindakan ini tidak dapat dibatalkan.
                                            </p>

                                            <x-slot name="actions">
                                                <form action="{{ route('supplier.destroy', $supplier->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition">
                                                        Ya, Hapus
                                                    </button>
                                                </form>
                                            </x-slot>
                                        </x-danger-modal>
                                    @else
                                        <a href="{{ route('supplier.show', $supplier->id) }}"
                                            class="px-3 py-1.5 text-xs bg-gray-100 text-gray-600 rounded-md hover:bg-gray-200 transition font-medium">
                                            👁 Lihat
                                        </a>
                                    @endif

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                📭 Data supplier belum tersedia
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- Footer Section -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <p class="text-sm text-gray-600">
                Menampilkan <strong>{{ $suppliers->count() }}</strong> dari <strong>{{ $suppliers->total() }}</strong>
                supplier
            </p>

            <div class="mt-4">
                {{ $suppliers->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
