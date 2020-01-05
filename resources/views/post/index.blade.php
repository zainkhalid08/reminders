@extends('layouts.app')

@section('header-and-main-content')

@include('partials.header')

<!-- Main Content -->
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        @forelse($posts as $post)
          <div class="post-preview">
            <a href="{{ $post->seoRoute('post.show') }}">
              <h2 class="post-title">
                {!! $post->title() !!} @if($post->isFitToBeNew()) <span class="badge badge-primary">New</span> @endif  
              </h2>
              <!-- <h3 class="post-subtitle">
                Problems look mighty small from 150 miles up
              </h3> -->
            </a>
            <p class="post-meta">{{ $post->meta() }}</p>
          </div>
          <hr>
        @empty
          <p>Nothing posted just yet.</p>
        @endforelse
      </div>
    </div>
</div> 

@endsection
