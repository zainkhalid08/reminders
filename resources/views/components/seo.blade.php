	  <title> {{ ucwords(strtolower($post->title)) }} | Reminders For Good</title>
@if (!is_null($post->meta))
	@forelse($post->meta as $key => $value)
      <meta name="{{ $key }}" content="{{ $value }}">
	@empty
	@endforelse
@endif