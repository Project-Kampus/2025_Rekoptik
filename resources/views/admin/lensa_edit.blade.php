<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Edit Lensa
      </h2>
   </x-slot>

   <div class="bg-white rounded-lg border p-6">
      <header class="mb-6">
         <h2 class="text-lg font-medium text-gray-900">
            Data Lensa
         </h2>
         <p class="mt-1 text-sm text-gray-600">
            Perbarui informasi lensa kacamata.
         </p>
      </header>

      <form method="POST" action="{{ route('lensa.update', $lensa->id) }}" class="space-y-6">
         @csrf
         @method('PUT')

         <!-- GRID FORM -->
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <!-- Nama Lensa -->
            <div>
               <x-input-label for="nama_lensa" value="Nama Lensa" />
               <x-text-input
                  id="nama_lensa"
                  name="nama_lensa"
                  type="text"
                  class="mt-1 block w-full"
                  required
                  autofocus
                  value="{{ old('nama_lensa', $lensa->nama_lensa) }}" />
               <x-input-error :messages="$errors->get('nama_lensa')" class="mt-2" />
            </div>

            <!-- Kategori -->
            <div>
               <x-input-label for="kategori" value="Kategori" />
               <x-text-input
                  id="kategori"
                  name="kategori"
                  type="text"
                  class="mt-1 block w-full"
                  required
                  value="{{ old('kategori', $lensa->kategori) }}" />
               <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
            </div>

            <!-- Material -->
            <div>
               <x-input-label for="material" value="Material" />
               <x-text-input
                  id="material"
                  name="material"
                  type="text"
                  class="mt-1 block w-full"
                  value="{{ old('material', $lensa->material) }}" />
            </div>

            <!-- Coating -->
            <div>
               <x-input-label for="coating" value="Coating" />
               <x-text-input
                  id="coating"
                  name="coating"
                  type="text"
                  class="mt-1 block w-full"
                  value="{{ old('coating', $lensa->coating) }}" />
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
                  value="{{ old('harga', $lensa->harga) }}" />
               <x-input-error :messages="$errors->get('harga')" class="mt-2" />
            </div>

         </div>

         <!-- TOMBOL -->
         <div class="flex items-center gap-3">
            <x-primary-button>
               Update
            </x-primary-button>

            <a href="{{ route('lensa.index') }}"
               class="text-sm text-gray-600 hover:text-gray-900">
               Batal
            </a>
         </div>
      </form>
   </div>
</x-app-layout>