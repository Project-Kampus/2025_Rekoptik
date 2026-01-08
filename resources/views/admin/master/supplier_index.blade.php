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

      {{-- Header --}}
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
         <div>
            <h2 class="text-lg font-medium text-gray-900">
               Tabel Supplier
            </h2>
            <p class="mt-1 text-sm text-gray-600">
               Kelola data supplier lensa dan frame.
            </p>
         </div>

         <!-- Search -->
         <form method="GET" action="{{ route('supplier.index') }}" class="flex gap-2">
            <input
               type="text"
               name="q"
               value="{{ request('q') }}"
               placeholder="Cari nama / kontak"
               class="w-64 rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">

            <button
               type="submit"
               class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-900">
               Cari
            </button>

            @if(request('q'))
            <a href="{{ route('supplier.index') }}"
               class="px-4 py-2 border rounded-md text-sm text-gray-600 hover:bg-gray-100">
               Reset
            </a>
            @endif
         </form>
      </div>

      {{-- Table --}}
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

                        {{-- Edit --}}
                        <a href="{{ route('supplier.edit', $supplier->id) }}"
                           class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700 hover:bg-blue-200">
                           Edit
                        </a>

                        {{-- Detail --}}
                        <a href="{{ route('supplier.show', $supplier->id) }}"
                           class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-700 hover:bg-gray-200">
                           Detail
                        </a>

                        {{-- Hapus --}}
                        <button
                           type="button"
                           class="px-2 py-1 text-xs rounded bg-red-100 text-red-700 hover:bg-red-200"
                           onclick="window.dispatchEvent(
                              new CustomEvent('open-modal', {
                                 detail: 'delete-supplier-{{ $supplier->id }}'
                              })
                           )">
                           Hapus
                        </button>

                     </div>
                  </td>

               </tr>

               <x-danger-modal id="delete-supplier-{{ $supplier->id }}" title="Hapus Supplier">
                  <p>
                     Apakah Anda yakin ingin menghapus supplier
                     <strong>{{ $supplier->nama_supplier }}</strong>?
                     <br>
                     Tindakan ini tidak dapat dibatalkan.
                  </p>

                  <x-slot name="actions">
                     <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST">
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