@extends('layouts.app')

@section('head')

{{-- keep title as ucwords --}}
@component('components.seo', ['title' => $seo['title'], 'meta' => $seo['meta']])
@endcomponent
<style type="text/css">
.success {
  border-left: 6px solid #86d922/*#ffb039*/;
}  

.fail {
  border-left: 6px solid red/*#ffb039*/;
}  

.system-callout {
  background-color: #fffaae;
  margin-bottom: 15px;
  padding: 0px 12px;
}

.system-says-flash {
  padding: 8px 4px;
}

.try-- {
/*    display: inline-block;
    margin: 0px auto;
    position: fixed;
    transition: all 0.5s ease-in-out 0s;
    z-index: 1031;
    top: 20px;
    right: 20px;
    animation-iteration-count: 1;
*/
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 1031;
  /*margin: 0px auto;*/
  /*display: inline-block;*/
}
</style>

@endsection

@section('header-and-main-content')

@component('components.header', ['heading' => 'Feedback', 'subheading' => 'Have something to say?', 'imageSrc' => asset('img/feedback.webp')])
@endcomponent

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        
        <div data-notify="container" class="col-xs-11 col-sm-4 alert alert-danger animated fadeInRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; right: 20px; animation-iteration-count: 1;">
          <button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>
          <span data-notify="icon"></span> 
          <span data-notify="title">
            <strong>Fail</strong><br>
          </span> 
          <span data-notify="message">Something didn't go according to plan. Kindly leave your feedback at remindersforgood@gmail.com, apologies for the inconvinence.</span>
          <a href="#" target="_blank" data-notify="url"></a>
        </div>        

        <div class="success system-callout try-- animated slideInDown ">
          <button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>
          <span data-notify="icon"></span> 
          <p class="system-says system-says-flash"><strong>Success:</strong> Thanks for the feedback.</p>
        </div>

        <div class="success system-callout">
          <p class="system-says system-says-flash"><strong>Success:</strong> Thanks for the feedback.</p>
        </div>

        <div class="fail system-callout animated bounce delay-2s">
          <p class="system-says system-says-flash"><strong>Fail:</strong> Something didn't go according to plan. Kindly leave your feedback at remindersforgood@gmail.com, apologies for the inconvinence.</p>
        </div>

        <p>To send an anonymous feedback, skip name and email.</p>

        <form method="post" action="{{ route('feedback.store') }}">
          @csrf
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Name</label>
              <input type="text" name="n3kIad3" class="form-control" placeholder="Name (optional)"  value="{{ old('name') }}">
              @component('components.feedback_error', ['field' => 'name'])
              @endcomponent
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Email</label>
              <input type="email" name="eaWDsk2" class="form-control" placeholder="Email (optional)" value="{{ old('email') }}">
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
              <textarea rows="5" name="mw2s8sJ" class="form-control" placeholder="Message (required)" required>{{ old('message') }}</textarea>
              @component('components.feedback_error', ['field' => 'message'])
              @endcomponent
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Five minus three equals?</label>
              <input type="text" name="Vw82iwl" class="form-control" placeholder="Five minus three equals? (required)" value="{{ old('verification') }}" required>
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
@include('components.flash')
@endsection