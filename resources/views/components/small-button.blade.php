<span>
    <button
        {{ $attributes->merge([
            'type' => 'button',
            'class' => 'py-0.5 px-2 border rounded-md text-xs leading-5 font-medium focus:outline-none focus:border-blue-300 shadow-sm focus:shadow-outline-blue transition duration-150 ease-in-out' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
        ]) }}
    >
        {{ $slot }}
    </button>
</span>
