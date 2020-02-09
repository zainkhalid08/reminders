@extends('admin.layouts.header_footer')

@section('dashboard-content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class=" align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Place Admin Instructions Here</h1>
        <ul>
          <li>ayah tag</li>
            <ul>
              <li>leave blank "" OR
              <li>type full proper reference 'Al-Baqara:155'</li>
            </ul>
          <li>hadith tag</li>
            <ul>
              <li>leave blank "" OR
              <li>type correct reference 'muslim' as anything typed in between quotes will be shown as is.</li>
            </ul>
          <li>tyme tag</li>
            <ul>
              <li>ENSURE to type BOTH min and sec. Can't skip, or else you'll see @:.</li>
            </ul>
        </ul>
      </div>
    </div>
    <!-- /.container-fluid -->
@endsection