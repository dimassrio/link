@extends('layout')

@section('body')
	<div class="container">
	<div class="row">
		<div class="col-md-12">
				<h1 class="page-header">Course Registered</h1>
		</div>
	</div>
		<div class="row">
			<div class="col-md-8">
				
					@foreach(Auth::user()->course as $c)
					<div class="course-{{$c->id}}"></div>

						<div class="media course-wrapper">
							<img src="{{url('uploads').'/'.$c->picture}}" alt="" class="media-object thumbnail pull-left" width="300px">
							@if($c->active==1)
							<h2 class="course-heading page-header"><a href="{{url('courses').'/'.$c->id}}"> {{$c->name}}</a></h2>
							@else
							<h2 class="course-heading page-header">{{$c->name}}</h2>
							@endif
							<div class="course-body">
								<p> {{$c->description}}</p>
								
							@if($c->active==1)
							<a href="{{url('courses').'/'.$c->id}}" class="btn btn-success"><span class="glyphicon glyphicon-white glyphicon-folder-open"></span> View Course</a>
							@else
							<a href="" class="btn btn-danger" disabled="disabled"><span class="glyphicon glyphicon-white glyphicon-folder-open"></span>Course Disabled</a>
							@endif
							</div>
						</div>
						<div class="course-footer">
								This course is available from <strong>{{date('d F Y', strtotime($c->start))}}</strong> until <strong>{{date('d F Y', strtotime($c->end))}}</strong>.
						</div>
					@endforeach
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="text-center">{{Auth::user()->realname}}</h4>
					</div>
					<ul class="list-group">
						<li class="list-group-item"><span class="glyphicon glyphicon-heart"></span>  {{Auth::user()->nim}}</li>
						<li class="list-group-item"><span class="glyphicon glyphicon-user"></span>  {{Auth::user()->username}}</li>
						<li class="list-group-item"><span class="glyphicon glyphicon-phone"></span> {{Auth::user()->phone}}</li>
						<li class="list-group-item"><span class="glyphicon glyphicon-envelope"></span> {{Auth::user()->email}}</li>
						<li class="list-group-item"><span class="glyphicon glyphicon-briefcase"></span> @if(!is_null(Auth::user()->classroom->first()->name)){{Auth::user()->classroom->first()->name}}@endif</li>
					</ul>
				</div>
				<a href="{{url('select')}}" class="btn btn-warning btn-lg btn-block"> <span class="glyphicon glyphicon-white glyphicon-send"></span> Find Courses</a>
			</div>
		</div>
	</div>
	
@stop