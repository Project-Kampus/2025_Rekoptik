<!--
    Contoh penggunaan Form Select Search Component di Blade View
    File ini menunjukkan berbagai cara menggunakan component
-->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8">Contoh Form Select Search</h1>

        <form action="{{ route('items.store') }}" method="POST" class="max-w-2xl">
            @csrf

            <!-- Example 1: Simple Select -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Frame (Simple)
                </label>
                <x-form-select-search name="frame_id" id="frameSelect" :options="$frames" labelKey="kode_frame" valueKey="id"
                    placeholder="Pilih Frame" :selected="old('frame_id') ?? null" />
                @error('frame_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Example 2: Select dengan Extra Labels -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Lensa (dengan Harga & Stok)
                </label>
                <x-form-select-search name="lensa_id" id="lensaSelect" :options="$lensas" labelKey="nama_lensa"
                    valueKey="id" placeholder="Pilih Lensa" :selected="old('lensa_id') ?? null" :extraLabels="['harga', 'stok']" />
                @error('lensa_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Example 3: Select dengan Default Value -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Supplier
                </label>
                <x-form-select-search name="supplier_id" id="supplierSelect" :options="$suppliers" labelKey="nama_supplier"
                    valueKey="id" placeholder="Pilih Supplier" :selected="$currentSupplier->id ?? null" :extraLabels="['kota', 'no_telp']" />
                @error('supplier_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Submit
                </button>
            </div>
        </form>

        <!-- Debug Info (Optional) -->
        <div class="mt-10 p-4 bg-gray-100 rounded">
            <h3 class="font-bold mb-2">Debug Info:</h3>
            <p class="text-sm text-gray-600">Open browser console to see component API</p>
            <pre class="text-xs bg-white p-2 mt-2 rounded overflow-auto"><code>
// Akses component via JavaScript
const frameSelect = window.SelectSearchComponent('frameSelect', options, config);

// Get selected value
console.log(frameSelect.getSelectedValue());

// Get selected label
console.log(frameSelect.getSelectedLabel());

// Get full state
console.log(frameSelect.getState());

// Set value programmatically
frameSelect.setValue(2);
        </code></pre>
        </div>
    </div>

    <script>
        // Script ini bisa diletakkan di asset JS atau di layout
        document.addEventListener('DOMContentLoaded', function() {
            // Jika ingin mendengarkan perubahan select
            const frameInput = document.querySelector('input[name="frame_id"]');
            if (frameInput) {
                frameInput.addEventListener('change', function() {
                    console.log('Frame selected:', this.value);
                });
            }
        });
    </script>
@endsection
