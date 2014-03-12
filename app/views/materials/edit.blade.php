@extends('layout')

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1 class="page-header">{{$pagetitle}}</h1>
				{{Form::model($materials, array('route' => array('materials.update', $materials->id), 'method'=>'PUT', 'files'=>true))}}
				<div class="form-group">
					{{Form::label('Material Name')}}
					{{Form::text('name',null,array('class'=>'form-control'))}}
				</div>
				<div class="form-group">
					{{Form::label('Content')}}
					{{Form::textarea('content',null,array('class'=>'form-control'))}}
				</div>
				<div class="form-group">
					{{Form::label('Video')}}
					{{Form::text('video',null,array('class'=>'form-control'))}}
				</div>
				<div class="form-group">
					{{Form::label('Quiz')}}
					{{Form::file('quiz',null,array('class'=>'form-control'))}}
				</div>
				<div class="form-group">
					<label for="">Course</label>
					{{Form::select('course', $courses, $selected, array('class'=>'form-control'))}}
				</div>
				<div class="form-group"><input type="submit" value="Submit" class="btn btn-success btn-lg"></div>
				{{Form::close()}}
			</div>
			<div class="col-md-4">
			</div>
		</div>
	</div>
@stop