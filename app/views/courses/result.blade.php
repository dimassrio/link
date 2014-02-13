@extends('layout')

@section('body')
	<div class="container">
	<div class="row">
			<div class="col-md-12">
				<ul class="nav nav-pills">
					<li><a href="{{url('courses').'/'.$courses['id']}}"><span class="glyphicon glyphicon-white glyphicon-info-sign"></span> Information</a></li>
					<li><a href="{{url('courses').'/'.$courses['id'].'/material'}}"><span class="glyphicon glyphicon-white glyphicon-th-list"></span> Material</a></li>
					<li class="active"><a href="{{url('courses').'/'.$courses['id'].'/result'}}"><span class="glyphicon glyphicon-white glyphicon-print"></span> Result</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<h5 class="lead">Print this result.</h5>
				<a href="{{url('courses/'.$courses['id'].'/result/printpdf')}}" class="btn btn-primary btn-lg">Print Result</a>
			</div>
			<div class="col-md-8">
				<h1 class="page-header">{{$pagetitle}}</h1>
				<table class="table table-bordered table-striped">
					<thead><tr>
					<th>No</th>
					<th>Material Name</th>
					<th>Quiz Value</th>
					</tr></thead>
					<tbody>
					<?php $no = 1; ?>
						@foreach($materials as $material)
						<tr>
							<td>{{$no}}</td>
							<td>{{$material['name']}}</td>
							<td>{{$value[$no-1]}}</td>
						</tr>
						<?php $no++; ?>
						@endforeach
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
@stop