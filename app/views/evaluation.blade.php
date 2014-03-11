@extends('layout')

@section('body')
	<div class="container">
		<div class="row"><div class="col-md-12">
			<h1 class="page-header">Student Evaluation Page</h1>
		</div></div>
		<div class="row">
			<div class="col-md-4">
				@if(Auth::user()->level < 3)
					{{Form::open(array('url'=>'evaluation'))}}
					<div class="form-group">
					{{Form::label('classroom', 'Select Classroom')}}
					{{Form::select('classroom', $classroom, null, array('class' => 'form-control'))}}
					</div>
					<div class="form-group">
						{{Form::label('course', 'Select Course')}}
						{{Form::select('course', $course, null, array('class'=>'form-control'))}}
					</div>
					<div class="form-group">
						{{Form::submit('Submit', array('class'=> 'form-control btn btn-primary'))}}
					</div>
					{{Form::close()}}
				@endif
			</div>
			<div class="col-md-8">
				@if(!isset($users))
					<h3 class="text-warning text-center">Silahkan memilih kelas dan modul yang anda ingin evaluasi.</h3>
				@else
					<table id="user-table"class="table table-bordered table-striped">
					<thead>
						<th>No</th>
						<th>NIM</th>
						<th>Name</th>
						<th>Material Name</th>
						<th>Value</th>
						<th>Access</th>
					</thead>
					<tbody>
					<?php $no = 1; ?>
						@foreach($users as $u)
						<tr>
							<td>{{$no++}}</td>
							<td>{{$u['nim']}}</td>
							<td>{{$u['name']}}</td>
							<td>{{Material::getNameFromId($u['material_id'])}}</td>
							<td>{{$u['value']}}</td>
							<td>{{$u['access']}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@endif
				
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
		$('#user-table').dataTable();
		$('[id|=edit-btn]').tooltip();
		$('[id|=delete-btn]').tooltip();
	});
	</script>
@stop