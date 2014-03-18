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
					<div class="nav navbar-nav navbar-right">
						
						<ul class="nav navbar-nav">
							<li class="dropdown" id="user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->realname}} <b class="caret"></b></a>
								<ul class="dropdown-menu" role="menu">
										<li><a href="{{url('users').'/'.Auth::user()->id.'/edit'}}" class="center-block"><span class="glyphicon glyphicon-pencil"></span> Edit Profile</a></li>
								</ul>
							</li>
						</ul>
						<li><a href="{{url('logout')}}" class="btn btn-danger navbar-btn"><span class="glyphicon glyphicon-white glyphicon-log-out"></span> Logout</a></li>
					</div>
				@endif
				</nav>
			</div>
		</div>
</header>

@if(!sizeof($errors->all())==0)
	<div class="container alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	@foreach($errors->all() as $error)
		<p class="text-danger">{{$error}}</p>
	@endforeach
	</div>
@endif