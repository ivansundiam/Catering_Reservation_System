<x-admin-layout>
    <x-slot name="title">
        {{ __('Users | ' . config('app.name')) }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-5 md:px-10 dark:bg-gray-800 sm:rounded-lg">
                <div class="px-6 rounded-t-lg py-3 shadow-md w-full bg-white">
                    <div class="flex flex-col md:flex-row items-start md:justify-between divide-x-2 overflow-x-scroll no-scrollbar">
                        <p class="mb-5 text-xl font-semibold">Users</p>

                        <div class="divide-x-2 flex justify-between items-center mt-5 md:m-0 relative">

                            <div class="relative md:pb-5">
                                <div class="md:before:content-['filter'] before:absolute before:bottom-0 before:text-sm before:text-gray-400 before:left-[37%]">
                                    <select name="" id="" class="w-auto input-field mx-1 md:my-1 md:mx-4">
                                        <option value="">fasdf</option>
                                    </select>
                                </div>    
                            </div>

                            <div class="relative md:pb-5">
                                <form action="{{ route('users.index') }}" method="get" class="md:before:content-['search'] before:absolute before:bottom-0 before:text-sm before:text-gray-400 before:left-[45%]" >
                                    <x-input type="text" name="search" class="input-field mx-1 md:my-1 md:ml-4" placeholder="Search" id="" />
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="relative overflow-x-scroll no-scrollbar pb-16">
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
                                <th class="text-center">
                                    Verified
                                </th>
                                <th class="text-center">
                                </th>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($users as $index => $user)
                                @php
                                    $verifiedClasses = $user->verified ? 'px-2 py-1 rounded-full bg-green-100 text-green-500' : 'px-2 py-1 rounded-full bg-amber-100 text-primary';
                                @endphp
                                <tr class="border-b {{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white'; }}">
                                    <td scope="row" class="font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->phone_number }}
                                    </td>
                                    <td class="text-center">
                                        <span class="{{ $verifiedClasses }}">{{ $user->verified ? 'Yes' : 'No' }}</span>
                                    </td>
                                    <td class="text-2xl text-right">
                                        <x-dropdown width="48" align="right">
                                            <x-slot name="trigger">
                                                <button type="button" class="font-bold text-gray-400 select-none">&#8942;</button>
                                            </x-slot>
                    
                                            <x-slot name="content">
                                                <x-dropdown-link href="{{ route('users.show', $user->id) }}">
                                                    {{ __('View') }}
                                                </x-dropdown-link>

                                                @livewire('users.archive-modal', ['user' => $user])

                                            </x-slot>
                    
                                        </x-dropdown>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white border-b">
                                    <td colspan="6" class="py-2 text-xl text-center text-gray-400">No users</td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table>
                    <x-pagination-links :model="$users" />
                </div>
                
            </div>
        </div>
    </div>
</x-admin-layout>
