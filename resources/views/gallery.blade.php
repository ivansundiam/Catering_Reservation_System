<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-10 overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <h3 class="heading-text !text-[1.5rem] text-primary-hover self-start mb-3 lg:mb-5">Gallery</h3>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4" x-data="{ isOpen: false, imageShown: '' }">
                    <div class="grid gap-4">
                        <div class="min-h-[20rem]" x-on:click="isOpen = true; imageShown = 1">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery1.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 2">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery2.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 3">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery3.webp') }}" alt="gallery-image">
                        </div>
                        <div class="min-h-[20rem]" x-on:click="isOpen = true; imageShown = 13">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery13.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 14">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery14.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 15">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery15.webp') }}" alt="gallery-image">
                        </div>
                    </div>
                    <div class="grid gap-4">
                        <div x-on:click="isOpen = true; imageShown = 4">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery4.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 5">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery5.webp') }}" alt="gallery-image">
                        </div>
                        <div  class="min-h-[20rem]" x-on:click="isOpen = true; imageShown = 6">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery6.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 16">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery16.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 17">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery17.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 18">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery18.webp') }}" alt="gallery-image">
                        </div>
                    </div>
                    <div class="grid gap-4">
                        <div class="min-h-[20rem]" x-on:click="isOpen = true; imageShown = 7">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery7.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 8">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery8.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 9">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery9.webp') }}" alt="gallery-image">
                        </div>
                        <div class="min-h-[20rem]" x-on:click="isOpen = true; imageShown = 19">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery19.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 20">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery20.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 21">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery21.webp') }}" alt="gallery-image">
                        </div>
                    </div>
                    <div class="grid gap-4">
                        <div x-on:click="isOpen = true; imageShown = 10">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery10.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 11">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery11.webp') }}" alt="gallery-image">
                        </div>
                        <div  class="min-h-[20rem]" x-on:click="isOpen = true; imageShown = 12">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery12.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 22">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery22.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 23">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery23.webp') }}" alt="gallery-image">
                        </div>
                        <div x-on:click="isOpen = true; imageShown = 1">
                            <img class="h-full max-w-full object-cover rounded-lg cursor-pointer" src="{{ asset('assets/web-images/high/gallery1.webp') }}" alt="gallery-image">
                        </div>
                    </div>

                    <div x-show.transition.opacity="isOpen"  id="gallery" class="fixed inset-0 z-40 bg-black bg-opacity-50" data-carousel="static"
                        x-data="{ selectedImage: 5 }"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">
                        <!-- Close button -->
                        <button x-on:click="isOpen = false" class="hover:bg-gray-300 active:bg-gray-100 hover:bg-opacity-50 active:bg-opacity-50 p-1 rounded-full absolute z-50 top-0 right-0 m-4 text-white focus:outline-none">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>

                        <!-- Carousel wrapper -->
                        <div class="relative overflow-hidden rounded-lg h-full">
                            <template x-for="i in 24">
                                <div x-bind:class="{ 'hidden': i != imageShown }" class="duration-700 ease-in-out" data-carousel-item="i == imageShown ? 'active' : ''">
                                    <img x-bind:src="'{{ asset('assets/web-images/high/gallery') }}' + i + '.webp'" class="absolute object-cover block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
                                </div>
                            </template>
                        </div>
                        <!-- Slider controls -->
                        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                </svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
</x-app-layout>