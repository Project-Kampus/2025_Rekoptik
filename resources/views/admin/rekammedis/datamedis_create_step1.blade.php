<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Create Data Medis – Step 1
        </h2>
    </x-slot>

    <!-- Pilihan -->
    <div class="bg-white rounded-xl border p-6">
        <h3 class="text-base font-semibold text-gray-800 mb-4">
            Apakah biodata pasien sudah terdaftar?
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <label class="flex items-center gap-3 p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                <input type="radio" name="biodata_exists" value="1" class="text-indigo-600" onchange="toggleForms()"
                    {{ $action == 'search' ? 'checked' : '' }}>
                <div>
                    <p class="font-medium">Sudah Ada</p>
                    <p class="text-sm text-gray-500">Cari pasien yang sudah terdaftar</p>
                </div>
            </label>

            <label class="flex items-center gap-3 p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                <input type="radio" name="biodata_exists" value="0" class="text-indigo-600"
                    onchange="toggleForms()">
                <div>
                    <p class="font-medium">Belum Ada</p>
                    <p class="text-sm text-gray-500">Input biodata pasien baru</p>
                </div>
            </label>
        </div>
    </div>

    <!-- SEARCH -->
    <div id="searchForm" class="{{ $action == 'search' ? '' : 'hidden' }} space-y-4">
        <div class="bg-white rounded-xl border p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Cari Data Pasien
            </h3>

            <form method="get" action="{{ route('datamedis.create.step1') }}" class="space-y-4">
                <div>
                    <x-input-label for="nama_pasien" value="Nama Pasien" />
                    <x-form-input id="nama_pasien" name="nama_pasien" class="mt-1 w-full"
                        placeholder="Masukkan nama pasien" value="{{ $nama_pasien }}" />
                </div>

                <input type="hidden" name="action" value="search">

                <div class="flex justify-end">
                    <x-primary-button>Cari</x-primary-button>
                </div>
            </form>
        </div>
        @if (isset($pasien))
            <div class="bg-white rounded-xl border p-6">
                <h4 class="font-semibold text-gray-700 mb-3">Hasil Pencarian</h4>

                @if ($pasien->isEmpty())
                    <p class="text-sm text-red-500">Pasien tidak ditemukan</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm border">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left">Nama</th>
                                    <th class="px-4 py-2 text-left">No Kartu</th>
                                    <th class="px-4 py-2 text-left">Kategori</th>
                                    <th class="px-4 py-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pasien as $p)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ $p->nama_pasien }}</td>
                                        <td class="px-4 py-2">{{ $p->no_kartu ?? '-' }}</td>
                                        <td class="px-4 py-2 uppercase">{{ $p->kategori }}</td>
                                        <td class="px-4 py-2 text-center">
                                            <a href="{{ route('datamedis.create.step2', $p->id) }}"
                                                class="px-2 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700">
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
        <div class="bg-white rounded-xl border p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Biodata Pasien Baru
            </h3>

            <form method="post" action="{{ route('datamedis.store.step1') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <x-input-label value="Nama Pasien" />
                        <x-form-input name="nama_pasien" class="mt-1 w-full" required />
                    </div>

                    <div>
                        <x-input-label value="No HP" />
                        <x-form-input name="no_hp" class="mt-1 w-full" />
                    </div>

                    <div>
                        <x-input-label value="Email" />
                        <x-form-input name="email" type="email" class="mt-1 w-full" />
                    </div>

                    <div>
                        <x-input-label value="Alamat" />
                        <x-form-input name="alamat" class="mt-1 w-full" />
                    </div>
                    <div>
                        <x-input-label value="Umur" />
                        <x-form-input name="umur" type="number" class="mt-1 w-full" />
                    </div>
                    <div>
                        <x-input-label value="Kategori" />
                        <select name="kategori" class="mt-1 w-full rounded-md border-gray-300">
                            <option value="umum">Umum</option>
                            <option value="bpjs">BPJS</option>
                            <option value="asuransi">Asuransi</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label value="No Kartu" />
                        <x-form-input name="no_kartu" type="number" class="mt-1 w-full" />
                    </div>

                    <div>
                        <x-input-label value="Kelas" />
                        <select name="kelas" class="mt-1 w-full rounded-md border-gray-300">
                            <option value="">Tidak Ada</option>
                            <option value="1">Kelas 1</option>
                            <option value="2">Kelas 2</option>
                            <option value="3">Kelas 3</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end">
                    <x-primary-button>
                        Simpan & Lanjut
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function toggleForms() {
            const value = document.querySelector('input[name="biodata_exists"]:checked')?.value;
            document.getElementById('searchForm').classList.toggle('hidden', value !== '1');
            document.getElementById('createForm').classList.toggle('hidden', value !== '0');
        }
    </script>
</x-app-layout>
