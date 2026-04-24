<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900">
                    Edit Data Medis
                </h2>
                <p class="text-sm text-gray-500 mt-1">Silakan edit data medis pasien di bawah ini.</p>
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
                <p class="text-base font-semibold text-gray-900">{{ $RmPemeriksaan->pasien->nama_pasien }}</p>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 border border-blue-200">
                <p class="text-xs font-semibold text-blue-600 uppercase mb-1">No HP</p>
                <p class="text-base font-semibold text-gray-900">{{ $RmPemeriksaan->pasien->no_hp ?? '-' }}</p>
            </div>
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4 border border-purple-200">
                <p class="text-xs font-semibold text-purple-600 uppercase mb-1">Kategori</p>
                <p class="text-base font-semibold text-gray-900">{{ ucfirst($RmPemeriksaan->pasien->kategori) }}</p>
            </div>
            <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-lg p-4 border border-emerald-200">
                <p class="text-xs font-semibold text-emerald-600 uppercase mb-1">Umur</p>
                <p class="text-base font-semibold text-gray-900">{{ $RmPemeriksaan->pasien->umur ?? '-' }} Tahun</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('datamedis.update', $RmPemeriksaan->id) }}" class="space-y-3">
        @csrf
        @method('PUT')

        <!-- Data Pemeriksaan -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
            <div class="mb-6">
                <h3 class="text-base font-bold text-gray-900 mb-4 pb-3 border-b border-gray-200">
                    Data Pemeriksaan
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                <div>
                    <x-input-label for="no_sep" value="No. SEP" class="font-semibold" />
                    <x-form-input id="no_sep" name="no_sep" class="w-full mt-2"
                        value="{{ old('no_sep', $RmPemeriksaan->no_sep) }}" required />
                    <x-input-error :messages="$errors->get('no_sep')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="kebiasaan" value="Kebiasaan/Pekerjaan" class="font-semibold" />
                    <x-form-input id="kebiasaan" name="kebiasaan" class="w-full mt-2"
                        value="{{ old('kebiasaan', $RmPemeriksaan->kebiasaan) }}" required />
                    <x-input-error :messages="$errors->get('kebiasaan')" class="mt-2" />
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <x-input-label for="keluhan_utama" value="Keluhan Utama" class="font-semibold" />
                    <textarea id="keluhan_utama" name="keluhan_utama"
                        class="mt-2 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Deskripsi keluhan utama pasien..." required>{{ old('keluhan_utama', $RmPemeriksaan->keluhan_utama) }}</textarea>
                    <x-input-error :messages="$errors->get('keluhan_utama')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="diagnosa" value="Diagnosa" class="font-semibold" />
                    <textarea id="diagnosa" name="diagnosa"
                        class="mt-2 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Hasil diagnosa pemeriksaan..." required>{{ old('diagnosa', $RmPemeriksaan->diagnosa) }}</textarea>
                    <x-input-error :messages="$errors->get('diagnosa')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="riwayat_penyakit" value="Riwayat Penyakit" class="font-semibold" />
                    <textarea id="riwayat_penyakit" name="riwayat_penyakit"
                        class="mt-2 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Riwayat penyakit sebelumnya..." required>{{ old('riwayat_penyakit', $RmPemeriksaan->riwayat_penyakit) }}</textarea>
                    <x-input-error :messages="$errors->get('riwayat_penyakit')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="penyakit_sekarang" value="Penyakit Sekarang" class="font-semibold" />
                    <textarea id="penyakit_sekarang" name="penyakit_sekarang"
                        class="mt-2 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Kondisi kesehatan saat ini..." required>{{ old('penyakit_sekarang', $RmPemeriksaan->penyakit_sekarang) }}</textarea>
                    <x-input-error :messages="$errors->get('penyakit_sekarang')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="penyakit_keluarga" value="Penyakit Keluarga" class="font-semibold" />
                    <textarea id="penyakit_keluarga" name="penyakit_keluarga"
                        class="mt-2 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Riwayat penyakit dalam keluarga..." required>{{ old('penyakit_keluarga', $RmPemeriksaan->penyakit_keluarga) }}</textarea>
                    <x-input-error :messages="$errors->get('penyakit_keluarga')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="pengobatan" value="Pengobatan" class="font-semibold" />
                    <textarea id="pengobatan" name="pengobatan"
                        class="mt-2 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        rows="3" placeholder="Riwayat pengobatan atau alergi..." required>{{ old('pengobatan', $RmPemeriksaan->pengobatan) }}</textarea>
                    <x-input-error :messages="$errors->get('pengobatan')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Resep Kacamata -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
            <div class="mb-6">
                <h3 class="text-base font-bold text-gray-900 mb-4 pb-3 border-b border-gray-200">
                    Resep Kacamata
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                <div>
                    <x-input-label for="resep_dari" value="Resep Dari" class="font-semibold" />
                    <x-form-input id="resep_dari" name="resep_dari" class="mt-2 w-full"
                        value="{{ old('resep_dari', $RmPemeriksaan->resep->resep_dari) }}"
                        placeholder="Nama dokter/optometris..." required />
                    <x-input-error :messages="$errors->get('resep_dari')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="resep_tanggal" value="Tanggal Resep" class="font-semibold" />
                    <x-form-input id="resep_tanggal" name="resep_tanggal" type="date" class="mt-2 w-full"
                        value="{{ old('resep_tanggal', \Carbon\Carbon::parse($RmPemeriksaan->resep->tanggal)->format('Y-m-d')) }}"
                        required />
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
                            <tr class="hover:bg-indigo-50 transition-colors">
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
            <div class="mb-6">
                <h3 class="text-base font-bold text-gray-900 mb-4 pb-3 border-b border-gray-200">
                    Pesanan
                </h3>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
                <div>
                    <x-input-label for="frame_id" value="Frame" />
                    <x-form-select-search class="mt-2 w-full" name="frame_id" :options="$frames"
                        labelKey="kode_frame" valueKey="id" :extraLabels="['merk', 'harga']" placeholder="Pilih Frame"
                        :selected="old('frame_id', $RmPemeriksaan->pesanan->frame_id)" />
                    <x-input-error :messages="$errors->get('frame_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="lensa_id" value="Lensa" />
                    <x-form-select-search class="mt-2 w-full" name="lensa_id" :options="$lensas"
                        labelKey="nama_lensa" valueKey="id" placeholder="Pilih Lensa" :selected="old('lensa_id', $RmPemeriksaan->pesanan->lensa_id)" />
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
                    <x-form-input id="biaya_kacamata" name="biaya_kacamata" type="rupiah" class="w-full mt-2"
                        value="{{ old('biaya_kacamata', $RmPemeriksaan->pesanan->biaya_kacamata) }}" required />
                    <x-input-error :messages="$errors->get('biaya_kacamata')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="tanggal_dipesan" value="Tanggal Pemesanan" />
                    <x-form-input id="tanggal_dipesan" name="tanggal_dipesan" type="date" class="w-full mt-2"
                        value="{{ old('tanggal_dipesan', optional($RmPemeriksaan->pesanan)->tanggal_dipesan ? $RmPemeriksaan->pesanan->tanggal_dipesan->format('Y-m-d') : '') }}"
                        required />
                    <x-input-error :messages="$errors->get('tanggal_dipesan')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="tanggal_pengambilan" value="Tanggal Pengambilan" />
                    <x-form-input id="tanggal_pengambilan" name="tanggal_pengambilan" type="date"
                        class="w-full mt-2"
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
