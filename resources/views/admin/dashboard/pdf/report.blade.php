<!DOCTYPE html>
<html>
<head>
  <title>Report</title>
  <style type="text/css">
  	table {
	    width: 50%;
	    margin-left: auto;
	    margin-right: auto;
	    border-spacing: 0px;
	}
  </style>
</head>
<body>
  <h1 style="text-align: center;">Stats Till {{ date('j') }}<sup>{{ date('S') }}</sup>{{ date(' M Y') }}</h1>
  <hr>
	<h2>For {{ isset(auth()->user()->name) ? auth()->user()->name : 'You'}}</h2>
  <hr>
  <h3>Total Ayahs: {{ $stats['total-ayahs'] }}</h3>
  <h3>Tagged Ayahs: {{ $stats['total-tagged-ayahs'] }}</h3>
  <h3>Progress: {{ $stats['percentage-of-tagging-finshed'].' % completed' }}</h3>
  <hr>

  <h3>Total Tags: {{ $tags->count() }}</h3>
  <h3>Total Days Tagged: {{ $stats['total-days-tagged'] }}</h3>

  <hr>

  <h3>Your Tags</h3>

	<div style="align-items: center;">
		@forelse($tags as $tag)
			@if($loop->first)
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	                  <thead>
	                    <tr>
	                      {{-- <th>Sr</th> --}}
	                      <th>Name</th>
	                      <th>Description</th>
	                      <th>Percentage</th>
	                    </tr>
	                  </thead>
	                  <tbody>
			@endif
						<tr>
		                  {{-- <td>{{ $loop->iteration }}</td> --}}
		                  <td>{{ $tag->name }}</td>
		                  <td>{{ isset($tag->description) ? $tag->description : 'No Description' }}</td>
		                  <td>{{ $tag->percentage() }}</td>
						</tr>
			@if($loop->last)
	                  </tbody>
	                </table> 
			@endif
		@empty
			<h4>You don't have any tags</h4>
		@endforelse
	</div>
</body>
</html>