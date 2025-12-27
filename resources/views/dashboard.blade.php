<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <!-- STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
            Aktivitas Terbaru
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 border">Tanggal</th>
                        <th class="px-3 py-2 border">Nama Pasien</th>
                        <th class="px-3 py-2 border">Kategori</th>
                        <th class="px-3 py-2 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aktivitas as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-2 border">
                                {{ $item->tanggal_pemeriksaan?->format('d-m-Y') }}
                            </td>
                            <td class="px-3 py-2 border">
                                {{ $item->nama_pasien }}
                            </td>
                            <td class="px-3 py-2 border capitalize">
                                {{ $item->kategori }}
                            </td>
                            <td class="px-3 py-2 border text-center">
                                <a href="{{ route('rekam-medis.edit', $item) }}"
                                    class="text-blue-600 hover:underline text-xs">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">
                                Belum ada aktivitas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- CHART JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        new Chart(document.getElementById('grafikPasien'), {
            type: 'line',
            data: {
                labels: {!! json_encode($bulan ?? []) !!},
                datasets: [{
                    label: 'Jumlah Pasien',
                    data: {!! json_encode($jumlahPasien ?? []) !!},
                    borderWidth: 2,
                    tension: 0.4,
                    fill: false
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
                labels: ['BPJS', 'Umum'],
                datasets: [{
                    data: [{{ $totalBpjs ?? 0 }}, {{ $totalUmum ?? 0 }}]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</x-app-layout>
