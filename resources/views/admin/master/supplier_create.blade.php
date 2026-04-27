<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($supplier) ? 'Edit Supplier' : 'Tambah Supplier' }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">

        <!-- Header Section -->
        <div class="px-6 py-6 bg-gray-50 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                Data Supplier
            </h3>
            <p class="mt-1 text-sm text-gray-600">
                {{ isset($supplier) ? 'Perbarui informasi supplier optik.' : 'Masukkan informasi supplier frame, lensa, dan aksesoris optik.' }}
            </p>
        </div>

        <!-- Form Section -->
        <div class="px-6 pb-6">
            <form method="POST"
                action="{{ isset($supplier) ? route('supplier.update', $supplier->id) : route('supplier.store') }}"
                class="space-y-6">
                @csrf
                @if (isset($supplier))
                    @method('PUT')
                @endif

                <!-- GRID FORM -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Nama Supplier -->
                    <div>
                        <x-input-label for="nama" value="Nama Supplier" />
                        <x-form-input id="nama" name="nama" type="text" class="mt-2 block w-full"
                            value="{{ old('nama', isset($supplier) ? $supplier->nama : null) }}" required autofocus />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>

                    <!-- Kontak -->
                    <div>
                        <x-input-label for="kontak" value="Kontak (HP / WhatsApp)" />
                        <x-form-input id="kontak" name="kontak" type="text" class="mt-2 block w-full"
                            value="{{ old('kontak', isset($supplier) ? $supplier->kontak : null) }}"
                            placeholder="08xxxxxxxxxx" />
                        <x-input-error :messages="$errors->get('kontak')" class="mt-2" />
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <x-input-label for="alamat" value="Alamat" />
                        <textarea id="alamat" name="alamat" rows="4"
                            class="mt-2 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm px-3 py-2"
                            placeholder="Alamat lengkap supplier">{{ old('alamat', isset($supplier) ? $supplier->alamat : null) }}</textarea>
                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                    </div>

                </div>

                <!-- ACTION BUTTONS -->
                <div class="flex justify-between items-center pt-4 border-t">
                    <x-secondary-button href="{{ route('supplier.index') }}">
                        Kembali
                    </x-secondary-button>

                    <x-primary-button>
                        {{ isset($supplier) ? 'Perbarui' : 'Simpan' }}
                    </x-primary-button>
                </div>

            </form>
        </div>

    </div>
</x-app-layout>
