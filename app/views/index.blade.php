@extends('layout')

@section('body')
	<div class="main-header">
	<div class="container">
	<div class="row">
		<h1 class="text-center">
			Learning English is fun, <small>start learning right here, right now, straight from your computer.</small>
		</h1>
		<div class="col-md-2 col-md-offset-4">
			<a href="{{url('register')}}" class="btn btn-danger btn-lg btn-block"><span class="glyphicon glyphicon-user"></span> Register Now</a>
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
			<div class="col-md-4">
			<div class="row panel panel-default">
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
			<div class="row">
			<div class="col-md-12">
				<h4>Not Registered Yet?</h4>
				<a href="{{url('register')}}">Sign up today!</a>
				<h4>Forgot Your Password?</h4>
				<a href="">Forget Password</a>
			</div>
		</div>
			</div>
			<div class="col-md-8">
				<iframe src="https://onedrive.live.com/embed?cid=CB72496105ED14A0&resid=CB72496105ED14A0%212157&authkey=AJefBtF7QglIqZw&em=2" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
				<small>Cannot see the content? Click <a href="http://1drv.ms/1gCOQHP">here</a> to download the tutorial.</small>
			</div>
		</div>
		
	</div>
@stop

@extends('js')
	{{HTML::script(asset('assets/js/delete.modal.js'))}}
@stop