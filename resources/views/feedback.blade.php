@extends('layouts.app')

@section('head')
  {{-- keep title as ucwords --}}
  <title>Blog On Friday Sermons Of Masjid Al Haram | Reminders For Good</title>
  <meta name="description" content="Blogs on friday sermons of masjid al haram updated every 2 weeks or earlier.">
@endsection

@section('header-and-main-content')

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Feedback</h1>
            <span class="subheading">Have something to say?</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <p>Fill out the form below to send a message. To contact anonymously just type in the message and send.</p>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form id="contactForm" method="post" action="{{ route('feedback.store') }}">
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
              <label>Email Address</label>
              <input type="email" name="email" class="form-control" placeholder="Email Address (optional)" value="{{ old('email') }}">
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