@extends('layouts.app')

@section('head')

@component('components.seo', ['title' => $post->titleHtmlTag(), 'meta' => $post->meta])
@endcomponent

@endsection

@section('header-and-main-content')

{{-- Page Header --}}
<header class="masthead" style="background-image: url('{{ asset('img/home.webp') }}')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-heading"> {{-- class="site-heading" --}}
          <h1>{{ $post->title }}</h1>
          {{-- <h2 class="subheading">Problems look mighty small from 150 miles up</h2> --}}
          <span class="meta">{!! $post->meta() !!}</span>
        </div>
      </div>
    </div>
  </div>
</header>
 
{{-- Post Content --}}
<article>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe id="funfyu" width="560" height="315" src="{{ $post->video_src }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <span class="caption text-muted">© Rights of the audio belong to <a href="http://www.haramain.com/app" target="_blank" rel="noreferrer">Haramain Recordings</a></span>
        <div id="JwuWiw">
         {!! $post->content !!}
        </div>
        <div class="info">
          <p class="system-says"><strong>Note:</strong> This is not the full version of the sermon. For full version, please have a look at the video shared on this page.</p>
        </div>
        
        {{-- To Show Tags --}} 
        {{-- <p> --}} 
          @forelse($post->tags as $tag)
            {{-- <span class="badge badge-pill badge-info">{{ $tag->name }}</span> --}}
          @empty
           {{-- <p>No tags</p> --}}
          @endforelse
        {{-- </p> --}} 
      </div>
    </div>
  </div>
</article>
@endsection

@section('bottom_scripts')
<script>
  var tag = document.createElement('script');
  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
  var player; var timer;
  function onYouTubeIframeAPIReady() {
    player = new YT.Player('funfyu');
  }
  function pauseVideo() {
    player.pauseVideo();
  }
</script>

{{-- Vue & its components --}}
<script src="{{ asset('js/app.js') }}"></script>

@endsection