<x-app-layout>

   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('Profile') }}
      </h2>
   </x-slot>

   <!-- Profile Information -->
   <div class="bg-white rounded-lg border p-6">
      <section class="max-w-xl">
         <header class="mb-4">
            <h2 class="text-lg font-medium text-gray-900">
               {{ __('Profile Information') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
               {{ __("Update your account's profile information and email address.") }}
            </p>
         </header>

         <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
         </form>

         <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('patch')

            <div>
               <x-input-label for="name" :value="__('Name')" />
               <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                  :value="old('name', $user->name)" required autofocus autocomplete="name" />
               <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
               <x-input-label for="email" :value="__('Email')" />
               <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                  :value="old('email', $user->email)" required autocomplete="username" />
               <x-input-error class="mt-2" :messages="$errors->get('email')" />

               @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
               <p class="text-sm mt-2 text-gray-800">
                  {{ __('Your email address is unverified.') }}
                  <button form="send-verification"
                     class="underline text-sm text-gray-600 hover:text-gray-900">
                     {{ __('Click here to re-send the verification email.') }}
                  </button>
               </p>

               @if (session('status') === 'verification-link-sent')
               <p class="mt-2 text-sm font-medium text-green-600">
                  {{ __('A new verification link has been sent to your email address.') }}
               </p>
               @endif
               @endif
            </div>

            <div class="flex items-center gap-4">
               <x-primary-button>{{ __('Save') }}</x-primary-button>

               @if (session('status') === 'profile-updated')
               <p x-data="{ show: true }" x-show="show" x-transition
                  x-init="setTimeout(() => show = false, 2000)"
                  class="text-sm text-gray-600">
                  {{ __('Saved.') }}
               </p>
               @endif
            </div>
         </form>
      </section>
   </div>

   <!-- Update Password -->
   <div class="bg-white rounded-lg border p-6">
      <section class="max-w-xl">
         <header class="mb-4">
            <h2 class="text-lg font-medium text-gray-900">
               {{ __('Update Password') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
               {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
         </header>

         <form method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <div>
               <x-input-label for="current_password" :value="__('Current Password')" />
               <x-text-input id="current_password" name="current_password" type="password"
                  class="mt-1 block w-full" autocomplete="current-password" />
               <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div>
               <x-input-label for="password" :value="__('New Password')" />
               <x-text-input id="password" name="password" type="password"
                  class="mt-1 block w-full" autocomplete="new-password" />
               <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
               <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
               <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                  class="mt-1 block w-full" autocomplete="new-password" />
               <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
               <x-primary-button>{{ __('Save') }}</x-primary-button>

               @if (session('status') === 'password-updated')
               <p class="text-sm text-gray-600">{{ __('Saved.') }}</p>
               @endif
            </div>
         </form>
      </section>
   </div>

   <!-- Delete Account -->
   <div class="bg-white rounded-lg border p-6">
      <section class="max-w-xl space-y-4">
         <header>
            <h2 class="text-lg font-medium text-gray-900">
               {{ __('Delete Account') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
               {{ __('Once your account is deleted, all data will be permanently removed.') }}
            </p>
         </header>

         <x-danger-button
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            {{ __('Delete Account') }}
         </x-danger-button>
      </section>
   </div>

</x-app-layout>