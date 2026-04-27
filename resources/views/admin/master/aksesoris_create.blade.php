<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($aksesoris) ? 'Edit Aksesoris' : 'Tambah Aksesoris' }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-xl border p-6">
        <header class="mb-6">
            <h2 class="text-lg font-medium text-gray-900">
                Data Aksesoris
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ isset($aksesoris) ? 'Perbarui data aksesoris.' : 'Masukkan informasi aksesoris optik yang akan digunakan.' }}
            </p>
        </header>

        <form action="{{ isset($aksesoris) ? route('aksesoris.update', $aksesoris->id) : route('aksesoris.store') }}"
            method="POST" class="space-y-6">
            @csrf
            @if (isset($aksesoris))
                @method('PUT')
            @endif

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                <!-- Supplier -->
                <div>
                    <x-input-label value="Supplier" />
                    <select name="supplier_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">-- Pilih Supplier --</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" @selected(old('supplier_id', $aksesoris->supplier_id ?? '') == $supplier->id)>
                                {{ $supplier->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama -->
                <div>
                    <x-input-label value="Nama Aksesoris" />
                    <x-form-input name="nama" class="w-full" :value="old('nama', $aksesoris->nama ?? '')" required />
                    <x-input-error :messages="$errors->get('nama')" />
                </div>

                <!-- Material -->
                <div>
                    <x-input-label value="Material" />
                    <x-form-input name="material" class="w-full" :value="old('material', $aksesoris->material ?? '')" />
                </div>
                <!-- Modal -->
                @if (auth()->user()->hasRole('superadmin'))
                    <div>
                        <x-input-label value="Modal (Rp)" />
                        <x-form-input name="modal" type="rupiah" class="w-full" :value="old('modal', $aksesoris->modal ?? '')" min="0"
                            required />
                        <x-input-error :messages="$errors->get('modal')" />
                    </div>
                @endif
                <!-- Harga -->
                <div>
                    <x-input-label value="Harga Jual (Rp)" />
                    <x-form-input name="harga" type="rupiah" class="w-full" :value="old('harga', $aksesoris->harga ?? '')" min="0"
                        required />
                    <x-input-error :messages="$errors->get('harga')" />
                </div>


            </div>

            <!-- Keterangan -->
            <div>
                <x-input-label value="Keterangan" />
                <textarea name="keterangan" rows="3"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('keterangan', $aksesoris->keterangan ?? '') }}</textarea>
            </div>

            <!-- ACTION -->
            <div class="flex justify-between items-center pt-4 border-t">
                <x-secondary-button href="{{ route('aksesoris.index') }}">
                    Kembali
                </x-secondary-button>

                <x-primary-button>
                    {{ isset($aksesoris) ? 'Update' : 'Simpan' }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
