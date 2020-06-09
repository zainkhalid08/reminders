@extends('admin.layouts.header_footer')

@section('head')
  <link href="{{ asset('admnistratorassetsonly/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('dashboard-content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <!-- <h1 class="h3 mb-2 text-gray-800">feedbacks</h1> -->
      <!-- <p class="mb-4"></p> --> {{-- kept empty intentionally, to keep alignment consistent with other pages as otherwise the card goes up  --}}

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Your Feedbacks</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            @forelse($feedbacks as $feedback)
              @if ($loop->first)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sr</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Message</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Sr</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Message</th>
                    </tr>
                  </tfoot>
                  <tbody>
              @endif      
                    <tr id="feedback-row-{{ $loop->iteration }}">
                      <td>{{ $loop->iteration }}</td>
                      <td>
                        <div id="feedback-name-{{ $loop->iteration }}"> {{ $feedback->name }} </div>
                      </td>
                      <td>
                        <div id="feedback-name-{{ $loop->iteration }}"> {{ $feedback->email }} </div>
                      </td>
                      <td>
                        <div id="feedback-name-{{ $loop->iteration }}"> {{ $feedback->message }} </div>
                      </td>
                    </tr>
              @if ($loop->last)
                  </tbody>
                </table> 
              @endif
            @empty
              <p>No feedbacks found</p>
            @endforelse
          </div>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->

@endsection

@section('page-script')
  <script src="{{ asset('admnistratorassetsonly/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admnistratorassetsonly/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admnistratorassetsonly/js/demo/datatables-demo.js') }}"></script>

@endsection
