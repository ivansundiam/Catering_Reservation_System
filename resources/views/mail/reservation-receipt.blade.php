@component('mail::message')
<h2>Hello {{ $user->name }},</h2>
<p>
Thank you for choosing Robert Camba's Catering Services. Your reservation has been successfully set. Click the attached file below to view the full details of your reservation.
</p>
<br>
<p>
If you have any questions or need further assistance, please don't hesitate to contact us at <i>cambarobert@yahoo.com</i> or <i>(+63922) 827-6802</i>.
</p>

@component('mail::button', ['url' => config('app.url') . 'reservations'])
View Reservations
@endcomponent

<p>Best regards,</p>
<p>{{ config('app.name') }}</p>

@component('mail::subcopy')
<p>If you're having trouble clicking "View Reservations" button, use the URL below into your web browser:
<a href="{{ config('app.url') }}">{{ config('app.url') }}</a>
</p>
@endcomponent
@endcomponent