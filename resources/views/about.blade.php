<x-app-layout>
    <div class="pt-4 bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 container pb-12">
            <div class="flex items-center mb-5">
                <x-application-mark />
                <span class="uppercase font-serif text-2xl ms-3">ROBERT CAMBA'S CATERING SERVICES</span>
            </div>
            <h3 class="heading-text !text-[1.5rem] text-primary-hover self-start mb-2 lg:mb-3">About Us</h3>

            <div class="flex flex-col lg:flex-row gap-x-20 items-start">
                <div class="w-full lg:w-[70%] text-justify">

                    <p class="mb-5">Robert Camba Catering Services is owned and managed by Mr. Robert Camba. It has been rendering service in and out of metropolis since 1989. For 15 years, it delivers elegant yet inexpensive services.</p>
                    <p class="mb-5">Robert Camba is a graduate of Philippine Christian University (PCU) with a degree of Bachelor of Arts in Business Administration in 1981. Robert, a.k.a to his friends, is a native of Barangay San Vicente, Bani, Pangasinan.</p>
                    <p class="mb-5">Robert Camba is a founding member of the Food Caterers Association of the Philippines (FCAP) and one of the caliber pioneers in equipment rentals and catering industry. He started his entrepreneurial legacy in chairs and tables rentals in 1984 under the auspice of “Camba Chairs Rentals”. Corollary to the expansion of the business, the tables and chairs rentals latter includes catering equipment.</p>
                    <p class="mb-5">Robert Camba Catering Services is located at Unit 107 Westria Residences 77 West ave. Quezon City, Philippines.</p>
                </div>

                <div class="w-full lg:w-[30%]">
                    <img src="{{ asset('assets/images/about-img3.jpg') }}" class="object-cover  lg:size-[18rem] mx-auto" alt="About image">
                </div>
            </div>

        </div>
    </div>
</x-app-layout>