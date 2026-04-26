# Form Select Search Component - Usage Guide

## Deskripsi

Component form select search yang telah dipisahkan menjadi:

1. **Blade Component** (`resources/views/components/form-select-search.blade.php`) - Hanya HTML + render data
2. **JavaScript Pure** (`public/app/Component/form-select-search.js`) - Logic tanpa PHP

## Cara Menggunakan

### 1. Include JavaScript di Layout/Blade

```blade
<script src="{{ asset('app/Component/form-select-search.js') }}"></script>
```

### 2. Gunakan Component di Blade View

```blade
<x-form-select-search
    name="frame_id"
    id="frame_select"
    :options="$frames"
    labelKey="kode_frame"
    valueKey="id"
    placeholder="Pilih Frame"
    :selected="$selectedFrameId ?? null"
    :extraLabels="['harga', 'stok']"
/>
```

### Parameter

- **name** - Nama input (untuk form submission)
- **id** - ID unik untuk component (opsional, auto-generated jika tidak ada)
- **options** - Array data dari database
- **labelKey** - Key yang ditampilkan sebagai label (default: 'label')
- **valueKey** - Key yang digunakan sebagai value (default: 'value')
- **placeholder** - Teks placeholder
- **selected** - Nilai yang sudah dipilih
- **extraLabels** - Array key tambahan untuk ditampilkan di bawah label utama

### Contoh Data

```php
$frames = [
    [
        'id' => 1,
        'kode_frame' => 'FR001',
        'harga' => 150000,
        'stok' => 10
    ],
    [
        'id' => 2,
        'kode_frame' => 'FR002',
        'harga' => 200000,
        'stok' => 5
    ]
];
```

### Contoh Usage di Blade

```blade
<x-form-select-search
    name="frame_id"
    id="frameSelect"
    :options="$frames"
    labelKey="kode_frame"
    valueKey="id"
    placeholder="Pilih Frame"
    :selected="old('frame_id') ?? $pasien->frame_id ?? null"
    :extraLabels="['harga', 'stok']"
/>
```

## JavaScript API

Setelah initialize, Anda bisa mengakses API component:

```javascript
// Initialize dan get reference
let selectComponent = window.SelectSearchComponent(
    "frameSelect",
    options,
    config,
);

// Get selected value
console.log(selectComponent.getSelectedValue());

// Get selected label
console.log(selectComponent.getSelectedLabel());

// Set value programmatically
selectComponent.setValue(2);

// Get current state
console.log(selectComponent.getState());
```

## Features

✅ Search/Filter options  
✅ Display extra labels (harga, stok, dll)  
✅ Selected indicator  
✅ Click outside to close  
✅ Pure JavaScript (no Alpine.js required)  
✅ Form submission ready  
✅ Responsive design

## Migration dari Alpine.js

Jika sebelumnya menggunakan Alpine.js, perubahan utama:

- ❌ Removed: Alpine.js dependency
- ✅ Added: Pure JavaScript component
- ✅ Improved: Separation of concerns (Blade hanya render HTML)
- ✅ Better: JavaScript tidak ada PHP lagi
