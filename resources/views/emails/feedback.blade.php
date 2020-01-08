@component('mail::message')
# Feedback Arrived

{{ $feedback->name ?? 'anoynomous name' }}
{{ $feedback->email ?? 'anoynomous email' }}
{{ $feedback->message ?? 'anoynomous message' }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
