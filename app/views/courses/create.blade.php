@extends('layout')
@section('css')
	{{HTML::style(asset('assets/js/jquery.ui/themes/base/jquery.ui.all.css'))}}
@stop
@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h4>Going Back</h4>
				<a href="{{url('courses')}}" class="btn btn-danger btn-lg">Click here to go back.</a>
			</div>
			<div class="col-md-8">
				<h1 class="page-header">	{{$pagetitle}}</h1>
				{{Form::open(array('url'=>'courses', 'method'=>'post', 'files'=>true))}}
					<div class="form-group"><label for="">Course Name</label><input type="text" name="name" class="form-control"></div>
					<div class="form-group"><label for="">Description</label><input type="text" name="description" class="form-control"></div>
					<div class="form-group"><label for="">Start Date</label><input type="text" name="start" class="form-control date-start"></div>
					<div class="form-group"><label for="">End Date</label><input type="text" name="end" class="form-control date-end"></div>
					<div class="form-group"><label for="">Author</label><input type="text" name="author" class="form-control"></div>
					<div class="form-group"><label for="">Information</label><textarea name="info" id="" class="form-control" cols="30" rows="10"></textarea></div>
					<div class="form-group"><label for="">Picture</label><input type="file" name="picture" class="form-control"></div>
					<div class="form-group"><input type="Submit" value="Submit" class="btn btn-success btn-lg btn-block"></div>
				{{Form::close()}}
			</div>
		</div>
	</div>
@stop

@section('js')
		{{HTML::script(asset('assets/js/jquery.ui/ui/jquery.ui.core.js'))}}
		{{HTML::script(asset('assets/js/jquery.ui/ui/jquery.ui.datepicker.js'))}}
		<script type="text/javascript">
		$('.date-start').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd',
			showButtonPanel: true
		});

		$('.date-end').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd',
			showButtonPanel: true
		});
		</script>
@stop