@extends('layout')

@section('body')
	<div class="container">
		<div class="row"><h1 class="page-header">List of Classes</h1></div>
		<div class="row">
			<div class="col-md-4">
			<h4>Need a new class?</h4>
				<a href="{{url('classrooms/create')}}" class="btn btn-success">Create New Classes</a>
			</div>
			<div class="col-md-8">
				<table class="table table-bordered table-stripped">
					<thead>
						<th>No</th>
						<th>Class Name</th>
						<th>Teacher</th>
						<th>Action</th>
					</thead>
				
				<tbody>
				<?php $no = 1; ?>
					@foreach($classes as $class)
					<tr>
						<td>{{$no}}</td>
						<td>{{$class['name']}}</td>
						<td>{{User::getNameFromId($class['teacher'])}}</td>
						<td>
							<a href="{{url('classrooms/'.$class['id'].'/edit')}}" class="btn btn-primary">Edit Classroom</a>
							<a href="{{url('classrooms/'.$class['id'])}}" data-method="delete" class="btn btn-danger">Delete Classroom</a>
						</td>
					</tr>
					<?php $no; ?>
					@endforeach
				</tbody>
				</table>
			</div>
		</div>
	</div>
@stop