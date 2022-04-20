@props(['questions' => null])

@if($questions)
<div class="bg-gray-50">
    <div class="max-w-screen-xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-center text-3xl leading-9 font-extrabold text-gray-900 sm:text-4xl sm:leading-10">
                Frequently asked questions
            </h2>
            <dl>
                @foreach($questions as $question)
            <div class="mt-6 border-t-2 border-gray-200 pt-6">
                        <x-marketing.question :question="$question" />
                    </div>
                    @endforeach
            </dl>
        </div>
    </div>
</div>
@endif