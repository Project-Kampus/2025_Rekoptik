<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Detail Supplier
        </h2>
    </x-slot>

    <div class="space-y-4">

        <!-- Header Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-white">
                            {{ $supplier->nama }}
                        </h3>
                        <p class="mt-2 text-blue-100 text-sm">
                            Mitra Penyedia Barang Optik
                        </p>
                    </div>

                    <a href="{{ route('supplier.edit', $supplier->id) }}"
                        class="px-4 py-2 rounded-md bg-white text-blue-600 text-sm hover:bg-blue-50 transition">
                        Edit Supplier
                    </a>

                </div>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-4 text-sm border-t border-gray-200">
                <div>
                    <dt class="text-gray-500 font-semibold text-xs uppercase tracking-wide">Kontak</dt>
                    <dd class="mt-2 text-gray-900 font-medium text-base">
                        {{ $supplier->kontak ?? '—' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-gray-500 font-semibold text-xs uppercase tracking-wide">Alamat</dt>
                    <dd class="mt-2 text-gray-900 font-medium text-base">
                        {{ $supplier->alamat ?? '—' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-gray-500 font-semibold text-xs uppercase tracking-wide">Tanggal Registrasi</dt>
                    <dd class="mt-2 text-gray-900 font-medium text-base">
                        {{ $supplier->created_at->format('d M Y') }}
                    </dd>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 font-medium text-sm">Total Frame</p>
                        <p class="mt-3 text-4xl font-bold text-gray-900">
                            {{ $supplier->frames->count() }}
                        </p>
                    </div>
                    <div class="text-4xl text-blue-100">
                        ⊞
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 font-medium text-sm">Total Lensa</p>
                        <p class="mt-3 text-4xl font-bold text-gray-900">
                            {{ $supplier->lensas->count() }}
                        </p>
                    </div>
                    <div class="text-4xl text-amber-100">
                        ○
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 font-medium text-sm">Total Aksesoris</p>
                        <p class="mt-3 text-4xl font-bold text-gray-900">
                            {{ $supplier->aksesoris->count() }}
                        </p>
                    </div>
                    <div class="text-4xl text-purple-100">
                        ✦
                    </div>
                </div>
            </div>

        </div>

        <!-- Frame Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-6 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    ⊞ Daftar Frame
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $supplier->frames->count() }} frame dari supplier ini
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-blue-50">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Kode Frame</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Merk</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Warna</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Bahan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($supplier->frames as $frame)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $frame->kode_frame }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $frame->merk }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $frame->warna }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $frame->bahan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                    Tidak ada data frame
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Lensa Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-6 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    ○ Daftar Lensa
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $supplier->lensas->count() }} lensa dari supplier ini
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-amber-50">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Nama Lensa</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Kategori</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Material</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Coating</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($supplier->lensas as $lensa)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $lensa->nama_lensa }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span
                                        class="inline-flex px-2 py-1 rounded text-xs font-medium bg-amber-100 text-amber-800">
                                        {{ ucfirst($lensa->kategori) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $lensa->material ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $lensa->coating ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                    Tidak ada data lensa
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Aksesoris Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-6 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    ✦ Daftar Aksesoris
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $supplier->aksesoris->count() }} aksesoris dari supplier ini
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-purple-50">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Nama Aksesoris</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Material</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Modal</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Harga Jual</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($supplier->aksesoris as $aksesoris)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $aksesoris->nama }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $aksesoris->material ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @if ($aksesoris->modal && $aksesoris->modal > 0)
                                        Rp {{ number_format($aksesoris->modal, 0, ',', '.') }}
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-green-600">
                                    Rp {{ number_format($aksesoris->harga, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                    Tidak ada data aksesoris
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
