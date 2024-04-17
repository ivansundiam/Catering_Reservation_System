<x-app-layout>
    <div class="relative selection:bg-primary selection:text-white h-[420px] lg:h-[620px]" >
        <img src="{{ asset('assets/web-web-images/lowages/high/hero-bg.webp') }}"  fetchpriority="high" class="z-0 w-full bg-cover absolute h-[420px] lg:h-[620px]" alt="Hero image">
        <img src="{{ asset('assets/web-images/low/hero-bg.webp') }}" width="620px" height="420px" fetchpriority="high" class="z-0 w-full bg-cover absolute h-[420px] lg:h-[620px]" alt="Hero image">

        <div class="relative z-10 flex items-center w-full h-full bg-gradient-to-r from-black to-transparent" >
            <div class="w-full px-5 text-center text-white sm:px-10 md:px-20 sm:text-left ">
                <p class="md:mb-3 title-primary ">Welcome to Robert Camba's Catering</p>
                <h1 class="heading-text !text-[2rem] lg:!text-[3rem] select-none md:w-2/3 lg:w-3/5">Providing elegant catering service for years.</h1>
                <p class="mt-4 mb-10 text-sm sm:text-base">Have it experienced and be surprised.</p>
                <a href="{{ route('reservation.create') }}" class="px-7 py-2 md:!px-10 md:!py-4 btn-primary-outline">Make a Reservation</a>
                
                <!-- chatbot -->
                <x-chat />

            </div>
        </div>
    </div> 

    {{-- services --}}
    <section class="bg-primary-light selection:bg-primary selection:text-white min-h-[38rem]" id="services"
        x-data="{ isOnServices: false }"
        x-on:scroll.window.$once="if(window.scrollY > 300) isOnServices = true">
        
        <div class="container flex flex-col justify-center py-8 md:py-16"
            x-show="isOnServices"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-12"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-12">

            <div class="flex flex-col items-center grow mb-9">
                <p class="title-primary">services</p>
                <h1 class="heading-text">Our services</h1>
                <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. At quibusdam eaque, quis eligendi tenetur deserunt.</p>
            </div>

            {{-- <div class="grid mx-12 md:mx-0 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 sm:gap-x-12 gap-y-6"  --}}
            <div class="relative">
                <div class="flex p-5 pb-12 mx-12 overflow-x-scroll md:mx-0 no-scrollbar" 
                    x-show="isOnServices"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-12"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-12">
    
                    <a href="{{ asset('assets/packages/sapphire.pdf') }}" target="_blank" class="mx-2 duration-300 ease-in-out bg-gray-600 shadow cursor-pointer hover:shadow-xl hover:scale-105 min-w-72">
                        <h4 class="text-lg text-white my-3 text-center !font-noticia">Wedding & Debut: Sapphire</h4>
                        <img src="{{ asset('assets/web-images/low/package-sapphire.webp') }}" class="package-service"  fetchpriority="high" alt="package sapphire">
                    </a>
                    
                    <a href="{{ asset('assets/packages/silver.pdf') }}" target="_blank" class="mx-2 duration-300 ease-in-out bg-gray-600 shadow cursor-pointer hover:shadow-xl hover:scale-105 min-w-72">
                        <h4 class="text-lg text-white my-3 text-center !font-noticia">Wedding & Debut: Silver</h4>
                        <img src="{{ asset('assets/web-images/low/package-silver.webp') }}" class="package-service"  fetchpriority="high" alt="package silver">
                    </a>
                    
                    <a href="{{ asset('assets/packages/ruby.pdf') }}" target="_blank" class="mx-2 duration-300 ease-in-out bg-gray-600 shadow cursor-pointer hover:shadow-xl hover:scale-105 min-w-72">
                        <h4 class="text-lg text-white my-3 text-center !font-noticia">Wedding & Debut: Ruby</h4>
                        <img src="{{ asset('assets/web-images/low/package-ruby.webp') }}" class="package-service"  fetchpriority="high" alt="package ruby">
                    </a>
                    
                    <a href="{{ asset('assets/packages/gold.pdf') }}" target="_blank" class="mx-2 duration-300 ease-in-out bg-gray-600 shadow cursor-pointer hover:shadow-xl hover:scale-105 min-w-72">
                        <h4 class="text-lg text-white my-3 text-center !font-noticia">Wedding & Debut: Gold</h4>
                        <img src="{{ asset('assets/web-images/low/package-gold.webp') }}" class="package-service"  fetchpriority="high" alt="package gold">
                    </a>
                    
                    <a href="{{ asset('assets/packages/tiffany.pdf') }}" target="_blank" class="mx-2 duration-300 ease-in-out bg-gray-600 shadow cursor-pointer hover:shadow-xl hover:scale-105 min-w-72">
                        <h4 class="text-lg text-white my-3 text-center !font-noticia">Wedding & Debut: Tiffany</h4>
                        <img src="{{ asset('assets/web-images/low/package-tiffany.webp') }}" class="package-service"  fetchpriority="high" alt="package tiffany">
                    </a>
    
                    <a href="{{ asset('assets/packages/ordinary.pdf') }}" target="_blank" class="mx-2 duration-300 ease-in-out bg-gray-600 shadow cursor-pointer hover:shadow-xl hover:scale-105 min-w-72">
                        <h4 class="text-lg text-white my-3 text-center !font-noticia">Dinner / Lunch Buffet: Ordinary</h4>
                        <img src="{{ asset('assets/web-images/low/package-ordinary.webp') }}" class="package-service"  fetchpriority="high" alt="package ordinary">
                    </a>
    
                    <a href="{{ asset('assets/packages/special.pdf') }}" target="_blank" class="mx-2 duration-300 ease-in-out bg-gray-600 shadow cursor-pointer hover:shadow-xl hover:scale-105 min-w-72">
                        <h4 class="text-lg text-white my-3 text-center !font-noticia">Dinner / Lunch Buffet: Special</h4>
                        <img src="{{ asset('assets/web-images/low/package-special.webp') }}" class="package-service"  fetchpriority="high" alt="package special">
                    </a>
    
                </div>

                <!-- fade sides -->
                <div class="absolute inset-y-0 left-0 w-8 pointer-events-none bg-gradient-to-r from-primary-light to-trasparent"></div>
                <div class="absolute inset-y-0 right-0 w-8 pointer-events-none bg-gradient-to-l to-trasparent from-primary-light"></div>
            </div>
        </div>
    </section>

    {{-- about us --}}
    <section class="bg-white selection:bg-primary selection:text-white" id="about"
        x-data="{ isOnAbout: false }"
        x-on:scroll.window="if(window.scrollY > 1100) isOnAbout = true">
        <div class="container flex flex-col py-16 md:flex-row">
            <div class="relative w-full md:w-1/2 ">
                <div x-show="isOnAbout"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-x-12"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 translate-x-12"
                >
                    <img src="{{ asset('assets/web-images/high/about-img1.webp') }}" class="absolute top-0 object-cover left-[calc(50%-200px)] lg:left-[calc(50%-264px)] w-80 h-40 md:size-64 lg:size-96"  fetchpriority="high" alt="about 1">
                    <img src="{{ asset('assets/web-images/high/about-img2.webp') }}" class="absolute object-cover w-44 h-24 border-4 border-white top-12 left-[calc(50%)] md:w-32 md:h-44 lg:w-48 lg:h-64 md:left-36 md:top-16 lg:left-[calc(50%+12px)] lg:top-28"  fetchpriority="high" alt="about 2">
                </div>
            </div>
            <div class="flex flex-col justify-center w-full pl-8 mt-48 text-left md:mt-0 md:w-1/2 md:h-64 lg:h-96 md:pl-0">
                <div x-show="isOnAbout"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-12"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-12">
                    <p class="title-primary">About us</p>
                    <h1 class="heading-text !text-[1.5rem] md:!text-[1.8rem] lg:!text-[3rem]">elegant yet inexpensive, have it experienced and be surprised</h1>
                    <p class="mb-8 text-sm md:text-base">Lorem ipsum dolor sit amet consectetur adipisicing elit. At quibusdam eaque, quis eligendi tenetur deserunt.</p>
                    <a href="" class="md:px-4 md:!py-3 lg:px-6 lg:!py-4 btn-primary-outline text-sm md:text-base ">More About Us</a>
                </div>
            </div>
        </div>
    </section>

    {{-- gallery --}}
    <section class="w-full bg-primary-light selection:bg-primary selection:text-white" id="gallery"
        x-data="{ isOnGallery: false }"
        x-on:scroll.window="if(window.scrollY > 1500) isOnGallery = true">
        <div class="container py-16">
            
            <div class="min-h-28">
                <div class="flex flex-col items-center grow" x-show="isOnGallery"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-12"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-12">
                    <p class="title-primary">gallery</p>
                    <h1 class="heading-text">Our gallery</h1>
                    <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. At quibusdam eaque, quis eligendi tenetur deserunt.</p>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-1 mt-10 md:gap-5">
                <div x-show="isOnGallery"
                    x-transition:enter="transition ease-out duration-300 delay-100 transform"
                    x-transition:enter-start="opacity-0 translate-y-12"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-12">
                    <button type="button" class="relative inline-block overflow-hidden size-full min-h-28 md:min-h-64">
                        <img src="{{ asset('assets/web-images/high/facility1.webp') }}" class="gallery-img"  fetchpriority="high" alt="facility 1">
                    </button>
                </div>
                <div x-show="isOnGallery"
                    x-transition:enter="transition ease-out duration-300 delay-[150ms] transform"
                    x-transition:enter-start="opacity-0 translate-y-12"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-12">
                    <button type="button" class="relative inline-block overflow-hidden size-full min-h-64">
                        <img src="{{ asset('assets/web-images/high/facility2.webp') }}" class="gallery-img"  fetchpriority="high" alt="facility 2">
                    </button>
                </div>
                <div x-show="isOnGallery"
                    x-transition:enter="transition ease-out duration-300 delay-200 transform"
                    x-transition:enter-start="opacity-0 translate-y-12"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-12">
                    <button type="button" class="relative inline-block overflow-hidden size-full min-h-64">
                        <img src="{{ asset('assets/web-images/high/facility3.webp') }}" class="gallery-img"  fetchpriority="high" alt="facility 3">
                    </button>
                </div>
                <div x-show="isOnGallery"
                    x-transition:enter="transition ease-out duration-300 delay-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-12"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-12">
                    <button type="button" class="relative inline-block overflow-hidden size-full min-h-64">
                        <img src="{{ asset('assets/web-images/high/facility1.webp') }}" class="gallery-img"  fetchpriority="high" alt="facility 1">
                    </button>
                </div>
                <div x-show="isOnGallery"
                    x-transition:enter="transition ease-out duration-300 delay-[350ms] transform"
                    x-transition:enter-start="opacity-0 translate-y-12"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-12">
                    <button type="button" class="relative inline-block overflow-hidden size-full min-h-64">
                        <img src="{{ asset('assets/web-images/high/facility2.webp') }}" class="gallery-img"  fetchpriority="high" alt="facility 2">
                    </button>
                </div>
                <div x-show="isOnGallery"
                    x-transition:enter="transition ease-out duration-300 delay-[400ms] transform"
                    x-transition:enter-start="opacity-0 translate-y-12"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-12">
                    <button type="button" class="relative inline-block overflow-hidden size-full min-h-64">
                        <img src="{{ asset('assets/web-images/high/facility3.webp') }}" class="gallery-img"  fetchpriority="high" alt="facility 3">
                    </button>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
