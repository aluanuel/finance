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
		table{
			margin-left: 50px;
		}
		th{
			padding-left: 40px;
			padding-right: 40px;
			padding-bottom: 10px;
		}
		td{
			padding-left: 40px;
			padding-right: 40px;
		}

	</style>
	<body>
		<div class="doc-header">
			<h4 style="text-align: center; text-transform: uppercase;" >{{ config('app.name', 'Laravel') }} <br> <small> P.O BOX 112, ARUA(U)</small></h4>
			<h4 style="text-align: center; text-transform: uppercase;">Incomes report</h4>
			<p><span style="text-align: left;">Date & Time: <strong>{{date('Y-m-d h:i:s')}}</strong></span></p>
		</div>
		<div class="doc-body">
			<table>
				<thead>
					<tr style="text-transform: uppercase;">
						<th style="padding-right: 5px;">#</th>
						<th style="padding-right: 90px;">details</th>
						<th>amount</th>
						<th>date</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					@foreach($income as $in)
						<tr>
							<td style="padding-right: 5px;">{{ $i }}</td>
							<td style="padding-right: 100px;">{{ $in->payment_name }}</td>
							<td>{{ number_format($in->payment_amount) }}</td>
							<td>{{ $in->created_at }}</td>
						</tr>
						<?php $i++; ?>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- <div class="doc-footer">
			<p>Signature and stamp</p>
		</div> -->
	</body>
</html>