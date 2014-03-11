@extends('layout')

@section('body')
	<div class="container">
		<div class="row">
			<h1 class="page-header">
				Give Feedback
			</h1>
		</div>
		<div class="row">
			<div class="col-md-8">
			{{Form::open(array('method'=>'POST','url' => 'feedbacks'))}}
				<div class="form-group">
					{{Form::label('target','For whom do these feedback for?')}}
					{{Form::select('target',$target,null,array('class'=>'form-control'))}}
				</div>
				<div class="form-group">
					{{Form::label('content','Content*')}}
					{{Form::textarea('content',null,array('class'=>'form-control'))}}
				</div>
				<div class="form-group"><input type="submit" class="btn btn-success btn-block btn-lg" value="Create Account"></div>
			{{Form::close()}}
			</div>
		</div>
	</div>
@stop