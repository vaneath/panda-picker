@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-2 border-gray-300 rounded-md focus:outline-none focus:ring-0 active:border-pink-500 focus:border-pink-500 shadow-sm h-10 px-4',
]) !!}>
