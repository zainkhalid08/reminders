<script>
	$(function() {

		// Speakers
		var speakers = [
			@forelse($availableData['speakers'] as $speaker)
				'{{ $speaker->name }}',
			@empty
			@endforelse
		];

		var options = {
			data: speakers,
		};

	  	$('#speaker-autocomplete').easyAutocomplete(options);

		// Locations
		var locations = [
			@forelse($availableData['locations'] as $location)
				'{{ $location->name }}',
			@empty
			@endforelse
		];

		var options = {
			data: locations,
		};

	  	$('#location-autocomplete').easyAutocomplete(options);

	  	// Tags For autocomplete and tagging
		var tags = [
			@forelse($availableData['tags'] as $tag)
				'{{ $tag->name }}',
			@empty
			@endforelse
		];

	  	$('#tags-autocomplete-with-tagging').amsifySuggestags({ // https://github.com/amsify42/jquery.amsify.suggestags#more-settings
			suggestions: tags,
			selectOnHover: false,
			backgrounds: ['#17a2b8', '#17a2b8', '#17a2b8', '#17a2b8', '#17a2b8'],
			colors: ['white', 'white', 'white', 'white', 'white'],
		});	
		
    });
</script>