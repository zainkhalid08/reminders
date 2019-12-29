@extends('admin.dashboard.template')

@section('dashboard-content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Planner</h1>
        <small class="md-0">* the estimates shown below are approximate values, as they are rounded.</small>
      </div>
      
      <!-- Content Row -->
      <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
          <!-- Project Card Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Recommendations</h6>
            </div>

            <div class="card-body text-center">
              {{-- <h4 class="small font-weight-bold">Plan by a deadline </h4> --}}
                <h5>"If you tag only 10 ayahs daily, then you'll finish the quran within 1 year 258 days. i.e. on {{ $recommendedDate->day.' '.$recommendedDate->monthName.' '.$recommendedDate->year }}."</h5>
                OR
                <h5>"If you plan to finish within 3 years, then you'll have to tag just 6 ayahs daily."</h5>
            </div>
          </div>        
        </div>
      </div> 

      <!-- Content Row -->
      <div class="row">
        <!-- Content Column -->
        <div class="col-lg-6 mb-4">
          <!-- Project Card Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Plan by ayahs</h6>
            </div>
            <div class="card-body">
              <p>If I tag <input type="number" min="1" name="tags_per_day" id="tags_per_day" style="width: 9%;"> ayahs per day. </p>
            </div>
          </div>
        </div>

        <div class="col-lg-6 mb-4">
          <!-- Project Card Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Result</h6>
            </div>
            <div class="card-body">
              <p>It will take <span id="tags_per_day_result">N</span> number of days to finish the whole quran.</p>
            </div>
          </div>
        </div>


      </div>
  
      <!-- Content Row -->
      <div class="row">
        <!-- Content Column -->
        <div class="col-lg-6 mb-4">
          <!-- Project Card Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Plan by a deadline</h6>
            </div>

            <div class="card-body">
              <p>I plan to finish tagging by <input type="date" name="" id="tags_by_deadline" min="{{ date('Y-m-d') }}" style="width: 151px;"> </p>
            </div>
          </div>        
        </div>

        <div class="col-lg-6 mb-4">
          <!-- Project Card Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Result</h6>
            </div>

            <div class="card-body">
              <p>You'll have to tag <span id="tags_by_deadline_result">N</span> number of ayahs to finish the whole quran till your deadline.</p>
            </div>
          </div>        
        </div>


      </div>      

    </div>
    <!-- /.container-fluid -->
@endsection

@section('page-script')

  @include('admin.dashboard.script.planner')

@endsection
