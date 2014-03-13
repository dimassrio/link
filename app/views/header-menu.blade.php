<!-- Frontpage menu -->
@if(Auth::check())
	@if(Auth::user()->level == 0)
		<li><a href="{{url('users')}}">Users</a></li>
		<li><a href="{{url('courses')}}">Course</a></li>
		<li><a href="{{url('materials')}}">Material</a></li>
		<li><a href="{{url('classrooms')}}">Class</a></li>
	@elseif(Auth::user()->level == 1)
		<li><a href="{{url('evaluation')}}">Evaluation</a></li>
		<li><a href="{{url('users')}}">Users</a></li>
	@elseif(Auth::user()->level == 2)
		<li><a href="{{url('evaluation')}}">Evaluation</a></li>
		<li><a href="{{url('users')}}">Users</a></li>
	@elseif(Auth::user()->level == 3)
	@endif
	<li><a href="{{url('select')}}" class="navbar-btn btn btn-primary"><span class="glyphicon glyphicon-white glyphicon-send"></span> Find Course</a></li>
@else
	@if(Request::is('/'))
		<li><a href="{{url('register')}}">Register</a></li>
		<li><a href="{{url('contact')}}">Help</a></li>
	@endif
@endif