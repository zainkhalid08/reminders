@extends('layouts.app')

@section('head')
  <title>Friday Sermons From Masjid Al Haram | Reminders For Good</title>
  <meta name="description" content="">
@endsection

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
                {!! $post->title() !!}  
              </h2>
              <h3 class="post-subtitle">
                Problems look mighty small from 150 miles up
              </h3>
            </a>
            <p class="post-meta">{{ $post->meta() }}</p>
          </div>
          <hr>
        @empty
          <p>Nothing posted just yet.</p>
        @endforelse
        
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="{{ route('post.index') }}">Older Posts &rarr;</a>
        </div>
        <!-- Pager -->
        @if($total > count($posts) )
        @endif
      </div>
    </div>
</div> 

@endsection
