<x-admin-layout>
    <x-slot name="title">
        {{ __('Archived Users | ' . config('app.name')) }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-10 overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <div class="flex justify-between">
                    <p class="mb-5 text-xl">Archived Users</p>

                    <form action="{{ route('users.archive') }}" method="get">
                        <x-input type="text" name="search" class="input-field" placeholder="Search" id="" />
                    </form>
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
                        <thead class="text-base text-gray-700 uppercase bg-primary-light">
                            <tr>
                                <th class="px-6 py-3">
                                    User Name
                                </th>
                                <th class="px-6 py-3">
                                    Email
                                </th>
                                <th class="px-6 py-3">
                                    Phone Number
                                </th>
                                <th class="px-6 py-3 text-center">
                                    Verified
                                </th>
                                <th class="px-6 py-3 ">
                                    Archived Date
                                </th>
                                <th class="px-6 py-3 text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $user->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->phone_number }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $user->verified ? 'Yes' : 'No' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->deleted_at->format('M d, Y - g:i A') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center">
                                            @livewire('users.restore-modal', ['user' => $user])
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr class="bg-white border-b">
                                <td colspan="6" class="text-xl text-center py-2 text-gray-400">No archived</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <x-pagination-links :model="$users" />
                </div>
                
            </div>
        </div>
    </div>
</x-admin-layout>
