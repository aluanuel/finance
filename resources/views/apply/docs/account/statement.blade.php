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
			padding-left: 30px;
			padding-right: 30px;
			padding-bottom: 10px;
		}
		td{
			padding-left: 30px;
			padding-right: 30px;
		}

	</style>
	<body>
		<div class="doc-header">
			<h4 style="text-align: center; text-transform: uppercase;" >Horizon Glory Investments Limited <br> <small> P.O BOX 112 <br> ARUA(U)</small></h4>
			<h4 style="text-align: center; text-transform: uppercase;">statement of accounts</h4>
			<p><span style="text-align: left;">Account name: {{$client->name}} </span><br><span >Account number: <strong>{{$client->account}}</strong></span>
				<br><span >Date & Time: <strong>{{date('Y-m-d h:i:s')}}</strong></span></p>
		</div>
		<div class="doc-body">
			<table>
				<thead>
					<tr>
						<th>DETAILS</th>
						<th>AMOUNT</th>
						<th>BALANCE</th>
						<th>DATE</th>
					</tr>
				</thead>
				<tbody>
					@foreach($savings as $sv)
						<tr>
							<td>{{ $sv->transaction_type }}</td>
							<td>{{ number_format($sv->amount_figures) }}</td>
							<td>{{ number_format($sv->savings_balance) }}</td>
							<td>{{ $sv->created_at }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="doc-footer">
			<p>Signature and stamp</p>
		</div>
	</body>
</html>