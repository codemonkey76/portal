<x-guest-layout>
    <a id="home"></a>
    <x-marketing.header />
    <main class="-mt-32">
        <div class="max-w-7xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
            <x-marketing.hero />
        </div>
    </main>
    <x-marketing.pricing />
    <x-marketing.testimonials :testimonial="$testimonial ?? null" />
    <x-marketing.features :features="$features ?? null" />
    <x-marketing.faq :questions="$questions ?? null" />
    <x-marketing.contact />
    <x-marketing.footer />
</x-guest-layout>