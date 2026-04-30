<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>
    <x-slot name="headerDetail">
        Ringkasan utama operasional, kunjungan, dan aktivitas pasien.

    </x-slot>



    @php
        $totalPasien = $totalPasien ?? 0;
        $hariIni = $hariIni ?? 0;
        $kunjunganBulanIni = $kunjunganBulanIni ?? 0;
        $rataRataHarian = $rataRataHarian ?? 0;
        $belumDiambil = $belumDiambil ?? 0;
        $totalBpjs = $totalBpjs ?? 0;
        $totalUmum = $totalUmum ?? 0;
        $totalAsuransi = $totalAsuransi ?? 0;
        $analysis = $analysis ?? [];
        $aktivitas = $aktivitas ?? collect();
        $bulanNames = $bulanNames ?? [];
        $grafikData = $grafikData ?? [];
    @endphp

    <div class="grid gap-4 lg:grid-cols-4">
        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-sm text-gray-500">Total Pasien</p>
            <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $totalPasien }}</p>
            <p class="mt-2 text-sm text-gray-500">Total pasien aktif di sistem.</p>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-sm text-gray-500">Kunjungan Hari Ini</p>
            <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $hariIni }}</p>
            <p class="mt-2 text-sm text-gray-500">Pemeriksaan yang tercatat hari ini.</p>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-sm text-gray-500">Kunjungan Bulan Ini</p>
            <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $kunjunganBulanIni }}</p>
            <p class="mt-2 text-sm text-gray-500">Rata-rata {{ $rataRataHarian }} pasien/hari.</p>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-sm text-gray-500">Pesanan Belum Diambil</p>
            <p class="mt-3 text-3xl font-semibold text-rose-600">{{ $belumDiambil }}</p>
            <p class="mt-2 text-sm text-gray-500">Segera tindak lanjut untuk realisasi penjualan.</p>
        </div>
    </div>

    <div class="grid gap-4 lg:grid-cols-3">
        <div class="lg:col-span-2 rounded-xl border border-gray-200 bg-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Tren Kunjungan Bulanan</h3>
                    <p class="mt-1 text-sm text-gray-500">Grafik perkembangan jumlah pemeriksaan setiap bulan.</p>
                </div>
            </div>
            <div class="mt-3 h-[320px]">
                <canvas id="grafikPasien"></canvas>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <h3 class="text-lg font-semibold text-gray-900">Komposisi Pasien</h3>
            <p class="mt-1 text-sm text-gray-500">Rasio BPJS, Umum, dan Asuransi.</p>
            <div class="mt-6 h-72">
                <canvas id="grafikKategori"></canvas>
            </div>
        </div>
    </div>

    <div class="grid gap-4 lg:grid-cols-2 mt-6">
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Insight Operasional</h3>
                    <p class="mt-1 text-sm text-gray-500">Rekomendasi utama untuk fokus tindakan.</p>
                </div>
                @isset($trendPercent)
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700">
                        {{ $trendPercent >= 0 ? '+' : '' }}{{ $trendPercent }}%
                    </span>
                @endisset
            </div>
            <div class="mt-6 space-y-3">
                @forelse($analysis as $line)
                    @php
                        $statusStyle = 'border-gray-200 bg-slate-50 text-gray-700';
                        if (stripos($line, 'belum diambil') !== false) {
                            $statusStyle =
                                $belumDiambil > 0
                                    ? 'border-orange-200 bg-orange-50 text-orange-700'
                                    : 'border-emerald-200 bg-emerald-50 text-emerald-700';
                        }
                    @endphp
                    <div class="rounded-2xl border p-4 text-sm {{ $statusStyle }}">
                        {{ $line }}
                    </div>
                @empty
                    <div class="rounded-2xl border border-gray-200 bg-slate-50 p-4 text-sm text-gray-700">
                        Belum ada analisis.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <h3 class="text-lg font-semibold text-gray-900">Aktivitas Hari Ini</h3>
            <p class="mt-1 text-sm text-gray-500">Daftar pasien yang baru diproses hari ini.</p>
            <div class="mt-6 overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full text-left text-sm text-gray-700">
                    <thead class="bg-slate-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3">Jam</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Aksi</th>
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
                                <td class="px-4 py-3">
                                    <a href="{{ route('datamedis.show', $item->id) }}"
                                        class="inline-flex items-center rounded-full bg-blue-600 px-3 py-1 text-xs font-semibold text-white hover:bg-blue-700">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-500">Tidak ada aktivitas
                                    hari ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($bulanNames);
        const chartData = @json($grafikData);

        new Chart(document.getElementById('grafikPasien'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Pemeriksaan',
                    data: chartData,
                    borderWidth: 3,
                    borderColor: '#0ea5e9',
                    backgroundColor: 'rgba(14, 165, 233, 0.16)',
                    pointRadius: 4,
                    pointBackgroundColor: '#0ea5e9',
                    fill: true,
                    tension: 0.35
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#64748b'
                        }
                    },
                    y: {
                        grid: {
                            color: '#e2e8f0'
                        },
                        ticks: {
                            color: '#64748b',
                            precision: 0
                        }
                    }
                }
            }
        });

        new Chart(document.getElementById('grafikKategori'), {
            type: 'doughnut',
            data: {
                labels: ['BPJS', 'Umum', 'Asuransi'],
                datasets: [{
                    data: [{{ $totalBpjs }}, {{ $totalUmum }}, {{ $totalAsuransi }}],
                    backgroundColor: ['#10b981', '#0ea5e9', '#f97316'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#64748b',
                            boxWidth: 12,
                            padding: 16
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
