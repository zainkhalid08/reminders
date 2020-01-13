@extends('layouts.app')

@section('head')
  {{-- keep title as ucwords --}}
  <title>Blog On Friday Sermons Of Masjid Al Haram | Reminders For Good</title>
  <meta name="description" content="Blogs on friday sermons of masjid al haram updated every 2 weeks or earlier.">
@endsection

@section('header-and-main-content')

@component('components.header', ['heading' => 'Blog On Friday Sermons', 'subheading' => 'Of Masjid Al Haram 🕋', 'imageSrc' => asset('img/home.webp')])
@endcomponent

{{-- Main Content --}}
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      @include('components.post_card')
      
      {{-- Older Posts Button --}}
      @if($total > count($posts) )
      <div class="clearfix">
        <a class="btn btn-primary float-right" href="{{ route('post.index') }}">Older Friday Sermons &rarr;</a>
      </div>
      @endif
    </div>
  </div>
</div> 
@endsection