@props(['title' => '', 'price' => ''])
<div class="relative z-10 rounded-lg shadow-xl">
<div
    class="pointer-events-none absolute inset-0 rounded-lg border-2 border-asg-500"></div>
<div class="absolute inset-x-0 top-0 transform translate-y-px">
    <div class="flex justify-center transform -translate-y-1/2">
                  <span
                      class="inline-flex rounded-full bg-asg-500 px-4 py-1 text-sm leading-5 font-semibold tracking-wider uppercase text-white">
                    Most popular
                  </span>
    </div>
</div>
<div class="bg-white rounded-t-lg px-6 pt-12 pb-10">
    <div>
        <h3 class="text-center text-3xl leading-9 font-semibold text-gray-900 sm:-mx-6"
            id="tier-growth">{{ $title }}</h3>
        <div class="mt-4 flex items-center justify-center">
                    <span class="px-3 flex items-start text-6xl leading-none tracking-tight text-gray-900 sm:text-6xl">
                      <span class="mt-2 mr-2 text-4xl font-medium">
                        $
                      </span>
                      <span class="font-extrabold">{{ $price }}</span>
                   </span>
            <span class="text-2xl leading-8 font-medium text-gray-500">
                      /month
                    </span>
        </div>
    </div>
</div>
<div
    class="border-t-2 border-gray-100 rounded-b-lg pt-10 pb-8 px-6 bg-gray-50 sm:px-10 sm:py-10">
    <ul>
        {{ $slot }}
    </ul>
    <div class="mt-10">
        <div class="rounded-lg shadow-md">
            <a href="#contact_us" @click="chooseOption"
               class="block w-full text-center rounded-lg border border-transparent bg-asg-500 px-6 py-4 text-xl leading-6 font-medium text-white hover:bg-asg-400 focus:outline-none focus:border-asg-600 focus:shadow-outline-indigo transition ease-in-out duration-150"
               aria-describedby="tier-growth" v-smooth-scroll>Enquire Now</a>
        </div>
    </div>
</div>
</div>