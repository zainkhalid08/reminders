<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-146593164-1"></script>
    <script>
      window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date()); gtag('config', 'UA-146593164-1');
    </script>
    {{-- Yandex.Metrika counter --}}
    <script type="text/javascript" >
       (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
       m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
       (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

       ym(73738168, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
       });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/73738168" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
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
                <p class="copyright text-muted"><a href="{{ route('legal') }}" target="_blank" rel="noreferrer">Legal</a> | <a href="#thanks" data-toggle="modal" data-target="#thanks">Thanks</a> | <a href="{{ route('feedback') }}" target="_blank" rel="noreferrer">Feedback</a> | <a rel="license" href="http://creativecommons.org/licenses/by-nd/4.0/" target="_blank" rel="noreferrer"><img alt="Creative Commons License" title="Attribution-NoDerivatives 4.0 International (CC BY-ND 4.0)" style="border-width:0" src="{{ asset('img/cc.webp') }}" /></a></p>
              @include('partials.footer_modals')
            </div>
          </div>
        </div>
    </footer>
    @include('partials.bottom_scripts')
    @yield('bottom_scripts')
  </body>
</html>
