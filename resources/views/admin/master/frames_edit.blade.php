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

                <!-- Supplier -->
                <div>
                    <x-input-label for="supplier_id" value="Supplier" />
                    <select id="supplier_id" name="supplier_id"
                        class="mt-1 block w-full rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                        <option value="">-- Pilih Supplier --</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}"
                                {{ old('supplier_id', $frame->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->nama }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('supplier_id')" class="mt-2" />
                </div>

                <!-- Kode Frame -->
                <div>
                    <x-input-label for="kode_frame" value="Kode Frame" />
                    <x-form-input id="kode_frame" name="kode_frame" type="text" class="mt-1 block w-full"
                        value="{{ old('kode_frame', $frame->kode_frame) }}" required />
                    <x-input-error :messages="$errors->get('kode_frame')" class="mt-2" />
                </div>

                <!-- Merk -->
                <div>
                    <x-input-label for="merk" value="Merk" />
                    <x-form-input id="merk" name="merk" type="text" class="mt-1 block w-full"
                        value="{{ old('merk', $frame->merk) }}" />
                </div>

                <!-- Warna -->
                <div>
                    <x-input-label for="warna" value="Warna" />
                    <x-form-input id="warna" name="warna" type="text" class="mt-1 block w-full"
                        value="{{ old('warna', $frame->warna) }}" />
                </div>

                <!-- Bahan -->
                <div>
                    <x-input-label for="bahan" value="Bahan" />
                    <x-form-input id="bahan" name="bahan" type="text" class="mt-1 block w-full"
                        value="{{ old('bahan', $frame->bahan) }}" placeholder="Metal, Plastik, TR90, dll" />
                </div>

            </div>

            <!-- TOMBOL -->
            <div class="flex items-center gap-3">
                <x-primary-button>
                    Simpan Perubahan
                </x-primary-button>

                <a href="{{ route('frame.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
