<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah User
        </h2>
    </x-slot>

    <div class="bg-white rounded-lg border p-6">
        <header class="mb-6">
            <h2 class="text-lg font-medium text-gray-900">
                Data User
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                Masukkan informasi user dan pilih role.
            </p>
        </header>

        <form method="POST" action="{{ route('admin.store') }}" class="space-y-8">
            @csrf

            <!-- INFORMASI UTAMA -->
            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-3">
                    Informasi Utama
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                    <!-- Nama -->
                    <div>
                        <x-input-label for="name" value="Nama" />
                        <x-form-input id="name" name="name" type="text" class="mt-1 block w-full" required
                            value="{{ old('name') }}" placeholder="Nama lengkap user" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-form-input id="email" name="email" type="email" class="mt-1 block w-full" required
                            value="{{ old('email') }}" placeholder="Email user" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" value="Password" />
                        <x-form-input id="password" name="password" type="password" class="mt-1 block w-full" required
                            placeholder="Password minimal 6 karakter" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                        <x-form-input id="password_confirmation" name="password_confirmation" type="password"
                            class="mt-1 block w-full" required placeholder="Ulangi password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                </div>
            </div>

            <!-- ROLE USER -->
            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-3">
                    Pilih Role
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <x-input-label for="role" value="Role User" />
                        <select id="role" name="role" required
                            class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Pilih Role --</option>
                            @foreach (['admin', 'bpjs', 'dimkes'] as $role)
                                <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                    {{ ucfirst($role) }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- TOMBOL -->
            <div class="flex items-center gap-3 pt-4">
                <x-primary-button>
                    Simpan
                </x-primary-button>

                <a href="{{ route('admin.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                    Batal
                </a>
            </div>

        </form>
    </div>
</x-app-layout>
