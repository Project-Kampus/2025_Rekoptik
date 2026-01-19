<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Data Medis – Step 2
        </h2>
    </x-slot>
    <div class="bg-white rounded-xl border p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Identitas Pasien
        </h3>

        <table class="w-full text-sm border">
            <tbody>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 font-medium bg-gray-50">Nama Pasien</td>
                    <td class="px-4 py-2">{{ $pasien->nama_pasien }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2 font-medium bg-gray-50">No HP</td>
                    <td class="px-4 py-2">{{ $pasien->no_hp ?? '-' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2 font-medium bg-gray-50">Kategori</td>
                    <td class="px-4 py-2 uppercase">{{ $pasien->kategori }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-medium bg-gray-50">Umur</td>
                    <td class="px-4 py-2">{{ $pasien->umur ?? '-' }} Tahun</td>
                </tr>
            </tbody>
        </table>
    </div>

    <form method="POST" action="{{ route('datamedis.store.step2', $pasien->id) }}" class="space-y-2">
        @csrf

        <div class="bg-white rounded-xl border p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Data Pemeriksaan
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label value="No. SEP" />
                    <x-form-input name="no_sep" class="w-full" value="{{ old('no_sep') }}" required />
                </div>
                <div>
                    <x-input-label value="Diagnosa" />
                    <x-form-input name="diagnosa" class="w-full" value="{{ old('diagnosa') }}" required />
                </div>
                <div>
                    <x-input-label value="Keluhan Utama" />
                    <textarea name="keluhan_utama" class="mt-1 w-full rounded-md border-gray-300"></textarea>
                </div>
                <div>
                    <x-input-label value="Riwayat Penyakit" />
                    <textarea name="riwayat_penyakit" class="mt-1 w-full rounded-md border-gray-300"></textarea>
                </div>

                <div>
                    <x-input-label value="Penyakit Sekarang" />
                    <textarea name="penyakit_sekarang" class="mt-1 w-full rounded-md border-gray-300"></textarea>
                </div>

                <div>
                    <x-input-label value="Penyakit Keluarga" />
                    <textarea name="penyakit_keluarga" class="mt-1 w-full rounded-md border-gray-300"></textarea>
                </div>

                <div>
                    <x-input-label value="Kebiasaan" />
                    <textarea name="kebiasaan" class="mt-1 w-full rounded-md border-gray-300"></textarea>
                </div>

                <div>
                    <x-input-label value="Pengobatan" />
                    <textarea name="pengobatan" class="mt-1 w-full rounded-md border-gray-300"></textarea>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Resep Kacamata
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <x-input-label value="Resep Dari" />
                    <x-form-input name="resep_dari" class="w-full" value="{{ old('no_sep') }}" required />
                </div>
                <div>
                    <x-input-label value="Tanggal" />
                    <x-form-input name="resep_tanggal" class="w-full" value="{{ old('resep_tanggal') }}" required />
                </div>
            </div>
            <div class="overflow-x-auto mt-3">
                <table class="w-full text-sm border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 border">Mata</th>
                            <th class="px-3 py-2 border">SPH</th>
                            <th class="px-3 py-2 border">CYL</th>
                            <th class="px-3 py-2 border">AXIS</th>
                            <th class="px-3 py-2 border">ADD</th>
                            <th class="px-3 py-2 border">PD</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (['kanan', 'kiri'] as $mata)
                            <tr>
                                <td class="border px-3 py-2 capitalize">{{ $mata }}</td>
                                <td class="border px-3 py-2">
                                    <x-form-input name="resep[{{ $mata }}][sph]" class="mt-1 w-full"
                                        required />
                                </td>
                                <td class="border px-3 py-2">
                                    <x-form-input name="resep[{{ $mata }}][cyl]" class="mt-1 w-full"
                                        required />
                                </td>
                                <td class="border px-3 py-2">
                                    <x-form-input name="resep[{{ $mata }}][axis]" class="mt-1 w-full"
                                        required />
                                </td>
                                <td class="border px-3 py-2">
                                    <x-form-input name="resep[{{ $mata }}][add]" class="mt-1 w-full"
                                        required />
                                </td>
                                <td class="border px-3 py-2">
                                    <x-form-input name="resep[{{ $mata }}][pd]" class="mt-1 w-full" required />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ================= PESANAN ================= --}}
        <div class="bg-white rounded-xl border p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Pesanan
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <x-input-label value="Frame" />
                    <x-form-select label="Frame" class="w-full" name="frame_id" :options="$frame" labelKey="merk"
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
                    <x-input-label value="Biaya" />
                    <x-form-input name="biaya_kacamata" class="w-full" value="{{ old('biaya_kacamata') }}"
                        required />
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

        {{-- ================= ACTION ================= --}}
        <div class="flex justify-end">
            <x-primary-button>
                Simpan Pemesanan
            </x-primary-button>
        </div>

    </form>

</x-app-layout>
