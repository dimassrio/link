@extends('layout')

@section('body')
	<div class="container">
		<div class="row"><div class="col-md-8">
			<table class="table table-bordered table-stripped">
	<thead><tr>
		<th>No</th>
		<th>Name</th>
		<th>Video</th>
		<th>Quiz</th>
		<th>Course</th>
		<th>Level</th>
	</tr></thead>
	<tbody>
	<?php $no = 1; ?>
	@if(isset($materials))
		@foreach($materials as $material)
		<tr>
				<td rowspan="2">{{$no}}</td>
				<td>{{$material['name']}}</td>
				<td>@if(!$material['video']=="")Available @else Not Available @endif</td>
				<td>@if(!$material['quiz']=="")Available @else Not Available @endif</td>
				<td>{{Course::find($material['course'])['name']}}</td>
				<td>{{$material['level']}}</td>
		</tr>
			<td colspan="5">
				<a href="" class="btn btn-danger">Delete Material</a>
				<a href="" class="btn btn-success">Edit Material</a>
			</td>
			<?php $no++; ?>
		@endforeach
	@endif
	</tbody>
</table>		
		</div></div>
	</div>
	
@stop