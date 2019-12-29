@extends('admin.layouts.header_footer')

@section('head')

  {{-- Autocomplete With Tagging --}}
  <link href="{{ asset('admin/css/autocomplete/amsify.suggestags.css') }}" rel="stylesheet">

  {{-- Autocomplete --}}
  <link href="{{ asset('admin/css/autocomplete/easy-autocomplete.min.css') }}" rel="stylesheet">

@endsection

@section('dashboard-content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Purpose</h1>
      </div>
      
      <!-- Content Row -->
      <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
          <!-- Project Card Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Create Post</h6>
            </div>

            <div class="card-body">
              <br>
              
                <div>
                  <form method="post" action="{{ route('admin.post.store') }}" id="post-creation-form">
                    @csrf
                    <h4>Title</h4>
                    <div class="text-center">
                      <input type="text" name="title" style="width: 100%;" placeholder="The Last Day">
                      @component('components.error', ['field' => 'title'])
                      @endcomponent
                    </div>
                    <h4>Speaker</h4>
                    <div class="text-center">
                      <input type="text" name="speaker" style="width: 100%;" placeholder="Sheikh Salaah Budaair" id="speaker-autocomplete">
                      @component('components.error', ['field' => 'speaker'])
                      @endcomponent
                    </div>
                    <h4>Location</h4>
                    <div class="text-center">
                      <input type="text" name="location" style="width: 100%;" placeholder="Masjid Al Haram" id="location-autocomplete">
                      @component('components.error', ['field' => 'location'])
                      @endcomponent
                    </div>
                    <h4>Date</h4>
                    <div class="text-center">
                      <input type="date" name="date" style="width: 100%;" placeholder="Date">
                      @component('components.error', ['field' => 'date'])
                      @endcomponent
                    </div>
                    <h4>Video</h4>
                    <div class="text-center">
                      <input type="text" name="video_src" style="width: 100%;" placeholder="https://www.youtube.com/embed/">
                      @component('components.error', ['field' => 'video_src'])
                      @endcomponent
                    </div>
                    <h4>Tags</h4>
                    <div class="text-center">
                      <input type="text" name="tags[]" style="width: 100%;" placeholder="allah, quran" id="tags-autocomplete-with-tagging">
                      @component('components.error', ['field' => 'tags'])
                      @endcomponent
                    </div>
                    <h4>Content</h4>
                    <div class="text-center">
                      <textarea name="content" style="width: 100%;" placeholder="Type here..."></textarea>
                      @component('components.error', ['field' => 'content'])
                      @endcomponent
                      <button type="button" class="btn btn-primary" style="margin-top: 2%;" onclick="event.preventDefault();
                                                                                                    document.getElementById('post-creation-form').submit();">Create</button>
                    </div>
                  </form> <br>

                  <div class="text-center">
                   <i>Say, "Whether you conceal what is in your breasts or reveal it, Allah knows it. And He knows that which is in the heavens and that which is on the earth. And Allah is over all things competent.</i><br>
                    <small>(Al-Imaran : 29)</small>
                  </div> 
                </div>
            </div>
          </div>        
        </div>
      </div> 

    </div>
    <!-- /.container-fluid -->
@endsection

@section('page-script')
  {{-- Autocomplete With Tagging --}}
  <script src="{{ asset('admin/js/autocomplete/jquery.amsify.suggestags.js') }}"></script>

  {{-- Autocomplete --}}
  <script src="{{ asset('admin/js/autocomplete/jquery.easy-autocomplete.min.js') }}"></script>
  @include('admin.scripts.create')
@endsection
