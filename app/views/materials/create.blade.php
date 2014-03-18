@extends('layout')

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1 class="page-header">Register Course Material</h1>
				{{Form::open(array('url'=>url('materials'), 'method'=>'post', 'files'=>true))}}
				<div class="form-group"><label for="">Name</label><input type="text" name="name" class="form-control"></div>
				<div class="form-group"><label for="">Content</label><textarea name="content" class="form-control" id="" cols="30" rows="10"></textarea></div>
				<div class="form-group"><label for="">Video</label><input type="text" name="video" class="form-control" placeholder="http://www.youtube.com/watch?=xxxxxxxx"></div>
				<div class="form-group">
					{{Form::label('Do you have quiz for this material?')}}
					<div class="radio">{{Form::radio('quiz-init', '1', true)}} Yes </div>
					<div class="radio">{{Form::radio('quiz-init', '0')}} No </div>
					
				</div>
				<div id="quiz-input" class="form-group"><label for="">Quiz</label><input type="file" name="quiz" class="form-control"></div>

				<div class="form-group"><label for="">Course</label>
					{{Form::select('course', $courses, $selected, array('id'=>'course-select','class'=>'form-control'))}}
				</div>
				
				<div class="form-group"><input type="submit" value="Submit" class="btn btn-success btn-lg"></div>
				{{Form::close()}}
			</div>
			<div class="col-md-4">
			</div>
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript">
	$(document).ready(function(){
		/*getOrder($('#course-select').val());
		$('#course-select').click(function(){
			getOrder($('#course-select').val());
		})*/
	
		$("input[name='quiz-init']").click(function(){
			if ($("input[name='quiz-init']:checked").val() == '1') {
				$('#quiz-input').fadeIn();
			}else{
				$('#quiz-input').fadeOut();
			}
		})
	});
	function getOrder(idc) {
		var opsi = [];
		var linkurl = 'http://'+window.location.hostname+'/materials/orders/'+idc;
		$.ajax(
		{
			url: linkurl,
			dataType: 'json',
			success: function(data){
				var result = jQuery.parseJSON(data);
				$('#order-select').empty();
				for (var i = 0; i < result.length; i++) {
					var obj = result[i];
					var option = $("<option></option>").attr("value", obj.id).text(obj.id+" : "+obj.label);
					$('#order-select').append(option);
				};
			}
		});
	}
	</script>
@stop