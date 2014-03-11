<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>eLanguage Center @if(isset($pagetitle)) | {{$pagetitle}} @endif</title>
	@section('header')
		{{HTML::style(asset('assets/style.min.css'))}}
		{{HTML::style(asset('assets/vendor/alertifyjs/example/assets/js/lib/alertify/alertify.core.css'))}}
		{{HTML::style(asset('assets/vendor/alertifyjs/example/assets/js/lib/alertify/alertify.bootstrap.css'))}}
		{{HTML::script(asset('assets/vendor/jquery/jquery.min.js'))}}
	@show
	@yield('css')
</head>
<body>
	@include('header')
	<div class="main-wrapper">
		@yield('body')
	</div>
	@include('footer')
	{{HTML::script(asset('assets/script.min.js'))}}
	{{HTML::script(asset('assets/vendor/alertifyjs/example/assets/js/lib/alertify/alertify.min.js'))}}
	@yield('js')
	@if(Session::has('message'))
		<script type="text/javascript">
			alertify.success("{{Session::get('message')}}");
		</script>
	@endif
</body>
</html>