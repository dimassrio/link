@extends('layout')

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="page-header">Choose Courses</h1>
				@if(isset($courses))
					@foreach($courses as $course)
						<div class="media panel panel-default course-{{$course['id']}}">
							<img src="{{url('uploads').'/'.$course['picture']}}" alt="" class="media-object thumbnail pull-left" width="300px">
							<div class="course-body panel-body">
								<h3 class="media-heading course-heading">{{$course['name']}}
								@if($course['active']==1)
									<span class="label label-success pull-right">Ready</span>
								@else
									<span class="label label-danger pull-right">Disabled</span>
								@endif
								</h3>
								<hr>
								<div class="media-body">
											{{$course['description']}}
								</div>
							</div>
							<div class="panel-footer clearfix">
								<strong>Author : </strong>{{$course['author']}} 
								<?php
								$courseList = array();
								foreach (Auth::user()->course as $c) {
									array_push($courseList, $c->id);	
								}
								?>
								@if(in_array($course['id'], $courseList))
									<p class="pull-right">You have been registered for this course.</p>
								@else
									@if($course['active']==1)
										<a href="{{url('select').'/'.$course['id']}}" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-white glyphicon-hand-up"></span> Register this Course</a>			
									@else
										<a href="" class="btn btn-danger pull-right" disabled="disabled"><span class="glyphicon glyphicon-white glyphicon-hand-up"></span> Register this Course</a>
									@endif
								@endif
							</div>
						</div>
					@endforeach
				@endif
			</div>
			</div>
		</div>
	</div>
@stop