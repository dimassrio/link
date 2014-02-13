<html>
<head>
	<link type="text/css" rel="stylesheet" href="assets/pdf.css">
</head>
<body>
	<img src="assets/image/telkom-university.png" alt=""><h1 class="inline">Result of Course {{$courses['name']}}</h1>
	<hr>
	<table class="table">
		<tr>
			<td>Name</td>
			<td>:</td>
			<td colspan="3">{{$user['realname']}}</td>
		</tr>
		<tr>
			<td>NIM</td>
			<td>:</td>
			<td>{{$user['nim']}}</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td>{{$user['email']}}</td>
		</tr>
	</table>
	<hr>
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
</body>
</html>