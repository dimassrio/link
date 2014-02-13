@extends('layout')

@section('body')
	<div class="container">
		<div class="row"><div class="col-md-12">
			<h1 class="page-header">Student Evaluation Page</h1>
		</div></div>
		<div class="row">
			<div class="col-md-4">
				@if(Auth::user()->level == 0 || Auth::user()->level == 3)
					{{Form::open(array('url'=>'evaluation'))}}
					<div class="form-group">
					{{Form::label('classroom', 'Select Classroom')}}
					{{Form::select('classroom', array(), null, array('class' => 'form-control'))}}
					</div>
					<div class="form-group">
						{{Form::label('course', 'Select Course')}}
						{{Form::select('course', array(), null, array('class'=>'form-control'))}}
					</div>
					<div class="form-group">
						{{Form::submit('Submit', array('class'=> 'form-control btn btn-primary'))}}
					</div>
					{{Form::close()}}
				@elseif(Auth::user()->level == 1)

				@else

				@endif
			</div>
			<div class="col-md-8">
				<table class="table table-bordered table-striped">
					<thead>
						<th>No</th>
						<th>NIM</th>
						<th>Name</th>
						<th colspan="5">Evaluation</th>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
@stop