<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Data Pasien
        </h2>
    </x-slot>

    <div class="space-y-6">
        <!-- CARD 1: IDENTITAS PASIEN -->
        <div class="bg-white rounded-lg border overflow-hidden">
            <!-- Header dengan nama pasien -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">
                    {{ $identitaspasien->nama_pasien }}
                </h2>
                <p class="mt-1 text-blue-100 text-sm">
                    Identitas Pasien
                </p>
            </div>

            <!-- Konten -->
            <div class="p-6">
                <!-- Row 1: Nama & No Kartu -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-sm">
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <label class="block font-semibold text-gray-500 uppercase tracking-wide">Kategori</label>
                        <p class="mt-2">
                            @php
                                $kategori = $identitaspasien->kategori;
                                $kategoriColor = match ($kategori) {
                                    'bpjs' => 'bg-blue-100 text-blue-700',
                                    'asuransi' => 'bg-amber-100 text-amber-700',
                                    'umum' => 'bg-green-100 text-green-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $kategoriColor }}">
                                {{ ucfirst($kategori) }}
                            </span>
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <label class="block font-semibold text-gray-500 uppercase tracking-wide">No.
                            Kartu</label>
                        <p class="mt-2 font-medium text-gray-900">{{ $identitaspasien->no_kartu ?? '—' }}</p>
                    </div>
                    <div class="bg-gray-50
                                    rounded-lg p-4 border border-gray-200">
                        <label class="block font-semibold text-gray-500 uppercase tracking-wide">Kelas</label>
                        <p class="mt-2 font-medium text-gray-900">
                            {{ $identitaspasien->kelas ? 'Kelas ' . $identitaspasien->kelas : '—' }}
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <label class="block font-semibold text-gray-500 uppercase tracking-wide">No. HP</label>
                        <p class="mt-2 font-medium text-gray-900">{{ $identitaspasien->no_hp ?? '—' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <label class="block font-semibold text-gray-500 uppercase tracking-wide">Email</label>
                        <p class="mt-2 font-medium text-gray-900">{{ $identitaspasien->email ?? '—' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <label class="block font-semibold text-gray-500 uppercase tracking-wide">Tanggal Lahir
                            (Umur)</label>
                        <p class="mt-2 font-medium text-gray-900">
                            {{ $identitaspasien->tanggal_lahir ? $identitaspasien->tanggal_lahir->format('d M Y') : '—' }}
                            ({{ $identitaspasien->umur ?? '—' }} Tahun)</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <label class="block font-semibold text-gray-500 uppercase tracking-wide">Tanggal
                            Terdaftar</label>
                        <p class="mt-2 font-medium text-gray-900">
                            {{ $identitaspasien->created_at->format('d-m-Y') }}</p>
                    </div>
                    <div class="bg-gray-50 lg:col-span-2 rounded-lg p-4 border border-gray-200">
                        <label class="block font-semibold text-gray-500 uppercase tracking-wide">Alamat</label>
                        <p class="mt-2 text-gray-900 leading-relaxed">
                            {{ $identitaspasien->alamat ?? '—' }}
                        </p>
                    </div>
                </div>
                <!-- Tombol Aksi -->
                @if (auth()->user()->hasRole('superadmin'))
                    <div class="flex items-center gap-3 mt-8 pt-6 border-t">
                        <a href="{{ route('identitaspasien.edit', $identitaspasien->id) }}"
                            class="px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600 transition">
                            Edit
                        </a>

                        <button type="button"
                            class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition"
                            onclick="window.dispatchEvent(
                            new CustomEvent('open-modal', {
                                detail: 'delete-pasien'
                            })
                        )">
                            Hapus
                        </button>

                        <!-- Delete Modal -->
                        <x-danger-modal id="delete-pasien" title="Hapus Data Pasien">
                            <p>
                                Apakah Anda yakin ingin menghapus data pasien
                                <strong>{{ $identitaspasien->nama_pasien }}</strong>?
                                <br>
                                Tindakan ini tidak dapat dibatalkan.
                            </p>

                            <x-slot name="actions">
                                <form action="#" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
                                        Ya, Hapus
                                    </button>
                                </form>
                            </x-slot>
                        </x-danger-modal>
                    </div>
                @endif
            </div>
        </div>

        <!-- CARD 2: RIWAYAT PEMERIKSAAN -->
        <div class="bg-white rounded-lg border p-6">
            <header class="mb-6 pb-4 border-b">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">
                            Riwayat Pemeriksaan
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Total {{ $pemeriksaans->count() }} pemeriksaan
                        </p>
                    </div>
                </div>
            </header>

            @if ($pemeriksaans->isNotEmpty())
                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="min-w-full">
                        <thead class="bg-blue-700 text-sm text-white">
                            <tr class="text-left">
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Keluhan Utama</th>
                                <th class="px-4 py-3">Diagnosa</th>
                                <th class="px-4 py-3">No. SEP</th>
                                <th class="px-4 py-3">Petugas</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y text-sm text-gray-700">
                            @foreach ($pemeriksaans as $pemeriksaan)
                                <tr class="hover:bg-blue-50">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ $pemeriksaan->created_at->format('d F Y') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ substr($pemeriksaan->keluhan_utama ?? '-', 0, 50) }}{{ strlen($pemeriksaan->keluhan_utama ?? '-') > 50 ? '...' : '' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ substr($pemeriksaan->diagnosa ?? '-', 0, 40) }}{{ strlen($pemeriksaan->diagnosa ?? '-') > 40 ? '...' : '' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $pemeriksaan->no_sep ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $pemeriksaan->user->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ route('datamedis.show', $pemeriksaan->id) }}"
                                            class="px-2 py-1 text-xs bg-blue-500 text-white rounded hover:bg-blue-600">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Tidak ada riwayat pemeriksaan</p>
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
