<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekoptik | Sistem Rekap Data Medis Optik</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-xl font-semibold text-indigo-600">
                Rekoptik
            </div>

            <div>
                <a href="{{ route('login') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                    Login
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <h1 class="text-4xl font-bold leading-tight mb-6">
                Sistem Rekap Data<br>
                <span class="text-indigo-600">Medis Optik Digital</span>
            </h1>

            <p class="text-gray-600 mb-8">
                Rekoptik membantu klinik optik dan tenaga kesehatan mata
                dalam mencatat, mengelola, dan merekap data pemeriksaan
                pasien secara terstruktur, aman, dan efisien.
            </p>

            <div class="flex gap-4">
                <a href="{{ route('login') }}"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition">
                    Masuk Sistem
                </a>

                <a href="#fitur"
                    class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-100 transition">
                    Lihat Fitur
                </a>
            </div>
        </div>

        <!-- Ilustrasi -->
        <div class="hidden md:flex justify-center">
            <div class="bg-indigo-100 rounded-2xl p-10">
                <svg class="w-48 h-48 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 12h6m-6 4h6M7 8h10M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                </svg>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="fitur" class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-center mb-12">
                Fitur Utama Rekoptik
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 rounded-xl border hover:shadow transition">
                    <h3 class="font-semibold mb-2">Manajemen Pasien</h3>
                    <p class="text-gray-600 text-sm">
                        Kelola data pasien optik secara terstruktur dan aman.
                    </p>
                </div>

                <div class="p-6 rounded-xl border hover:shadow transition">
                    <h3 class="font-semibold mb-2">Rekap Pemeriksaan</h3>
                    <p class="text-gray-600 text-sm">
                        Simpan dan lihat riwayat pemeriksaan mata dengan mudah.
                    </p>
                </div>

                <div class="p-6 rounded-xl border hover:shadow transition">
                    <h3 class="font-semibold mb-2">Akses Aman</h3>
                    <p class="text-gray-600 text-sm">
                        Sistem login aman berbasis autentikasi Laravel.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 py-6">
        <div class="max-w-7xl mx-auto px-6 text-center text-sm text-gray-500">
            © {{ date('Y') }} Rekoptik. Sistem Rekap Data Medis Optik.
        </div>
    </footer>

</body>

</html>