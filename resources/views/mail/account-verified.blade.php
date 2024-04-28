@component('mail::message')
<h2>Hello {{ $user->name }},</h2>
<p>
Your account has been verified. You can now make a reservation.
</p>
@component('mail::button', ['url' => 'http://127.0.0.1:8000/'])
    Go to Home Page
@endcomponent
@component('mail::subcopy')
<p>If you're having trouble clicking "Go to Home Page" button, use the URL below into your web browser:
<a href="{{ config('app.url') }}">{{ config('app.url') }}</a>
</p>
@endcomponent
@endcomponent
