<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#317EFB"/>
    <title>Page Expired Due To Inactivity</title>
    <meta name="author" content="remindersforgood@gmail.com">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    @include('partials.navbar')

    {{-- Page Header --}}
    <header class="masthead" style="background-image: url('{{ asset('img/home.webp')  }}')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              {{-- <h1>419</h1> --}}
              <h1>Page Expired Due To Inactivity</h1>
              <span class="subheading">Please go back, refresh and try again.</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    @include('partials.bottom_scripts')

  </body>
  <script>
     {{-- Disabling Scroll --}}
    $("body").css("overflow", "hidden");
  </script>
</html>
