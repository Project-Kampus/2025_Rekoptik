<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $document ? 'Edit Dokumen' : 'Tambah Dokumen' }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-lg border p-6">
        <header class="mb-6">
            <h2 class="text-lg font-medium text-gray-900">
                Data Dokumen
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ $document ? 'Perbarui informasi dokumen yang sudah ada.' : 'Masukkan informasi dokumen yang akan digunakan.' }}
            </p>
        </header>

        <form action="{{ $document ? route('document.update', $document->id) : route('document.store') }}" method="POST"
            class="space-y-6">
            @csrf
            @if ($document)
                @method('PUT')
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Dokumen <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" value="{{ old('nama', $document->nama ?? '') }}"
                        placeholder="Contoh: Surat Rujukan"
                        class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori"
                        class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="bpjs" @selected(old('kategori', $document->kategori ?? '') === 'bpjs')>BPJS</option>
                        <option value="asuransi" @selected(old('kategori', $document->kategori ?? '') === 'asuransi')>Asuransi</option>
                        <option value="umum" @selected(old('kategori', $document->kategori ?? '') === 'umum')>Umum</option>
                    </select>
                    @error('kategori')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Keterangan
                </label>
                <textarea name="keterangan" rows="3" placeholder="Keterangan tambahan (opsional)"
                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('keterangan', $document->keterangan ?? '') }}</textarea>
                @error('keterangan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center pt-4 border-t">
                <x-secondary-button href="{{ route('document.index') }}">
                    Batal
                </x-secondary-button>

                <x-primary-button>
                    {{ $document ? 'Perbarui' : 'Simpan' }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
