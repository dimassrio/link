@extends('layout')

@section('body')
	<div class="container">
		<div class="row"><div class="col-md-12">
			<h1 class="page-header">Reset Password <small>Please enter the information below.</small></h1>
		</div></div>
		<div class="row">
			<div class="col-md-8">
				{{Form::open(array('url'=>'	reset', 'method'=>'post'))}}
					<div class="form-group">
						{{Form::label('nim', 'Your NIM')}}
						{{Form::text('nim', null, array('class'=>'form-control'))}}
					</div>
					<div class="form-group">
						{{Form::label('email', 'Your Email')}}
						{{Form::text('email', null, array('class'=>'form-control'))}}
					</div>
					<div class="form-group">
						{{Form::submit('Send to Email',array('class'=>'btn btn-primary btn-lg'))}}
					</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
@stop