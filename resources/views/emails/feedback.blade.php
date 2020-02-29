@component('mail::message')
# Feedback Arrived

<p>Name: {{ $feedback->name ?? 'not given' }}</p>
<p>Email: {{ $feedback->email ?? 'not given' }}</p>
<p>Message: {{ $feedback->message ?? 'not given' }}</p>

<small>
	<i>Remember this was a feedback form NOT A CONTACT. Reply isn't a must</i>
</small><br>

Thanks,
{{ config('app.name') }}
@endcomponent
