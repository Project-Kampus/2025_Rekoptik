<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Lensa
        </h2>
    </x-slot>

    <div class="bg-white rounded-lg border p-6">
        <header class="mb-6">
            <h2 class="text-lg font-medium text-gray-900">
                Data Lensa
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                Masukkan informasi lensa kacamata yang akan digunakan.
            </p>
        </header>

        <form method="POST" action="{{ route('lensa.store') }}" class="space-y-8">
            @csrf

            <!-- INFORMASI UTAMA -->
            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-3">
                    Informasi Utama
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                    <!-- Supplier -->
                    <div>
                        <x-input-label for="supplier_id" value="Supplier" />
                        <select id="supplier_id" name="supplier_id"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                            <option value="">-- Pilih Supplier --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->nama }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('supplier_id')" class="mt-2" />
                    </div>

                    <!-- Nama Lensa -->
                    <div>
                        <x-input-label for="nama_lensa" value="Nama Lensa" />
                        <x-form-input id="nama_lensa" name="nama_lensa" type="text" class="mt-1 block w-full"
                            required value="{{ old('nama_lensa') }}" placeholder="Contoh: Kryptok HMC" />
                        <x-input-error :messages="$errors->get('nama_lensa')" class="mt-2" />
                    </div>

                    <!-- Kategori -->
                    <div>
                        <x-input-label for="kategori" value="Kategori" />
                        <x-form-input id="kategori" name="kategori" type="text" class="mt-1 block w-full" required
                            value="{{ old('kategori') }}" placeholder="Single Vision, Bifokal, Progresif" />
                        <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                    </div>

                    <!-- Harga -->
                    <div>
                        <x-input-label for="harga" value="Harga (Rp)" />
                        <x-form-input id="harga" name="harga" type="number" class="mt-1 block w-full" required
                            value="{{ old('harga') }}" placeholder="250000" min="0" step="1" />
                        <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                    </div>

                </div>
            </div>

            <!-- SPESIFIKASI LENSA -->
            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-3">
                    Spesifikasi Lensa
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                    <!-- Material -->
                    <div>
                        <x-input-label for="material" value="Material" />
                        <x-form-input id="material" name="material" type="text" class="mt-1 block w-full"
                            value="{{ old('material') }}" placeholder="CR-39, Polycarbonate, High Index" />
                    </div>

                    <!-- Coating -->
                    <div>
                        <x-input-label for="coating" value="Coating" />
                        <x-form-input id="coating" name="coating" type="text" class="mt-1 block w-full"
                            value="{{ old('coating') }}" placeholder="HMC, Blue Cut, Anti Radiasi" />
                    </div>

                </div>
            </div>

            <!-- UKURAN LENSA -->
            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-3">
                    Ukuran Lensa
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- OD -->
                    <div>
                        <x-input-label for="od" value="OD (Mata Kanan)" />
                        <x-form-input id="od" name="od" type="text" class="mt-1 block w-full"
                            value="{{ old('od') }}" placeholder="+1.00 / -0.50 x 180" />
                    </div>

                    <!-- OS -->
                    <div>
                        <x-input-label for="os" value="OS (Mata Kiri)" />
                        <x-form-input id="os" name="os" type="text" class="mt-1 block w-full"
                            value="{{ old('os') }}" placeholder="+1.25 / -0.75 x 170" />
                    </div>

                </div>
            </div>

            <!-- TOMBOL -->
            <div class="flex items-center gap-3 pt-4">
                <x-primary-button>
                    Simpan
                </x-primary-button>

                <a href="{{ route('lensa.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                    Batal
                </a>
            </div>

        </form>
    </div>
</x-app-layout>
