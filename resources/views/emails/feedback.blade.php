@component('mail::message')
# Feedback Arrived

{{ $feedback->name ?? 'anoynomous name' }}
{{ $feedback->email ?? 'anoynomous email' }}
{{ $feedback->message ?? 'anoynomous message' }}

<i>Remember this was a feedback form NOT A CONTACT. Reply sin't a must</i>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
