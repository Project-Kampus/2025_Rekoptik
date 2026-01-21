<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Data Medis
            </h2>
            <div class="text-sm text-gray-600">
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-semibold">
                    Step 2 of 2
                </span>
            </div>
        </div>
    </x-slot>

    <!-- Identitas Pasien -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-200 p-6 shadow-sm">
        <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            Identitas Pasien
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded p-4 border-l-4 border-blue-500">
                <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Nama Pasien</p>
                <p class="text-lg font-semibold text-gray-800">{{ $pasien->nama_pasien }}</p>
            </div>
            <div class="bg-white rounded p-4 border-l-4 border-green-500">
                <p class="text-xs font-semibold text-gray-500 uppercase mb-1">No HP</p>
                <p class="text-lg font-semibold text-gray-800">{{ $pasien->no_hp ?? '-' }}</p>
            </div>
            <div class="bg-white rounded p-4 border-l-4 border-purple-500">
                <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Kategori</p>
                <p class="text-lg font-semibold text-gray-800 uppercase">{{ $pasien->kategori }}</p>
            </div>
            <div class="bg-white rounded p-4 border-l-4 border-orange-500">
                <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Umur</p>
                <p class="text-lg font-semibold text-gray-800">{{ $pasien->umur ?? '-' }} Tahun</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('datamedis.store.step2', $pasien->id) }}" class="space-y-3">
        @csrf

        <!-- Data Pemeriksaan -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <h3 class="text-lg font-bold text-gray-800 mb-5 flex items-center pb-4 border-b-2 border-gray-100">
                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                    <path fill-rule="evenodd"
                        d="M4 5a2 2 0 012-2 1 1 0 000-2H2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V9a1 1 0 10-2 0v8H4V5zm12-3a1 1 0 000 2h2a1 1 0 100-2h-2z"
                        clip-rule="evenodd"></path>
                </svg>
                Data Pemeriksaan
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                <div>
                    <x-input-label value="No. SEP" />
                    <x-form-input name="no_sep" class="w-full" value="{{ old('no_sep') }}" required />
                </div>
                <div>
                    <x-input-label value="Kebiasaan/Pekerjaan" />
                    <x-form-input name="kebiasaan" class="w-full" value="{{ old('kebiasaan') }}" required />
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5">
                <div>
                    <x-input-label value="Keluhan Utama" />
                    <textarea name="keluhan_utama"
                        class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Deskripsi keluhan utama pasien..."></textarea>
                </div>
                <div>
                    <x-input-label value="Diagnosa" />
                    <textarea name="diagnosa"
                        class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Hasil diagnosa pemeriksaan...">{{ old('diagnosa') }}</textarea>
                </div>
                <div>
                    <x-input-label value="Riwayat Penyakit" />
                    <textarea name="riwayat_penyakit"
                        class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Riwayat penyakit sebelumnya..."></textarea>
                </div>
                <div>
                    <x-input-label value="Penyakit Sekarang" />
                    <textarea name="penyakit_sekarang"
                        class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Kondisi kesehatan saat ini..."></textarea>
                </div>
                <div>
                    <x-input-label value="Penyakit Keluarga" />
                    <textarea name="penyakit_keluarga"
                        class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Riwayat penyakit dalam keluarga..."></textarea>
                </div>
                <div>
                    <x-input-label value="Pengobatan" />
                    <textarea name="pengobatan"
                        class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Riwayat pengobatan atau alergi..."></textarea>
                </div>
            </div>
        </div>

        <!-- Resep Kacamata -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <h3 class="text-lg font-bold text-gray-800 mb-5 flex items-center pb-4 border-b-2 border-gray-100">
                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z">
                    </path>
                </svg>
                Resep Kacamata
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                <div>
                    <x-input-label value="Resep Dari" />
                    <x-form-input name="resep_dari" class="w-full" value="{{ old('resep_dari') }}"
                        placeholder="Nama dokter/optometris..." required />
                </div>
                <div>
                    <x-input-label value="Tanggal Resep" />
                    <x-form-input name="resep_tanggal" type="date" class="w-full" value="{{ old('resep_tanggal') }}"
                        required />
                </div>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full text-sm">
                    <thead class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Mata</th>
                            <th class="px-4 py-3 text-left font-semibold">SPH</th>
                            <th class="px-4 py-3 text-left font-semibold">CYL</th>
                            <th class="px-4 py-3 text-left font-semibold">AXIS</th>
                            <th class="px-4 py-3 text-left font-semibold">ADD</th>
                            <th class="px-4 py-3 text-left font-semibold">PD</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach (['kanan' => 'Mata Kanan (OD)', 'kiri' => 'Mata Kiri (OS)'] as $key => $label)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 font-semibold text-gray-700">{{ $label }}</td>
                                <td class="px-4 py-3">
                                    <x-form-input name="resep[{{ $key }}][sph]" class="w-full text-center"
                                        placeholder="0.00" required />
                                </td>
                                <td class="px-4 py-3">
                                    <x-form-input name="resep[{{ $key }}][cyl]" class="w-full text-center"
                                        placeholder="0.00" required />
                                </td>
                                <td class="px-4 py-3">
                                    <x-form-input name="resep[{{ $key }}][axis]" class="w-full text-center"
                                        placeholder="0" required />
                                </td>
                                <td class="px-4 py-3">
                                    <x-form-input name="resep[{{ $key }}][add]" class="w-full text-center"
                                        placeholder="0.00" required />
                                </td>
                                <td class="px-4 py-3">
                                    <x-form-input name="resep[{{ $key }}][pd]" class="w-full text-center"
                                        placeholder="0.00" required />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pesanan -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <h3 class="text-lg font-bold text-gray-800 mb-5 flex items-center pb-4 border-b-2 border-gray-100">
                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z">
                    </path>
                </svg>
                Pesanan
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <div>
                    <x-input-label value="Frame" />
                    <x-form-select class="w-full" name="frame_id" :options="$frame" labelKey="merk"
                        extraLabel="kode_frame" placeholder="Pilih Frame" />
                </div>
                <div>
                    <x-input-label value="Lensa" />
                    <x-form-select class="w-full" name="lensa_id" :options="$lensa" labelKey="nama_lensa"
                        placeholder="Pilih Lensa" />
                </div>
                <div>
                    <x-input-label value="Aksesoris" />
                    <x-form-select class="w-full" name="aksesoris_id" :options="$aksesoris" labelKey="nama"
                        placeholder="Pilih Akseoris" />
                </div>
                <div>
                    <x-input-label value="Biaya (Rp)" />
                    <x-form-input name="biaya_kacamata" class="w-full" type="number"
                        value="{{ old('biaya_kacamata') }}" placeholder="0" required />
                </div>
                <div>
                    <x-input-label value="Tanggal Pemesanan" />
                    <x-form-input name="tanggal_dipesan" type="date" class="w-full"
                        value="{{ old('tanggal_dipesan') }}" required />
                </div>
                <div>
                    <x-input-label value="Tanggal Pengambilan" />
                    <x-form-input name="tanggal_pengambilan" type="date" class="w-full"
                        value="{{ old('tanggal_pengambilan') }}" required />
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center gap-4">
            <a href="{{ route('datamedis.index') }}"
                class="inline-flex items-center px-6 py-2.5 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                    </path>
                </svg>
                Kembali
            </a>
            <x-primary-button class="px-6 py-2.5">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                    </path>
                </svg>
                Simpan Pemesanan
            </x-primary-button>
        </div>

    </form>

    <script src="{{ asset('app/dummy/datamedis_create_step2.js') }}"></script>
</x-app-layout>
