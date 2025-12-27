<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800">
         Riwayat Frame
      </h2>
   </x-slot>

   <div class="bg-white rounded-lg border p-6">
      {{-- Info Frame --}}
      <div class="mb-5">
         <h3 class="text-lg font-semibold">
            {{ $frame->nama_frame }}
         </h3>
         <p class="text-sm text-gray-600">
            Kode: {{ $frame->kode_frame }} • Stok Saat Ini: {{ $frame->stok }}
         </p>
      </div>

      {{-- Table --}}
      <div class="overflow-x-auto">
         <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-50">
               <tr class="text-sm text-gray-600">
                  <th class="px-4 py-3 border">Tanggal</th>
                  <th class="px-4 py-3 border text-center">Jenis</th>
                  <th class="px-4 py-3 border text-center">Jumlah</th>
                  <th class="px-4 py-3 border">Keterangan</th>
                  <th class="px-4 py-3 border text-center">Sumber</th>
               </tr>
            </thead>
            <tbody class="text-sm">
               @forelse ($riwayat as $row)
               <tr class="hover:bg-gray-50">
                  <td class="px-4 py-2 border">
                     {{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}
                  </td>
                  <td class="px-4 py-2 border text-center">
                     @if ($row->jenis === 'masuk')
                     <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">
                        Masuk
                     </span>
                     @else
                     <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded">
                        Keluar
                     </span>
                     @endif
                  </td>
                  <td class="px-4 py-2 border text-center">
                     {{ $row->jumlah }}
                  </td>
                  <td class="px-4 py-2 border">
                     {{ $row->keterangan }}
                  </td>
                  <td class="px-4 py-2 border text-center text-xs text-gray-500">
                     {{ $row->sumber }}
                  </td>
               </tr>
               @empty
               <tr>
                  <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                     Belum ada riwayat
                  </td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </div>

      <div class="mt-4">
         {{ $riwayat->links() }}
      </div>
   </div>
</x-app-layout>