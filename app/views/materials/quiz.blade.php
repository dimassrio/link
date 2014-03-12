@extends('layout')

@section('body')
	<div class="container">
		<h1 class="page-header">{{$pagetitle}}</h1>
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<div class="input-group"><span class="input-group-addon">Number of Question</span>
						<input name="count" id="count" type="text" class="form-control"></div>
				</div>
				<div class="form-group">
					<div class="input-group"><span class="input-group-addon">Number of Option</span>
						<input name="opt" id="opt" type="text" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<button id="count-btn" class="btn btn-primary form-control">Insert</button>
				</div>
				<hr>
				{{Form::open(array('url'=>'quizbuilder', 'method'=>'post'))}}
				<div id="build-wrapper" class="input-build-wrapper">
				</div>

				<input type="submit" id="submit-btn" value="Submit" class="btn btn-primary btn-block">
				{{Form::close()}}
			</div>
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript">
	$(document).ready(function(){
		$('#submit-btn').hide();
		$('#count-btn').click(function(){

			var count = $('#count').val();
			var opt = $('#opt').val();
			var answerHtml = "<input type='hidden' name='count' value='"+count+"'>";
			answerHtml+= "<input type='hidden' name='opt' value='"+opt+"'>";
				for (var i = 0; i <count; i++) {
					answerHtml += 	"<div class='form-group'><div class='input-group'>"+
										"<span class='input-group-addon'>Question "+i+"</span>"+
											"<input type='text' name='el-"+i+"' class='form-control'>"+
									"</div><ul>";
					for (var j = 0; j < opt; j++) {
						answerHtml+="<li><div class='input-group'>"+
										"<span class='input-group-addon'>Option "+j+"</span>"+
										"<input type='text' name='op-"+i+"-"+j+"' class='form-control'>"+
									"</div>";
					};
					answerHtml+="<li><div class='input-group'>"+
							"<span class='input-group-addon'>Answer "+i+"</span>"+
								"<select name='ans-"+i+"' class='form-control'>";
					for (var k = 0; k<opt; k++) {
						answerHtml+= "<option value='"+k+"''>"+k+"</option>";
					}
					answerHtml += "</select></li></ul></div></div><hr/>";
					/*$("#build-wrapper").append("<div class='form-group'>");
					$("#build-wrapper").append(
							"<div class='input-group'>"+
								"<span class='input-group-addon'>Question "+i+"</span>"+
								"<input type='text' name='el-"+i+"' class='form-control'>"+
							"</div>"
					);
						for (var j = 0; j<opt; j++) {
							$("#build-wrapper").append(
								"<div class='input-group'>"+
									"<span class='input-group-addon'>Option "+j+"</span>"+
									"<input type='text' name='op-"+i+"-"+j+"' class='form-control'>"+
								"</div>"
							);
						};
					$("#build-wrapper").append(
						"<div class='input-group'>"+
							"<span class='input-group-addon'>Answer "+i+"</span>"+
								"<select name='ans-"+i+"' class='form-control'>");
								for (var k = 0; k<opt; k++) {
									$("#build-wrapper").append("<option value='"+k+">"+k+"</option>'");
								}
					$("#build-wrapper").append("</select></div>");
					$("#build-wrapper").append("</div>"); */
				};

				document.getElementById('build-wrapper').innerHTML = answerHtml;

				$('#submit-btn').show();
			}
		);
	});
	</script>
@stop