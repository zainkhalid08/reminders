@extends('admin.dashboard.template')

@section('head')
  {{-- Autocomplete --}}
  <link href="{{ asset('css/autocomplete/easy-autocomplete.min.css') }}" rel="stylesheet">
  {{-- Flash Messages --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

@endsection

@section('dashboard-content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Search</h1>
      </div>
      
      <!-- Content Row -->
      <div class="row">

        {{-- Search --}}
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
          <!-- Project Card Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Search For A Tag</h6>
            </div>

            <div class="card-body">
              <!-- Topbar Search -->
              <form class="col-lg-12 d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100" id="search-form" method="get" action="{{ route('admin.tag.search') }}">
                <div class="input-group d-flex justify-content-center">
                  <input type="text" name="tag" form="search-form" class="form-control bg-light border-0 small" id="autocomplete-only" placeholder="{{ isset(auth()->user()->tags->first()->name) ? 'eg. '.auth()->user()->tags->first()->name : 'type a tag'  }}" aria-label="Search" aria-describedby="basic-addon2">

                  <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                      <i class="fas fa-search fa-sm"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>        
        </div>
      </div> 
        
      @yield('results')

    </div>
    <!-- /.container-fluid -->
@endsection

@section('page-script')

  {{-- Autocomplete --}}
  <script src="{{ asset('js/autocomplete/jquery.easy-autocomplete.min.js') }}"></script>
  @include('admin.dashboard.script.search')
  {{-- Flash Message --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  @error('tag')
    <script>
      $(function(){
          toastr.clear(); // to remove any previous message shown coz of validation failure
          toastr["warning"]("{{ $message }}"); // flashing message using plugin
      });
    </script>
  @enderror
@endsection

