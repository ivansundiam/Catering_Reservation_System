<x-admin-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-10 overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <div class="flex justify-between mb-5 align-baseline">
                    <p class="text-xl">Reservations</p>
                    <a href="{{ route('generate-pdf') }}" type="button" class="flex btn-info">print</a>
                </div>

                <a href="{{ route('receipt-pdf') }}" class="p-5 btn-info">receipt</a>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
                        <thead class="text-base text-gray-700 uppercase bg-primary-light">
                            <tr>
                                <th class="px-6 py-3">
                                    CLient Name
                                </th>
                                <th class="px-6 py-3">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-center">
                                    Package
                                </th>
                                <th class="px-6 py-3">
                                    Date
                                </th>
                                <th class="px-6 py-3">
                                    Time
                                </th>
                                <th class="px-6 py-3">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reservations as $res)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $res->user->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $res->user->email }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $res->package }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $res->date->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $res->time->format('g:i a') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $res->payment_percent == 100 ? 'Paid' : 'Pending Payment' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center">
                                            <a href="{{ route('admin.reservation.show', $res->id) }}" class="size-8 mx-1 !p-0 btn-info">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                            </a>
                                            <a href="{{ route('admin.reservation.show', $res->id) }}" class="size-8 mx-1 !p-0 btn-danger">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M14 10V17M10 10V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                            <tr class="bg-white border-b">
                                <td colspan="6" class="py-2 text-xl text-center text-gray-400">No reservations</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</x-admin-layout>
