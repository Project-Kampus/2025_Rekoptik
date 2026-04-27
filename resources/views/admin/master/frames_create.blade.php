<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($frame) ? 'Edit Frame' : 'Tambah Frame' }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-lg border p-6">
        <header class="mb-6">
            <h2 class="text-lg font-medium text-gray-900">
                Data Frame
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ isset($frame)
                    ? 'Perbarui informasi frame kacamata.'
                    : 'Masukkan informasi frame kacamata yang akan digunakan.' }}
            </p>
        </header>

        <form method="POST" action="{{ isset($frame) ? route('frame.update', $frame->id) : route('frame.store') }}"
            class="space-y-6">
            @csrf
            @if (isset($frame))
                @method('PUT')
            @endif

            <!-- GRID FORM -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                <!-- Supplier -->
                <div>
                    <x-input-label for="supplier_id" value="Supplier" />
                    <x-form-select-search class="mt-1 w-full" name="supplier_id" :options="$suppliers" labelKey="nama"
                        valueKey="id" placeholder="Pilih Supplier" :selected="old('supplier_id', $frame->supplier_id ?? null)" />
                    <x-input-error :messages="$errors->get('supplier_id')" class="mt-2" />
                </div>

                <!-- Kode Frame -->
                <div>
                    <x-input-label for="kode_frame" value="Kode Frame" />
                    <x-form-input id="kode_frame" name="kode_frame" type="text" class="mt-1 block w-full"
                        :value="old('kode_frame', $frame->kode_frame ?? '')" required />
                    <x-input-error :messages="$errors->get('kode_frame')" class="mt-2" />
                </div>

                <!-- Merk -->
                <div>
                    <x-input-label for="merk" value="Merk" />
                    <x-form-input id="merk" name="merk" type="text" class="mt-1 block w-full"
                        :value="old('merk', $frame->merk ?? '')" />
                </div>

                <!-- Warna -->
                <div>
                    <x-input-label for="warna" value="Warna" />
                    <x-form-input id="warna" name="warna" type="text" class="mt-1 block w-full"
                        :value="old('warna', $frame->warna ?? '')" />
                </div>

                <!-- Bahan -->
                <div>
                    <x-input-label for="bahan" value="Bahan" />
                    <x-form-input id="bahan" name="bahan" type="text" class="mt-1 block w-full"
                        placeholder="Metal, Plastik, TR90, dll" :value="old('bahan', $frame->bahan ?? '')" />
                </div>

                <!-- Modal -->
                @if (auth()->user()->hasRole('superadmin'))
                    <div>
                        <x-input-label for="modal" value="Harga Modal (Rp)" />
                        <x-form-input id="modal" name="modal" type="rupiah" class="mt-1 block w-full"
                            :value="old('modal', $frame->modal ?? '')" required />
                        <x-input-error :messages="$errors->get('modal')" class="mt-2" />
                    </div>
                @endif

                <!-- Harga -->
                <div>
                    <x-input-label for="harga" value="Harga Jual (Rp)" />
                    <x-form-input id="harga" name="harga" type="rupiah" class="mt-1 block w-full"
                        :value="old('harga', $frame->harga ?? '')" required />
                    <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                </div>

            </div>

            <!-- ACTION -->
            <div class="flex justify-between items-center pt-4 border-t">
                <x-secondary-button href="{{ route('frame.index') }}">
                    Kembali
                </x-secondary-button>

                <x-primary-button>
                    {{ isset($frame) ? 'Update' : 'Simpan' }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
