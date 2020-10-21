<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<title>{{ config('app.name', 'Laravel') }}</title>
	</head>
	<style type="text/css">
		.doc-body p{
			margin-left: 50px;
			margin-right: 30px;
		}
		.doc-footer p{
			padding-top: 50px;
			margin-left: 50px;
		}
	</style>
	<body>
		<div class="doc-header">
			<h4 style="text-align: center; text-transform: uppercase;" >Horizon Glory Investments Limited <br> <small> P.O BOX 112 <br> ARUA(U)</small></h4>
			<h4 style="text-align: center; text-transform: uppercase;">INSTALMENT COLLECTION RECEIPT</h4>

			@foreach($data as $loan)
			<p style="margin-left: 50px; margin-right: 30px;"><span style="text-align: left; padding-right: 350px;">DATE {{date('Y-m-d',strtotime($loan->created_at))}} </span><span style="text-align: right;">TICKET: <strong>{{$loan->receipt_number}}</strong></span></p>
		</div>
		<div class="doc-body">
			<p>Received with thanks from {{$loan->depositer}}</p>
			<p>The sum of shillings two millions only</p>
			<p>Being payment of Loan Instalment Payment - {{$loan->loan_number}}</p>
		</div>
		@endforeach
		<div class="doc-footer">
			<p>Signature and stamp</p>
		</div>
	</body>
</html>