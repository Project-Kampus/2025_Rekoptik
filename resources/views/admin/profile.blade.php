<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profil
        </h2>
    </x-slot>

    <!-- Informasi Profil -->
    <div class="bg-white rounded-lg border p-6">
        <section class="max-w-xl">
            <header class="mb-4">
                <h2 class="text-lg font-medium text-gray-900">
                    Informasi Profil
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Perbarui informasi profil dan alamat email akun Anda.
                </p>
            </header>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <x-input-label for="name" value="Nama" />
                    <x-form-input id="name" name="name" type="text" class="mt-1 block w-full"
                        :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" value="Email" />
                    <x-form-input id="email" name="email" type="email" class="mt-1 block w-full"
                        :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <p class="text-sm mt-2 text-gray-800">
                            Alamat email Anda belum diverifikasi.
                            <button form="send-verification"
                                class="underline text-sm text-gray-600 hover:text-gray-900">
                                Klik di sini untuk mengirim ulang email verifikasi.
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm font-medium text-green-600">
                                Link verifikasi baru telah dikirim ke email Anda.
                            </p>
                        @endif
                    @endif
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>Simpan</x-primary-button>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">
                            Berhasil disimpan.
                        </p>
                    @endif
                </div>
            </form>
        </section>
    </div>

    <!-- Ubah Password -->
    <div class="bg-white rounded-lg border p-6">
        <section class="max-w-xl">
            <header class="mb-4">
                <h2 class="text-lg font-medium text-gray-900">
                    Ubah Kata Sandi
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Pastikan akun Anda menggunakan kata sandi yang kuat dan aman.
                </p>
            </header>

            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div>
                    <x-input-label for="current_password" value="Kata Sandi Saat Ini" />
                    <x-form-input id="current_password" name="current_password" type="password"
                        class="mt-1 block w-full" autocomplete="current-password" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" value="Kata Sandi Baru" />
                    <x-form-input id="password" name="password" type="password" class="mt-1 block w-full"
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" />
                    <x-form-input id="password_confirmation" name="password_confirmation" type="password"
                        class="mt-1 block w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>Simpan</x-primary-button>

                    @if (session('status') === 'password-updated')
                        <p class="text-sm text-gray-600">
                            Kata sandi berhasil diperbarui.
                        </p>
                    @endif
                </div>
            </form>
        </section>
    </div>

    <!-- Hapus Akun -->
    {{--
   <div class="bg-white rounded-lg border p-6">
      <section class="max-w-xl space-y-4">
         <header>
            <h2 class="text-lg font-medium text-gray-900">
               Hapus Akun
            </h2>
            <p class="mt-1 text-sm text-gray-600">
               Setelah akun dihapus, seluruh data akan dihapus secara permanen.
            </p>
         </header>

         <x-danger-button
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            Hapus Akun
         </x-danger-button>
      </section>
   </div>
   --}}

</x-app-layout>
