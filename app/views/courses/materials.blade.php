@extends('layout')

@section('body')
	<div class="container">
		<div class="row course-nav">
			<div class="col-md-12">
				<ul class="nav nav-pills">
					<li><a href="{{url('courses').'/'.$courses['id']}}"><span class="glyphicon glyphicon-white glyphicon-info-sign"></span> Information</a></li>
					<li class="active"><a href="{{url('courses').'/'.$courses['id'].'/material'}}"><span class="glyphicon glyphicon-white glyphicon-th-list"></span> Material</a></li>
					<li><a href="{{url('courses').'/'.$courses['id'].'/result'}}"><span class="glyphicon glyphicon-white glyphicon-print"></span> Result</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="list-group material-list">
				<?php $no = 1; ?>
				@foreach($list as $l)
					<?php $n = $no-1; ?>
					@if($l['id']==$material['id'])
					<a href="{{url('courses').'/'.$courses['id'].'/material/'.$l['id']}}" class="list-group-item active">{{$no.'. '.$l['name']}} <br /> @if($n<$cur)<span class="label label-success pull-right">Completed</span> @else <span class="label label-danger pull-right">Not Complete</span> @endif</a>
					@else
						@if($n<=$cur)
							<a href="{{url('courses').'/'.$courses['id'].'/material/'.$l['id']}}" class="list-group-item">{{$no.'. '.$l['name']}} @if($n<$cur)<br/><span class="label label-success pull-right">Completed</span> @else <span class="label label-danger pull-right">Not Complete</span> @endif </a>
						@else
							<a href="" class="list-group-item disabled">{{$no.'. '.$l['name']}} @if($n<$cur)<br /><span class="label label-success pull-right">Completed</span> @else <span class="label label-danger pull-right">Not Complete</span> @endif </a>
						@endif
					@endif
					<?php $no++ ?>
				@endforeach
				</div>
			</div>
			<div class="col-md-8 material-view">
				<h1 class="page-header material-heading">
					{{$pagetitle}}
				</h1>
				<!-- Navigation -->
				<ul class="nav nav-tabs">
					<li  class="active" ><a href="#Material" data-toggle="tab">Material</a></li>
					@if(!$material['quiz'] == "")
						<li><a href="#quiz" data-toggle="tab">Quiz</a></li>
					@endif
					<li><a href="#reference" data-toggle="tab">Reference</a></li>
				</ul>
				<div class="tab-content material-body">
					<!-- Content -->
					<div class="tab-pane" id="reference">
						<div class="material-content panel panel-default">
							<div class="panel-body">{{Material::prepareReference($material['content'])}}</div>
							<div class="panel-footer"><strong>Authored by : </strong>{{$material['author']}}</div>
						</div>	
					</div>
					<!-- Material -->
					<div class="tab-pane active" id="Material">
						<div class="material-video video-wrapper">
							<iframe src="//www.youtube.com/embed/{{Material::getValueFromUrl($material['video'])}}?feature=player_detailpage" frameborder="0" allowfullscreen></iframe>
						</div>
						<hr>
						@if ($material['quiz'] == "")
							@if($cur<=$max)
							<a href="{{url('courses').'/'.$courses['id'].'/material/'.$material['id'].'/nextmaterial'}}" class="btn btn-success btn-lg btn-block">Go to Next Material</a>
							@endif
						@endif
					</div>
					<!-- Quiz -->
					@if(!$material['quiz'] == "")
					<div class="tab-pane" id="quiz">
						<div class="panel panel-default">
							<div class="panel-body"><p>In order to move to the next learning material, you must complete the quiz provided below. Remember you can only take the test twice, and every question and anwer choice will be randomized in order to prevent memorizing the answers. We hope that you can complete this test.</p></div>
							<div class="panel-footer">
								<p class="lead">The last result for this test is : {{$qr}} </p>
							</div>
						</div>
						<div class="alert alert-warning">
							Remaining chance : {{$qc}}
						</div>
						@if($qc <= 0)
							<a href="" class="btn btn-danger btn-lg btn-block" disabled="disabled">Take Quiz</a>
						@else
							<a href="{{url('courses').'/'.$courses['id'].'/material/'.$material['id'].'/quiz'}}" class="btn btn-success btn-lg btn-block">Take Quiz</a>								
						@endif
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@stop