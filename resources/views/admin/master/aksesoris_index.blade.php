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
         <form method="GET" action="{{ route('aksesoris.index') }}" class="flex gap-2">
            <input
               type="text"
               name="q"
               value="{{ request('q') }}"
               placeholder="Cari nama"
               class="w-64 rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">

            <button
               type="submit"
               class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
               Cari
            </button>

            @if(request('q'))
            <a href="{{ route('aksesoris.index') }}"
               class="px-4 py-2 border rounded-md text-sm text-gray-600 hover:bg-gray-100">
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
                     No
                  </th>
                  <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                     Nama
                  </th>
                  <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                     Material
                  </th>
                  <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                     Supplier
                  </th>
                  <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                     Keterangan
                  </th>
                  <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">
                     Aksi
                  </th>
               </tr>
            </thead>
            <tbody class="divide-y">
               @forelse ($aksesoris as $item)
               <tr class="hover:bg-gray-50">
                  <td class="px-4 py-3 text-sm text-gray-600">
                     {{ $loop->iteration + ($aksesoris->currentPage() - 1) * $aksesoris->perPage() }}
                  </td>
                  <td class="px-4 py-3 text-sm font-medium text-gray-800">
                     {{ $item->nama }}
                  </td>
                  <td class="px-4 py-3 text-sm text-gray-600">
                     {{ $item->material ?? '-' }}
                  </td>
                  <td class="px-4 py-3 text-sm text-gray-600">
                     {{ $item->supplier->nama ?? '-' }}
                  </td>
                  <td class="px-4 py-3 text-sm text-gray-600">
                     {{ $item->keterangan ?? '-' }}
                  </td>
                  <td class="px-4 py-3 text-sm text-center">
                     <div class="flex justify-center gap-2">
                        <a href="{{ route('aksesoris.edit', $item) }}"
                           class="px-3 py-1 text-xs bg-yellow-500 text-white rounded hover:bg-yellow-600">
                           Edit
                        </a>

                        <button
                           type="button"
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
                     Apakah Anda yakin ingin menghapus dokumen
                     <strong class="text-gray-900">{{ $item->nama }}</strong>?
                     <br>
                     Tindakan ini tidak dapat dibatalkan.
                  </p>

                  <x-slot name="actions">
                     <form action="{{ route('aksesoris.destroy', $item) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button
                           type="submit"
                           class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
                           Ya, Hapus
                        </button>
                     </form>
                  </x-slot>
               </x-danger-modal>

               @empty
               <tr>
                  <td colspan="4"
                     class="px-4 py-6 text-center text-sm text-gray-500">
                     Data dokumen belum tersedia
                  </td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </div>

      <p class="text-sm text-gray-500 mt-1">
         Menampilkan {{ $aksesoris->count() }} dari {{ $aksesoris->total() }} frame
      </p>

      <div class="mt-4">
         {{ $aksesoris->links() }}
      </div>
   </div>
</x-app-layout>