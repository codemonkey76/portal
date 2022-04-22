@props(['value' => false])
<span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 {{ $value ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $value ? 'Active' : 'Inactive' }}</span>