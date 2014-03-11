@extends('layout')

@section('body')
	<div class="container">
		<div class="row"><div class="col-md-12">
			<h1 class="page-header">Student Evaluation Page</h1>
		</div></div>
		<div class="row">
			<div class="col-md-4">
				@if(Auth::user()->level < 3)
					{{Form::open(array('url'=>'evaluation'))}}
					<div class="form-group">
					{{Form::label('classroom', 'Select Classroom')}}
					{{Form::select('classroom', $classroom, null, array('class' => 'form-control'))}}
					</div>
					<div class="form-group">
						{{Form::label('course', 'Select Course')}}
						{{Form::select('course', $course, null, array('class'=>'form-control'))}}
					</div>
					<div class="form-group">
						{{Form::submit('Submit', array('class'=> 'form-control btn btn-primary'))}}
					</div>
					{{Form::close()}}
				@endif
			</div>
			<div class="col-md-8">
				@if(!isset($users))
					<h3 class="text-warning text-center">Silahkan memilih kelas dan modul yang anda ingin evaluasi.</h3>
				@else
					<table id="user-table"class="table table-bordered table-striped">
					<thead>
						<th>No</th>
						<th>NIM</th>
						<th>Name</th>
						<th colspan="3">Evaluation</th>
					</thead>
					<tbody>
					<?php $no = 1; ?>
						@foreach($users as $u)
						<tr>
							<td>{{$no++}}</td>
							<td>{{$u['nim']}}</td>
							<td>{{$u['name']}}</td>
							<td>
							@foreach($u['data'] as $a)
								<div>
									<h4>{{Material::getNameFromId($a['material_id'])}}</h4>
									<p class="lead">Value : {{$a['value']}}</p>
									<p class="text-danger"> Access Date : {{$a['access']}}</p>
								</div>
								<hr>
							@endforeach
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@endif
				
			</div>
		</div>
	</div>
@stop