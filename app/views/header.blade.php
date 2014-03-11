<header class="banner navbar navbar-default navbar-static-top col-lg-12" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-sm-12">
					<div class="navbar-header text-center">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="{{url()}}"><img src="{{asset('assets/image/header-logo-small.png')}}" alt=""></a>

					</div>
				</div>
				<nav class="collapse navbar-collapse" role="navigation">

				<ul class="nav navbar-nav">
					@include('header-menu')
				</ul>
				@if(Auth::check())
					<div class="navbar-right">
						<a href="{{url('logout')}}" class="btn btn-danger navbar-btn"><span class="glyphicon glyphicon-white glyphicon-log-out"></span> Logout</a>
						<ul class="nav navbar-nav">
							<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->realname}} <b class="caret"></b></a></li>
						</ul>
					</div>
				@endif
				</nav>
			</div>
		</div>
</header>
@if(Session::has('message'))
	<div class="container alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p class="alert">{{ Session::get('message') }}</p>
	</div>
@endif

@if(!sizeof($errors->all())==0)
	<div class="container alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	@foreach($errors->all() as $error)
		<p class="text-danger">{{$error}}</p>
	@endforeach
	</div>
@endif