<div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
        <table class="min-w-full divide-y divide-gray-300">
            @if(isset($head) && $head != null)
                <thead class="bg-gray-50">
                    <tr>
                        {{ $head }}
                    </tr>
                </thead>
            @endif

            @if(isset($body) && $body != null)
                <tbody class="divide-y divide-gray-200 bg-white">
                    {{ $body }}
                </tbody>
            @endif

            @if (isset($foot) && $foot != null)
                <tfoot>
                    {{ $foot }}
                </tfoot>
            @endif
        </table>
    </div>
</div>
