@if(Session::has('message'))
    <script type="text/javascript">
        jQuery(document).ready(function(){
            bootstrapNotify('{{session('message')[0]}}','{{session('message')[1]}}');
        });
	    function bootstrapNotify(type, message) {

		    switch (type) {
		          case 'success':
		              icon = "la-check-circle";
		              title = "Success";
		              break;
		          case 'danger':
		              icon = "la-times-circle";
		              title = "Fail";
		              break;
		          case 'warning':
		              icon = "la-exclamation-circle";
		              title = "Warning";
		    }

		    $.notify(
		    	{
				    // options
			        title: "<strong>"+title+"</strong><br>",
			        message: message 
		      	}, {
			        // settings
			        type: type,
			        animate: {
			          enter: 'animated fadeInRight',
			          exit: 'animated fadeOutRight'
			        },
			        placement: {
			          from: "top", // vertically
			          align: "right" // horizontally
			        },
			        mouse_over: "pause", // don't fade on mouse hover
			        delay: 13000, // 13s
		    	}
		    );
	    }

    </script>
@endif


@if($errors->any())
    <script type="text/javascript">
        jQuery(document).ready(function(){
            $('html, body').animate({
	            scrollTop: $("form").offset().top
	        }, 2000);
        });

    </script>
@endif