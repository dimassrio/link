@extends('layout')

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1 class="page-header">Register Course Material</h1>
				{{Form::open(array('url'=>url('materials'), 'method'=>'post', 'files'=>true))}}
				<div class="form-group"><label for="">Name</label><input type="text" name="name" class="form-control"></div>
				<div class="form-group"><label for="">Content</label><textarea name="content" class="form-control" id="" cols="30" rows="10"></textarea></div>
				<div class="form-group"><label for="">Video</label><input type="text" name="video" class="form-control"></div>
				<div class="form-group"><label for="">Quiz</label><input type="file" name="quiz" class="form-control"></div>
				<div class="form-group"><label for="">Course</label>
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