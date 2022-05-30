@props([
    'color' => 'red'
    ])
<span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 bg-{{$color}}-100 text-{{$color}}-800">{{ $slot }}</span>
