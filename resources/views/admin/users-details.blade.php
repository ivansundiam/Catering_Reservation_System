<x-admin-layout> 
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-10 overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <p class="text-xl ">Users</p>

                <x-section-border />

                <a href="{{ route('users.index') }}" class="absolute p-3 transition duration-150 ease-in rounded-full hover:bg-gray-100 active:bg-gray-200">
                   <svg fill="#9c9c9c" width="20px" height="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" stroke="#9c9c9c"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M222.927 580.115l301.354 328.512c24.354 28.708 20.825 71.724-7.883 96.078s-71.724 20.825-96.078-7.883L19.576 559.963a67.846 67.846 0 01-13.784-20.022 68.03 68.03 0 01-5.977-29.488l.001-.063a68.343 68.343 0 017.265-29.134 68.28 68.28 0 011.384-2.6 67.59 67.59 0 0110.102-13.687L429.966 21.113c25.592-27.611 68.721-29.247 96.331-3.656s29.247 68.721 3.656 96.331L224.088 443.784h730.46c37.647 0 68.166 30.519 68.166 68.166s-30.519 68.166-68.166 68.166H222.927z"></path></g></svg>
                </a>
                <div class="w-3/4 mx-auto">
                    @livewire('users.details', ['user' => $user])
                </div>
  
            </div>
        </div>
    </div>
</x-admin-layout>