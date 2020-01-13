<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#317EFB"/>
    @yield('head')
    <meta name="author" content="remindersforgood@gmail.com">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    @include('partials.navbar')

    @yield('header-and-main-content')       

    <hr>

    {{-- Footer --}}
    <footer>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
              {{-- Social Logos --}}
              {{-- <ul class="list-inline text-center">
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
              </ul> --}}
              <!-- <p class="copyright text-muted">Reminders For Good - {{date('Y')}}</p> -->
                <p class="copyright text-muted"><a href="#thanks" data-toggle="modal" data-target="#thanks">Thanks</a> | <a href="{{ route('feedback') }}" target="_blank">Feedback</a> | <a rel="license" href="http://creativecommons.org/licenses/by-nd/4.0/" target="_blank"><img alt="Creative Commons License" title="Attribution-NoDerivatives 4.0 International (CC BY-ND 4.0)" style="border-width:0" src="{{ asset('img/cc.webp') }}" /></a></p>
              <!-- <div class="col-md-6">
                <p class="copyright text-muted">Reminders For Good - {{date('Y')}}</p>
              </div> -->
              @include('partials.footer_modals')
            </div>
          </div>
        </div>
    </footer>
    @include('partials.bottom_scripts')
    @yield('bottom_scripts')
  </body>
</html>
