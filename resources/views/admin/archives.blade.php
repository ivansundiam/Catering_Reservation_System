<x-admin-layout>
    <x-slot name="title">
        {{ __('Archived Users | ' . config('app.name')) }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-5 md:px-10shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <div class="w-full px-6 py-3 bg-white rounded-t-lg shadow-md">
                    <div class="flex flex-col items-start overflow-x-scroll md:flex-row md:justify-between no-scrollbar">
                        <p class="mb-5 text-xl font-semibold">Archived Users</p>
                        
                        <div class="relative flex items-center justify-between mt-5 md:m-0">
                            <form action="{{ route('users.archive') }}" method="get" class="" >
                                <x-input type="text" name="search" class="mx-1 input-field md:my-1 md:ml-4" placeholder="Search" id="search" />
                            </form>
                        </div>
                    </div>
                </div>

                <div class="relative pb-16 overflow-x-scroll no-scrollbar">
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
                                <td colspan="6" class="py-2 text-xl text-center text-gray-400">No archived user</td>
                            </tr>
                            @endforelse
                        </x-slot>
                    </x-table>
                    <x-pagination-links :model="$users" />
                </div>
                
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function submitForm() {
                document.getElementById('filter-form').submit();
            }
        </script>
    @endpush
</x-admin-layout>
