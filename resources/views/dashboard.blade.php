<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <!-- STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
        <div class="bg-white border rounded-lg p-4">
            <p class="text-sm text-gray-500">Total Pasien</p>
            <h3 class="text-2xl font-bold">{{ $totalPasien ?? 0 }}</h3>
        </div>

        <div class="bg-white border rounded-lg p-4">
            <p class="text-sm text-gray-500">Pasien BPJS</p>
            <h3 class="text-2xl font-bold text-emerald-600">{{ $totalBpjs ?? 0 }}</h3>
        </div>

        <div class="bg-white border rounded-lg p-4">
            <p class="text-sm text-gray-500">Pasien Umum</p>
            <h3 class="text-2xl font-bold text-blue-600">{{ $totalUmum ?? 0 }}</h3>
        </div>

        <div class="bg-white border rounded-lg p-4">
            <p class="text-sm text-gray-500">Pasien Asuransi</p>
            <h3 class="text-2xl font-bold text-orange-600">
                {{ $totalAsuransi ?? 0 }}
            </h3>
        </div>

        <div class="bg-white border rounded-lg p-4">
            <p class="text-sm text-gray-500">Belum Diambil</p>
            <h3 class="text-2xl font-bold text-red-600">
                {{ $belumDiambil ?? 0 }}
            </h3>
        </div>


        <div class="bg-white border rounded-lg p-4">
            <p class="text-sm text-gray-500">Hari Ini</p>
            <h3 class="text-2xl font-bold text-purple-600">{{ $hariIni ?? 0 }}</h3>
        </div>
    </div>

    <!-- GRAFIK -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-2">

        <!-- GRAFIK GARIS -->
        <div class="lg:col-span-4 bg-white border rounded-lg p-6">
            <h3 class="font-semibold text-gray-800 mb-4">
                Grafik Kunjungan Pasien (Bulanan)
            </h3>

            <div class="h-[320px]">
                <canvas id="grafikPasien"></canvas>
            </div>
        </div>

        <!-- GRAFIK PIE -->
        <div class="lg:col-span-1 bg-white border rounded-lg p-6">
            <h3 class="font-semibold text-gray-800 mb-4">
                Perbandingan Kategori
            </h3>

            <div class="h-[240px]">
                <canvas id="grafikKategori"></canvas>
            </div>
        </div>
    </div>

    <!-- AKTIVITAS TERBARU -->
    <div class="bg-white border rounded-lg p-6">
        <h3 class="font-semibold text-gray-800 mb-4">
            Aktivitas Terbaru Hari Ini
        </h3>

        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Jam</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama Pasien</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Kategori</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($aktivitas as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-gray-600 font-medium whitespace-nowrap">
                                {{ $item->tanggal_pemeriksaan?->format('H:i') }}
                            </td>
                            <td class="px-4 py-3 text-gray-900">
                                {{ $item->nama_pasien }}
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="px-3 py-1 text-xs font-medium rounded-full inline-block
                                    @if ($item->kategori === 'bpjs') bg-emerald-100 text-emerald-700
                                    @elseif($item->kategori === 'umum') bg-blue-100 text-blue-700
                                    @else bg-orange-100 text-orange-700 @endif">
                                    {{ ucfirst($item->kategori) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('datamedis.show', $item->id) }}"
                                    class="px-2 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                Belum ada aktivitas hari ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @php
        $dashboardData = [
            'bulanNames' => $bulanNames ?? [],
            'grafikData' => $grafikData ?? [],
            'totalBpjs' => $totalBpjs ?? 0,
            'totalUmum' => $totalUmum ?? 0,
            'totalAsuransi' => $totalAsuransi ?? 0,
        ];
    @endphp

    <!-- CHART JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dashboardData = @json($dashboardData);
        const {
            bulanNames,
            grafikData,
            totalBpjs,
            totalUmum,
            totalAsuransi
        } = dashboardData;

        new Chart(document.getElementById('grafikPasien'), {
            type: 'line',
            data: {
                labels: bulanNames,
                datasets: [{
                    label: 'Jumlah Pemeriksaan',
                    data: grafikData,
                    borderWidth: 2,
                    tension: 0.4,
                    fill: false,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        new Chart(document.getElementById('grafikKategori'), {
            type: 'doughnut',
            data: {
                labels: ['BPJS', 'Umum', 'Asuransi'],
                datasets: [{
                    data: [
                        totalBpjs,
                        totalUmum,
                        totalAsuransi
                    ],
                    backgroundColor: [
                        '#10b981',
                        '#3b82f6',
                        '#f97316'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>

</x-app-layout>
