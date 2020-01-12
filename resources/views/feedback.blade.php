@extends('layouts.app')

@section('head')
  {{-- keep title as ucwords --}}
  <title>Blog On Friday Sermons Of Masjid Al Haram | Reminders For Good</title>
  <meta name="description" content="Blogs on friday sermons of masjid al haram updated every 2 weeks or earlier.">
  
  {{-- Notifications --}}
  <link href="{{ asset('css/animate.css') }}" rel="stylesheet">

@endsection

@section('header-and-main-content')

@component('partials.header', ['heading' => 'Feedback', 'subheading' => 'Have something to say?', 'imageSrc' => asset('img/contact-bg.jpg')])
@endcomponent

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <p>To send an anonymous feedback, skip name and email.</p>

        <form method="post" action="{{ route('feedback.store') }}">
          @csrf
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Name</label>
              <input type="text" name="name" class="form-control" placeholder="Name (optional)"  value="{{ old('name') }}">
              @component('components.feedback_error', ['field' => 'name'])
              @endcomponent
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Email</label>
              <input type="email" name="email" class="form-control" placeholder="Email (optional)" value="{{ old('email') }}">
              @component('components.feedback_error', ['field' => 'email'])
              @endcomponent
            </div>
          </div>
          {{-- <div class="control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>Phone Number</label>
              <input type="tel" class="form-control" placeholder="Phone Number" required>
              <p class="help-block text-danger"></p>
            </div>
          </div> --}}
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Message</label>
              <textarea rows="5" name="message" class="form-control" placeholder="Message (required)" required>{{ old('message') }}</textarea>
              @component('components.feedback_error', ['field' => 'message'])
              @endcomponent
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Five minus three equals?</label>
              <input type="text" name="verification" class="form-control" placeholder="Five minus three equals? (required)" value="{{ old('verification') }}" required>
              @component('components.feedback_error', ['field' => 'verification'])
              @endcomponent
            </div>
          </div>
          <br>
          <div id="success"></div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('bottom_scripts')

{{-- Notifications --}}
<script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
@include('components.flash')
@endsection