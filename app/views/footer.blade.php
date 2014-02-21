@section('footer')
	<div class="footer">
		<div class="copyright">
			<div class="container">
			<div class="row">
				<div class="col-md-3">
					<img src="{{asset('assets/image/telkom-university2.png')}}" alt="Telkom University">
				</div>
				<div class="col-md-6">
					<ul class="horizontal-menu clearfix">
						<li><a href="">About Us</a></li>
						<li><a href="">Teacher</a></li>
						<li><a href="">Contact</a></li>
						<li><a href="{{url('feedbacks/create')}}">Feedback</a></li>
					</ul>w 
					Language Center Online, provide Interactive online lectures from Telkom University Language Center.
				</div>
				<div class="col-md-3">
					<p class="text-right"><small>&copy; {{date('Y')}} Language Center,<br/> except where noted.<br/> All right reserved.</small></p>
				</div>
			</div>
			</div>
		</div>
	</div>
@show