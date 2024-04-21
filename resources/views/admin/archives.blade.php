<x-admin-layout>
    <x-slot name="title">
        {{ __('Archived Users | ' . config('app.name')) }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-5 md:px-10shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <div class="flex justify-between">
                    <p class="mb-5 text-xl">Archived Users</p>

                    <form action="{{ route('users.archive') }}" method="get">
                        <x-input type="text" name="search" class="input-field" placeholder="Search" id="" />
                    </form>
                </div>

                <div class="relative">
                    <x-table>
                        <x-slot name="thead">
                            <tr>
                                <th>
                                    User Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Phone Number
                                </th>
                                <th>
                                    Archived Date
                                </th>
                                <th class="text-center">
                                    Verified
                                </th>
                                <th class="text-center">
                                </th>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($users as $index => $user)
                                <tr>
                                    <td class="font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->phone_number }}
                                    </td>
                                    <td>
                                        {{ $user->deleted_at->format('M d, Y - g:i A') }}
                                    </td>
                                    <td class="text-center">
                                        {{ $user->verified ? 'Yes' : 'No' }}
                                    </td>
                                    <td class="text-2xl text-right">
                                        <x-dropdown width="48" align="right">
                                            <x-slot name="trigger">
                                                <button type="button" class="font-bold text-gray-400 select-none">&#8942;</button>
                                            </x-slot>
                    
                                            <x-slot name="content">
                                                @livewire('users.restore-modal', ['user' => $user])
                                            </x-slot>
                    
                                        </x-dropdown>
                                    </td>
                                </tr>
                            @empty
                            <tr class="bg-white border-b">
                                <td colspan="6" class="py-2 text-xl text-center text-gray-400">No archived</td>
                            </tr>
                            @endforelse
                        </x-slot>
                    </x-table>
                    <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
                        <thead class="text-base text-gray-700 uppercase bg-primary-light">

                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>

                    <x-pagination-links :model="$users" />
                </div>
                
            </div>
        </div>
    </div>
</x-admin-layout>
