@if(Session::has('message'))
    <script type="text/javascript">
        jQuery(document).ready(function(){
            bootstrapNotify('{{session('message')[0]}}', '{{session('message')[1]}}', '{{isset(session('message')[2]) ? session('message')[2] : 13000}}');
        });
	    function bootstrapNotify(type, message, delay = 13000) {

		    switch (type) {
		          case 'success':
		              icon = "la-check-circle";
		              title = "Success";
		              break;
		          case 'fail':
		              icon = "la-times-circle";
		              title = "Fail";
		              // type = "danger";
		              type = "fail";
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
			          enter: 'animated fadeInDown',
			          exit: 'animated fadeOutUp'
			        },
			        placement: {
			          from: "top", // vertically
			          align: "center" // horizontally
			        },
			        mouse_over: "pause", // don't fade on mouse hover
			        delay: delay, // 13s
			        template: '<div class="{0} system-callout">'+
					              '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>'+
						          '<span data-notify="icon"></span>'+ 
						          '<p class="system-says"><strong>'+ title.toUpperCase() +':</strong> '+ message +'</p>'+
					           '</div>'
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