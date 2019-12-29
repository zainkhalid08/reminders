<script>
   
    var previousData;
    /** 
     * MAKES Div EDITABLE AND BRINGS FOCUS AND RETAINS DIV CONTENT FOR COMPARISION
     * 
     * @param {number}  divNumber - to know which div is to be edited
     * @return void
     */
    function makeDivEditableBringFocusAndGetPreviousData(divId){
      // make the div editable 
      $('#'+divId).attr('contenteditable', 'true');
      // bring focus to the div
      $('#'+divId).get(0).focus();
      // get previous tag content
      previousData = $('#'+divId).text();
    }

    /** 
     * AJAX REQUEST TO EDIT THE DESCRIPTION
     * 
     * @param {number}  tag_id - tag id
     * @param {string}  tagDescription
     * @return {json}   data['status'] 
     */
    function editTagDescription(tag_id, tagDescription){
      if (previousData.trim() != tagDescription.trim()) {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        jQuery.ajax({
          url: "{{ route('admin.tag.update', 0) }}"+tag_id, // placed 0 as otherwise it says missing required parameter
          method: 'post',
          data: {
            tag_id: tag_id,
            description: tagDescription.replace(/<[^>]*>?/g, ''),
            _method: 'put',
            _token: '{{ csrf_token() }}'
          },
          success: function(data){
            if (data['status'] === 'success') {
              flashMessage(data['message'])
            } else if( data['status'] === 'fail' ){
              flashMessage(data['message'], "error")
            } else if( data['status'] === 'csrf' ) {
                refreshPageModal();
            } else {
              flashMessage("{{ internalErrorMessage() }}", "error")
            }
          },
          error: function(data){
              var response = data.responseJSON;

              if (typeof response.errors !== 'undefined' && typeof response.errors.description !== 'undefined') {
                  response.errors.description.forEach(function(element) {
                      flashMessage(element, "warning", "13000")
                  });
              } else {
                flashMessage("{{ internalErrorMessage() }}", "error")
              } 

          }
        });
      }
    }

    /** 
     * AJAX REQUEST TO EDIT THE NAME
     * 
     * @param {number}  tag_id - tag id
     * @param {string}  tagName
     * @return {json}   data['status'] 
     */
    function editTagName(tag_id, tagName){
      if (previousData.trim() != tagName.trim()) {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        jQuery.ajax({
          url: "{{ route('admin.tag.update', 0) }}"+tag_id, // placed 0 as otherwise it says missing required parameter
          method: 'post',
          data: {
            tag_id: tag_id,
            name: tagName.replace(/<[^>]*>?/g, ''),
            _method: 'put',
            _token: '{{ csrf_token() }}'
          },
          success: function(data){
            if (data['status'] === 'success') {
              flashMessage(data['message'])
            } else if( data['status'] === 'fail' ){
              flashMessage(data['message'], "error")
            } else if( data['status'] === 'csrf' ) {
                refreshPageModal();
            } else {
                flashMessage("{{ internalErrorMessage() }}", "error")
            }
          },
          error: function(data){
              var response = data.responseJSON;

              if (typeof response.errors !== 'undefined' && typeof response.errors.name !== 'undefined') {
                  response.errors.name.forEach(function(element) {
                      toastr.options["timeOut"] = "13000"; // overiding 
                      flashMessage(element, "warning")
                  });
              } else {
                flashMessage("{{ internalErrorMessage() }}", "error")
              } 
          }
        });
      }
    }

    /** 
     * AJAX REQUEST TO DELETE THE COMMENT
     * 
     * @param {number}  tag_id      - tag id
     * @param {number}  rowNumber       - to know which row is to be deleted
     * @return {json}   data['status'] 
     */
    function deleteTag(tag_id, rowNumber){
      swal({
        title: "Are you sure?",
        text: "You want to delete this tag! This tag will be detached from the ayahs, it was attached to.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          jQuery.ajax({
            url: "{{ route('admin.tag.destroy', 0) }}"+tag_id, // placed 0 as otherwise it says missing required parameter
            method: 'post',
            data: {
              tag_id: tag_id,
              _method: 'delete',
              _token: '{{ csrf_token() }}'
            },
            success: function(data){
              if (data['status'] === 'success') {
                // hide that tag div and then show flash message
                $('#tag-row-'+rowNumber).fadeOut(1000, function(){
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

    /**
     * Popup a modal to offer a refresh page button
     * 
     * @return void
     */
    function refreshPageModal() {
      swal({
        title: "Please, refresh the page!",
        text: "The form has expired due to inactivity.",
        icon: "warning",
        buttons: ["Cancel", "Refresh"],
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          location.reload(true);
        } 
      });
    }

  </script>