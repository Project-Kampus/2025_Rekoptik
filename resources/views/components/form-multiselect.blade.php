@props([
    'name' => '',
    'options' => [],
    'labelKey' => 'name',
    'valueKey' => 'id',
    'placeholder' => 'Pilih...',
    'selected' => [],
])


<div x-data="multiSelect()" x-init="init();
$watch('selected', function(val) {
    setTimeout(() => {
        if (typeof updateSummary === 'function') {
            updateSummary();
        }
    }, 50);
}, { deep: true });" {{ $attributes->merge(['class' => 'relative']) }}
    data-options='@json($options)' data-label-key="{{ $labelKey }}" data-value-key="{{ $valueKey }}"
    data-selected='@json(old($name, $selected))'>

    <!-- Trigger -->
    <div @click="open = !open" class="border rounded px-3 py-2 cursor-pointer shadow-sm min-h-[40px] flex flex-wrap gap-1"
        :class="open ? 'border-indigo-500 ring-1 ring-indigo-500' : 'border-gray-300'">
        <template x-for="id in selected" :key="id">
            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs mr-1 mb-1"
                x-text="options.find(o => String(o[valueKey]) === String(id))?.[labelKey] || '-'">
            </span>
        </template>

        <span x-show="selected.length === 0" class="text-gray-400">
            {{ $placeholder }}
        </span>
    </div>

    <!-- Dropdown -->
    <div x-show="open" @click.away="open = false"
        class="absolute z-10 bg-white border rounded mt-1 w-full max-h-48 overflow-auto shadow-lg">

        <template x-for="option in options" :key="getValue(option)">
            <div @click="toggle(option)" class="px-3 py-2 hover:bg-blue-50 cursor-pointer flex items-center">
                <input type="checkbox" :checked="isSelected(option)" class="mr-2">

                <span x-text="getLabel(option)"></span>
            </div>
        </template>

    </div>

    <!-- Hidden inputs -->
    <template x-for="id in selected" :key="id">
        <input type="hidden" name="{{ $name }}[]" :value="id">
    </template>
</div>
