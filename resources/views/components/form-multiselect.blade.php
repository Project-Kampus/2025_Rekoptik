@props(['name', 'options' => [], 'labelKey' => 'name', 'selected' => [], 'placeholder' => 'Pilih...'])

@php
    $mappedOptions = collect($options)->mapWithKeys(fn($o) => [$o['id'] => $o[$labelKey]])->toArray();
@endphp

<div x-data="{
    open: false,
    selected: @js(old($name, $selected)),
    options: @js($mappedOptions)
}" class="relative">
    <!-- Trigger -->
    <div @click="open = !open" class="border rounded px-3 py-2 bg-white cursor-pointer min-h-[40px] flex flex-wrap gap-1">
        <template x-for="id in selected" :key="id">
            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs mr-1 mb-1" x-text="options[id]"></span>
        </template>

        <span x-show="selected.length === 0" class="text-gray-400">
            {{ $placeholder }}
        </span>
    </div>

    <!-- Dropdown -->
    <div x-show="open" @click.away="open = false"
        class="absolute z-10 bg-white border rounded mt-1 w-full max-h-48 overflow-auto shadow-lg">
        <template x-for="(label, id) in options" :key="id">
            <div @click="
                    selected.includes(id)
                        ? selected = selected.filter(i => i !== id)
                        : selected.push(id)
                "
                class="px-3 py-2 hover:bg-blue-50 cursor-pointer flex items-center">
                <input type="checkbox" :checked="selected.includes(id)" class="mr-2">
                <span x-text="label"></span>
            </div>
        </template>
    </div>

    <!-- Hidden inputs -->
    <template x-for="id in selected" :key="id">
        <input type="hidden" name="{{ $name }}[]" :value="id">
    </template>
</div>
