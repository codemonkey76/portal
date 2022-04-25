<span>
    <button
        {{ $attributes->merge([
            'class' => 'py-0.5 px-0.5 border rounded-md text-xs leading-5 font-medium focus:outline-none focus:border-blue-300 shadow-sm focus:shadow-outline-blue transition duration-150 ease-in-out text-white bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border-indigo-600' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
            'type' => 'button']) }}>
    {{ $slot }}
    </button>
</span>
