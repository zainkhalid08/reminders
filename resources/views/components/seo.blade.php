 {{-- $meta should BE AN ARRAY --}}
 
	<title>{{ $title }} | Reminders For Good</title>
@if(config('app.env') !== 'staging')
	@if (!is_null($meta))
		@forelse($meta as $key => $value)
	<meta name="{{ $key }}" content="{{ $value }}">
		@empty
		@endforelse
	@endif
@else
	{{-- To prevent most search engine web crawlers from indexing a page REF: https://support.google.com/webmasters/answer/93710?hl=en --}}
	<meta name="robots" content="noindex">
@endif