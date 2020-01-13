@extends('admin.dashboard.template')

@section('head')
  
  <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  {{-- Flash Messages --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

@endsection

@section('dashboard-content')
  <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Tags</h1>
      <p class="mb-4"></p> {{-- kept empty intentionally, to keep alignment consistent with other pages as otherwise the card goes up  --}}

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Your Tags</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            @forelse($tags as $tag)
              @if ($loop->first)
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sr</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Operations</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Sr</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Operations</th>
                    </tr>
                  </tfoot>
                  <tbody>
              @endif      
                    <tr id="tag-row-{{ $loop->iteration }}">
                      <td>{{ $loop->iteration }}</td>
                      <td>
                        <div id="tag-name-{{ $loop->iteration }}" onblur="editTagName({{ $tag->id }}, this.innerHTML)"> {{ $tag->name }} 
                        </div> 
                      </td>
                      <td>
                        <div id="tag-description-{{ $loop->iteration }}" onblur="editTagDescription({{ $tag->id }}, this.innerHTML)">{{ isset($tag->description) ? $tag->description : 'No Description'  }}
                        </div> 
                      </td>
                      <td>
                        <button class="btn btn-link btn-sm" onclick="makeDivEditableBringFocusAndGetPreviousData('tag-name-'+{{ $loop->iteration }} )">Edit Name</button>
                        <button class="btn btn-link btn-sm" onclick="makeDivEditableBringFocusAndGetPreviousData('tag-description-'+{{ $loop->iteration }} )">Edit Description</button>
                        <button class="btn btn-link btn-sm" onclick="deleteTag({{ $tag->id }}, {{ $loop->iteration }})">Delete Tag</button>
                      </td>
                    </tr>
              @if ($loop->last)
                  </tbody>
                </table> 
              @endif
            @empty
              <p>No tags found</p>
            @endforelse
          </div>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('page-script')
  <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
  {{-- Sweet Alert --}}
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  {{-- Flash Message --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  @include('admin.dashboard.script.tag')
  <script src="{{ asset('js/config_flash_message.js') }}"></script>
@endsection