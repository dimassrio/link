@extends('layout')

@section('body')
	<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="page-header">Edit Classrooms</h1>
		</div>
	</div>
		<div class="row">
			<div class="col-md-2">
				<a href="{{url('classrooms')}}" class="btn btn-danger"><span class="glyphicon glyphicon-th-list"></span> Going Back</a>
			</div>
			<div class="col-md-10">
				{{Form::model($classroom, array('method' => 'PUT', 'route'=>array('classrooms.update', $classroom->id, $classroom)))}}
					<div class="form-group">
						{{Form::label('name', 'Name : ')}}
						{{Form::text('name', null, array('class'=>'form-control'))}}
					</div>
					<div class="form-group">
						{{Form::label('author', 'Teacher : ')}}
						{{Form::select('teacher', $teacher, null, array('class'=>'form-control'))}}
					</div>
					<div class="form-group">
						{{Form::submit('Edit Classrooms', array('class'=>'btn btn-primary btn-lg'))}} 
					</div>
				{{Form::close()}}
			</div>
			
		</div>
	</div>
@stop