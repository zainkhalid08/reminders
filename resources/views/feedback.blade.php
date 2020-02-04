@extends('layouts.app')

@section('head')

@component('components.seo', ['title' => $seo['title'], 'meta' => $seo['meta']])
@endcomponent

@endsection

@section('header-and-main-content')

@component('components.header', ['heading' => 'Feedback', 'subheading' => 'Have something to say?', 'imageSrc' => asset('img/feedback.webp')])
@endcomponent

  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        
        <p>To send an anonymous feedback, skip name and email.</p>

        <form method="post" action="{{ route('feedback.store') }}">
          @csrf
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Name</label>
              <input type="text" name="n3kIad3" class="form-control" placeholder="Name (optional)"  value="{{ old('n3kIad3') }}">
              @component('components.error', ['field' => 'n3kIad3'])
              @endcomponent
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Email</label>
              <input type="email" name="eaWDsk2" class="form-control" placeholder="Email (optional)" value="{{ old('eaWDsk2') }}">
              @component('components.error', ['field' => 'eaWDsk2'])
              @endcomponent
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Message</label>
              <textarea rows="5" name="mw2s8sJ" class="form-control" placeholder="Message (required)" required>{{ old('mw2s8sJ') }}</textarea>
              @component('components.error', ['field' => 'mw2s8sJ'])
              @endcomponent
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Five minus three equals?</label>
              <input type="text" name="Vw82iwl" class="form-control" placeholder="Five minus three equals? (required)" value="{{ old('Vw82iwl') }}" required>
              @component('components.error', ['field' => 'Vw82iwl'])
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
@include('components.scripts.flash')
@endsection