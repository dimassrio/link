@extends('layout')
@section('css')
	{{HTML::style(asset('assets/js/jquery.ui/themes/base/jquery.ui.all.css'))}}
@stop
@section('body')
	<div class="container">
		<div class="row course-nav">
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
				<img src="{{url('uploads').'/'.$courses->picture}}" alt="{{$courses['name']}} picture." class="thumbnail course-thumbnail" width="300px">
			</div>
			<div class="col-md-8">
				<h1 class="page-header">{{$pagetitle}}</h1>
				<div class="courses-body">
				<p>{{$courses['info']}}</p>
				</div>
				<hr>
				<p>Authored by : {{$courses['author']}}</p>
				@if(User::isAdmin())
				<div id="material-list">
					<p class="lead">You can choose the order of material here.</p>
					<table class="table table-striped table-bordered">
						<thead><th>Name</th></thead>
						<tbody id="sortable">
						<?php $no = 1;?>
							@foreach($material as $m)
								<tr id="{{$m['attributes']['id']}}">
									<td>{{$m['attributes']['name']}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					<button class="btn btn-primary btn-block btn-lg" id="submit-btn"><span class="glyphicon glyphicon-submit"></span> Submit</button>
				</div>
				@endif
			</div>
		</div>
	</div>
@stop

@section('js')
	<!-- {{HTML::script(asset('assets/js/jquery.ui/ui/jquery.ui.core.js'))}}
	{{HTML::script(asset('assets/js/jquery.ui/ui/jquery.ui.mouse.js'))}}
	{{HTML::script(asset('assets/js/jquery.ui/ui/jquery.ui.widget.js'))}}-->
	{{HTML::script(asset('assets/js/jquery.ui/ui/jquery-ui-1.10.4.custom.min.js'))}}
	<!--	{{HTML::script('http://code.jquery.com/ui/1.10.4/jquery-ui.js')}} -->
	<script type="text/javascript">
		$(document).ready(function(){
			var neword = new Array();
			$('#submit-btn').hide();
			$('#sortable').sortable({
				placeholder: "ui-state-highlight",
				update: function(){
					$('#sortable tr').each(function(){
						var id = $(this).attr('id');
						var obj = null;
						obj = id;
						//obj.push(id);
						neword.push(obj);
					});
					$('#submit-btn').fadeIn();
				}
			});
			$( "#sortable" ).disableSelection();
			$('#submit-btn').click(
				function(){
					$.post("{{url('orders/post/')}}", {'neworder': neword}, function(data){
						alertify.success("Ordering Material complete.");
					});
			});
		});
	</script>
@stop