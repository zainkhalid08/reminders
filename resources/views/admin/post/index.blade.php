@extends('admin.layouts.header_footer')

@section('head')
  <link href="{{ asset('admnistratorassetsonly/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('dashboard-content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <!-- <h1 class="h3 mb-2 text-gray-800">Posts</h1> -->
      <!-- <p class="mb-4"></p> --> {{-- kept empty intentionally, to keep alignment consistent with other pages as otherwise the card goes up  --}}

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Your Posts</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            @forelse($posts as $post)
              @if ($loop->first)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sr</th>
                      <th>Title</th>
                      <th>Location</th>
                      <th>Operations</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Sr</th>
                      <th>Title</th>
                      <th>Operations</th>
                    </tr>
                  </tfoot>
                  <tbody>
              @endif      
                    <tr id="post-row-{{ $loop->iteration }}">
                      <td>{{ $loop->iteration }}</td>
                      <td>
                        <div id="post-name-{{ $loop->iteration }}"> {{ $post->title }} </div>
                      </td>
                      <td>
                        <div id="post-name-{{ $loop->iteration }}"> {{ $post->location->name }} </div>
                      </td>
                      <td>
                        <a href="{{ route('admin.post.edit', $post->id) }}">edit</a> |
                        <a href="{{ $post->seoRoute('post.show') }}" target="_blank" rel="noreferrer">preview</a> |
                        @if($post->isUnpublished())
                          @php($route = route('admin.post.update.publish', $post->id))
                          @php($formId = 'publish_form_'.$loop->iteration)
                          <a href="{{ $route }}" onclick="event.preventDefault();document.getElementById('{{ $formId }}').submit();">pub</a>
                          <form method="post" action="{{ $route }}" id="{{ $formId }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" form="{{ $formId }}">
                            <input type="hidden" name="_method" value="PUT" form="{{ $formId }}">
                          </form>
                        @endif
                      </td>
                    </tr>
              @if ($loop->last)
                  </tbody>
                </table> 
              @endif
            @empty
              <p>No posts found</p>
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
