	<div class="card">
	    <div class="card-header">
	        <h3 class="card-title">Loan Payment</h3>
	    </div>
	        <!-- /.card-header -->
	    <div class="card-body">
			<form action="/apply/teller/trans" method="post">
			     @csrf
				<div class="row form-group">
					<div class="col-12">
					    <label>Loan Number</label>
					    <div class="form-group">
					      <select class="form-control select2bs4" name="id_loan" style="width: 100%;" required="required">
					      	@if(is_null($id_loan))
						      	@foreach($loans as $loan)
						      	<option></option>
						      	<option value="{{ $loan->id }}">{{ $loan->loan_number }}</option>
						      	@endforeach
						    @else
						    	@foreach($loans as $loan)
						      	<option value="{{ $loan->id }}">{{ $loan->loan_number }}</option>
						      	@endforeach
						    @endif
					      </select>
					    </div>
					</div>
				</div>
				<div class="row form-group">
				  	<div class="col-12">
				    	<label>Deposit Amount</label>
				    	<input type="number" name="deposit" autocomplete="off" class="form-control" placeholder="Deposit Amount" required="required">
					</div>
				 </div>
				 <div class="row form-group">
				  	<div class="col-12">
				    	<label>Depositor</label>
				    	<input type="text" name="depositer" autocomplete="off" class="form-control" placeholder="Name of depositor" required="required">
					</div>
				 </div>
			  <input type="hidden" name="receipt_number" value="">
			  <div class="row form-group">
			    <button class="btn btn-primary ml-2">Submit</button>
			  </div>
			</form>
		</div>
		<!-- card body -->
	</div>