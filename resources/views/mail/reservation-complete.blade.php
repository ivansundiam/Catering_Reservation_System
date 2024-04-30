@component('mail::message')
<h2>Dear Admin,</h2>
<p>
A user has added a reservation. Log in as admin to see reservation details
</p>

@component('mail::table')
    | Name            | Package                         | Menu                         | Date                                    |
    | :-------------: | :------------------------------:| :--------------------------: | :-------------------------------------: |
    |{{ $user->name }}|{{ $reservation->package->name }}|{{ $reservation->menu->name }}|{{ $reservation->date->format('m-d-Y') }}|
@endcomponent

@component('mail::button', ['url' => 'http://127.0.0.1:8000/admin/reservations'])
    See reservation
@endcomponent
@component('mail::subcopy')
<p>If you're having trouble clicking "See reservation" button, use the URL below into your web browser:
<a href="{{ config('app.url') }}">{{ config('app.url') }}</a>
</p>
@endcomponent
@endcomponent
