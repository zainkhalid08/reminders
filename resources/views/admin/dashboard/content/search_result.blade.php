@extends('admin.dashboard.content.search')

@section('results')
  
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $ayahs->count() }} Search Result(s) For <span class="badge badge-pill badge-info">{{ request('tag') }}</span></h1>
  </div>
  
  @forelse($ayahs as $ayah)
    <div class="row">
      <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" title="Surah : Ayah">{{ $ayah->surah->name.' : '.$ayah->ayah_number }}</h6>
          </div>

          <div class="card-body text-right">
            {{-- <h4 class="small font-weight-bold">Plan by a deadline </h4> --}}
            @component('admin.components.ayah_text', ['ayah' => $ayah, 'loop' => $loop])
            @endcomponent
            @component('admin.components.translation_text', ['ayah' => $ayah])
            @endcomponent
          </div>
        </div>
      </div>
    </div>
  @empty

  @endforelse

@endsection