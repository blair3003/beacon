<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-blue-900 hover:opacity-90 font-bold py-2 px-4 rounded']) }}>
    {{ $slot }}
</button>
