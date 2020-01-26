<script>
   
  /**
   * Flash A Message Using Plugin
   * 
   * @param  {string} message 
   * @param  {string} type    
   * @param  {string|bol} type    
   * @return {void}   flash message should appear
   */
  function flashMessage(message, type = 'success', hiding_timout = "5000") {
    $(function(){
      toastr.clear();
      toastr.options["closeButton"] = true; // overiding 
      toastr.options["timeOut"] = hiding_timout; // overiding 
      toastr[type](message) // flashing message using plugin
    });
  }
  
  </script>