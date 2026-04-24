@props(['disabled' => false, 'type' => 'text'])

@if ($type === 'rupiah')
    <input @disabled($disabled) type="text" data-currency="rupiah"
        {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm currency-input']) }}>

    @php
        $displayName = $attributes->get('data-display-name') ?? $attributes->get('name') . '_display';
        $actualName = $attributes->get('name');
        $value = $attributes->get('value');
    @endphp

    <input type="hidden" name="{{ $actualName }}" class="currency-hidden" value="{{ $value }}">
@else
    <input type="{{ $type }}" @disabled($disabled)
        {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
@endif
