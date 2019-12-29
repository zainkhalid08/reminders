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
          <span class="meta">{{ $post->speaker->name }} | {{ $post->location->name }} | {{ $post->date }}</span>
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
        <!-- <span class="caption text-muted">To go places and do things that have never been done before – that’s what living is all about.</span> -->

        <!-- <h2 class="section-heading">Summary</h2> -->
        <!-- <ul>
          <li>@1:02 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed </li>
          <li>@2:02 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed </li>
          <li>@3:02 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed </li>
          <li>@3:02 Lorem ipsum 
            <blockquote class="blockquote">The dreams of yesterday are the hopes of today and the reality of tomorrow. Science has not yet mastered prophecy. We predict too much for the next year and yet far too little for the next ten.</blockquote>
          </li>
          <li>@3:02 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed </li>
        </ul> -->
<!--         <p>There can be no thought of finishing for ‘aiming for the stars.’ And no matter how much progress one makes, there is always the thrill of just beginning. <small>@2:33</small> </p>

        <blockquote class="blockquote">The dreams of yesterday are the hopes of today and the reality of tomorrow. Science has not yet mastered prophecy. We predict too much for the next year and yet far too little for the next ten. <small>@2:33</small></blockquote>

        <p>Spaceflights cannot be stopped. This is not the work of any one man or even a group of men. It is a historical process which mankind is carrying out in accordance with the natural laws of human development. <small>@2:33</small> </p>
 -->

         {!! $post->content !!}
        <!-- <h2 class="section-heading">Tags</h2> -->
        
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
