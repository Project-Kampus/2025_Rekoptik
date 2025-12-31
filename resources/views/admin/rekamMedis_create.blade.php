<x-app-layout>

    <div class="bg-white rounded-lg border p-6">
        <header class="mb-6">
            <h2 class="text-lg font-medium text-gray-900">
                Data Pasien & Pemeriksaan
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                Lengkapi data rekam medis pasien dengan benar.
            </p>
        </header>

        <form method="POST" action="{{ route('rekam-medis.store') }}" class="space-y-6" enctype="multipart/form-data">
            @csrf
            <div class="bg-gray-50 border rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    Data Pasien
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <x-input-label value="Nama Pasien" />
                        <x-text-input name="nama_pasien" class="mt-1 block w-full" required />
                    </div>

                    <div>
                        <x-input-label value="No HP" />
                        <x-text-input name="no_hp" class="mt-1 block w-full" />
                    </div>

                    <div>
                        <x-input-label value="Kategori" />
                        <select name="kategori" id="kategori"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">-- Pilih --</option>
                            <option value="bpjs">BPJS</option>
                            <option value="asuransi">Asuransi</option>
                            <option value="umum">Umum</option>
                        </select>
                    </div>

                    <div id="field_no_kartu" class="hidden">
                        <x-input-label value="No Kartu BPJS / Asuransi" />
                        <x-text-input name="no_kartu" id="no_kartu" class="mt-1 block w-full" />
                    </div>

                    <div class="md:col-span-2 lg:col-span-3">
                        <x-input-label value="Alamat" />
                        <textarea name="alamat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="2"></textarea>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 border rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    Riwayat Pasien
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="md:col-span-2 lg:col-span-1">
                        <x-input-label value="Keluhan Utama" />
                        <textarea name="keluhan_utama" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3"></textarea>
                    </div>

                    <div class="md:col-span-2 lg:col-span-1">
                        <x-input-label value="Riwayat Penyakit" />
                        <textarea name="riwayat_penyakit" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3"></textarea>
                    </div>

                    <div class="md:col-span-2 lg:col-span-1">
                        <x-input-label value="Penyakit Sekarang" />
                        <textarea name="penyakit_sekarang" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3"></textarea>
                    </div>

                    <div class="md:col-span-2 lg:col-span-1">
                        <x-input-label value="Penyakit Keluarga" />
                        <textarea name="penyakit_keluarga" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3"></textarea>
                    </div>

                    <div class="md:col-span-2 lg:col-span-1">
                        <x-input-label value="Kebiasaan" />
                        <textarea name="kebiasaan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3"></textarea>
                    </div>

                    <div class="md:col-span-2 lg:col-span-1">
                        <x-input-label value="Pengobatan / Konsumsi Obat" />
                        <textarea name="pengobatan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 border rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    Pemeriksaan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <x-input-label value="Pemberi Resep" />
                        <x-text-input name="resep_dari" class="mt-1 block w-full" placeholder="Dokter / Optometris"
                            required />
                    </div>

                    <div>
                        <x-input-label value="Diagnosa" />
                        <x-text-input name="diagnosa" class="mt-1 block w-full" placeholder="Diagnosa" required />
                    </div>

                    <div id="field_no_sep" class="hidden">
                        <x-input-label value="No Rujukan / SEP" />
                        <x-text-input name="no_sep" id="no_sep" class="mt-1 block w-full" />
                    </div>


                    <div>
                        <x-input-label value="Tanggal Pemeriksaan" />
                        <x-text-input type="date" name="tanggal_pemeriksaan" class="mt-1 block w-full" required />
                    </div>

                    <div class="md:col-span-2 lg:col-span-3">
                        <x-input-label value="Dokument Pemeriksaan" />
                        <input
                            type="file"
                            name="dokument[]"
                            multiple
                            accept="image/*,.pdf"
                            class="mt-1 block w-full text-sm text-gray-700
                       file:mr-4 file:py-2 file:px-4
                       file:rounded-md file:border-0
                       file:text-sm file:font-semibold
                       file:bg-indigo-50 file:text-indigo-700
                       hover:file:bg-indigo-100">
                        <p class="mt-1 text-xs text-gray-500">
                            Format: JPG, PNG, atau PDF (maks. 2MB per file)
                        </p>
                    </div>
                </div>
            </div>



            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- OD -->
                <div class="border bg-gray-50  rounded-lg p-4">
                    <h4 class="font-semibold mb-3 text-gray-700">Mata Kanan (OD)</h4>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <x-input-label value="Sferis (SPH)" />
                            <x-text-input class="mt-1 block w-full" name="od_sferis" placeholder="Contoh: -1.25" />
                        </div>

                        <div>
                            <x-input-label value="Silindris (CYL)" />
                            <x-text-input class="mt-1 block w-full" name="od_silindris" placeholder="Contoh: -0.50" />
                        </div>

                        <div>
                            <x-input-label value="Axis (AX)" />
                            <x-text-input class="mt-1 block w-full" name="od_axis" placeholder="0 – 180" />
                        </div>

                        <div>
                            <x-input-label value="Add" />
                            <x-text-input class="mt-1 block w-full" name="od_add_lensa" placeholder="+1.00" />
                        </div>
                    </div>
                </div>

                <!-- OS -->
                <div class="border bg-gray-50 rounded-lg p-4">
                    <h4 class="font-semibold mb-3 text-gray-700">Mata Kiri (OS)</h4>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <x-input-label value="Sferis (SPH)" />
                            <x-text-input class="mt-1 block w-full" name="os_sferis" placeholder="Contoh: -1.00" />
                        </div>

                        <div>
                            <x-input-label value="Silindris (CYL)" />
                            <x-text-input class="mt-1 block w-full" name="os_silindris" placeholder="Contoh: -0.75" />
                        </div>

                        <div>
                            <x-input-label value="Axis (AX)" />
                            <x-text-input class="mt-1 block w-full" name="os_axis" placeholder="0 – 180" />
                        </div>

                        <div>
                            <x-input-label value="Add" />
                            <x-text-input class="mt-1 block w-full" name="os_add_lensa" placeholder="+1.00" />
                        </div>
                    </div>
                </div>

            </div>

            <div class="bg-gray-50 border rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    Kacamata
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <x-input-label value="Frame" />
                        <select
                            name="frame_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Frame --</option>
                            @foreach ($frames as $frame)
                            <option value="{{ $frame->id }}">
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
                            <option value="{{ $lensa->id }}">
                                {{ $lensa->nama_lensa }}
                                ({{ $lensa->kategori }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label value="PD" />
                        <x-text-input name="pd" class="mt-1 block w-full" />
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 border rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    Biaya & Pembayaran
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Biaya Kacamata --}}
                    <div>
                        <x-input-label value="Biaya Kacamata" />
                        <input type="text" class="mt-1 block w-full border-gray-300 rounded-md rupiah"
                            data-target="biaya_kacamata" placeholder="Rp 0">
                        <input type="hidden" name="biaya_kacamata" id="biaya_kacamata" value="0">
                    </div>

                    {{-- Dibayar BPJS --}}
                    <div id="field_bpjs">
                        <x-input-label value="Dibayar BPJS" />
                        <input type="text" class="rupiah mt-1 block w-full border-gray-300 rounded-md"
                            data-target="dibayar_bpjs" placeholder="Rp 0">
                        <input type="hidden" name="dibayar_bpjs" id="dibayar_bpjs" value="0">
                    </div>

                    {{-- Dibayar Asuransi --}}
                    <div id="field_asuransi" class="hidden">
                        <x-input-label value="Dibayar Asuransi" />
                        <input type="text" class="rupiah mt-1 block w-full border-gray-300 rounded-md"
                            data-target="dibayar_asuransi" placeholder="Rp 0">
                        <input type="hidden" name="dibayar_asuransi" id="dibayar_asuransi" value="0">
                    </div>

                    {{-- Dibayar Pasien --}}
                    <div id="field_umum">
                        <x-input-label value="Dibayar Pasien" />
                        <input type="text" class="rupiah mt-1 block w-full border-gray-300 rounded-md"
                            data-target="dibayar_pasien" placeholder="Rp 0">
                        <input type="hidden" name="dibayar_pasien" id="dibayar_pasien" value="0">
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 border rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    Tanggal
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <x-input-label value="Tanggal Pemesanan" />
                        <x-text-input type="date" name="tanggal_dipesan" class="mt-1 block w-full" />
                    </div>

                    <div>
                        <x-input-label value="Tanggal Pengambilan" />
                        <x-text-input type="date" name="tanggal_pengambilan" class="mt-1 block w-full" />
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <x-primary-button>
                    Simpan Rekam Medis
                </x-primary-button>

                <a href="{{ route('rekam-medis.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                    Batal
                </a>
            </div>

        </form>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const kategori = document.getElementById('kategori');

            const fieldNoKartu = document.getElementById('field_no_kartu');
            const fieldNoSep = document.getElementById('field_no_sep');

            const fieldBpjs = document.getElementById('field_bpjs');
            const fieldAsuransi = document.getElementById('field_asuransi');
            const fieldPasien = document.getElementById('field_umum');

            /* ===============================
                FORMAT RUPIAH
            =============================== */
            function formatRupiah(angka) {
                angka = angka.toString().replace(/[^0-9]/g, '');
                if (!angka) return 'Rp 0';
                return 'Rp ' + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            /* ===============================
                RESET NILAI (TEXT + HIDDEN)
            =============================== */
            function resetValue(id) {
                const hidden = document.getElementById(id);
                hidden.value = 0;

                const textInput = document.querySelector(`[data-target="${id}"]`);
                if (textInput) {
                    textInput.value = formatRupiah('0');
                }
            }

            /* ===============================
                TOGGLE FIELD BERDASARKAN KATEGORI
            =============================== */
            function toggleFields() {

                // HIDE SEMUA
                fieldNoKartu.classList.add('hidden');
                fieldNoSep.classList.add('hidden');
                fieldBpjs.classList.add('hidden');
                fieldAsuransi.classList.add('hidden');

                // PASIEN SELALU TAMPIL
                fieldPasien.classList.remove('hidden');

                // RESET DEFAULT
                resetValue('dibayar_bpjs');
                resetValue('dibayar_asuransi');

                if (kategori.value === 'bpjs') {
                    fieldNoKartu.classList.remove('hidden');
                    fieldNoSep.classList.remove('hidden');
                    fieldBpjs.classList.remove('hidden');
                }

                if (kategori.value === 'asuransi') {
                    fieldNoKartu.classList.remove('hidden');
                    fieldAsuransi.classList.remove('hidden');
                }

                if (kategori.value === 'umum') {
                    // BPJS & Asuransi tetap 0
                    resetValue('dibayar_bpjs');
                    resetValue('dibayar_asuransi');
                }
            }

            kategori.addEventListener('change', toggleFields);
            toggleFields();

            /* ===============================
                INPUT RUPIAH REALTIME
            =============================== */
            document.querySelectorAll('.rupiah').forEach(function(input) {
                input.addEventListener('input', function() {
                    const target = this.dataset.target;
                    let angka = this.value.replace(/[^0-9]/g, '');

                    document.getElementById(target).value = angka || 0;
                    this.value = formatRupiah(angka);
                });
            });

        });
    </script>



</x-app-layout>