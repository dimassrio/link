@extends('layout')

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<h4>Create a new Course.</h4>
				<a href="{{url('courses/create')}}" class="btn btn-danger"><span class="glyphicon glyphicon-plus-sign"></span> Create Courses</a>
			</div>
			<div class="col-md-10">
				<h1 class="page-header">{{$pagetitle}}</h1>
				<table class="table table-bordered table-stripped" id="course-table">
					<thead><th>No</th><th>Name</th><th>Description</th><th>Start Date</th><th>End Date</th><th>Action</th></thead>
					<tbody>
						@if(isset($courses))
						<?php $no = 1; ?>
							@foreach($courses as $course)
								<tr>
									<td>{{$no}}</td>
									<td>{{$course['name']}}</td>
									<td>{{$course['description']}}</td>
									<td>{{$course['start']}}</td>
									<td>{{$course['end']}}</td>
									<td>
										<a href="{{url('materials/create').'/'.$course['id']}}" class="btn btn-primary"id="add-btn" data-toggle="tooltip" data-placement="right" title="Add Material"><span class="glyphicon glyphicon-white glyphicon-plus" ></span></a>
										@if($course['active']==1)
											<a href="{{url('courses/disable').'/'.$course['id']}}" class="btn btn-info" id="disable-btn" data-toggle="tooltip" data-placement="right" title="Disable this Course"><span class="glyphicon glyphicon-white glyphicon-off" ></span></a>
										@else
											<a href="{{url('courses/enable').'/'.$course['id']}}" class="btn btn-success" id="enable-btn" data-toggle="tooltip" data-placement="right" title="Enable this Course"><span class="glyphicon glyphicon-white glyphicon-off"></span></a>
										@endif
										<a href="{{url('courses').'/'.$course['id'].'/edit'}}" class="btn btn-warning" id="edit-btn" data-toggle="tooltip" data-placement="right" title="Edit Course"><span class="glyphicon glyphicon-white glyphicon-pencil" ></span></a>
										<a href="{{url('courses').'/'.$course['id']}}" data-method="delete" class="btn btn-danger" id="delete-btn" data-toggle="tooltip" data-placement="right" title="Delete Course"><span class="glyphicon glyphicon-white glyphicon-trash" ></span></a>
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

@section('css')
	<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
@stop

@section('js')
	<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#course-table').dataTable();
		$('[id|=add-btn]').tooltip();
		$('[id|=enable-btn]').tooltip();
		$('[id|=disable-btn]').tooltip();
		$('[id|=edit-btn]').tooltip();
		$('[id|=delete-btn]').tooltip();
	});
	</script>
	{{HTML::script(asset('assets/js/delete.modal.js'))}}
@stop