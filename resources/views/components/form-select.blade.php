@props([
    'name',
    'options' => [],
    'valueKey' => 'id',
    'labelKey',
    'extraLabel' => null,
    'placeholder' => 'Pilih data',
    'selected' => null,
])


{{-- Select --}}
<select name="{{ $name }}" id="{{ $name }}"
    {{ $attributes->merge([
        'class' => 'mt-1 rounded-md border-gray-300',
    ]) }}>
    {{-- Placeholder --}}
    <option value="">{{ $placeholder }}</option>

    {{-- Options --}}
    @forelse ($options as $option)
        <option value="{{ $option[$valueKey] }}" @selected(old($name, $selected) == $option[$valueKey])>
            {{ $option[$labelKey] }}
            {{ $extraLabel ? ' - ' . $option[$extraLabel] : '' }}
        </option>
    @empty
        <option disabled>Tidak ada data</option>
    @endforelse
</select>
