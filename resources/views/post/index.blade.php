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
        @forelse($posts as $post)
          <div class="post-preview">
            <a href="{{ route('post.show', ['post' => $post->id]) }}">
              <h2 class="post-title">
                🕋 {{ $post->title }} @if($post->isFitToBeNew()) <span class="badge badge-primary">New</span> @endif  
              </h2>
              <!-- <h3 class="post-subtitle">
                Problems look mighty small from 150 miles up
              </h3> -->
            </a>
            <p class="post-meta">{{ $post->speaker->name }} | {{ $post->location->name }} | {{ $post->readableDate() }}</p>
          </div>
          <hr>
        @empty
          <p>Nothing posted just yet.</p>
        @endforelse
      </div>
    </div>
</div> 

@endsection
