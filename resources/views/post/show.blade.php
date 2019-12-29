@extends('layouts.app')

@section('header-and-main-content')

<!-- Page Header -->
<header class="masthead" style="background-image: url('{{ asset('img/home-bg.jpg') }}')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-heading">
          <h1>{{ $post->title }}</h1>
          <!-- <h2 class="subheading">Problems look mighty small from 150 miles up</h2> -->
          <span class="meta">{{ $post->speaker->name }} | {{ $post->location->name }} | {{ $post->readableDate() }}</span>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Post Content -->
<article>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe width="560" height="315" src="{{ $post->video_src }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <span class="caption text-muted">© Rights of the audio belong to <a href="http://www.haramain.com/app" target="_blank">Haramain Recordings</a></span>


         {!! $post->content !!}
        
        <p> 
          @forelse($post->tags as $tag)
            <span class="badge badge-pill badge-info">{{ $tag->name }}</span>
          @empty
           <p>No tags</p>
          @endforelse
        </p>

      </div>
    </div>
  </div>
</article>


@endsection
