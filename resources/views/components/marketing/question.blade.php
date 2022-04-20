@props(['question' => null])
<div x-data="{
    isOpen: false,
}">
    <dt class="text-lg leading-7">
        <!-- Expand/collapse question button -->
        <button @click="isOpen = !isOpen" class="text-left w-full flex justify-between items-start text-gray-400 focus:outline-none focus:text-gray-900">
            <span class="font-medium text-gray-900">
                {{ $question->title }}
            </span>
            <span class="ml-6 h-7 flex items-center">
                <svg :class="{'-rotate-180' : isOpen, 'rotate-0': !isOpen}" class="h-6 w-6 transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </span>
        </button>
    </dt>
    <dd x-show="isOpen" class="mt-2 pr-12">
        <div class="text-base leading-6 text-gray-500">
            {!! $question->answer !!}
        </div>
    </dd>
</div>