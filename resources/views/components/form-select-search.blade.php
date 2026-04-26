@props([
    'options' => [],
    'labelKey' => null,
    'valueKey' => null,
    'extraLabels' => [],
    'placeholder' => 'Pilih...',
    'name' => '',
    'selected' => null,
])

<div x-data="selectSearchData()" x-init="init()" @click.outside="open = false" class="relative w-full"
    data-options='@json($options)' data-selected='@json($selected)'
    data-label-key='{{ $labelKey ?? 'label' }}' data-value-key='{{ $valueKey ?? 'value' }}'
    data-extra-labels='@json($extraLabels)' data-placeholder='{{ $placeholder }}'>

    <!-- Trigger -->
    <div @click="open = !open"
        class="flex items-center justify-between px-3 py-2 mt-2 border rounded-lg cursor-pointer bg-white">
        <span x-text="selectedLabel || placeholder" class=" text-gray-700"></span>

        <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-90' : ''" fill="currentColor"
            viewBox="0 0 20 20">
            <path d="M6 4l8 6-8 6V4z" />
        </svg>
    </div>

    <!-- Dropdown -->
    <div x-show="open" x-transition
        class="absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden"
        style="max-height: 15rem; overflow-y: scroll; top: 100%; left: 0;">

        <!-- Search -->
        <div class="p-2 border-b bg-gray-50 sticky top-0">
            <input type="text" x-model="search" @input="filterOptions" placeholder="Search..."
                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <!-- Options -->
        <ul class="text-sm divide-y">

            <!-- Empty -->
            <template x-if="filteredOptions.length === 0">
                <li class="px-4 py-3 text-gray-500 text-center">
                    Tidak ditemukan
                </li>
            </template>

            <!-- List -->
            <template x-for="(option, index) in filteredOptions" :key="index">
                <li @click="select(option)"
                    class="px-4 py-2 cursor-pointer hover:bg-indigo-50 transition flex items-center justify-between"
                    :class="isSelected(option) ? 'bg-indigo-100 text-indigo-700 font-medium' : ''">

                    <!-- KIRI: Label + Extra -->
                    <div>
                        <!-- Label utama -->
                        <div class="font-medium" x-text="getLabel(option)"></div>

                        <!-- Extra labels -->
                        <template x-if="extraLabels.length > 0">
                            <div class="text-xs text-gray-500 mt-0.5">
                                <template x-for="(label, idx) in extraLabels" :key="idx">
                                    <span>
                                        <span x-text="capitalizeFirst(label) + ': ' + (option[label] ?? '-')"></span>
                                        <template x-if="idx < extraLabels.length - 1">
                                            <span>•</span>
                                        </template>
                                    </span>
                                </template>
                            </div>
                        </template>
                    </div>

                    <!-- KANAN: Check icon -->
                    <div class="ml-3 flex-shrink-0">
                        <svg x-show="isSelected(option)" class="w-4 h-4 text-indigo-600" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                </li>
            </template>

        </ul>
    </div>

    <!-- Hidden input -->
    <input type="hidden" name="{{ $name }}" x-model="selectedValue">
</div>
