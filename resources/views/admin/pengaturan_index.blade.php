<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Pengaturan Aplikasi
      </h2>
   </x-slot>

   <div class="bg-white border rounded-lg p-6 ">

      <form method="POST"
         action="{{ route('pengaturan.update') }}"
         enctype="multipart/form-data"
         class="space-y-6">
         @csrf
         @method('PUT')

         <!-- NAMA APLIKASI -->
         <div>
            <x-input-label value="Nama Klinik / Aplikasi" />
            <x-text-input
               name="nama_aplikasi"
               class="mt-1 block w-full"
               value="{{ old('nama_aplikasi', $pengaturan->nama_aplikasi ?? '') }}"
               required />
         </div>

         <!-- LOGO -->
         <div>
            <x-input-label value="Logo" />
            <div class="flex items-center gap-4 mt-2">

               @if(!empty($pengaturan->logo))
               <img src="{{ asset('storage/'.$pengaturan->logo) }}"
                  alt="Logo"
                  class="h-16 rounded border">
               @else
               <div class="h-16 w-16 flex items-center justify-center border rounded text-gray-400">
                  No Logo
               </div>
               @endif

               <input type="file"
                  name="logo"
                  class="text-sm text-gray-600"
                  accept="image/*">
            </div>

            <p class="text-xs text-gray-500 mt-1">
               Format JPG / PNG, maksimal 2MB
            </p>
         </div>

         <!-- KONTAK -->
         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
               <x-input-label value="No. Telepon" />
               <x-text-input
                  name="no_hp"
                  class="mt-1 block w-full"
                  value="{{ old('no_hp', $pengaturan->no_hp ?? '') }}" />
            </div>

            <div>
               <x-input-label value="Email" />
               <x-text-input
                  type="email"
                  name="email"
                  class="mt-1 block w-full"
                  value="{{ old('email', $pengaturan->email ?? '') }}" />
            </div>
         </div>

         <!-- ALAMAT -->
         <div>
            <x-input-label value="Alamat" />
            <textarea
               name="alamat"
               rows="3"
               class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">{{ old('alamat', $pengaturan->alamat ?? '') }}</textarea>
         </div>


         <!-- ACTION -->
         <div class="flex justify-end gap-3 pt-4 border-t">
            <button type="submit"
               class="px-5 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
               Simpan Pengaturan
            </button>
         </div>

      </form>
   </div>
</x-app-layout>