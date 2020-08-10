@extends('layouts.app')

@section('head')

@component('components.seo', ['title' => $seo['title'], 'meta' => $seo['meta']])
@endcomponent

@endsection

@section('header-and-main-content')

@component('components.header', ['heading' => 'Legal', 'subheading' => '', 'imageSrc' => asset('img/legal.webp')])
@endcomponent

  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        
        <h2>Privacy Policy</h2>
        <p>We use <b>google analytics</b> to analyze traffic. With google analytics lots of technical data is collected such as browser information, operating system, cookies etc. The reason we use such third party services is to improve the overall user experience of our visitors and to know how well our blogs are performing. For more information on "How Google Uses Data" can be found <a class="turquoise" rel="noreferrer" target="_blank" href="https://www.google.com/policies/privacy/partners/">here.</a>

        <div class="info">
          <p class="system-says"><strong>Last updated:</strong> 10<sup>th</sup> August, 2020</p>
        </div>

      </div>
    </div>
  </div>

@endsection

@section('bottom_scripts')
@include('components.scripts.flash')
@endsection