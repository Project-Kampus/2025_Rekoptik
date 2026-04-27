<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900">
                    Buat Data Medis
                </h2>
                <p class="text-sm text-gray-500 mt-1">Langkah 1: Identifikasi Data Pasien</p>
            </div>
        </div>
    </x-slot>

    <!-- Pilihan -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-900 mb-2">
                Apakah biodata pasien sudah terdaftar?
            </h3>
            <p class="text-sm text-gray-600">Pilih opsi di bawah untuk melanjutkan</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <label
                class="flex items-start gap-4 p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-all duration-200 group">
                <input type="radio" name="biodata_exists" value="1" class="text-indigo-600 mt-1"
                    onchange="toggleForms()" {{ $action == 'search' ? 'checked' : '' }}>
                <div class="flex-1">
                    <p class="font-semibold text-gray-900">Pasien Sudah Terdaftar</p>
                    <p class="text-sm text-gray-600 mt-1">Cari dan pilih pasien dari database yang ada</p>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-600 transition-colors" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
            </label>

            <label
                class="flex items-start gap-4 p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-emerald-400 hover:bg-emerald-50 transition-all duration-200 group">
                <input type="radio" name="biodata_exists" value="0" class="text-indigo-600 mt-1"
                    onchange="toggleForms()">
                <div class="flex-1">
                    <p class="font-semibold text-gray-900">Pasien Baru</p>
                    <p class="text-sm text-gray-600 mt-1">Daftarkan pasien baru dengan biodata lengkap</p>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition-colors" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z"
                        clip-rule="evenodd" />
                </svg>
            </label>
        </div>
    </div>

    <!-- SEARCH -->
    <div id="searchForm" class="{{ $action == 'search' ? '' : 'hidden' }} space-y-4">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-2">
                    Cari Data Pasien
                </h3>
                <p class="text-sm text-gray-600">Masukkan nama pasien untuk mencari data yang ada</p>
            </div>

            <form method="get" action="{{ route('datamedis.create.step1') }}" class="space-y-4">
                <div class="flex gap-3">
                    <div class="flex-1">
                        <x-input-label for="nama_pasien" value="Nama Pasien" />
                        <x-form-input id="nama_pasien" name="nama_pasien" class="mt-2 w-full"
                            placeholder="Ketik nama pasien..." value="{{ $nama_pasien }}" />
                    </div>
                    <div class="flex items-end gap-2">
                        <input type="hidden" name="action" value="search">
                        <x-primary-button class="whitespace-nowrap">
                            <svg class="w-4 h-4 mr-2 inline" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                            Cari
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>

        @if (isset($pasien))
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="mb-4">
                    <h4 class="text-lg font-bold text-gray-900 mb-2">Hasil Pencarian</h4>
                </div>

                @if ($pasien->isEmpty())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <p class="text-sm text-red-700 font-medium">Pasien tidak ditemukan</p>
                        <p class="text-xs text-red-600 mt-1">Coba gunakan nama lain atau daftarkan pasien baru</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                                    <th class="px-4 py-3 text-left font-semibold text-gray-900">Nama Pasien</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-900">No Kartu</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-900">Kategori</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-900">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($pasien as $p)
                                    <tr class="hover:bg-indigo-50 transition-colors duration-150">
                                        <td class="px-4 py-3">
                                            <p class="font-medium text-gray-900">{{ $p->nama_pasien }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">{{ $p->no_kartu ?? '-' }}</td>
                                        <td class="px-4 py-3">
                                            @if ($p->kategori === 'bpjs')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    BPJS
                                                </span>
                                            @elseif($p->kategori === 'asuransi')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                    Asuransi
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    Umum
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('datamedis.create.step2', $p->id) }}"
                                                class="inline-flex items-center gap-2 px-3 py-1.5 bg-indigo-600 text-white text-xs font-medium rounded-lg hover:bg-indigo-700 transition-colors duration-150">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L9 4.414V16a1 1 0 102 0V4.414l6.293 6.293a1 1 0 001.414-1.414l-7-7z" />
                                                </svg>
                                                Pilih
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @endif
    </div>


    <!-- CREATE -->
    <div id="createForm" class="hidden">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-2">
                    Biodata Pasien Baru
                </h3>
                <p class="text-sm text-gray-600">Isi formulir di bawah dengan data lengkap pasien</p>
            </div>

            <form method="post" action="{{ route('datamedis.store.step1') }}" class="space-y-8">
                @csrf

                <!-- Informasi Dasar -->
                <div>
                    <h4 class="text-base font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                        Informasi Dasar
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <x-input-label value="Nama Pasien" class="font-semibold" />
                            <x-form-input name="nama_pasien" class="mt-2 w-full" placeholder="Masukkan nama lengkap"
                                required />
                        </div>

                        <div>
                            <x-input-label value="Tanggal Lahir" class="font-semibold" />
                            <x-form-input name="tanggal_lahir" type="date" class="mt-2 w-full" required />
                        </div>

                        <div>
                            <x-input-label value="No HP (Opsional)" class="font-semibold" />
                            <x-form-input name="no_hp" type="tel" inputmode="numeric" pattern="[0-9]*"
                                class="mt-2 w-full" placeholder="08xxxxxxxxxx"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                        </div>

                        <div class="lg:col-span-2">
                            <x-input-label value="Email (Opsional)" class="font-semibold" />
                            <x-form-input name="email" type="email" class="mt-2 w-full"
                                placeholder="pasien@example.com" />
                        </div>

                        <div>
                            <x-input-label value="Alamat (Opsional)" class="font-semibold" />
                            <x-form-input name="alamat" class="mt-2 w-full" placeholder="Jl. Contoh No 123" />
                        </div>
                    </div>
                </div>

                <!-- Informasi Asuransi -->
                <div>
                    <h4 class="text-base font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                        Informasi Asuransi & Kategori
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <x-input-label value="Kategori" class="font-semibold" />
                            <select name="kategori" id="kategori"
                                class="mt-2 w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                                onchange="toggleKartuKelas()">
                                <option value="umum" selected>Umum</option>
                                <option value="bpjs">BPJS</option>
                                <option value="asuransi">Asuransi</option>
                            </select>
                        </div>

                        <div id="noKartuDiv" class="hidden">
                            <x-input-label value="No Kartu" class="font-semibold" />
                            <x-form-input name="no_kartu" type="number" class="mt-2 w-full"
                                placeholder="Nomor kartu asuransi" />
                        </div>

                        <div id="kelasDiv" class="hidden">
                            <x-input-label value="Kelas" class="font-semibold" />
                            <select name="kelas"
                                class="mt-2 w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                                <option value="">Tidak Ada</option>
                                <option value="1">Kelas 1</option>
                                <option value="2">Kelas 2</option>
                                <option value="3">Kelas 3</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Button -->
                <div class="flex justify-between pt-6 border-t border-gray-200">
                    <button type="reset"
                        class="px-6 py-2.5 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-150">
                        Reset
                    </button>
                    <x-primary-button class="px-6 py-2.5">
                        <svg class="w-4 h-4 mr-2 inline" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                        </svg>
                        Simpan & Lanjut
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function toggleForms() {
            const value = document.querySelector('input[name="biodata_exists"]:checked')?.value;
            const searchForm = document.getElementById('searchForm');
            const createForm = document.getElementById('createForm');

            if (value === '1') {
                searchForm.classList.remove('hidden');
                searchForm.classList.add('animate-fade-in');
                createForm.classList.add('hidden');
                createForm.classList.remove('animate-fade-in');
            } else if (value === '0') {
                createForm.classList.remove('hidden');
                createForm.classList.add('animate-fade-in');
                searchForm.classList.add('hidden');
                searchForm.classList.remove('animate-fade-in');
            }
        }

        function toggleKartuKelas() {
            const kategori = document.getElementById('kategori').value;
            const noKartuDiv = document.getElementById('noKartuDiv');
            const kelasDiv = document.getElementById('kelasDiv');
            const noKartuInput = noKartuDiv.querySelector('input');
            const kelasSelect = kelasDiv.querySelector('select');

            if (kategori === 'umum' || kategori === 'asuransi') {
                noKartuDiv.classList.add('hidden');
                noKartuInput.value = '';
                noKartuInput.removeAttribute('required');
                kelasDiv.classList.add('hidden');
                kelasSelect.value = '';
            } else if (kategori === 'bpjs') {
                noKartuDiv.classList.remove('hidden');
                noKartuInput.setAttribute('required', 'required');
                kelasDiv.classList.remove('hidden');
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleKartuKelas();

            // Add smooth scroll behavior
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Custom select styling */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            padding-right: 2.5rem;
        }

        /* Input focus styles */
        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
        }
    </style>
</x-app-layout>
