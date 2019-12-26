@extends('layouts.app')

@section('header-and-main-content')

<!-- Page Header -->
<header class="masthead" style="background-image: url('{{ asset('img/home-bg.jpg')  }}')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Friday Sermons</h1>
            <span class="subheading">From Masjid Al Haram & Masjid An Nabawi</span>
          </div>
        </div>
      </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-preview">
          <a href="post.html">
            <h2 class="post-title">
              🕋 The Last Day
            </h2>
            <!-- <h3 class="post-subtitle">
              Problems look mighty small from 150 miles up
            </h3> -->
          </a>
          <p class="post-meta">Sheikh Salaah Al Budair | Masjid Al Haram | September 24, 2019</p>
        </div>
        <hr>
        
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
      </div>
    </div>
</div> 

@endsection
