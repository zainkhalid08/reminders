@component('mail::message')
# Feedback Arrived

{{ $feedback->name ?? 'no name' }}
{{ $feedback->email ?? 'no email' }}
{{ $feedback->message ?? 'no message' }}

<i>Remember this was a feedback form NOT A CONTACT. Reply sin't a must</i>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
