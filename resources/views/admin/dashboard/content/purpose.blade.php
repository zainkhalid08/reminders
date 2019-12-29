@extends('admin.dashboard.template')

@section('head')
  {{-- Flash Messages --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
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
              <h6 class="m-0 font-weight-bold text-primary">Why do you want to tag each ayah of the quran?</h6>
            </div>

            <div class="card-body">
              <br>
              
              @if(auth()->user()->hasStoredHisPurpose())
                <div class="text-center">
                  <i><h4>"{{ auth()->user()->purpose->text }}"</h4></i>
                </div>
              @else
                <div>
                  <form method="post" action="{{ route('admin.purpose.store') }}">
                    @csrf
                    <div class="text-center">
                      <textarea name="text" style="width: 100%;" placeholder="Type here..."></textarea>
                      <button type="submit" class="btn btn-primary" style="margin-top: 2%;">Save</button>
                    </div>
                  </form> <br>

                  <small>* Please, feel free to write down, this won't be shared with anyone.
                  This is just to keep your efforts purposeful.
                  </small>

                  {{-- <div class="text-center">
                   <i>Say, "Whether you conceal what is in your breasts or reveal it, Allah knows it. And He knows that which is in the heavens and that which is on the earth. And Allah is over all things competent.</i><br>
                    <small>(Al-Imaran : 29)</small>
                  </div> --}}
                </div>
              @endif
            </div>
          </div>        
        </div>
      </div> 

    </div>
    <!-- /.container-fluid -->
@endsection

@section('page-script')
  {{-- Flash Message --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  @error('text')
    <script>
      flashMessage("{{ $message }}", "warning")
    </script>
  @enderror
  @if(session()->has('message'))
    <script>
      flashMessage("{{ session('message') }}")
    </script>
  @endif
@endsection

