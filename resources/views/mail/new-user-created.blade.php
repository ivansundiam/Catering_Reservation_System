@component('mail::message')
<h2>Dear Admin,</h2>
<p>
A new user has been created. To ensure the authenticity of the user, please take a moment to verify their details on the dashboard.
</p>

@component('mail::table')
    | User ID       | Name            | Email            |
    | :-----------: |:---------------:| :---------------:|
    |{{ $user->id }}|{{ $user->name }}|{{ $user->email }}|
@endcomponent

@component('mail::button', ['url' => 'http://127.0.0.1:8000/admin/users'])
    Verify User
@endcomponent
@component('mail::subcopy')
<p>If you're having trouble clicking "Verify User" button, use the URL below into your web browser:
<a href="{{ config('app.url') }}">{{ config('app.url') }}</a>
</p>
@endcomponent
@endcomponent
