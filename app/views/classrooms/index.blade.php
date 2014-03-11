@extends('layout')

@section('body')
	<div class="container">
		<div class="row"><h1 class="page-header">List of Classes</h1></div>
		<div class="row">
			<div class="col-md-2">
			<h4>Need a new class?</h4>
				<a href="{{url('classrooms/create')}}" class="btn btn-success">Create New Classes</a>
			</div>
			<div class="col-md-10">
				<table class="table table-bordered table-striped" id="classroom-table">
					<thead>
						<th>No</th>
						<th>Class Name</th>
						<th>Teacher</th>
						<th>Action</th>
					</thead>
				
				<tbody>
				<?php $no = 1; $x = 0;?>
					@foreach($classes as $class)
					<tr>
						<td>{{$no++}}</td>
						<td>{{$class['name']}}</td>
						<td>{{User::getNameFromId($teacher[$x])}}</td>
						<td>
							@if($class['active']== 0) 
								<a href="{{url('classrooms')}}/{{$class['id']}}/toggle" class="btn btn-success"><span class="glyphicon glyphicon-off"></span> Enable Classroom</a>
							@else<a href="{{url('classrooms')}}/{{$class['id']}}/toggle" class="btn btn-danger"><span class="glyphicon glyphicon-off"></span> Disable Classroom</a>
							@endif
							<a href="{{url('classrooms/'.$class['id'].'/edit')}}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Edit Classroom</a>
							
							<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-method-modal="{{url('classrooms/').'/'.$class->id}}"><span class="glyphicon glyphicon-remove"></span> Delete Classroom</button>
						</td>
					</tr>
					<?php $x++;?>
					@endforeach
				</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Modal title</h4>
				</div>
				<div class="modal-body">
					Are you really sure you want to delete this item?
				</div>
					<div class="modal-footer">
				</div>
			</div>
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
			$('#classroom-table').dataTable();
			$('[id|=edit-btn]').tooltip();
			$('[id|=delete-btn]').tooltip();
		});
	</script>
	{{HTML::script(asset('assets/js/delete.modal.js'))}}
@stop