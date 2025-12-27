<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Riwayat Stok Frame
      </h2>
   </x-slot>

   <div class="bg-white rounded-lg border p-6">
      {{-- Filter Tanggal --}}
      <form method="GET" class="mb-4">
         <div class="flex flex-wrap items-end gap-3">

            <div>
               <label class="text-xs text-gray-600">Dari Tanggal</label>
               <input
                  type="date"
                  name="from"
                  value="{{ request('from') }}"
                  class="mt-1 rounded border-gray-300 text-sm">
            </div>

            <div>
               <label class="text-xs text-gray-600">Sampai Tanggal</label>
               <input
                  type="date"
                  name="to"
                  value="{{ request('to') }}"
                  class="mt-1 rounded border-gray-300 text-sm">
            </div>

            <button
               type="submit"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">
               Filter
            </button>

            @if(request()->has('from') || request()->has('to'))
            <a
               href="{{ route('frame.riwayat') }}"
               class="px-4 py-2 border rounded-md text-sm hover:bg-gray-100">
               Reset
            </a>
            @endif

         </div>
      </form>

      <div class="overflow-x-auto">
         <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-50 text-sm text-gray-600">
               <tr>
                  <th class="px-4 py-3 border">Tanggal</th>
                  <th class="px-4 py-3 border">Frame</th>
                  <th class="px-4 py-3 border text-center">Jenis</th>
                  <th class="px-4 py-3 border text-center">Jumlah</th>
                  <th class="px-4 py-3 border">Keterangan</th>
                  <th class="px-4 py-3 border text-center">Sumber</th>
               </tr>
            </thead>

            <tbody class="text-sm text-gray-700">
               @forelse ($riwayat as $row)
               <tr class="hover:bg-gray-50">
                  <td class="px-4 py-2 border">
                     {{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') }}
                  </td>
                  <td class="px-4 py-2 border">
                     <div class="font-medium">{{ $row->kode_frame }}</div>
                     <div class="text-xs text-gray-500">{{ $row->nama_frame }}</div>
                  </td>
                  <td class="px-4 py-2 border text-center">
                     @if ($row->jenis === 'masuk')
                     <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                        Masuk
                     </span>
                     @else
                     <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">
                        Keluar
                     </span>
                     @endif
                  </td>
                  <td class="px-4 py-2 border text-center">
                     {{ $row->jumlah }}
                  </td>
                  <td class="px-4 py-2 border">
                     {{ $row->keterangan ?? '-' }}
                  </td>
                  <td class="px-4 py-2 border text-center text-xs">
                     {{ str_replace('_', ' ', $row->sumber) }}
                  </td>
               </tr>
               @empty
               <tr>
                  <td colspan="6" class="px-4 py-6 text-center text-gray-500">
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