<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      @yield('head')
      <meta name="author" content="remindersforgood@gmail.com">
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
              <a class="navbar-brand" href="{{ route('welcome') }}">{{ env('APP_NAME', 'Reminders For Good') }}</a>
              <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
              </button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="index.html">Tags</a>
                  </li> -->
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="">Search</a>
                  </li> -->
                  <!-- <li class="nav-item">
                    <a class="nav-link" target="_blank" href="https://www.youtube.com/channel/UC67OCp258L66nqQHS54MxFQ/videos">Youtube Channel</a>
                  </li> -->
                </ul>
              </div>
            </div>
        </nav>

        @yield('header-and-main-content')       

        <hr>

        <!-- Footer -->
        <footer>
            <div class="container">
              <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                  <!-- <ul class="list-inline text-center">
                    <li class="list-inline-item">
                      <a href="#">
                        <span class="fa-stack fa-lg">
                          <i class="fas fa-circle fa-stack-2x"></i>
                          <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                        </span>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#">
                        <span class="fa-stack fa-lg">
                          <i class="fas fa-circle fa-stack-2x"></i>
                          <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                        </span>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#">
                        <span class="fa-stack fa-lg">
                          <i class="fas fa-circle fa-stack-2x"></i>
                          <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                        </span>
                      </a>
                    </li>
                  </ul> -->
                  <p class="copyright text-muted">Reminders For Good - {{date('Y')}}</p>
                  <!-- <p class="copyright text-muted">remindersforgood@gmail.com</p> -->
                </div>
              </div>
            </div>
        </footer>

        <!-- Bootstrap core JavaScript -->
        <!-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> -->
        <!-- <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->

        <!-- Custom scripts for this template -->
        <!-- <script src="{{ asset('js/clean-blog.min.js') }}"></script>  -->
         {{-- Jquery & Bootstrap --}}
        <script src="{{ asset('js/vendor.js') }}"></script>
        
        {{-- CleanBlog Js --}}
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
