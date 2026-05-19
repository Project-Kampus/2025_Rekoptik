<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Data Pasien
        </h2>
    </x-slot>

    <div class="bg-white rounded-lg border p-6">
        <header class="mb-6">
            <h2 class="text-lg font-medium text-gray-900">
                Data Identitas Pasien
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                Perbarui informasi identitas pasien.
            </p>
        </header>

        <form method="POST" action="{{ route('identitaspasien.update', $identitaspasien->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- GRID FORM -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- Nama Pasien -->
                <div>
                    <x-input-label for="nama_pasien" value="Nama Pasien" />
                    <x-form-input id="nama_pasien" name="nama_pasien" type="text" class="mt-1 block w-full"
                        value="{{ old('nama_pasien', $identitaspasien->nama_pasien) }}" required />
                    <x-input-error :messages="$errors->get('nama_pasien')" class="mt-2" />
                </div>

                <!-- No. Kartu -->
                <div>
                    <x-input-label for="no_kartu" value="No. Kartu (BPJS/Asuransi)" />
                    <x-form-input id="no_kartu" name="no_kartu" type="text" class="mt-1 block w-full"
                        value="{{ old('no_kartu', $identitaspasien->no_kartu) }}" />
                    <x-input-error :messages="$errors->get('no_kartu')" class="mt-2" />
                </div>

                <!-- No. HP -->
                <div>
                    <x-input-label for="no_hp" value="No. HP" />
                    <x-form-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full"
                        value="{{ old('no_hp', $identitaspasien->no_hp) }}" placeholder="08xxxxxxxxxx" />
                    <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" value="Email" />
                    <x-form-input id="email" name="email" type="email" class="mt-1 block w-full"
                        value="{{ old('email', $identitaspasien->email) }}" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
                    <x-form-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full"
                        value="{{ old('tanggal_lahir', $identitaspasien->tanggal_lahir ? $identitaspasien->tanggal_lahir->format('Y-m-d') : '') }}"
                        required />
                    <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                </div>

                <!-- Kategori -->
                <div>
                    <x-input-label for="kategori" value="Kategori" />
                    <select id="kategori" name="kategori"
                        class="mt-1 block w-full rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="bpjs"
                            {{ old('kategori', $identitaspasien->kategori) == 'bpjs' ? 'selected' : '' }}>BPJS</option>
                        <option value="asuransi"
                            {{ old('kategori', $identitaspasien->kategori) == 'asuransi' ? 'selected' : '' }}>Asuransi
                        </option>
                        <option value="umum"
                            {{ old('kategori', $identitaspasien->kategori) == 'umum' ? 'selected' : '' }}>Umum</option>
                    </select>
                    <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                </div>

                <!-- Kelas -->
                <div>
                    <x-input-label for="kelas" value="Kelas" />
                    <select id="kelas" name="kelas"
                        class="mt-1 block w-full rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Pilih Kelas --</option>
                        <option value="1" {{ old('kelas', $identitaspasien->kelas) == '1' ? 'selected' : '' }}>
                            Kelas 1</option>
                        <option value="2" {{ old('kelas', $identitaspasien->kelas) == '2' ? 'selected' : '' }}>
                            Kelas 2</option>
                        <option value="3" {{ old('kelas', $identitaspasien->kelas) == '3' ? 'selected' : '' }}>
                            Kelas 3</option>
                    </select>
                    <x-input-error :messages="$errors->get('kelas')" class="mt-2" />
                </div>

            </div>

            <!-- Alamat -->
            <div>
                <x-input-label for="alamat" value="Alamat" />
                <textarea id="alamat" name="alamat" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('alamat', $identitaspasien->alamat) }}</textarea>
                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
            </div>

            <!-- TOMBOL -->
            <div class="flex items-center gap-3">
                <x-primary-button>
                    Simpan Perubahan
                </x-primary-button>

                <a href="{{ route('identitaspasien.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
