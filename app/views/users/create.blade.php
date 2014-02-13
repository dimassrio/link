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
			{{Form::open(array('url'=>'users', 'method'=>'post'))}}
				<div class="form-group"><label for="nim">NIM*</label><input type="text" name="nim" class="form-control" placeholder="Input with your student identification number (NIM)"></div>
				<div class="form-group"><label for="username">Username*</label><input name="username" type="text" class="form-control"></div>
				<div class="form-group"><label for="password">Password*</label><input name="password" type="password" class="form-control"></div>
				<div class="form-group"><label for="realname">Real Name*</label><input name="realname" type="text" class="form-control" placeholder="example : John Doe"></div>
				<div class="form-group">{{Form::label('class','Class*')}}{{Form::select('class',$classes,null,array('class'=>'form-control'))}}</div>
				<div class="form-group"><label for="email">Email*</label><input name="email" type="text" class="form-control" placeholder="example : email@email.com"></div>
				<div class="form-group"><label for="phone">Phone*</label><input name="phone" type="text" class="form-control" placeholder="example : 0811111111111"></div>
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