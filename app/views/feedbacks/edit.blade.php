@extends('layout')

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
  <li><a href="#profile" data-toggle="tab">Profile</a></li>
  <li><a href="#messages" data-toggle="tab">Messages</a></li>
  <li><a href="#settings" data-toggle="tab">Settings</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="home">1</div>
  <div class="tab-pane" id="profile">2</div>
  <div class="tab-pane" id="messages">3</div>
  <div class="tab-pane" id="settings">4</div>
</div>
			</div>
		</div>
	</div>
@stop