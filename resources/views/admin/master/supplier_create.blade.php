<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Tambah Supplier
      </h2>
   </x-slot>

   <div class="bg-white rounded-lg border p-6">

      <header class="mb-6">
         <h2 class="text-lg font-medium text-gray-900">
            Data Supplier
         </h2>
         <p class="mt-1 text-sm text-gray-600">
            Masukkan informasi supplier frame dan lensa.
         </p>
      </header>

      <form method="POST" action="{{ route('supplier.store') }}" class="space-y-6">
         @csrf

         <!-- GRID FORM -->
         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Nama Supplier -->
            <div>
               <x-input-label for="nama_supplier" value="Nama Supplier" />
               <x-text-input
                  id="nama_supplier"
                  name="nama"
                  type="text"
                  class="mt-1 block w-full"
                  value="{{ old('nama') }}"
                  required
                  autofocus />
               <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>

            <!-- Kontak -->
            <div>
               <x-input-label for="kontak" value="Kontak (HP / WhatsApp)" />
               <x-text-input
                  id="kontak"
                  name="kontak"
                  type="text"
                  class="mt-1 block w-full"
                  value="{{ old('kontak') }}"
                  placeholder="08xxxxxxxxxx" />
               <x-input-error :messages="$errors->get('kontak')" class="mt-2" />
            </div>

            <!-- Alamat -->
            <div class="md:col-span-2">
               <x-input-label for="alamat" value="Alamat" />
               <textarea
                  id="alamat"
                  name="alamat"
                  rows="3"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                  placeholder="Alamat lengkap supplier">{{ old('alamat') }}</textarea>
               <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
            </div>

         </div>

         <!-- TOMBOL -->
         <div class="flex items-center gap-3">
            <x-primary-button>
               Simpan
            </x-primary-button>

            <a href="{{ route('supplier.index') }}"
               class="text-sm text-gray-600 hover:text-gray-900">
               Batal
            </a>
         </div>

      </form>
   </div>
</x-app-layout>