<script>
	$(function() {

		var tags = [
			@forelse($tags as $tag)
				'{{ $tag->name }}',
			@empty

			@endforelse
		];

		var options = {
			data: tags,
			list: {
				onChooseEvent: function() {
					document.getElementById('search-form').submit();
				}	
			}
		};

	  	$('#autocomplete-only').easyAutocomplete(options);
		
    });
</script>