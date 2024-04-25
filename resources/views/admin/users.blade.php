<x-admin-layout>
    <x-slot name="title">
        {{ __('Users | ' . config('app.name')) }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-5 md:px-10 dark:bg-gray-800 sm:rounded-lg">
                <div class="w-full px-6 py-3 bg-white rounded-t-lg shadow-md">
                    <div class="flex flex-col items-start overflow-x-scroll md:flex-row md:justify-between no-scrollbar">
                        <p class="mb-5 text-xl font-semibold">Users</p>

                        <form method="GET" id="filter-form" action="{{ route('users.index') }}" class="relative flex items-center justify-between mt-5 divide-x-2 md:m-0">

                            <div class="px-1 md:py-1 md:px-4">
                                <x-label for="user-status">User status</x-label>
                                <select name="user-status" id="user-status" class="w-auto input-field" onchange="submitForm()">
                                    <option value="all" {{ request('user-status') == 'all' ? 'selected' : '' }}>all</option>
                                    <option value="verified" {{ request('user-status') == 'verified' ? 'selected' : '' }}>verified</option>
                                    <option value="unverified" {{ request('user-status') == 'unverified' ? 'selected' : '' }}>unverified</option>
                                </select>
                            </div>    

                            <div class="self-end md:py-1 md:pl-4">
                                <x-input type="text" name="search" class="mx-1 input-field" placeholder="Search" id="search" />

                            </div>

                        </form>
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
    @push('scripts')
        <script>
            function submitForm() {
                document.getElementById('filter-form').submit();
            }
        </script>
    @endpush
</x-admin-layout>
