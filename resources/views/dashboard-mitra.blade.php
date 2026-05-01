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
            <p class="text-sm text-gray-500">Kunjungan Bulan Ini</p>
            <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $kunjunganBulanIni }}</p>
            <p class="mt-2 text-sm text-gray-500">Total pemeriksaan {{ $categoryLabel }} bulan ini.</p>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-sm text-gray-500">Pesanan Belum Diambil</p>
            <p class="mt-3 text-3xl font-semibold text-rose-600">{{ $belumDiambil }}</p>
            <p class="mt-2 text-sm text-gray-500">Pesanan {{ $categoryLabel }} yang masih dalam status dipesan.</p>
        </div>
    </div>

    <!-- Grafik Kunjungan Bulanan -->
    <div class="mt-6 rounded-xl border border-gray-200 bg-white p-6">
        <h3 class="mb-4 text-lg font-semibold text-gray-900">Grafik Kunjungan Bulanan - Tahun Ini</h3>
        <div style="height: 300px;">
            <canvas id="kunjunganChart"></canvas>
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
            @elseif ($category === 'asuransi')
                <a href="{{ route('mitra.asuransi.index') }}"
                    class="inline-flex items-center rounded-full bg-amber-600 px-4 py-2 text-sm font-semibold text-white hover:bg-amber-700">
                    Buka Rekap Asuransi
                </a>
            @else
                <div class="rounded-2xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-700">
                    Fitur rekap akan ditampilkan sesuai kategori Anda.
                </div>
            @endif
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('kunjunganChart').getContext('2d');
        const grafikData = @json($grafikData);
        const bulanNames = @json($bulanNames);

        // Menggunakan label bulan (Januari - Desember)
        const labels = bulanNames;

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Kunjungan {{ $categoryLabel }}',
                    data: grafikData,
                    backgroundColor: '{{ $category === 'bpjs' ? '#2563eb' : '#b45309' }}',
                    borderColor: '{{ $category === 'bpjs' ? '#1d4ed8' : '#92400e' }}',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
