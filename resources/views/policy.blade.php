<x-guest-layout>
    <div class="pt-4 bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div class="flex items-center">
                <x-application-mark />
                <span class="uppercase font-serif text-2xl ms-3">ROBERT CAMBA'S CATERING SERVICES</span>
            </div>

            <div class="w-full sm:max-w-5xl my-6 p-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg prose dark:prose-invert">
                {!! $policy !!}
            </div>
        </div>
    </div>
</x-guest-layout>
