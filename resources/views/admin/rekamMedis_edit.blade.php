<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Rekam Medis
        </h2>
    </x-slot>

    <div class="bg-white rounded-lg border p-6">

        <form method="POST" action="{{ route('rekam-medis.update', $pasien->id) }}" class="space-y-8">
            @csrf
            @method('PUT')

            <div>
                <h3 class="font-semibold text-gray-800 mb-3">Data Pasien & Riwayat</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                    <!-- DATA PASIEN -->
                    <div>
                        <x-input-label value="Nama Pasien" />
                        <x-text-input name="nama_pasien" class="mt-1 block w-full"
                            value="{{ old('nama_pasien', $pasien->nama_pasien) }}" required />
                    </div>

                    <div>
                        <x-input-label value="No HP" />
                        <x-text-input name="no_hp" class="mt-1 block w-full"
                            value="{{ old('no_hp', $pasien->no_hp) }}" />
                    </div>

                    <div>
                        <x-input-label value="Kategori" />
                        <select name="kategori" id="kategori"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">-- Pilih --</option>
                            <option value="bpjs" {{ old('kategori', $pasien->kategori) == 'bpjs' ? 'selected' : '' }}>
                                BPJS</option>
                            <option value="asuransi"
                                {{ old('kategori', $pasien->kategori) == 'asuransi' ? 'selected' : '' }}>Asuransi
                            </option>
                            <option value="umum" {{ old('kategori', $pasien->kategori) == 'umum' ? 'selected' : '' }}>
                                Umum</option>
                        </select>
                    </div>

                    <!-- No Kartu -->
                    <div id="field_no_kartu"
                        class="{{ in_array(old('kategori', $pasien->kategori), ['bpjs', 'asuransi']) ? '' : 'hidden' }}">
                        <x-input-label value="No Kartu BPJS / Asuransi" />
                        <x-text-input name="no_kartu" class="mt-1 block w-full"
                            value="{{ old('no_kartu', $pasien->no_kartu) }}" />
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2 lg:col-span-3">
                        <x-input-label value="Alamat" />
                        <textarea name="alamat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="2">{{ old('alamat', $pasien->alamat) }}</textarea>
                    </div>

                    <!-- RIWAYAT PASIEN -->
                    <div class="md:col-span-2 lg:col-span-1">
                        <x-input-label value="Keluhan Utama" />
                        <textarea name="keluhan_utama" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ old('keluhan_utama', $pasien->keluhan_utama) }}</textarea>
                    </div>

                    <div class="md:col-span-2 lg:col-span-1">
                        <x-input-label value="Riwayat Penyakit" />
                        <textarea name="riwayat_penyakit" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ old('riwayat_penyakit', $pasien->riwayat_penyakit) }}</textarea>
                    </div>

                    <div class="md:col-span-2 lg:col-span-1">
                        <x-input-label value="Penyakit Sekarang" />
                        <textarea name="penyakit_sekarang" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ old('penyakit_sekarang', $pasien->penyakit_sekarang) }}</textarea>
                    </div>

                    <div class="md:col-span-2 lg:col-span-1">
                        <x-input-label value="Penyakit Keluarga" />
                        <textarea name="penyakit_keluarga" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ old('penyakit_keluarga', $pasien->penyakit_keluarga) }}</textarea>
                    </div>

                    <div class="md:col-span-2 lg:col-span-1">
                        <x-input-label value="Kebiasaan" />
                        <textarea name="kebiasaan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ old('kebiasaan', $pasien->kebiasaan) }}</textarea>
                    </div>

                    <div class="md:col-span-2 lg:col-span-1">
                        <x-input-label value="Pengobatan / Konsumsi Obat" />
                        <textarea name="pengobatan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ old('pengobatan', $pasien->pengobatan) }}</textarea>
                    </div>

                </div>
            </div>

            <!-- ================= DATA PEMERIKSAAN ================= -->
            <div>
                <h3 class="font-semibold text-gray-800 mb-3">Data Pemeriksaan</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                    <div>
                        <x-input-label value="Pemberi Resep" />
                        <x-text-input name="resep_dari" class="mt-1 block w-full"
                            value="{{ old('resep_dari', $pasien->resep_dari) }}" required />
                    </div>

                    <div>
                        <x-input-label value="Diagnosa" />
                        <x-text-input name="diagnosa" class="mt-1 block w-full"
                            value="{{ old('diagnosa', $pasien->diagnosa) }}" required />
                    </div>

                    <div id="field_no_sep">
                        <x-input-label value="No Rujukan / SEP" />
                        <x-text-input name="no_sep" class="mt-1 block w-full"
                            value="{{ old('no_sep', $pasien->no_sep) }}" />
                    </div>

                    <div>
                        <x-input-label value="Tanggal Pemeriksaan" />
                        <x-text-input type="date" name="tanggal_pemeriksaan" class="mt-1 block w-full"
                            value="{{ old('tanggal_pemeriksaan', optional($pasien->tanggal_pemeriksaan)->format('Y-m-d')) }}"
                            required />
                    </div>

                </div>
            </div>

            <!-- ================= RESEP OD ================= -->
            <div>
                <h3 class="font-semibold text-gray-800 mb-3">Resep Mata Kanan (OD)</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <x-text-input name="od_sferis" class="mt-1 block w-full" placeholder="SPH"
                        value="{{ old('od_sferis', $pasien->od_sferis) }}" />
                    <x-text-input name="od_silindris" class="mt-1 block w-full" placeholder="CYL"
                        value="{{ old('od_silindris', $pasien->od_silindris) }}" />
                    <x-text-input name="od_axis" class="mt-1 block w-full" placeholder="AX"
                        value="{{ old('od_axis', $pasien->od_axis) }}" />
                    <x-text-input name="od_add_lensa" class="mt-1 block w-full" placeholder="ADD"
                        value="{{ old('od_add_lensa', $pasien->od_add_lensa) }}" />
                </div>
            </div>

            <!-- ================= RESEP OS ================= -->
            <div>
                <h3 class="font-semibold text-gray-800 mb-3">Resep Mata Kiri (OS)</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <x-text-input name="os_sferis" class="mt-1 block w-full" placeholder="SPH"
                        value="{{ old('os_sferis', $pasien->os_sferis) }}" />
                    <x-text-input name="os_silindris" class="mt-1 block w-full" placeholder="CYL"
                        value="{{ old('os_silindris', $pasien->os_silindris) }}" />
                    <x-text-input name="os_axis" class="mt-1 block w-full" placeholder="AX"
                        value="{{ old('os_axis', $pasien->os_axis) }}" />
                    <x-text-input name="os_add_lensa" class="mt-1 block w-full" placeholder="ADD"
                        value="{{ old('os_add_lensa', $pasien->os_add_lensa) }}" />
                </div>
            </div>

            <!-- ================= KACAMATA ================= -->
            <div>
                <h3 class="font-semibold text-gray-800 mb-3">Kacamata</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <x-input-label value="Frame" />
                        <select
                            name="frame_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Frame --</option>
                            @foreach ($frames as $frame)
                            <option value="{{ $frame->id }}"
                                {{ old('frame_id', $pasien->frame_id) == $frame->id ? 'selected' : '' }}>
                                {{ $frame->merk }} - {{ $frame->kode_frame }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label value="Lensa" />
                        <select
                            name="lensa_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Lensa --</option>
                            @foreach ($lensas as $lensa)
                            <option value="{{ $lensa->id }}"
                                {{ old('lensa_id', $pasien->lensa_id) == $lensa->id ? 'selected' : '' }}>
                                {{ $lensa->nama_lensa }}
                                ({{ $lensa->kategori }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label value="pd" />
                        <x-text-input name="pd" class="mt-1 block w-full" value="{{ old('pd', $pasien->pd) }}" />
                    </div>

                </div>
            </div>

            <!-- ================= PEMBAYARAN ================= -->
            <div>
                <h3 class="font-semibold text-gray-800 mb-3">Pembayaran</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                    {{-- Biaya Kacamata --}}
                    <div>
                        <x-input-label value="Biaya Kacamata" />
                        <input type="text" class="rupiah mt-1 block w-full border-gray-300 rounded-md"
                            data-target="biaya_kacamata">
                        <input type="hidden" name="biaya_kacamata" id="biaya_kacamata"
                            value="{{ old('biaya_kacamata', $pasien->biaya_kacamata) }}">
                    </div>

                    <div id="field_bpjs">
                        <x-input-label value="Dibayar BPJS" />
                        <input type="text" class="rupiah mt-1 block w-full border-gray-300 rounded-md"
                            data-target="dibayar_bpjs">
                        <input type="hidden" name="dibayar_bpjs" id="dibayar_bpjs"
                            value="{{ old('dibayar_bpjs', $pasien->dibayar_bpjs) }}">
                    </div>

                    <div id="field_asuransi">
                        <x-input-label value="Dibayar Asuransi" />
                        <input type="text" class="rupiah mt-1 block w-full border-gray-300 rounded-md"
                            data-target="dibayar_asuransi">
                        <input type="hidden" name="dibayar_asuransi" id="dibayar_asuransi"
                            value="{{ old('dibayar_asuransi', $pasien->dibayar_asuransi) }}">
                    </div>

                    <div id="field_umum">
                        <x-input-label value="Dibayar Pasien" />
                        <input type="text" class="rupiah mt-1 block w-full border-gray-300 rounded-md"
                            data-target="dibayar_pasien">
                        <input type="hidden" name="dibayar_pasien" id="dibayar_pasien"
                            value="{{ old('dibayar_pasien', $pasien->dibayar_pasien) }}">
                    </div>

                    <x-text-input type="date" name="tanggal_dipesan" class="mt-1 block w-full"
                        value="{{ old('tanggal_dipesan', optional($pasien->tanggal_dipesan)->format('Y-m-d')) }}" />

                    <x-text-input type="date" name="tanggal_pengambilan" class="mt-1 block w-full"
                        value="{{ old('tanggal_pengambilan', optional($pasien->tanggal_pengambilan)->format('Y-m-d')) }}" />
                </div>
            </div>

            <!-- ================= BUTTON ================= -->
            <div class="flex gap-3">
                <x-primary-button>Update Rekam Medis</x-primary-button>
                <a href="{{ route('rekam-medis.index') }}" class="text-sm text-gray-600">Batal</a>
            </div>

        </form>

        <!-- ================= SCRIPT (SAMA DENGAN CREATE) ================= -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const kategori = document.getElementById('kategori');

                const fieldNoKartu = document.getElementById('field_no_kartu');
                const fieldNoSep = document.getElementById('field_no_sep');

                const fieldBpjs = document.getElementById('field_bpjs');
                const fieldAsuransi = document.getElementById('field_asuransi');
                const fieldUmum = document.getElementById('field_umum');

                /* ===============================
                    FORMAT RUPIAH
                =============================== */
                function formatRupiah(angka) {
                    angka = angka.toString().replace(/[^0-9]/g, '');
                    if (!angka) return 'Rp 0';
                    return 'Rp ' + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }

                /* ===============================
                    TOGGLE FIELD (TANPA RESET!)
                =============================== */
                function toggleFields() {

                    fieldNoKartu.classList.add('hidden');
                    fieldNoSep.classList.add('hidden');
                    fieldBpjs.classList.add('hidden');
                    fieldAsuransi.classList.add('hidden');
                    fieldUmum.classList.add('hidden');

                    if (kategori.value === 'bpjs') {
                        fieldNoKartu.classList.remove('hidden');
                        fieldNoSep.classList.remove('hidden');
                        fieldBpjs.classList.remove('hidden');
                        fieldUmum.classList.remove('hidden');
                    }

                    if (kategori.value === 'asuransi') {
                        fieldNoKartu.classList.remove('hidden');
                        fieldAsuransi.classList.remove('hidden');
                        fieldUmum.classList.remove('hidden');
                    }

                    if (kategori.value === 'umum') {
                        fieldUmum.classList.remove('hidden');
                    }
                }

                kategori.addEventListener('change', toggleFields);
                toggleFields();

                /* ===============================
                    INIT + INPUT RUPIAH EDIT
                =============================== */
                document.querySelectorAll('.rupiah').forEach(function(input) {

                    const hidden = document.getElementById(input.dataset.target);

                    // 🔥 INIT NILAI AWAL (INI PENTING!)
                    input.value = formatRupiah(hidden.value || 0);

                    input.addEventListener('input', function() {
                        let angka = this.value.replace(/[^0-9]/g, '');
                        hidden.value = angka || 0;
                        this.value = formatRupiah(angka);
                    });
                });

            });
        </script>


    </div>
</x-app-layout>