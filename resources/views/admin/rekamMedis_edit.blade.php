<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Edit Rekam Medis
      </h2>
   </x-slot>

   <div class="bg-white rounded-lg border p-6">
      <header class="mb-6">
         <h2 class="text-lg font-medium text-gray-900">
            Data Pasien & Pemeriksaan
         </h2>
         <p class="mt-1 text-sm text-gray-600">
            Perbarui data rekam medis pasien dengan benar.
         </p>
      </header>

      <form method="POST" action="{{ route('rekam-medis.update', $pasien->id) }}" class="space-y-8">
         @csrf
         @method('PUT')

         <!-- DATA PASIEN -->
         <div>
            <h3 class="font-semibold text-gray-800 mb-3">Data Pasien</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

               <div>
                  <x-input-label value="Nama Pasien" />
                  <x-text-input
                     name="nama_pasien"
                     class="mt-1 block w-full"
                     value="{{ old('nama_pasien', $pasien->nama_pasien) }}"
                     required />
               </div>

               <div>
                  <x-input-label value="No HP" />
                  <x-text-input
                     name="no_hp"
                     class="mt-1 block w-full"
                     value="{{ old('no_hp', $pasien->no_hp) }}" />
               </div>

               <div>
                  <x-input-label value="No BPJS / Kartu" />
                  <x-text-input
                     name="no_kartu"
                     class="mt-1 block w-full"
                     value="{{ old('no_kartu', $pasien->no_kartu) }}" />
               </div>

               <div class="md:col-span-2 lg:col-span-3">
                  <x-input-label value="Alamat" />
                  <textarea
                     name="alamat"
                     class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                     rows="2">{{ old('alamat', $pasien->alamat) }}</textarea>
               </div>

            </div>
         </div>

         <!-- DATA PEMERIKSAAN -->
         <div>
            <h3 class="font-semibold text-gray-800 mb-3">Data Pemeriksaan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

               <div>
                  <x-input-label value="Pemberi Resep" />
                  <x-text-input
                     name="resep_dari"
                     class="mt-1 block w-full"
                     value="{{ old('resep_dari', $pasien->resep_dari) }}"
                     required />
               </div>

               <div>
                  <x-input-label value="No Rujukan / SEP" />
                  <x-text-input
                     name="no_sep"
                     class="mt-1 block w-full"
                     value="{{ old('no_sep', $pasien->no_sep) }}" />
               </div>

               <div>
                  <x-input-label value="Tanggal Pemeriksaan" />
                  <x-text-input
                     type="date"
                     name="tanggal_pemeriksaan"
                     class="mt-1 block w-full"
                     value="{{ old('tanggal_pemeriksaan', optional($pasien->tanggal_pemeriksaan)->format('Y-m-d')) }}"
                     required />
               </div>

               <div>
                  <x-input-label value="Kategori" />
                  <select
                     name="kategori"
                     class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                     required>
                     <option value="">-- Pilih --</option>
                     <option value="bpjs" {{ old('kategori', $pasien->kategori) == 'bpjs' ? 'selected' : '' }}>BPJS</option>
                     <option value="umum" {{ old('kategori', $pasien->kategori) == 'umum' ? 'selected' : '' }}>UMUM</option>
                  </select>
               </div>

            </div>
         </div>

         <!-- RESEP OD -->
         <div>
            <h3 class="font-semibold text-gray-800 mb-3">Resep Mata Kanan (OD)</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
               <x-text-input name="od_sferis" placeholder="Sferis"
                  value="{{ old('od_sferis', $pasien->od_sferis) }}" />
               <x-text-input name="od_silindris" placeholder="Silindris"
                  value="{{ old('od_silindris', $pasien->od_silindris) }}" />
               <x-text-input name="od_axis" placeholder="Axis"
                  value="{{ old('od_axis', $pasien->od_axis) }}" />
               <x-text-input name="od_add_lensa" placeholder="Add"
                  value="{{ old('od_add_lensa', $pasien->od_add_lensa) }}" />
            </div>
         </div>

         <!-- RESEP OS -->
         <div>
            <h3 class="font-semibold text-gray-800 mb-3">Resep Mata Kiri (OS)</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
               <x-text-input name="os_sferis" placeholder="Sferis"
                  value="{{ old('os_sferis', $pasien->os_sferis) }}" />
               <x-text-input name="os_silindris" placeholder="Silindris"
                  value="{{ old('os_silindris', $pasien->os_silindris) }}" />
               <x-text-input name="os_axis" placeholder="Axis"
                  value="{{ old('os_axis', $pasien->os_axis) }}" />
               <x-text-input name="os_add_lensa" placeholder="Add"
                  value="{{ old('os_add_lensa', $pasien->os_add_lensa) }}" />
            </div>
         </div>

         <!-- KACAMATA -->
         <div>
            <h3 class="font-semibold text-gray-800 mb-3">Kacamata</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

               <div>
                  <x-input-label value="Frame" />
                  <select name="frame_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                     <option value="">-- Pilih Frame --</option>
                     @foreach($frames as $frame)
                     <option value="{{ $frame->id }}"
                        {{ old('frame_id', $pasien->frame_id) == $frame->id ? 'selected' : '' }}>
                        {{ $frame->kode_frame }} - {{ $frame->nama_frame }}
                     </option>
                     @endforeach
                  </select>
               </div>

               <div>
                  <x-input-label value="Lensa" />
                  <x-text-input name="lensa" class="mt-1 block w-full"
                     value="{{ old('lensa', $pasien->lensa) }}" />
               </div>

               <div>
                  <x-input-label value="PD" />
                  <x-text-input name="pd" class="mt-1 block w-full"
                     value="{{ old('pd', $pasien->pd) }}" />
               </div>

            </div>
         </div>

         <!-- PEMBAYARAN -->
         <div>
            <h3 class="font-semibold text-gray-800 mb-3">Pembayaran</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
               <div>
                  <x-input-label value="Biaya Kacamata" />
                  <input type="text"
                     class="mt-1 block w-full border-gray-300 rounded-md rupiah"
                     data-target="biaya_kacamata"
                     placeholder="Rp 0">
                  <input type="hidden" name="biaya_kacamata" id="biaya_kacamata" value="{{ old('biaya_kacamata', $pasien->biaya_kacamata) }}">
               </div>

               <div>
                  <x-input-label value="Dibayar BPJS" />
                  <input type="text"
                     class="mt-1 block w-full border-gray-300 rounded-md rupiah"
                     data-target="dibayar_bpjs"
                     placeholder="Rp 0">
                  <input type="hidden" name="dibayar_bpjs" id="dibayar_bpjs" value="{{ old('dibayar_bpjs', $pasien->dibayar_bpjs) }}">
               </div>

               <div>
                  <x-input-label value="Dibayar Pasien" />
                  <input type="text"
                     class="mt-1 block w-full border-gray-300 rounded-md rupiah"
                     data-target="dibayar_pasien"
                     placeholder="Rp 0">
                  <input type="hidden" name="dibayar_pasien" id="dibayar_pasien" value="{{ old('dibayar_pasien', $pasien->dibayar_pasien) }}">
               </div>

               <div>
                  <x-input-label value="Tanggal Pengambilan" />
                  <x-text-input class="mt-1 block w-full" type="date" name="tanggal_pengambilan"
                     value="{{ old('tanggal_pengambilan', optional($pasien->tanggal_pengambilan)->format('Y-m-d')) }}" />
               </div>

            </div>
         </div>

         <!-- TOMBOL -->
         <div class="flex items-center gap-3">
            <x-primary-button>
               Update Rekam Medis
            </x-primary-button>

            <a href="{{ route('rekam-medis.index') }}"
               class="text-sm text-gray-600 hover:text-gray-900">
               Batal
            </a>
         </div>

      </form>

      <script>
         document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.rupiah').forEach(function(input) {
               let target = input.dataset.target;
               let hiddenInput = document.getElementById(target);

               // === SAAT HALAMAN LOAD (EDIT MODE) ===
               let initialValue = hiddenInput?.value || 0;
               input.value = formatRupiah(initialValue);

               // === SAAT DIKETIK ===
               input.addEventListener('input', function() {
                  let value = this.value.replace(/[^0-9]/g, '');
                  hiddenInput.value = value || 0;
                  this.value = formatRupiah(value);
               });
            });

         });

         function formatRupiah(angka) {
            if (!angka || angka === '0') return 'Rp 0';
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
         }
      </script>


   </div>
</x-app-layout>