<x-app-layout>
    <div class="bg-cover w-full selection:bg-primary selection:text-white h-[420px] lg:h-[620px]" style="background-image: url('assets/hero-bg.jpg')">
        <div class="flex items-center w-full h-full bg-gradient-to-r from-black to-transparent" >
            <div class="w-full px-5 text-center text-white sm:px-10 md:px-20 sm:text-left ">
                <p class="md:mb-3 title-primary ">Welcome to Robert Camba's Catering</p>
                <h1 class="heading-text !text-[2rem] lg:!text-[3rem] select-none md:w-2/3 lg:w-3/5">Providing elegant catering service for years.</h1>
                <p class="mt-4 mb-10 text-sm sm:text-base">Have it experienced and be surprised.</p>
                <a href="{{ route('reservation.create') }}" class="px-7 py-2 md:!px-10 md:!py-4 btn-primary-outline">Make a Reservation</a>
      
                <div x-data="{ isVisible: false, isChatOpen: false }" x-on:scroll.window="isVisible = window.scrollY > 100" x-cloak>
                    
                    <x-chat />

                    {{-- <div x-show="isVisible" x-transition class="fixed bottom-6 z-50 right-6 btn-primary !text-white !p-0 shadow-lg ">
                        <a href="{{ route('login') }}" class="btn-primary text-sm md:text-base md:!px-6 md:!py-3 shadow-md">
                            {{ __('Reserve Now!') }}
                        </a>
                        <livewire:auth.login-modal :buttonName="'Reserve Now!'" :classes="'nav-link !text-white !no-underline'" />
                    </div> --}}
                    {{-- <button x-show="isVisible && !isChatOpen" x-on:click="isChatOpen = !isChatOpen" 
                        x-transition class="fixed z-50 p-1 bg-gray-800 rounded-full shadow-lg md:p-2 bottom-4 left-6">
                        <svg class="size-[34px]" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools --> <title>ic_fluent_chat_help_24_filled</title> <desc>Created with Sketch.</desc> <g id="🔍-System-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="ic_fluent_chat_help_24_filled" fill="#dedede" fill-rule="nonzero"> <path d="M12,2 C17.5228,2 22,6.47715 22,12 C22,17.5228 17.5228,22 12,22 C10.3596,22 8.77516,21.6039 7.35578,20.8583 L3.06538,21.9753 C2.6111,22.0937 2.1469,21.8213 2.02858,21.367 C1.99199,21.2266 1.99198,21.0791 2.02855,20.9386 L3.1449,16.6502 C2.3972,15.2294 2,13.6428 2,12 C2,6.47715 6.47715,2 12,2 Z M12,15.5 C11.4477,15.5 11,15.9477 11,16.5 C11,17.0523 11.4477,17.5 12,17.5 C12.5523,17.5 13,17.0523 13,16.5 C13,15.9477 12.5523,15.5 12,15.5 Z M12,6.75 C10.4812,6.75 9.25,7.98122 9.25,9.5 C9.25,9.91421 9.58579,10.25 10,10.25 C10.3797,10.25 10.6935,9.96785 10.7432,9.60177 L10.7565,9.37219 C10.8205,8.74187 11.3528,8.25 12,8.25 C12.6904,8.25 13.25,8.80964 13.25,9.5 C13.25,10.0388 13.115,10.3053 12.6051,10.8322 L12.3011,11.1414 C11.5475,11.926 11.25,12.4892 11.25,13.5 C11.25,13.9142 11.5858,14.25 12,14.25 C12.4142,14.25 12.75,13.9142 12.75,13.5 C12.75,12.9612 12.885,12.6947 13.3949,12.1678 L13.6989,11.8586 C14.4525,11.074 14.75,10.5108 14.75,9.5 C14.75,7.98122 13.5188,6.75 12,6.75 Z" id="🎨-Color"> </path> </g> </g> </g></svg>
                    </button> --}}
                    {{-- <div x-show="isVisible && isChatOpen" x-on:click.away="isChatOpen = false"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-96"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-300 transform"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-96"
                        class="fixed z-50 overflow-hidden text-black bg-white rounded-lg rounded-bl-none shadow-lg bottom-4 left-6">
                        <div class=" w-96">
                            <div class="flex items-center justify-between text-white bg-gray-800">
                                <p class="px-4">Need Help?</p>
                                <button x-on:click="isChatOpen = false" class="px-4 py-1 text-2xl font-bold text-gray-500 hover:bg-gray-700">
                                    ×
                                </button>
                            </div>

                            <div class="flex flex-col max-h-96 h-96">
                                <div class="p-4 bg-gray-200 grow">
                                    <iframe src="/chat" frameborder="0" width="100%" height="100%"></iframe>
                                </div>
                                <form action="{{ url('/botman') }}" method="post">
                                    <input type="text" class="border-0 w-full h-[3rem] focus:outline-none focus:ring-0" placeholder="Ask a question">
                                </form>
                            </div>
                        </div>
                    </div> --}}
                </div>      

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
            x-transition:leave-end="opacity-0 translate-y-12"
        >
            <div class="flex flex-col items-center grow mb-9">
                <p class="title-primary">services</p>
                <h1 class="heading-text">Our services</h1>
                <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. At quibusdam eaque, quis eligendi tenetur deserunt.</p>
            </div>

            <div class="grid mx-12 md:mx-0 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 sm:gap-x-12 gap-y-6" 
            x-show="isOnServices"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-12"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-12"
            >
                <a href="{{ route('reservation.create') }}"  class="duration-300 ease-in-out transform bg-gray-400 rounded-lg shadow-lg hover:shadow-xl hover:scale-110">
                    <img src="{{ asset('assets/service1.png') }}" class="package-service" alt="">
                    <h4 class="heading-text !text-2xl text-white mt-3 text-center">package 1</h4>
                    <p class="mb-5 text-center text-white">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis dignissimos, ea consequatur molestiae officia eligendi?</p>
                </a>
                <a href="{{ route('reservation.create') }}" class="duration-300 ease-in-out transform bg-gray-400 rounded-lg shadow-lg hover:shadow-xl hover:scale-110">
                    <img src="{{ asset('assets/service2.png') }}" class="package-service" alt="">
                    <h4 class="heading-text !text-2xl text-white mt-3 text-center">package 2</h4>
                    <p class="mb-5 text-center text-white">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis dignissimos, ea consequatur molestiae officia eligendi?</p>
                </a>
                <a href="{{ route('reservation.create') }}" class="duration-300 ease-in-out transform bg-gray-400 rounded-lg shadow-lg hover:shadow-xl hover:scale-110">
                    <img src="{{ asset('assets/service3.png') }}" class="package-service" alt="">
                    <h4 class="heading-text !text-2xl text-white mt-3 text-center">package 3</h4>
                    <p class="mb-5 text-center text-white">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis dignissimos, ea consequatur molestiae officia eligendi?</p>
                </a>
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
                    <img src="{{ asset('assets/about-img1.jpg') }}" class="absolute top-0 object-cover left-[calc(50%-200px)] lg:left-[calc(50%-264px)] w-80 h-40 md:size-64 lg:size-96" alt="">
                    <img src="{{ asset('assets/about-img2.jpg') }}" class="absolute object-cover w-44 h-24 border-4 border-white top-12 left-[calc(50%)] md:w-32 md:h-44 lg:w-48 lg:h-64 md:left-36 md:top-16 lg:left-[calc(50%+12px)] lg:top-28" alt="">
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
                        <img src="{{ asset('assets/facility1.jpg') }}" class="gallery-img" alt="">
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
                        <img src="{{ asset('assets/facility2.jpg') }}" class="gallery-img" alt="">
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
                        <img src="{{ asset('assets/facility3.jpg') }}" class="gallery-img" alt="">
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
                        <img src="{{ asset('assets/facility1.jpg') }}" class="gallery-img" alt="">
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
                        <img src="{{ asset('assets/facility2.jpg') }}" class="gallery-img" alt="">
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
                        <img src="{{ asset('assets/facility3.jpg') }}" class="gallery-img" alt="">
                    </button>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
