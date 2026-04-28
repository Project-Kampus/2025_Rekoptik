@props(['id', 'title' => 'Konfirmasi'])

<div x-data="{ open: false }" x-show="open" @open-modal.window="if ($event.detail === '{{ $id }}') open = true"
    @close-modal.window="open = false" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">

        <!-- TITLE -->
        <h2 class="text-lg font-semibold text-gray-900 text-center">
            {{ $title }}
        </h2>

        <!-- CONTENT -->
        <div class="mt-3 text-sm text-gray-600 text-center">
            {{ $slot }}
        </div>

        <!-- ACTION -->
        <div class="mt-6 flex justify-end gap-3">
            <button type="button" @click="open = false"
                class="px-4 py-2 text-sm border rounded-md text-gray-700 hover:bg-gray-100">
                Batal
            </button>

            {{ $actions }}
        </div>

    </div>
</div>
