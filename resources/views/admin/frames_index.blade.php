<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Data Frame
      </h2>
   </x-slot>

   <x-slot name="headerAction">
      <a href="{{ route('frame.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
         + Tambah Frame
      </a>
      <a href="{{ route('frame.stok.create') }}"
         class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700 text-sm">
         + Tambah Stok
      </a>
   </x-slot>

   <div class="bg-white rounded-lg border p-6">
      {{-- Header --}}
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
         <div>
            <h2 class="text-lg font-medium text-gray-900">
               Tabel Frame
            </h2>
            <p class="mt-1 text-sm text-gray-600">
               Kelola data frame kacamata, stok, dan harga.
            </p>
         </div>

         <!-- Search -->
         <form method="GET" action="{{ route('frame.index') }}" class="flex gap-2">
            <input
               type="text"
               name="q"
               value="{{ request('q') }}"
               placeholder="Cari kode / nama / merk"
               class="w-64 rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">

            <button
               type="submit"
               class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-900">
               Cari
            </button>

            @if(request('q'))
            <a href="{{ route('frame.index') }}"
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
                  <th class="px-4 py-3 border">Kode</th>
                  <th class="px-4 py-3 border">Nama Frame</th>
                  <th class="px-4 py-3 border">Merk</th>
                  <th class="px-4 py-3 border">Kategori</th>
                  <th class="px-4 py-3 border">Harga</th>
                  <th class="px-4 py-3 border">Stok</th>
                  <th class="px-4 py-3 border text-center">Status</th>
                  <th class="px-4 py-3 border text-center">Aksi</th>
               </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
               @forelse ($frames as $frame)
               <tr class="hover:bg-gray-50">
                  <td class="px-4 py-2 border">
                     {{ $frame->kode_frame }}
                  </td>
                  <td class="px-4 py-2 border">
                     {{ $frame->nama_frame }}
                  </td>
                  <td class="px-4 py-2 border">
                     {{ $frame->merk ?? '-' }}
                  </td>
                  <td class="px-4 py-2 border capitalize">
                     {{ str_replace('_', ' ', $frame->kategori) }}
                  </td>
                  <td class="px-4 py-2 border">
                     Rp {{ number_format($frame->harga, 0, ',', '.') }}
                  </td>
                  <td class="px-4 py-2 border text-center">
                     {{ $frame->stok }}
                  </td>
                  <td class="px-4 py-2 border text-center">
                     @if ($frame->aktif)
                     <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                        Aktif
                     </span>
                     @else
                     <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">
                        Nonaktif
                     </span>
                     @endif
                  </td>
                  <td class="px-4 py-2 border text-center">
                     <div class="flex justify-center gap-2">
                        <a href="{{ route('frame.edit', $frame->id) }}"
                           class="text-blue-600 hover:underline text-sm">
                           Edit
                        </a>

                        <button
                           type="button"
                           class="text-red-600 hover:underline text-sm"
                           onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'delete-frame-{{ $frame->id }}' }))">
                           Hapus
                        </button>

                        <a href="{{ route('frame.riwayat', $frame->id) }}"
                           class="text-emerald-600 hover:underline text-sm">
                           Riwayat
                        </a>

                     </div>
                  </td>
               </tr>

               <x-danger-modal id="delete-frame-{{ $frame->id }}" title="Hapus Frame">
                  <p>
                     Apakah Anda yakin ingin menghapus frame
                     <strong>{{ $frame->nama_frame }}</strong>?
                     <br>
                     Tindakan ini tidak dapat dibatalkan.
                  </p>

                  <x-slot name="actions">
                     <form action="{{ route('frame.destroy', $frame->id) }}" method="POST">
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
                  <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                     Data frame belum tersedia
                  </td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </div>

      <p class="text-sm text-gray-500 mt-1">
         Menampilkan {{ $frames->count() }} dari {{ $frames->total() }} frame
      </p>

      <div class="mt-2">
         {{ $frames->links() }}
      </div>

   </div>


</x-app-layout>