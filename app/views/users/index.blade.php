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
				<table class="table table-bordered table-striped">
					<thead>
						<th>No</th><th>Realname</th><th>Classrooms</th><th>Status</th><th>Username</th><th>Email</th><th>Phone</th>
					</thead>
					<tbody>
					<?php $no=1; ?>
						@foreach($users as $user)
						<tr>
							<td rowspan="2">{{$no++}}</td>
							<td>{{$user->realname}}</td>
							<?php $c = $user->classroom->first();?>
							<td>@if($user->level > 2){{$c['name']}}@else Not a student @endif </td>
							<td>{{User::getStatus($user->level)}}</td>
							<td>{{$user->username}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->phone}}</td>
						</tr>
						<tr><td colspan="6">
							<a href="{{url('users/'.$user->id.'/edit')}}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Edit User</a>
							<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-method-modal="{{url('users/').$user->id}}"><span class="glyphicon glyphicon-remove"></span> Delete User</button>
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