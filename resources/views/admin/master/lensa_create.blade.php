<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($lensa) ? 'Edit Lensa' : 'Tambah Lensa' }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-lg border p-6">
        <header class="mb-6">
            <h2 class="text-lg font-medium text-gray-900">
                Data Lensa
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ isset($lensa) ? 'Perbarui informasi lensa.' : 'Masukkan informasi lensa kacamata yang akan digunakan.' }}
            </p>
        </header>

        <form method="POST" action="{{ isset($lensa) ? route('lensa.update', $lensa->id) : route('lensa.store') }}"
            class="space-y-6">

            @csrf
            @if (isset($lensa))
                @method('PUT')
            @endif

            <!-- INFORMASI UTAMA -->
            <div class="pt-2 border-t">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">
                    Informasi Utama
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                    <!-- Supplier -->
                    <div>
                        <x-input-label value="Supplier" />
                        <x-form-select-search class="mt-1 w-full" name="supplier_id" :options="$suppliers" labelKey="nama"
                            valueKey="id" placeholder="Pilih Supplier" :selected="old('supplier_id', $lensa->supplier_id ?? null)" />
                    </div>

                    <!-- Nama -->
                    <div>
                        <x-input-label value="Nama Lensa" />
                        <x-form-input name="nama_lensa" class="mt-1 w-full" :value="old('nama_lensa', $lensa->nama_lensa ?? '')" required />
                    </div>

                    <!-- Kategori -->
                    <div>
                        <x-input-label value="Kategori" />
                        <x-form-input name="kategori" class="mt-1 w-full" :value="old('kategori', $lensa->kategori ?? '')" required />
                    </div>

                    <!-- Modal -->
                    @if (auth()->user()->hasRole('superadmin'))
                        <div>
                            <x-input-label value="Harga Modal (Rp)" />
                            <x-form-input name="modal" type="rupiah" class="mt-1 w-full" :value="old('modal', $lensa->modal ?? '')" />
                        </div>
                    @endif

                    <!-- Harga -->
                    <div>
                        <x-input-label value="Harga Jual (Rp)" />
                        <x-form-input name="harga" type="rupiah" class="mt-1 w-full" :value="old('harga', $lensa->harga ?? '')" required />
                    </div>

                </div>
            </div>

            <!-- SPESIFIKASI -->
            <div class="pt-2 border-t">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">
                    Spesifikasi Lensa
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                    <div>
                        <x-input-label value="Material" />
                        <x-form-input name="material" class="mt-1 w-full" :value="old('material', $lensa->material ?? '')" />
                    </div>

                    <div>
                        <x-input-label value="Coating" />
                        <x-form-input name="coating" class="mt-1 w-full" :value="old('coating', $lensa->coating ?? '')" />
                    </div>

                </div>
            </div>

            <!-- UKURAN -->
            <div class="pt-2 border-t">
                <h3 class="font-semibold text-gray-700 mb-3">
                    Ukuran Lensa
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <x-input-label value="OD (Mata Kanan)" />
                        <x-form-input name="od" class="mt-1 w-full" :value="old('od', $lensa->od ?? '')" />
                    </div>

                    <div>
                        <x-input-label value="OS (Mata Kiri)" />
                        <x-form-input name="os" class="mt-1 w-full" :value="old('os', $lensa->os ?? '')" />
                    </div>

                </div>
            </div>

            <!-- ACTION -->
            <div class="flex justify-between items-center pt-4 border-t">
                <x-secondary-button href="{{ route('lensa.index') }}">
                    Kembali
                </x-secondary-button>

                <x-primary-button>
                    {{ isset($lensa) ? 'Update' : 'Simpan' }}
                </x-primary-button>
            </div>

        </form>
    </div>
</x-app-layout>
