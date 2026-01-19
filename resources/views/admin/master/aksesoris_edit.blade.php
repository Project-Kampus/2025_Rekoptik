<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Aksesoris
        </h2>
    </x-slot>

    <div class="bg-white rounded-lg border p-6">
        <header class="mb-6">
            <h2 class="text-lg font-medium text-gray-900">
                Data Aksesoris
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                Perbarui informasi aksesoris yang sudah ada.
            </p>
        </header>

        <form action="{{ route('aksesoris.update', $aksesori->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <x-input-label value="Nama Aksesoris" />
                    <x-form-input name="nama" class="w-full" value="{{ old('nama', $aksesori->nama) }}" required />
                </div>

                <div>
                    <x-input-label value="Material" />
                    <x-form-input name="material" class="w-full" value="{{ old('material', $aksesori->material) }}" />
                </div>

                <div>
                    <x-input-label value="Supplier" />
                    <select name="supplier_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">-- Pilih Supplier --</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" @selected($supplier->id == $aksesori->supplier_id)>
                                {{ $supplier->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <x-input-label value="Keterangan" />
                <textarea name="keterangan" rows="3"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('keterangan', $aksesori->keterangan) }}</textarea>
            </div>

            <div class="flex justify-end items-center gap-3">
                <x-secondary-button href="{{ route('aksesoris.index') }}">
                    Batal
                </x-secondary-button>

                <x-primary-button>
                    Update
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
