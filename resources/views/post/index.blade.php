@extends('layouts.app')

@section('head')

{{-- keep title as ucwords --}}
@component('components.seo', ['title' => 'Older Friday Sermons Of Masjid Al Haram', 'meta' => $meta])
@endcomponent

@endsection

@section('header-and-main-content')

@component('components.header', ['heading' => 'Older Friday Sermons', 'subheading' => 'Of Masjid Al Haram 🕋', 'imageSrc' => asset('img/afs.webp')])
@endcomponent

{{-- Main Content --}}
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        @include('components.post_card')
      </div>
    </div>
</div> 
@endsection
