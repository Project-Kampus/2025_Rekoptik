<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900">
                    Buat Data Medis
                </h2>
                <p class="text-sm text-gray-500 mt-1">Langkah 2: Riwayat Medis & Pesanan</p>
            </div>

        </div>
    </x-slot>

    <!-- Identitas Pasien -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="mb-4">
            <h3 class="text-base font-bold text-gray-900 mb-4">
                Data Pasien
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-lg p-4 border border-indigo-200">
                <p class="text-xs font-semibold text-indigo-600 uppercase mb-1">Nama Pasien</p>
                <p class="text-base font-semibold text-gray-900">{{ $pasien->nama_pasien }}</p>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 border border-blue-200">
                <p class="text-xs font-semibold text-blue-600 uppercase mb-1">No HP</p>
                <p class="text-base font-semibold text-gray-900">{{ $pasien->no_hp ?? '-' }}</p>
            </div>
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4 border border-purple-200">
                <p class="text-xs font-semibold text-purple-600 uppercase mb-1">Kategori</p>
                <p class="text-base font-semibold text-gray-900">{{ ucfirst($pasien->kategori) }}</p>
            </div>
            <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-lg p-4 border border-emerald-200">
                <p class="text-xs font-semibold text-emerald-600 uppercase mb-1">Umur</p>
                <p class="text-base font-semibold text-gray-900">{{ $pasien->umur ?? '-' }} Tahun</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('datamedis.store.step2', $pasien->id) }}" class="space-y-3">
        @csrf

        <!-- Data Pemeriksaan -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 m-0">
            <div class="mb-6">
                <h3 class="text-base font-bold text-gray-900 mb-4 pb-3 border-b border-gray-200">
                    Data Pemeriksaan
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                <div>
                    <x-input-label value="No. SEP" class="font-semibold" />
                    <x-form-input name="no_sep" class="mt-2 w-full" value="{{ old('no_sep') }}"
                        placeholder="Masukkan nomor SEP" required />
                </div>
                <div>
                    <x-input-label value="Kebiasaan/Pekerjaan" class="font-semibold" />
                    <x-form-input name="kebiasaan" class="mt-2 w-full" value="{{ old('kebiasaan') }}"
                        placeholder="Masukkan kebiasaan/pekerjaan" required />
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <x-input-label value="Keluhan Utama" class="font-semibold" />
                    <textarea name="keluhan_utama"
                        class="mt-2 w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-3 transition-colors"
                        rows="3" placeholder="Deskripsi keluhan utama pasien...">{{ old('keluhan_utama') }}</textarea>
                </div>
                <div>
                    <x-input-label value="Diagnosa" class="font-semibold" />
                    <textarea name="diagnosa"
                        class="mt-2 w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-3 transition-colors"
                        rows="3" placeholder="Hasil diagnosa pemeriksaan...">{{ old('diagnosa') }}</textarea>
                </div>
                <div>
                    <x-input-label value="Riwayat Penyakit" class="font-semibold" />
                    <textarea name="riwayat_penyakit"
                        class="mt-2 w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-3 transition-colors"
                        rows="3" placeholder="Riwayat penyakit sebelumnya...">{{ old('riwayat_penyakit') }}</textarea>
                </div>
                <div>
                    <x-input-label value="Penyakit Sekarang" class="font-semibold" />
                    <textarea name="penyakit_sekarang"
                        class="mt-2 w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-3 transition-colors"
                        rows="3" placeholder="Kondisi kesehatan saat ini...">{{ old('penyakit_sekarang') }}</textarea>
                </div>
                <div>
                    <x-input-label value="Penyakit Keluarga" class="font-semibold" />
                    <textarea name="penyakit_keluarga"
                        class="mt-2 w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-3 transition-colors"
                        rows="3" placeholder="Riwayat penyakit dalam keluarga...">{{ old('penyakit_keluarga') }}</textarea>
                </div>
                <div>
                    <x-input-label value="Pengobatan" class="font-semibold" />
                    <textarea name="pengobatan"
                        class="mt-2 w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-3 transition-colors"
                        rows="3" placeholder="Riwayat pengobatan atau alergi...">{{ old('pengobatan') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Resep Kacamata -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="mb-6">
                <h3 class="text-base font-bold text-gray-900 mb-4 pb-3 border-b border-gray-200">
                    Resep Kacamata
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <x-input-label value="Resep Dari" class="font-semibold" />
                    <x-form-input name="resep_dari" class="mt-2 w-full" value="{{ old('resep_dari') }}"
                        placeholder="Nama dokter/optometris..." required />
                </div>
                <div>
                    <x-input-label value="Tanggal Resep" class="font-semibold" />
                    <x-form-input name="resep_tanggal" type="date" class="mt-2 w-full"
                        value="{{ old('resep_tanggal') }}" required />
                </div>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full text-sm">
                    <thead class="bg-gradient-to-r  from-indigo-600 to-indigo-700 text-white">
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
                            <tr class="hover:bg-indigo-50 transition-colors duration-150">
                                <td class="px-4 py-3 font-semibold text-gray-900">{{ $label }}</td>
                                <td class="px-4 py-3">
                                    <x-form-input name="resep[{{ $key }}][sph]" type="number"
                                        step="0.01" class="w-full text-center" placeholder="0.00"
                                        value="{{ old('resep.' . $key . '.sph') }}" required />
                                </td>
                                <td class="px-4 py-3">
                                    <x-form-input name="resep[{{ $key }}][cyl]" type="number"
                                        step="0.01" class="w-full text-center" placeholder="0.00"
                                        value="{{ old('resep.' . $key . '.cyl') }}" required />
                                </td>
                                <td class="px-4 py-3">
                                    <x-form-input name="resep[{{ $key }}][axis]" type="number"
                                        step="0.01" class="w-full text-center" placeholder="0"
                                        value="{{ old('resep.' . $key . '.axis') }}" required />
                                </td>
                                <td class="px-4 py-3">
                                    <x-form-input name="resep[{{ $key }}][add]" type="number"
                                        step="0.01" class="w-full text-center" placeholder="0.00"
                                        value="{{ old('resep.' . $key . '.add') }}" required />
                                </td>
                                <td class="px-4 py-3">
                                    <x-form-input name="resep[{{ $key }}][pd]" type="number"
                                        step="0.01" class="w-full text-center" placeholder="0.00"
                                        value="{{ old('resep.' . $key . '.pd') }}" required />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pesanan -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="mb-6">
                <h3 class="text-base font-bold text-gray-900 mb-4 pb-3 border-b border-gray-200">
                    Pesanan
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <x-input-label value="Frame" class="font-semibold" />
                    <x-form-select-search class="mt-2 w-full" name="frame_id" :options="$frame" labelKey="kode_frame"
                        valueKey="id" :extraLabels="['merk', 'harga']" placeholder="Pilih Frame" />
                </div>
                <div>
                    <x-input-label value="Lensa" class="font-semibold" />
                    <x-form-select-search class="mt-2 w-full" name="lensa_id" :options="$lensa" labelKey="nama_lensa"
                        valueKey="id" :extraLabels="['harga']" placeholder="Pilih Lensa" />
                </div>
                <div>
                    <x-input-label value="Aksesoris" class="font-semibold" />
                    <x-form-multiselect name="aksesoris_id" :options="$aksesoris" labelKey="nama"
                        placeholder="Pilih Aksesoris" />
                </div>
                <div>
                    <x-input-label value="Biaya (Rp)" class="font-semibold" />
                    <x-form-input name="biaya_kacamata" class="mt-2 w-full" type="rupiah"
                        value="{{ old('biaya_kacamata') }}" placeholder="0" required />
                </div>
                <div>
                    <x-input-label value="Tanggal Pemesanan" class="font-semibold" />
                    <x-form-input name="tanggal_dipesan" type="date" class="mt-2 w-full"
                        value="{{ old('tanggal_dipesan') }}" required />
                </div>
                <div>
                    <x-input-label value="Tanggal Pengambilan" class="font-semibold" />
                    <x-form-input name="tanggal_pengambilan" type="date" class="mt-2 w-full"
                        value="{{ old('tanggal_pengambilan') }}" required />
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div
            class="bg-white rounded-lg shadow-sm border flex justify-between items-center gap-4 px-6 py-3 border-gray-200">
            <a href="{{ route('datamedis.index', ['status' => 'dipesan']) }}"
                class="inline-flex items-center px-6 py-2.5 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-150">
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
