<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Tambah Stok Frame
      </h2>
   </x-slot>

   <script src="//unpkg.com/alpinejs" defer></script>

   <div class="bg-white rounded-lg border p-6"
      x-data="stokFrame()">

      <form method="POST" action="{{ route('frame.stok.store') }}">
         @csrf

         <template x-for="(item, index) in items" :key="index">
            <div class="border rounded-lg p-4 mb-4 bg-gray-50">

               <div class="flex justify-between items-center mb-3">
                  <h3 class="text-sm font-semibold text-gray-700">
                     Frame #<span x-text="index + 1"></span>
                  </h3>

                  <button
                     type="button"
                     @click="remove(index)"
                     x-show="items.length > 1"
                     class="text-red-600 text-xs hover:underline">
                     Hapus
                  </button>
               </div>

               <!-- INPUT 1 BARIS -->
               <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

                  <!-- Frame -->
                  <div class="md:col-span-3">
                     <label class="text-xs text-gray-600">Frame</label>
                     <select
                        :name="`frames[${index}][frame_id]`"
                        class="w-full mt-1 rounded border-gray-300 text-sm"
                        required>
                        <option value="">-- Pilih Frame --</option>
                        @foreach ($frames as $frame)
                        <option value="{{ $frame->id }}">
                           {{ $frame->kode_frame }} - {{ $frame->nama_frame }}
                        </option>
                        @endforeach
                     </select>
                  </div>

                  <!-- Jenis -->
                  <div class="md:col-span-2">
                     <label class="text-xs text-gray-600">Jenis</label>
                     <select
                        :name="`frames[${index}][jenis]`"
                        class="w-full mt-1 rounded border-gray-300 text-sm"
                        required>
                        <option value="masuk">Masuk</option>
                        <option value="keluar">Keluar</option>
                     </select>
                  </div>

                  <!-- Jumlah -->
                  <div class="md:col-span-2">
                     <label class="text-xs text-gray-600">Jumlah</label>
                     <input
                        type="number"
                        min="1"
                        :name="`frames[${index}][jumlah]`"
                        class="w-full mt-1 rounded border-gray-300 text-sm"
                        required>
                  </div>

                  <!-- Tanggal -->
                  <div class="md:col-span-2">
                     <label class="text-xs text-gray-600">Tanggal</label>
                     <input
                        type="date"
                        :name="`frames[${index}][tanggal]`"
                        value="{{ now()->toDateString() }}"
                        class="w-full mt-1 rounded border-gray-300 text-sm"
                        required>
                  </div>

                  <!-- Keterangan -->
                  <div class="md:col-span-3">
                     <label class="text-xs text-gray-600">Keterangan</label>
                     <input
                        type="text"
                        :name="`frames[${index}][keterangan]`"
                        class="w-full mt-1 rounded border-gray-300 text-sm"
                        placeholder="Pembelian / Penjualan">
                  </div>

               </div>
            </div>
         </template>


         <!-- Tombol -->
         <div class="flex gap-3 mt-6">
            <button type="button"
               @click="add()"
               class="px-4 py-2 bg-gray-200 rounded-md text-sm hover:bg-gray-300">
               + Tambah Frame
            </button>

            <button type="submit"
               class="px-4 py-2 bg-emerald-600 text-white rounded-md text-sm hover:bg-emerald-700">
               Simpan Stok
            </button>

            <a href="{{ route('frame.index') }}"
               class="px-4 py-2 border rounded-md text-sm text-gray-700 hover:bg-gray-100">
               Batal
            </a>
         </div>
      </form>
   </div>

   <script>
      function stokFrame() {
         return {
            items: [{}],
            add() {
               this.items.push({})
            },
            remove(index) {
               this.items.splice(index, 1)
            }
         }
      }
   </script>
</x-app-layout>