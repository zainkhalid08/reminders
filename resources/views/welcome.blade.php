@extends('layouts.app')

@section('head')

{{-- keep title as ucwords --}}
@component('components.seo', ['title' => 'Blog On Friday Sermons Of Masjid Al Haram', 'meta' => $meta])
@endcomponent

@endsection

@section('header-and-main-content')

@component('components.header', ['heading' => 'Blog On Friday Sermons', 'subheading' => 'Of Masjid Al Haram 🕋', 'imageSrc' => asset('img/home.webp')])
@endcomponent

{{-- Main Content --}}
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto" id="sermons">
      @include('components.post_card')
      
      {{-- Older Posts Button --}}
      @if($total > count($posts) )
      <div class="clearfix">
        <a class="btn btn-primary float-right" aria-labelledby="sermons" aria-label="view older friday sermons" title="view older friday sermons" href="{{ route('post.index') }}">Older Friday Sermons &rarr;</a>
      </div>
      @endif
    </div>
  </div>
</div> 
@endsection