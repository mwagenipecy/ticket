<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn bg-red-600 hover:bg-red-500 text-white whitespace-nowrap']) }}>
    {{ $slot }}
</button>
