@extends('layout')

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<h4>Create a new Course.</h4>
				<a href="{{url('courses/create')}}" class="btn btn-danger">Create Courses</a>
			</div>
			<div class="col-md-10">
				<h1 class="page-header">{{$pagetitle}}</h1>
				<table class="table table-bordered table-stripped">
					<thead><th>No</th><th>Name</th><th>Description</th><th>Start Date</th><th>End Date</th></thead>
					<tbody>
						@if(isset($courses))
						<?php $no = 1; ?>
							@foreach($courses as $course)
								<tr>
									<td rowspan="2">{{$no}}</td>
									<td>{{$course['name']}}</td>
									<td>{{$course['description']}}</td>
									<td>{{$course['start']}}</td>
									<td>{{$course['end']}}</td>
								</tr>
								<tr>
									<td colspan="4">
										<a href="{{url('material/create').'/'.$course['id']}}" class="btn btn-primary"><span class="glyphicon glyphicon-white glyphicon-plus"></span> Add Material</a>
										@if($course['active']==1)
											<a href="{{url('courses/disable').'/'.$course['id']}}" class="btn btn-info"><span class="glyphicon glyphicon-white glyphicon-off"></span> Disable this Course</a>
										@else
											<a href="{{url('courses/enable').'/'.$course['id']}}" class="btn btn-success"><span class="glyphicon glyphicon-white glyphicon-off"></span> Activate this Course</a>
										@endif
										<a href="{{url('courses').'/'.$course['id']}}" data-method="delete" class="btn btn-warning"><span class="glyphicon glyphicon-white glyphicon-pencil"></span> Edit Course</a>
										<a href="{{url('courses').'/'.$course['id']}}" data-method="delete" class="btn btn-danger"><span class="glyphicon glyphicon-white glyphicon-trash"></span> Delete Course</a>
										</td>
									</tr>
									<?php $no++; ?>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop