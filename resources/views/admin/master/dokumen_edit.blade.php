<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Edit Dokumen
      </h2>
   </x-slot>

   <div class="bg-white rounded-lg border p-6 ">
      <header class="mb-6">
         <h2 class="text-lg font-medium text-gray-900">
            Data Dokumen
         </h2>
         <p class="mt-1 text-sm text-gray-600">
            Perbarui informasi dokumen yang sudah ada.
         </p>
      </header>

      <form action="{{ route('document.update', $document->id) }}" method="POST" class="space-y-6">
         @csrf
         @method('PUT')

         <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
               Nama Dokumen <span class="text-red-500">*</span>
            </label>
            <input
               type="text"
               name="nama"
               value="{{ old('nama', $document->nama) }}"
               class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            @error('nama')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
         </div>

         <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
               Keterangan
            </label>
            <textarea
               name="keterangan"
               rows="3"
               class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('keterangan', $document->keterangan) }}</textarea>
            @error('keterangan')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
         </div>

         <div class="flex justify-end items-center gap-3">
            <x-secondary-button href="{{ route('document.index') }}">
               Batal
            </x-secondary-button>

            <x-primary-button>
               Simpan
            </x-primary-button>
         </div>
      </form>
   </div>
</x-app-layout>