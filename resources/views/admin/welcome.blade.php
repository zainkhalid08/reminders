@extends('admin.layouts.header_footer')

@section('dashboard-content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nothing here just yet</h1>
        <!-- <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
      </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('page-script')
  <!-- Page level plugins -->
  <script src="{{ asset('admnistratorassetsonly/vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
@endsection
