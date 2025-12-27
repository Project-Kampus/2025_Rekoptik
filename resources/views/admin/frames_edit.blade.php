<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Edit Frame
      </h2>
   </x-slot>

   <div class="bg-white rounded-lg border p-6">
      <header class="mb-6">
         <h2 class="text-lg font-medium text-gray-900">
            Data Frame
         </h2>
         <p class="mt-1 text-sm text-gray-600">
            Perbarui informasi frame kacamata.
         </p>
      </header>

      <form method="POST" action="{{ route('frame.update', $frame->id) }}" class="space-y-6">
         @csrf
         @method('PUT')

         <!-- GRID FORM -->
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <!-- Kode Frame -->
            <div>
               <x-input-label for="kode_frame" value="Kode Frame" />
               <x-text-input
                  id="kode_frame"
                  name="kode_frame"
                  type="text"
                  class="mt-1 block w-full"
                  value="{{ old('kode_frame', $frame->kode_frame) }}"
                  required />
               <x-input-error :messages="$errors->get('kode_frame')" class="mt-2" />
            </div>

            <!-- Nama Frame -->
            <div>
               <x-input-label for="nama_frame" value="Nama Frame" />
               <x-text-input
                  id="nama_frame"
                  name="nama_frame"
                  type="text"
                  class="mt-1 block w-full"
                  value="{{ old('nama_frame', $frame->nama_frame) }}"
                  required />
            </div>

            <!-- Merk -->
            <div>
               <x-input-label for="merk" value="Merk" />
               <x-text-input
                  id="merk"
                  name="merk"
                  type="text"
                  class="mt-1 block w-full"
                  value="{{ old('merk', $frame->merk) }}" />
            </div>

            <!-- Warna -->
            <div>
               <x-input-label for="warna" value="Warna" />
               <x-text-input
                  id="warna"
                  name="warna"
                  type="text"
                  class="mt-1 block w-full"
                  value="{{ old('warna', $frame->warna) }}" />
            </div>

            <!-- Bahan -->
            <div>
               <x-input-label for="bahan" value="Bahan" />
               <x-text-input
                  id="bahan"
                  name="bahan"
                  type="text"
                  class="mt-1 block w-full"
                  value="{{ old('bahan', $frame->bahan) }}"
                  placeholder="Metal, Plastik, TR90, dll" />
            </div>

            <!-- Kategori -->
            <div>
               <x-input-label for="kategori" value="Kategori" />
               <select
                  id="kategori"
                  name="kategori"
                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                  required>
                  <option value="bpjs" {{ old('kategori', $frame->kategori) == 'bpjs' ? 'selected' : '' }}>
                     BPJS
                  </option>
                  <option value="non_bpjs" {{ old('kategori', $frame->kategori) == 'non_bpjs' ? 'selected' : '' }}>
                     Non BPJS
                  </option>
               </select>
            </div>

            <!-- Harga -->
            <div>
               <x-input-label for="harga" value="Harga" />
               <x-text-input
                  id="harga"
                  name="harga"
                  type="number"
                  class="mt-1 block w-full"
                  min="0"
                  value="{{ old('harga', $frame->harga) }}" />
            </div>

         </div>

         <!-- STATUS FRAME -->
         <div class="flex items-center gap-3 pt-2">
            <label class="relative inline-flex items-center cursor-pointer">
               <input
                  type="checkbox"
                  name="aktif"
                  value="1"
                  class="sr-only peer"
                  {{ old('aktif', $frame->aktif) ? 'checked' : '' }}>
               <div class="w-11 h-6 bg-gray-200 rounded-full peer
                  peer-checked:bg-indigo-600
                  after:content-[''] after:absolute after:top-0.5 after:left-[2px]
                  after:bg-white after:border after:rounded-full after:h-5 after:w-5
                  after:transition-all peer-checked:after:translate-x-full">
               </div>
            </label>

            <span class="text-sm text-gray-700">Status Frame</span>
         </div>

         <!-- TOMBOL -->
         <div class="flex items-center gap-3">
            <x-primary-button>
               Simpan Perubahan
            </x-primary-button>

            <a href="{{ route('frame.index') }}"
               class="text-sm text-gray-600 hover:text-gray-900">
               Batal
            </a>
         </div>
      </form>
   </div>
</x-app-layout>