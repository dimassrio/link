@extends('layout')

@section('body')
	<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="page-header">User List</h1>
		</div>
	</div>
		<div class="row">
			<div class="col-md-12">
			<a href="{{url('users/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add New User</a>
			<hr/>
				<table class="table table-bordered table-striped" id="user-table">
					<thead>
						<th>No</th><th>Realname</th><th>Classrooms</th><th>Status</th><th>Username</th><th>Email</th><th>Phone</th><th>Action</th>
					</thead>
					<tbody>
					<?php $no=1; ?>
						@foreach($users as $user)
						<tr>
							<td>{{$no++}}</td>
							<td>{{$user->realname}}</td>
							<?php $c = $user->classroom->first();?>
							<td>@if($user->level > 2){{$c['name']}}@else Not a student @endif </td>
							<td>{{User::getStatus($user->level)}}</td>
							<td>{{$user->username}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->phone}}</td>
							<td style="text-align: center;">
								<a href="{{url('users/'.$user->id.'/edit')}}" class="btn btn-warning" id="edit-btn-{{$user->id}}" data-toggle="tooltip" data-placement="right" title="Edit User"><span class="glyphicon glyphicon-pencil"></span></a>
								<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-method-modal="{{url('users/').$user->id}}" id="delete-btn-{{$user->id}}" data-toggle="tooltip" data-placement="right" title="Delete User"><span class="glyphicon glyphicon-remove"></span></button>
						</td></tr>
						@endforeach
					</tbody>
				</table>
				
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