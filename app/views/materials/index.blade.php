@extends('layout')

@section('body')
	<div class="container">
		<div class="row"><div class="col-md-12">
			<h1 class="page-header">{{$pagetitle}}</h1>
			<table class="table table-bordered table-striped" id="material-table">
				<thead>
					<tr>
						<th>No</th>
						<th>Name</th>
						<th>Video</th>
						<th>Quiz</th>
						<th>Course</th>
						<th>Level</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php $no = 1; ?>
				@if(isset($materials))
					@foreach($materials as $material)
					<tr>
							<td>{{$no}}</td>
							<td>{{$material['name']}}</td>
							<td>@if(!$material['video']=="")Available @else Not Available @endif</td>
							<td>@if(!$material['quiz']=="")Available @else Not Available @endif</td>
							<td><a href="{{url('courses/'.$material['course'])}}"> <?php $cou = Course::find($material['course']); ?>{{$cou['name']}}</a></td>
							<td>{{$material['level']}}</td>
							<td>
								<a href="{{url('materials/'.$material['id'].'/edit')}}" class="btn btn-success" id="edit-btn" data-toggle="tooltip" data-placement="right" title="Edit Material"><span class="glyphicon glyphicon-wrench"></span></a>
								<a href="" class="btn btn-danger" id="delete-btn" data-toggle="tooltip" data-placement="right" title="Delete Material"><span class="glyphicon glyphicon-remove"></span></a>
								
							</td>
					</tr>
						<?php $no++; ?>
					@endforeach
				@endif
				</tbody>
		</table>
		<hr>
		<p class="lead">Click here to create new Material</p>	
		<a href="{{url('materials/create')}}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span> Create New Material</a>
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
			$('#material-table').dataTable();
			$('[id|=edit-btn]').tooltip();
			$('[id|=delete-btn]').tooltip();
		});
	</script>
	{{HTML::script(asset('assets/js/delete.modal.js'))}}
@stop