@props([
    'name',
    'options' => [],
    'valueKey' => 'id',
    'labelKey',
    'extraLabels' => null,
    'placeholder' => 'Pilih data',
    'selected' => null,
])

@php
    // Support both singular 'extraLabel' and plural 'extraLabels' for backward compatibility
    $extraLabelList = $extraLabels;
    if (is_string($extraLabelList)) {
        $extraLabelList = [$extraLabelList];
    } elseif (!is_array($extraLabelList)) {
        $extraLabelList = [];
    }
@endphp

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
            @foreach ($extraLabelList as $extra)
                {{ ' - ' . $option[$extra] }}
            @endforeach
        </option>
    @empty
        <option disabled>Tidak ada data</option>
    @endforelse
</select>
