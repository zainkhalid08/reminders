<script>
    const days_in_year = 366;
    const total_ayahs = {{ $stats['total-ayahs'] }};

    $('#tags_per_day').on('change',function(){


      var tags_per_day = $(this).val();

      var total_days_floating = total_ayahs / tags_per_day;
      var total_days = Math.round(total_days_floating);

      var total_years_floating = (total_days / days_in_year);
      var total_years = parseInt(total_years_floating); // not rounding just taking decimal part.

      var days_floating = (total_years_floating % 1).toFixed(5); // taking floating part

      var days = Math.round(days_floating * days_in_year);

      $('#tags_per_day_result').text( total_years + ' year(s) ' + days +' day(s)' );
    });

    $('#tags_by_deadline').on('change',function(){
      var deadline = $(this).val();
      // console.log(deadline)

      var today = todaysDate();
      // console.log(today)

      var differenceOfDays = datediff(parseDate(today), parseDate(deadline))
      
      var ayahs_to_tag_daily_floating = total_ayahs / differenceOfDays; // Infinity

      if (ayahs_to_tag_daily_floating == 'Infinity' ) {
        var ayahs_to_tag_daily = total_ayahs;
      } else {
        var ayahs_to_tag_daily = Math.round(ayahs_to_tag_daily_floating);
      }

      if( ayahs_to_tag_daily < 0 ){
        ayahs_to_tag_daily = total_ayahs;
      } 

      $('#tags_by_deadline_result').text(ayahs_to_tag_daily);
    });

    // new Date("dateString") is browser-dependent and discouraged, so we'll write
    // a simple parse function for U.S. date format (which does no error checking)
    function parseDate(str) {
        var mdy = str.split('-');
        // console.log(mdy)
        return new Date(mdy[0], mdy[1]-1, mdy[2]);
    }

    function datediff(first, second) {
        // Take the difference between the dates and divide by milliseconds per day.
        // Round to nearest whole number to deal with DST.
        return Math.round((second-first)/(1000*60*60*24));
    }

    function todaysDate() {
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

      // today = mm + '-' + dd + '-' + yyyy;
      today = yyyy + '-' + mm + '-' + dd;
      return today;
    }

    var recommendedDate = '';

    var myStr = '{{ date('Y-m-d') }}';
    var numOfYears = 2;
    var expireDate = new Date(myStr);
    expireDate.setFullYear(expireDate.getFullYear() + numOfYears);
    expireDate.setDate(expireDate.getDate() -1);
    // console.log(expireDate.toString()); 

  </script>