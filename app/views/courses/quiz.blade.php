@extends('layout')

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="nav nav-pills">
					<li><a href="{{url('courses').'/'.$courses['id']}}">Information</a></li>
					<li class="active"><a href="{{url('courses').'/'.$courses['id'].'/material'}}">Material</a></li>
					<li><a href="{{url('courses').'/'.$courses['id'].'/result'}}">Result</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div id="quizGuide" class="list-group">
					<?php $x = sizeof($qlist) ?>
					@for($i=1;$i<=$x;$i++)
						<a href="#item_{{$i}}" id="item_{{$i}}"class="list-group-item list-group-item-danger">{{$i}}</a>
					@endfor
				</div>
			</div>
			<div class="col-md-10">
				<h1 class="page-header">{{$pagetitle}}</h1>
				<?php $no = 1; ?>
				{{Form::open(array("url"=>url('courses/'.$courses['id'].'/material/'.$material['id'].'/showresult/')))}}
					@foreach($qlist as $question)
					<div id="item_{{$no}}" class="form-group">
						<label for="">{{$no.'. '.$question->question}}</label>
							<?php 
							$answerlist = (array) $question->answerlist; 
							shuffle($answerlist);
							?>
							@foreach($answerlist as $answer)
							<div class="radio"><input type="radio" id="{{$no}}" name="item_{{$no}}[]" value="{{$answer->key}}">{{$answer->answer}}</div>
							@endforeach	
					</div>
					<?php $no++; ?>
					@endforeach
				
				<div id="quizModal" class="modal fade bs-modal-sm" role="dialog" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					<div id="quizModalPost" class="model-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<div class="modal-title"><h4>Finishing your test?</h4></div>
							</div>
							<div class="modal-body">
								Please check your answer before submiting, you can check your answer by seeing the indicator on the left side. Remember you can only take the test twice, so do your best.
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<input id="formSubmits" type="submit" class="btn btn-primary" value="Submit Quiz" disabled="disabled">
							</div>
						</div>
					</div>
				</div>
				{{Form::close()}}
				<button  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#quizModal">Submit</button>
			</div>
		</div>
	</div>
@stop

@section('js')
<script type="text/javascript">
	$(function(){
		var quizL = "{{$no-1}}";
		$('input:radio').change(
			function(){
				$('#item_'+$(this).attr('id')).removeClass('list-group-item-danger').addClass('list-group-item-success');
				if ($(':radio:checked').length == quizL) {
        				$('#formSubmits').removeAttr("disabled");
    			}
			}
		);
	});
</script>
@stop