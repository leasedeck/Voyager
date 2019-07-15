@component('mail::message')
# {{ $data['title'] }}

U ontvangt deze systeem notificatie omdat u een login hebt op {{ config('app.name') }}

@component('mail::panel')
**Verzonden door:** {{ $user['voornaam'] }} {{ $user['achternaam'] }}<br>
**Titel:** {{ $data['title'] }} <br>
**Bericht:** {{ $data['message']}}
@endcomponent

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent
