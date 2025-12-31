<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Riwayat Pengambilan Frame & Lensa
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

            @if(request()->filled('from') || request()->filled('to'))
            <a
               href="{{ route('frame.riwayat') }}"
               class="px-4 py-2 border rounded-md text-sm hover:bg-gray-100">
               Reset
            </a>
            @endif

         </div>
      </form>

      {{-- Table --}}
      <div class="overflow-x-auto">
         <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-50 text-sm text-gray-600">
               <tr>
                  <th class="px-4 py-3 border">Tanggal</th>
                  <th class="px-4 py-3 border">Nama Pasien</th>
                  <th class="px-4 py-3 border">Frame</th>
                  <th class="px-4 py-3 border">Lensa</th>
                  <th class="px-4 py-3 border text-center">Resep OB</th>
                  <th class="px-4 py-3 border text-center">Resep OS</th>
               </tr>
            </thead>

            <tbody class="text-sm text-gray-700">
               @forelse ($riwayat as $row)
               <tr class="hover:bg-gray-50">
                  {{-- Tanggal --}}
                  <td class="px-4 py-2 border">
                     {{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') }}
                  </td>

                  {{-- Pasien --}}
                  <td class="px-4 py-2 border">
                     {{ $row->nama_pasien }}
                  </td>

                  {{-- Frame --}}
                  <td class="px-4 py-2 border">
                     <div class="font-medium">{{ $row->kode_frame }}</div>
                     <div class="text-xs text-gray-500">{{ $row->merk_frame }}</div>
                  </td>

                  {{-- Lensa --}}
                  <td class="px-4 py-2 border">
                     @if($row->nama_lensa)
                     <div class="font-medium">{{ $row->nama_lensa }}</div>
                     <div class="text-xs text-gray-500">{{ $row->kategori }}</div>
                     @else
                     <span class="text-gray-400 text-xs">-</span>
                     @endif
                  </td>

                  {{-- OB --}}
                  <td class="px-4 py-2 border text-center text-xs">
                     S: {{ $row->od_sferis }} <br>
                     C: {{ $row->od_silindris }} <br>
                     A: {{ $row->od_axis }}
                  </td>

                  {{-- OS --}}
                  <td class="px-4 py-2 border text-center text-xs">
                     S: {{ $row->os_sferis }} <br>
                     C: {{ $row->os_silindris }} <br>
                     A: {{ $row->os_axis }}
                  </td>
               </tr>
               @empty
               <tr>
                  <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                     Tidak ada data riwayat
                  </td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </div>

      {{-- Pagination --}}
      <div class="mt-4">
         {{ $riwayat->links() }}
      </div>

   </div>
</x-app-layout>