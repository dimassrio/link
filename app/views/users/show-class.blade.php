@extends('layout')

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="page-header">{{$pagetitle}}</h1>
				{{Form::open(array('url'=>'show-classroom'))}}
					<div class="group-control">
						{{Form::label('Course')}}
						{{Form::select('course', $course, null)}}
					</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
@stop