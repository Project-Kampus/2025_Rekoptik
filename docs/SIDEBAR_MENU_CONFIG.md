# Sidebar Menu Configuration

Sidebar menu sekarang menggunakan struktur array yang dapat dikonfigurasi di file `app/View/Components/Sidebar.php`.

## Struktur Menu

### 1. Single Menu Item

Menu tunggal yang langsung menuju ke satu halaman:

```php
[
    'type' => 'single',
    'label' => 'Dashboard',
    'route' => 'dashboard',
    'routePattern' => 'dashboard',
]
```

### 2. Multi Menu Item (Dropdown)

Menu dengan submenu:

```php
[
    'type' => 'multi',
    'label' => 'Rekam Medis',
    'routePattern' => ['datamedis.*', 'identitaspasien.*'],
    'items' => [
        [
            'label' => 'Tambah Pemesanan',
            'route' => 'datamedis.create.step1',
            'routePattern' => 'datamedis.create.*',
        ],
        [
            'label' => 'Data Medis',
            'route' => 'datamedis.index',
            'routePattern' => ['datamedis.index', 'datamedis.show', 'datamedis.edit'],
        ],
    ],
]
```

### 3. Separator

Garis pemisah antara menu:

```php
[
    'type' => 'separator',
]
```

## Role-Based Access

Untuk membatasi akses menu hanya untuk role tertentu, tambahkan `requireRole`:

```php
[
    'type' => 'single',
    'label' => 'Pengaturan',
    'route' => 'pengaturan.index',
    'routePattern' => 'pengaturan.*',
    'requireRole' => 'superadmin',  // Hanya superadmin yang bisa akses
]
```

## Cara Menambah Menu Baru

1. Buka file `app/View/Components/Sidebar.php`
2. Cari array `$this->menu` di dalam `__construct()` method
3. Tambahkan item menu baru sesuai struktur yang diinginkan

### Contoh: Menambah Single Menu Baru

```php
[
    'type' => 'single',
    'label' => 'Laporan',
    'route' => 'laporan.index',
    'routePattern' => 'laporan.*',
]
```

### Contoh: Menambah Multi Menu Baru dengan Role Restriction

```php
[
    'type' => 'multi',
    'label' => 'Analytics',
    'routePattern' => ['analytics.*', 'report.*'],
    'requireRole' => 'superadmin',
    'items' => [
        [
            'label' => 'Dashboard Analytics',
            'route' => 'analytics.index',
            'routePattern' => 'analytics.*',
        ],
        [
            'label' => 'Laporan Bulanan',
            'route' => 'report.monthly',
            'routePattern' => 'report.*',
        ],
    ],
]
```

## Properties Setiap Menu Item

### Single Menu

- `type` (string): 'single' - Wajib
- `label` (string): Teks yang ditampilkan di UI - Wajib
- `route` (string): Route name - Wajib
- `routePattern` (string|array): Pattern untuk deteksi active state - Wajib
- `requireRole` (string, optional): 'superadmin' - Hanya superadmin jika diset

### Multi Menu

- `type` (string): 'multi' - Wajib
- `label` (string): Teks parent menu - Wajib
- `routePattern` (string|array): Pattern untuk deteksi active state parent - Wajib
- `items` (array): Array submenu items - Wajib
- `requireRole` (string, optional): 'superadmin' - Hanya superadmin jika diset

### Submenu Item (di dalam `items`)

- `label` (string): Teks submenu - Wajib
- `route` (string): Route name - Wajib
- `routePattern` (string|array): Pattern untuk deteksi active state - Wajib

### Separator

- `type` (string): 'separator' - Wajib
- `requireRole` (string, optional): 'superadmin' - Hanya superadmin jika diset

## Route Pattern

Route pattern menggunakan wildcard Laravel:

- `dashboard` - Match exact route 'dashboard'
- `datamedis.*` - Match semua route yang dimulai dengan 'datamedis.'
- `['admin.*', 'user.*']` - Match multiple patterns

## Catatan Penting

1. Blade template otomatis membaca dari array `$menu` di component class
2. Tidak perlu mengubah blade template saat menambah menu baru
3. Active state otomatis dideteksi berdasarkan route pattern
4. Dropdown otomatis terbuka jika ada submenu yang active
