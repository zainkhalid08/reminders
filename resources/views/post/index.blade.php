@extends('layouts.app')

@section('head')
  {{-- keep title as ucwords --}}
  <title>Older Friday Sermons Of Masjid Al Haram | Reminders For Good</title>
  <meta name="description" content="Blogs on friday sermons of masjid al haram updated every 2 weeks or earlier.">
@endsection

@section('header-and-main-content')

@component('partials.header', ['heading' => 'Older Friday Sermons', 'subheading' => 'Of Masjid Al Haram 🕋', 'imageSrc' => asset('img/home-bg-o.jpg')])
@endcomponent

{{-- Main Content --}}
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        @forelse($posts as $post)
          <div class="post-preview">
            <a href="{{ $post->seoRoute('post.show') }}">
              <h2 class="post-title">
                {!! $post->title() !!} @if($post->isFitToBeNew()) <span class="badge badge-primary">New</span> @endif  
              </h2>
              {{-- <h3 class="post-subtitle">
                Problems look mighty small from 150 miles up
              </h3> --}}
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
