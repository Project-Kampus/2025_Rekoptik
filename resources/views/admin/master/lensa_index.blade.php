<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Data Lensa
      </h2>
   </x-slot>

   <x-slot name="headerAction">
      <a href="{{ route('lensa.create') }}"
         class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
         + Tambah Lensa
      </a>
   </x-slot>

   <div class="bg-white rounded-lg border p-6">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
         <div>
            <h2 class="text-lg font-medium text-gray-900">
               Tabel Lensa
            </h2>
            <p class="mt-1 text-sm text-gray-600">
               Kelola data lensa kacamata, kategori, coating, dan harga.
            </p>
         </div>

         <!-- Search -->
         <form method="GET" action="{{ route('lensa.index') }}" class="flex gap-2">
            <input
               type="text"
               name="q"
               value="{{ request('q') }}"
               placeholder="Cari nama / kategori / coating"
               class="w-64 rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">

            <button
               type="submit"
               class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
               Cari
            </button>

            @if(request('q'))
            <a href="{{ route('lensa.index') }}"
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
                  <th class="px-4 py-3 border">Nama Lensa</th>
                  <th class="px-4 py-3 border">Kategori</th>
                  <th class="px-4 py-3 border">Material</th>
                  <th class="px-4 py-3 border">Coating</th>
                  <th class="px-4 py-3 border">OD</th>
                  <th class="px-4 py-3 border">OS</th>
                  <th class="px-4 py-3 border">Supplier</th>
                  <th class="px-4 py-3 border text-center">Aksi</th>
               </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
               @forelse ($lensas as $lensa)
               <tr class="hover:bg-gray-50">
                  <td class="px-4 py-2 border font-medium">
                     {{ $lensa->nama_lensa }}
                  </td>
                  <td class="px-4 py-2 border capitalize">
                     {{ $lensa->kategori }}
                  </td>
                  <td class="px-4 py-2 border">
                     {{ $lensa->material ?? '-' }}
                  </td>
                  <td class="px-4 py-2 border">
                     {{ $lensa->coating ?? '-' }}
                  </td>
                  <td class="px-4 py-2 border">
                     {{ $lensa->od ?? '-' }}
                  </td>
                  <td class="px-4 py-2 border">
                     {{ $lensa->os ?? '-' }}
                  </td>
                  <td class="px-4 py-2 border">
                     {{ $lensa->supplier->nama ?? '-' }}
                  </td>
                  <td class="px-4 py-2 border text-center">
                     <div class="flex justify-center gap-3">
                        <a href="{{ route('lensa.edit', $lensa->id) }}"
                           class="px-2 py-1 text-xs bg-yellow-500 text-white rounded hover:bg-yellow-600">
                           Edit
                        </a>

                        <button
                           type="button"
                           class="px-2 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600"
                           onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'delete-lensa-{{ $lensa->id }}' }))">
                           Hapus
                        </button>
                     </div>
                  </td>
               </tr>

               {{-- Modal Hapus --}}
               <x-danger-modal id="delete-lensa-{{ $lensa->id }}" title="Hapus Lensa">
                  <p>
                     Apakah Anda yakin ingin menghapus lensa
                     <strong>{{ $lensa->nama_lensa }}</strong>?
                     <br>
                     Tindakan ini tidak dapat dibatalkan.
                  </p>

                  <x-slot name="actions">
                     <form action="{{ route('lensa.destroy', $lensa->id) }}" method="POST">
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
                  <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                     Data lensa belum tersedia
                  </td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </div>

      <p class="text-sm text-gray-500 mt-2">
         Menampilkan {{ $lensas->count() }} dari {{ $lensas->total() }} lensa
      </p>

      <div class="mt-2">
         {{ $lensas->links() }}
      </div>
   </div>
</x-app-layout>