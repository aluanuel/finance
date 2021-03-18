<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<title>{{ config('app.name', 'Laravel') }}</title>
	</head>
	<style type="text/css">
		.doc-header p{
			/*margin-left: 80px;*/
			text-align: center;
		}
		.doc-body p{
			margin-left: 80px;
			margin-right: 30px;
		}
		.doc-footer p{
			padding-top: 50px;
			margin-left: 80px;
		}
		/*table{
			margin-left: 50px;
		}*/
		th{
			padding-left: 15px;
			padding-right: 15px;
			padding-bottom: 10px;
		}
		td{
			padding-left: 15px;
			padding-right: 15px;
		}

	</style>
	<body>
		<div class="doc-header">
			<h4 style="text-align: center; text-transform: uppercase;" >{{ config('app.name', 'Laravel') }} <br> <small> P.O BOX 112, ARUA(U)</small></h4>
			<h4 style="text-align: center; text-transform: uppercase;">list of accounts</h4>
			<p><span style="text-align: left;">Date & Time: <strong>{{date('Y-m-d h:i:s')}}</strong></span></p>
		</div>
		<div class="doc-body">
			<table>
				<thead>
					<tr style="text-transform: uppercase;">
						<th>#</th>
						<th>a/c number</th>
						<th>name</th>
						<th>gender</th>
						<th>telephone</th>
						<th>occupation</th>
						<th>created_at</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					@foreach($accounts as $ac)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $ac->account }}</td>
							<td>{{ $ac->name }}</td>
							<td>{{ $ac->gender }}</td>
							<td>{{ $ac->telephone }}</td>
							<td>{{ $ac->occupation }}</td>
							<td>{{ $ac->created_at }}</td>
						</tr>
						<?php $i++; ?>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="doc-footer">
			<p>Signature and stamp</p>
		</div>
	</body>
</html>