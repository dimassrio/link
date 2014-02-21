@extends('layout')

@section('body')
	<div class="main-header">
	<div class="container">
	<div class="row">
		<h1 class="text-center">
			Learning English is fun, <small>start learning right here, right now, straight from your computer.</small>
		</h1>
		<div class="col-md-2 col-md-offset-4">
			<a href="{{url('users/create')}}" class="btn btn-danger btn-lg btn-block"><span class="glyphicon glyphicon-user"></span> Register Now</a>
		</div>
		<div class="col-md-2">
			 <a href="#login-form" class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-log-in"></span> Login</a>
		</div>
	</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="text-center page-header">Language Center Online Learning <br/><small>Providing interactive online language classes from Telkom University.</small></h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4 panel panel-default">
				<h4 class="page-header text-center">LOGIN</h4>
				<div id="login-form" class="login-form clearfix panel-body">
				{{Form::open(array('url'=>'login'))}}
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" placeholder="username" class="form-control">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" placeholder="password" class="form-control">
					</div>
					<label class="checkbox-inline">
						<input type="checkbox" name="remember" value="1"> Remember Me
					</label>
					<input type="submit" class="btn btn-success btn-lg pull-right" value="Login">
				{{Form::close()}}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<h4>Not Registered Yet?</h4>
				<a href="{{url('users/create')}}">Sign up today!</a>
				<h4>Forgot Your Password?</h4>
				<a href="">Forget Password</a>
			</div>
		</div>
	</div>
@stop

@extends('js')
	{{HTML::script(asset('assets/js/delete.modal.js'))}}
@stop