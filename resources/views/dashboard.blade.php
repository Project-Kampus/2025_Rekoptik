<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- <x-slot name="headerAction">
        <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
            + Tambah
        </a>
    </x-slot> --}}

    <!-- Content -->
    <div class="bg-white rounded-lg border p-6">
        <h2 class="font-semibold mb-2">Statistik</h2>
        <p class="text-sm text-gray-600">
            Ringkasan data sistem ditampilkan di sini.
        </p>
    </div>

    <div class="bg-white rounded-lg border p-6">
        <h2 class="font-semibold mb-2">Aktivitas Terbaru</h2>
        <p class="text-sm text-gray-600">
            Riwayat aktivitas pengguna.
        </p>
    </div>

</x-app-layout>