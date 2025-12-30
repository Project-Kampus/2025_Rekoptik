<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800">
         Rekap Medis Pasien
      </h2>
   </x-slot>

   <x-slot name="headerAction">
      <a href="{{ route('rekam-medis.create') }}"
         class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
         + Tambah Rekam Medis
      </a>
   </x-slot>

   <div class="bg-white rounded-lg border p-6">

      <!-- Filter & Search -->
      <form method="GET" class="mb-4 flex flex-wrap items-end justify-between gap-4">

         <!-- KIRI: FILTER -->
         <div class="flex flex-wrap items-end gap-3">

            <div>
               <label class="block text-xs text-gray-600 mb-1">Dari Tanggal</label>
               <input type="date" name="tanggal_awal"
                  value="{{ request('tanggal_awal') }}"
                  class="rounded border-gray-300 text-sm">
            </div>

            <div>
               <label class="block text-xs text-gray-600 mb-1">Sampai</label>
               <input type="date" name="tanggal_akhir"
                  value="{{ request('tanggal_akhir') }}"
                  class="rounded border-gray-300 text-sm">
            </div>

            <div>
               <label class="block text-xs text-gray-600 mb-1">Kategori</label>
               <select name="kategori" class="rounded border-gray-300 text-sm">
                  <option value="">Semua</option>
                  <option value="bpjs" {{ request('kategori') == 'bpjs' ? 'selected' : '' }}>BPJS</option>
                  <option value="umum" {{ request('kategori') == 'umum' ? 'selected' : '' }}>Umum</option>
               </select>
            </div>

            <a href="{{route('rekam-medis.index')}}"
               class="px-4 py-2 bg-gray-700 text-white text-sm rounded hover:bg-gray-800">Reset</a>

            <button type="submit"
               class="px-4 py-2 bg-gray-700 text-white text-sm rounded hover:bg-gray-800">
               Terapkan
            </button>
         </div>

         <!-- KANAN: SEARCH -->
         <div class="flex items-end gap-2">
            <input type="text" name="q"
               value="{{ request('q') }}"
               placeholder="Cari nama / no kartu"
               class="w-64 rounded border-gray-300 text-sm">

            <button type="submit"
               class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
               Cari
            </button>
         </div>

      </form>

      <div class="overflow-x-auto">
         <table class="min-w-full border text-sm">
            <thead class="bg-gray-50">
               <tr>
                  <th class="px-3 py-2 border">No</th>
                  <th class="px-3 py-2 border">Nama</th>
                  <th class="px-3 py-2 border">Kategori</th>
                  <th class="px-3 py-2 border">Tanggal</th>
                  <th class="px-3 py-2 border">Frame</th>
                  <th class="px-3 py-2 border">Biaya</th>
                  <th class="px-3 py-2 border">Sisa</th>
                  <th class="px-3 py-2 border text-center">Aksi</th>
               </tr>
            </thead>

            <tbody>
               @forelse ($pasiens as $pasien)
               <tr class="hover:bg-gray-50">
                  <td class="px-3 py-2 border">{{ $pasien->id }}</td>
                  <td class="px-3 py-2 border">{{ $pasien->nama_pasien }}</td>
                  <td class="px-3 py-2 border capitalize">{{ $pasien->kategori }}</td>
                  <td class="px-3 py-2 border">
                     {{ $pasien->tanggal_pemeriksaan?->format('d-m-Y') }}
                  </td>
                  <td class="px-3 py-2 border">
                     {{ $pasien->frame?->nama_frame ?? '-' }}
                  </td>
                  <td class="px-3 py-2 border">
                     Rp {{ number_format($pasien->biaya_kacamata,0,',','.') }}
                  </td>
                  <td class="px-3 py-2 border">
                     Rp {{ number_format($pasien->sisa,0,',','.') }}
                  </td>
                  <td class="px-3 py-2 border text-center">
                     <div class="flex justify-center gap-2">

                        <!-- Edit -->
                        <a href="{{ route('rekam-medis.edit', $pasien) }}"
                           class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700 hover:bg-blue-200">
                           Edit
                        </a>

                        <!-- Struk -->
                        <a href="{{ route('rekam-medis.struk', $pasien->id) }}"
                           target="_blank"
                           class="px-2 py-1 text-xs rounded bg-emerald-100 text-emerald-700 hover:bg-emerald-200">
                           Struk
                        </a>

                        <!-- Hapus -->
                        <button
                           type="button"
                           onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'hapus-{{ $pasien->id }}' }))"
                           class="px-2 py-1 text-xs rounded bg-red-100 text-red-700 hover:bg-red-200">
                           Hapus
                        </button>

                     </div>
                  </td>

               </tr>
               <x-danger-modal id="hapus-{{ $pasien->id }}" title="Hapus Rekam Medis">
                  <p class="text-sm text-gray-700">
                     Apakah Anda yakin ingin menghapus rekam medis
                     <strong>{{ $pasien->nama_pasien }}</strong>?
                     <br>
                     Tindakan ini tidak dapat dibatalkan.
                  </p>

                  <x-slot name="actions">
                     <form method="POST" action="{{ route('rekam-medis.destroy', $pasien->id) }}">
                        @csrf
                        @method('DELETE')

                        <button
                           type="submit"
                           class="px-4 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                           Ya, Hapus
                        </button>
                     </form>
                  </x-slot>
               </x-danger-modal>

               @empty
               <tr>
                  <td colspan="7" class="text-center py-6 text-gray-500">
                     Belum ada data
                  </td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </div>

      <div class="mt-4">
         {{ $pasiens->links() }}
      </div>

   </div>
</x-app-layout>