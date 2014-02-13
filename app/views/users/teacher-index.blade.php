@extends('layout')

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="page-header">Class Alocation<br/><small>This is the class that allocated to your account.</small></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<table class="table table-bordered table-striped">
					<thead>
						<th>No</th><th>Classroom Name</th><th>Number of Students</th><th>Action</th>
					</thead>
					<tbody>
					<?php $no = 1; ?>
						@foreach($classroom as $class)
							<tr><td>{{$no++}}</td><td>{{$class->name}}</td><td>{{$class->number}}</td><td><a href="" class="btn btn-primary">Show Report</a></td></tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop