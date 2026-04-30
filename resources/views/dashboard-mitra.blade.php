<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Mitra</h2>
    </x-slot>

    <x-slot name="headerDetail">
        Ringkasan khusus untuk mitra {{ $categoryLabel }}. Lihat rekap dan aktivitas kategori Anda.
    </x-slot>

    <div class="grid gap-4 lg:grid-cols-3">
        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-sm text-gray-500">Total Pasien {{ $categoryLabel }}</p>
            <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $totalCategory }}</p>
            <p class="mt-2 text-sm text-gray-500">Jumlah pasien yang terdaftar dalam kategori {{ $categoryLabel }}.</p>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-sm text-gray-500">Kunjungan Hari Ini</p>
            <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $hariIni }}</p>
            <p class="mt-2 text-sm text-gray-500">Pemeriksaan {{ $categoryLabel }} yang dicatat hari ini.</p>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-sm text-gray-500">Pesanan Belum Diambil</p>
            <p class="mt-3 text-3xl font-semibold text-rose-600">{{ $belumDiambil }}</p>
            <p class="mt-2 text-sm text-gray-500">Pesanan {{ $categoryLabel }} yang masih dalam status dipesan.</p>
        </div>
    </div>

    <div class="mt-6 rounded-xl border border-gray-200 bg-white p-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Akses Cepat Rekap</h3>
                <p class="mt-1 text-sm text-gray-500">Lihat detail rekap dan dokumen sesuai kategori Anda.</p>
            </div>
            @if ($category === 'bpjs')
                <a href="{{ route('mitra.bpjs.index') }}"
                    class="inline-flex items-center rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                    Buka Rekap BPJS
                </a>
            @else
                <div class="rounded-2xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-700">
                    Fitur rekap untuk mitra Asuransi akan ditambahkan sesuai pengaturan sistem.
                </div>
            @endif
        </div>
    </div>

    <div class="mt-6 rounded-xl border border-gray-200 bg-white p-6">
        <h3 class="text-lg font-semibold text-gray-900">Aktivitas {{ $categoryLabel }} Hari Ini</h3>
        <p class="mt-1 text-sm text-gray-500">Daftar pasien {{ $categoryLabel }} yang diproses hari ini.</p>

        <div class="mt-6 overflow-x-auto rounded-xl border border-gray-200">
            <table class="min-w-full text-left text-sm text-gray-700">
                <thead class="bg-slate-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-3">Jam</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Kategori</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($aktivitas as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 text-gray-700">
                                {{ optional($item->tanggal_pemeriksaan)->format('H:i') }}</td>
                            <td class="px-4 py-3 text-gray-900">{{ $item->nama_pasien }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                    {{ ucfirst($item->kategori) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-8 text-center text-gray-500">Tidak ada aktivitas hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
