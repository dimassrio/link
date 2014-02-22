@extends('layout')

@section('body')
<div class="container">
<div class="row">
	<h1 class="page-header">WELCOME! <small>register below to create your account.</small></h1>
</div>
<div class="row">
	
</div>
	<div class="row">
		<div class="col-md-8">
		<p class="lead">Please complete the following fields to register for an account. Required fields are noted by <strong>bold text and an asterisk (*). </strong></p>
			{{Form::open(array('method'=>'POST','url' => 'register'))}}
				<div class="form-group">
					{{Form::label('nim','NIM*')}}
					{{Form::text('nim',null,array('class'=>'form-control'))}}
				</div>
				<div class="form-group">
					{{Form::label('username','Username*')}}
					{{Form::text('username',null,array('class'=>'form-control'))}}
				</div>
				<div class="form-group"><label for="password">Password*</label><input name="password" type="password" class="form-control"></div>
				<div class="form-group">
					{{Form::label('realname','Realname*')}}
					{{Form::text('realname',null,array('class'=>'form-control'))}}
				</div>
				<div class="form-group">
					{{Form::label('classroom','Class*')}}
					{{Form::select('classroom',$classes,null,array('class'=>'form-control'))}}
				</div>
				<div class="form-group">
					{{Form::label('email','Email*')}}
					{{Form::text('email',null,array('class'=>'form-control'))}}
				</div>
				<div class="form-group">
					{{Form::label('phone','Phone*')}}
					{{Form::text('phone',null,array('class'=>'form-control'))}}
				</div>
				<div class="form-group"><input type="submit" class="btn btn-success btn-block btn-lg" value="Create Account"></div>
			{{Form::close()}}
		</div>
		<div class="col-md-4">
			<h4>Already Registered?</h4>
			<a href="{{url('/')}}">Click Here to Login.</a>
			<h4>Welcome to Language Laboratory</h4>
			<p>Registering with Language Laboratory gives you access to all of our current and future free courses. Not ready to take a course just yet? Registering puts you on our mailing list - we will update you as courses are added.</p>
		</div>
	</div>
</div>
@stop