<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Data Medis
            </h2>
            <a href="{{ route('datamedis.show', $RmPemeriksaan->id) }}"
                class="text-sm text-gray-600 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-md">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <!-- Identitas Pasien -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-200 p-6 shadow-sm mb-6">
        <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            Identitas Pasien
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded p-4 border-l-4 border-blue-500">
                <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Nama Pasien</p>
                <p class="text-lg font-semibold text-gray-800">{{ $RmPemeriksaan->pasien->nama_pasien }}</p>
            </div>
            <div class="bg-white rounded p-4 border-l-4 border-green-500">
                <p class="text-xs font-semibold text-gray-500 uppercase mb-1">No HP</p>
                <p class="text-lg font-semibold text-gray-800">{{ $RmPemeriksaan->pasien->no_hp ?? '-' }}</p>
            </div>
            <div class="bg-white rounded p-4 border-l-4 border-purple-500">
                <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Kategori</p>
                <p class="text-lg font-semibold text-gray-800 uppercase">{{ $RmPemeriksaan->pasien->kategori }}</p>
            </div>
            <div class="bg-white rounded p-4 border-l-4 border-orange-500">
                <p class="text-xs font-semibold text-gray-500 uppercase mb-1">Umur</p>
                <p class="text-lg font-semibold text-gray-800">{{ $RmPemeriksaan->pasien->umur ?? '-' }} Tahun</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('datamedis.update', $RmPemeriksaan->id) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Data Pemeriksaan -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
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
                    <x-input-label for="no_sep" value="No. SEP" />
                    <x-form-input id="no_sep" name="no_sep" class="w-full"
                        value="{{ old('no_sep', $RmPemeriksaan->no_sep) }}" required />
                    <x-input-error :messages="$errors->get('no_sep')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="kebiasaan" value="Kebiasaan/Pekerjaan" />
                    <x-form-input id="kebiasaan" name="kebiasaan" class="w-full"
                        value="{{ old('kebiasaan', $RmPemeriksaan->kebiasaan) }}" required />
                    <x-input-error :messages="$errors->get('kebiasaan')" class="mt-2" />
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5">
                <div>
                    <x-input-label for="keluhan_utama" value="Keluhan Utama" />
                    <textarea id="keluhan_utama" name="keluhan_utama"
                        class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Deskripsi keluhan utama pasien..." required>{{ old('keluhan_utama', $RmPemeriksaan->keluhan_utama) }}</textarea>
                    <x-input-error :messages="$errors->get('keluhan_utama')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="diagnosa" value="Diagnosa" />
                    <textarea id="diagnosa" name="diagnosa"
                        class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Hasil diagnosa pemeriksaan..." required>{{ old('diagnosa', $RmPemeriksaan->diagnosa) }}</textarea>
                    <x-input-error :messages="$errors->get('diagnosa')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="riwayat_penyakit" value="Riwayat Penyakit" />
                    <textarea id="riwayat_penyakit" name="riwayat_penyakit"
                        class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Riwayat penyakit sebelumnya..." required>{{ old('riwayat_penyakit', $RmPemeriksaan->riwayat_penyakit) }}</textarea>
                    <x-input-error :messages="$errors->get('riwayat_penyakit')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="penyakit_sekarang" value="Penyakit Sekarang" />
                    <textarea id="penyakit_sekarang" name="penyakit_sekarang"
                        class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Kondisi kesehatan saat ini..." required>{{ old('penyakit_sekarang', $RmPemeriksaan->penyakit_sekarang) }}</textarea>
                    <x-input-error :messages="$errors->get('penyakit_sekarang')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="penyakit_keluarga" value="Penyakit Keluarga" />
                    <textarea id="penyakit_keluarga" name="penyakit_keluarga"
                        class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Riwayat penyakit dalam keluarga..." required>{{ old('penyakit_keluarga', $RmPemeriksaan->penyakit_keluarga) }}</textarea>
                    <x-input-error :messages="$errors->get('penyakit_keluarga')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="pengobatan" value="Pengobatan" />
                    <textarea id="pengobatan" name="pengobatan"
                        class="mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Riwayat pengobatan atau alergi..." required>{{ old('pengobatan', $RmPemeriksaan->pengobatan) }}</textarea>
                    <x-input-error :messages="$errors->get('pengobatan')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Resep Kacamata -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
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
                    <x-input-label for="resep_dari" value="Resep Dari" />
                    <x-form-input id="resep_dari" name="resep_dari" class="w-full"
                        value="{{ old('resep_dari', $RmPemeriksaan->resep->resep_dari) }}"
                        placeholder="Nama dokter/optometris..." required />
                    <x-input-error :messages="$errors->get('resep_dari')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="resep_tanggal" value="Tanggal Resep" />
                    <x-form-input id="resep_tanggal" name="resep_tanggal" type="date" class="w-full"
                        value="{{ old('resep_tanggal', $RmPemeriksaan->resep->tanggal) }}" required />
                    <x-input-error :messages="$errors->get('resep_tanggal')" class="mt-2" />
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
                        @php
                            $mata = [
                                'kanan' => [
                                    'label' => 'Mata Kanan (OD)',
                                    'fields' => ['od_sferis', 'od_silindris', 'od_axis', 'od_add_lensa', 'pd_od'],
                                ],
                                'kiri' => [
                                    'label' => 'Mata Kiri (OS)',
                                    'fields' => ['os_sferis', 'os_silindris', 'os_axis', 'os_add_lensa', 'pd_os'],
                                ],
                            ];
                        @endphp
                        @foreach ($mata as $key => $data)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 font-semibold text-gray-700">{{ $data['label'] }}</td>
                                <td class="px-4 py-3">
                                    <input type="number" name="resep[{{ $key }}][sph]" step="0.01"
                                        value="{{ old("resep.$key.sph", $RmPemeriksaan->resep->{$data['fields'][0]}) }}"
                                        class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                        required />
                                </td>
                                <td class="px-4 py-3">
                                    <input type="number" name="resep[{{ $key }}][cyl]" step="0.01"
                                        value="{{ old("resep.$key.cyl", $RmPemeriksaan->resep->{$data['fields'][1]}) }}"
                                        class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                        required />
                                </td>
                                <td class="px-4 py-3">
                                    <input type="number" name="resep[{{ $key }}][axis]" step="1"
                                        value="{{ old("resep.$key.axis", $RmPemeriksaan->resep->{$data['fields'][2]}) }}"
                                        class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                        required />
                                </td>
                                <td class="px-4 py-3">
                                    <input type="number" name="resep[{{ $key }}][add]" step="0.01"
                                        value="{{ old("resep.$key.add", $RmPemeriksaan->resep->{$data['fields'][3]}) }}"
                                        class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                        required />
                                </td>
                                <td class="px-4 py-3">
                                    <input type="number" name="resep[{{ $key }}][pd]" step="1"
                                        value="{{ old("resep.$key.pd", $RmPemeriksaan->resep->{$data['fields'][4]}) }}"
                                        class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                        required />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pesanan Kacamata -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
            <h3 class="text-lg font-bold text-gray-800 mb-5 flex items-center pb-4 border-b-2 border-gray-100">
                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z">
                    </path>
                    <path d="M16 16a2 2 0 11-4 0 2 2 0 014 0zM4 12a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Pesanan Kacamata
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
                <div>
                    <x-input-label for="frame_id" value="Frame" />
                    <select id="frame_id" name="frame_id"
                        class="mt-1 block w-full rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                        <option value="">-- Pilih Frame --</option>
                        @foreach ($frames as $frame)
                            <option value="{{ $frame->id }}"
                                {{ old('frame_id', $RmPemeriksaan->pesanan->frame_id) == $frame->id ? 'selected' : '' }}>
                                {{ $frame->kode_frame }} - {{ $frame->merk }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('frame_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="lensa_id" value="Lensa" />
                    <select id="lensa_id" name="lensa_id"
                        class="mt-1 block w-full rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                        <option value="">-- Pilih Lensa --</option>
                        @foreach ($lensas as $lensa)
                            <option value="{{ $lensa->id }}"
                                {{ old('lensa_id', $RmPemeriksaan->pesanan->lensa_id) == $lensa->id ? 'selected' : '' }}>
                                {{ $lensa->nama_lensa }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('lensa_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="aksesoris_id" value="Aksesoris (bisa pilih lebih dari satu)" />
                    <x-form-multiselect name="aksesoris_id" :options="$aksesoris" labelKey="nama" :selected="$RmPemeriksaan->pesanan?->aksesoris->pluck('id')->toArray() ?? []"
                        placeholder="Pilih Aksesoris" />
                    <x-input-error :messages="$errors->get('aksesoris_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="biaya_kacamata" value="Biaya Kacamata (Rp)" />
                    <x-form-input id="biaya_kacamata" name="biaya_kacamata" type="number" class="w-full"
                        value="{{ old('biaya_kacamata', $RmPemeriksaan->pesanan->biaya_kacamata) }}" required />
                    <x-input-error :messages="$errors->get('biaya_kacamata')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="tanggal_dipesan" value="Tanggal Pemesanan" />
                    <x-form-input id="tanggal_dipesan" name="tanggal_dipesan" type="date" class="w-full"
                        value="{{ old('tanggal_dipesan', optional($RmPemeriksaan->pesanan)->tanggal_dipesan ? $RmPemeriksaan->pesanan->tanggal_dipesan->format('Y-m-d') : '') }}"
                        required />
                    <x-input-error :messages="$errors->get('tanggal_dipesan')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="tanggal_pengambilan" value="Tanggal Pengambilan" />
                    <x-form-input id="tanggal_pengambilan" name="tanggal_pengambilan" type="date" class="w-full"
                        value="{{ old('tanggal_pengambilan', optional($RmPemeriksaan->pesanan)->tanggal_pengambilan ? $RmPemeriksaan->pesanan->tanggal_pengambilan->format('Y-m-d') : '') }}"
                        required />
                    <x-input-error :messages="$errors->get('tanggal_pengambilan')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Tombol -->
        <div class="flex items-center gap-3 bg-white p-6 rounded-lg border border-gray-200">
            <x-primary-button>
                Simpan Perubahan
            </x-primary-button>

            <a href="{{ route('datamedis.show', $RmPemeriksaan->id) }}"
                class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-600 hover:bg-gray-50">
                Batal
            </a>
        </div>
    </form>
</x-app-layout>
