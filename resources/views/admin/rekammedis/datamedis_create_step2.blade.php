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
                    <x-input-label value="Diagnosa" />
                    <textarea name="diagnosa" class="mt-1 w-full rounded-md border-gray-300"></textarea>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Resep Kacamata
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 border">Mata</th>
                            <th class="px-3 py-2 border">SPH</th>
                            <th class="px-3 py-2 border">CYL</th>
                            <th class="px-3 py-2 border">AXIS</th>
                            <th class="px-3 py-2 border">ADD</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (['kanan', 'kiri'] as $mata)
                            <tr>
                                <td class="border px-3 py-2 capitalize">{{ $mata }}</td>
                                <td class="border px-3 py-2">
                                    <x-text-input name="resep[{{ $mata }}][sph]" class="mt-1 w-full" required />
                                </td>
                                <td class="border px-3 py-2">
                                    <x-text-input name="resep[{{ $mata }}][cyl]" class="mt-1 w-full" required />
                                </td>
                                <td class="border px-3 py-2">
                                    <x-text-input name="resep[{{ $mata }}][axis]" class="mt-1 w-full"
                                        required />
                                </td>
                                <td class="border px-3 py-2">
                                    <x-text-input name="resep[{{ $mata }}][add]" class="mt-1 w-full" required />
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label value="Jenis Pesanan" />
                    <select name="jenis_pesanan" class="mt-1 w-full rounded-md border-gray-300">
                        <option value="kacamata">Kacamata</option>
                        <option value="lensa">Lensa</option>
                    </select>
                </div>

                <div>
                    <x-input-label value="Status Pesanan" />
                    <select name="status" class="mt-1 w-full rounded-md border-gray-300">
                        <option value="dipesan">Dipesan</option>
                        <option value="diambil">Diambil</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- ================= ACTION ================= --}}
        <div class="flex justify-end">
            <x-primary-button>
                Simpan Pemeriksaan
            </x-primary-button>
        </div>

    </form>

</x-app-layout>
