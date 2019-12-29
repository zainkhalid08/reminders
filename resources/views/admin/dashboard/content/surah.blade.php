@extends('admin.dashboard.template')

@section('head')
  {{-- Autocomplete --}}
  <link href="{{ asset('css/autocomplete/amsify.suggestags.css') }}" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  {{-- Flash Messages --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
  <style type="text/css">
    .float{
      position:fixed;
      width:60px;
      height:60px;
      bottom:40px;
      background-color:#4e73df;
      z-index: 1000;
      color:#FFF;
      border-radius:50px;
      text-align:center;
      box-shadow: 2px 2px 3px #999;
    }

    .my-float{
      margin-top:22px;
    }

    /* To add border to the tagging field */
    input[type="text"] {
      border: solid 1px #36b9cc !important;
    }

  </style>
@endsection

@section('dashboard-content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800">{{ request('surah') }}</h1>
      <a href="#" class="float" onclick="event.preventDefault();
                                        document.getElementById('taggingForm').submit();">
        <i class="fa fa-save my-float"></i>
      </a>
      <div class="container text-right">
        @forelse($surah as $ayah)
          <div class="container">
            <div class="row">
              <div class="col-md-4">
                <div class="row">
                  <form method="post" action="{{ route('admin.tag.ayah') }}" id="taggingForm">
                    @csrf
                  </form>
                  <input type="text" value="" name="tags[{{ $ayah->id }}]" id="tagsSpecial" class="input-tagging" form="taggingForm"></input>
                </div>
                <div class="row" style="padding-top: 3%;">
                  @foreach (App\Ayah::find($ayah->id)->tags()->wherePivot('user_id', auth()->id())->get() as $tag)
                      <h6 style="margin-right: 1%;"><span id="tag-{{ $loop->parent->iteration.$loop->iteration }}" class="badge badge-pill badge-info">{{ $tag->name }} <i class="fa fa-times" aria-hidden="true" onclick="detachTagFromAyah({{ $tag->id }}, {{ $ayah->id }}, {{ $loop->parent->iteration.$loop->iteration }})" style="cursor: pointer;"></i></span> </h6>
                  @endforeach
                </div>
                {{-- <hr> --}}
              </div>
              <div class="col-md-8" dir="ltr">
                @component('admin.components.ayah_text', ['ayah' => $ayah])
                @endcomponent
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                @component('admin.components.translation_text', ['ayah' => $ayah])
                @endcomponent
              </div>
              <span style="font-size: 79%;">
                ({{ $ayah->surah->name.' : '. $ayah->ayah_number}})
              </span>
            </div>
          </div>
          <hr>
        @empty
          <p class="">No ayah found in database!</p>
        @endforelse
      </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('page-script')
  {{-- Autocomplete --}}
  <script src="{{ asset('js/autocomplete/jquery.amsify.suggestags.js') }}"></script>
  @include('admin.dashboard.script.surah')
  {{-- Sweet Alert --}}
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  {{-- Flash Message --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@endsection
