@extends('layout')

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="nav nav-pills">
					<li class="active"><a href="{{url('courses').'/'.$courses['id']}}"><span class="glyphicon glyphicon-white glyphicon-info-sign"></span> Information</a></li>
					<li><a href="{{url('courses').'/'.$courses['id'].'/material'}}"><span class="glyphicon glyphicon-white glyphicon-th-list"></span> Material</a></li>
					<li><a href="{{url('courses').'/'.$courses['id'].'/result'}}"><span class="glyphicon glyphicon-white glyphicon-print"></span> Result</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="list-groups"></div>
			</div>
			<div class="col-md-8">
				<h1 class="page-header">{{$pagetitle}}</h1>
				<div class="courses-body">
				<p>{{$courses['info']}}</p>
				</div>
				<hr>
				<p>Authored by : {{$courses['author']}}</p>
			</div>
		</div>
	</div>
@stop