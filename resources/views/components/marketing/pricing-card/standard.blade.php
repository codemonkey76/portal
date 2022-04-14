@props(['title' => '', 'price' => ''])
<div
        {{ $attributes->merge(['class' => 'flex flex-col rounded-lg shadow-lg overflow-hidden lg:rounded-none']) }}>
        <div class="flex-1 flex flex-col">
            <div class="bg-white px-6 py-10">
                <div>
                    <h3 class="text-center text-2xl leading-8 font-medium text-gray-900"
                        id="tier-scale">{{ $title}}</h3>
                    </h3>
                    <div class="mt-4 flex items-center justify-center">
                      <span class="px-3 flex items-start text-6xl leading-none tracking-tight text-gray-900">
                        <span class="mt-2 mr-2 text-4xl font-medium">
                          $
                        </span>
                        <span class="font-extrabold">{{ $price }}</span>
                      </span>
                        <span class="text-xl leading-7 font-medium text-gray-500">
                        /month
                      </span>
                    </div>
                </div>
            </div>
            <div
                class="flex-1 flex flex-col justify-between border-t-2 border-gray-100 p-6 bg-gray-50 sm:p-10 lg:p-6 xl:p-10">
                <ul>
                    {{ $slot }}
                </ul>
                <div class="mt-8">
                    <div class="rounded-lg shadow-md">
                        <a href="#contact_us" @click="chooseOption"
                           class="block w-full text-center rounded-lg border border-transparent bg-white px-6 py-3 text-base leading-6 font-medium text-asg-500 hover:text-asg-400 focus:outline-none focus:shadow-outline transition ease-in-out duration-150"
                           aria-describedby="tier-scale" v-smooth-scroll>Enquire Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>