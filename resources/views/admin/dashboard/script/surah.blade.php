<script>
	$(function() {

		var tags = [
			@forelse($tags as $tag)
				'{{ $tag->name }}',
			@empty

			@endforelse
		];

	  	$('.input-tagging').amsifySuggestags({
			suggestions: tags
		});
		
    });

	/**
	 * Detach a tag from an ayah
	 * 	
	 * @param  {int} tag_id   
	 * @param  {int} ayah_id 
	 * @param  {int} div_number 
	 * @return response success|fail|csrf
	 */
    function detachTagFromAyah(tag_id, ayah_id, div_number) {
      swal({
        title: "Are you sure?",
        text: "You want to detach this tag from this ayah!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          jQuery.ajax({
            url: "{{ route('admin.detach-tag') }}", 
            method: 'post',
            data: {
              tag_id: tag_id,
              ayah_id: ayah_id,
              _token: "{{ csrf_token() }}"
            },
            success: function(data){
              if (data['status'] === 'success') {
                // hide that tag div and then show flash message
                $('#tag-'+div_number).fadeOut(1000, function(){
                	flashMessage(data['message'])
                });
              } else if( data['status'] === 'fail' ){
              		flashMessage(data['message'], "error")
              } else if( data['status'] === 'csrf' ) {
                  	refreshPageModal();
              } else {
              		flashMessage("{{ internalErrorMessage() }}", "error")
              }
            }
          });
        } 
      });
    }
</script>