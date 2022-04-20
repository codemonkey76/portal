@props(['features' => null])

@if($features)
<div class="py-12 bg-white">
    <a id="services" class="absolute -mt-20"></a>
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <p class="text-base leading-6 text-asg-500 font-semibold tracking-wide uppercase">VoIP Benefits</p>
            <h3 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                Reasons to choose VoIP
            </h3>
            <p class="mt-4 max-w-2xl text-xl leading-7 text-gray-500 lg:mx-auto">
                VoIP services are superior to traditional telephone services in many ways.
            </p>
        </div>

        <div class="mt-10">
            <ul class="md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                @foreach($features as $feature)
                <li>
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-asg-400 text-white">
                                {!! $feature->icon !!}
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg leading-6 font-medium text-gray-900">{{ $feature->title }}</h4>
                            <p class="mt-2 text-base leading-6 text-gray-500">{!! $feature->description !!}</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif