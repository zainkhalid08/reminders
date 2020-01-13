@extends('layouts.app')

@section('head')
  {{-- keep title as ucwords --}}
  <title>Older Friday Sermons Of Masjid Al Haram | Reminders For Good</title>
  <meta name="description" content="Blogs on friday sermons of masjid al haram updated every 2 weeks or earlier.">
@endsection

@section('header-and-main-content')

@component('components.header', ['heading' => 'Older Friday Sermons', 'subheading' => 'Of Masjid Al Haram 🕋', 'imageSrc' => asset('img/home-bg-o.webp')])
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
