<a
    href="{{ Route::has($route) ? route($route):  '#' }}"
    title="{{ $label }}"
    {{ $attributes->merge([
        'class' => 'group flex items-center px-2 py-2 text-sm leading-5 font-medium rounded-md focus:outline-none ' .
            'focus:bg-gray-700 transition ease-in-out duration-150 ' .
            (Route::is($route) ?
                'text-white bg-gray-900':
                'text-gray-300 hover:text-white hover:bg-gray-700') . ($attributes->get('first', true) ? '' : ' mt-1')
    ]) }}>
    <svg
        class="mr-3 h-6 w-6 text-gray-300 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150 fill-current"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor">
        {{ $slot }}
    </svg>
    {{ $label }}
</a>