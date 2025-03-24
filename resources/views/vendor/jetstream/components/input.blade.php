@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!} >
