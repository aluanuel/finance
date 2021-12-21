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
					      <select class="form-control select2bs4" name="id_loan" style="width: 100%;" required="required" id="id_loan">
					      	@if(is_null($id_loan))
						      	@foreach($loans as $loan)
						      	<option></option>
						      	<option value="{{ $loan->id }}" label="{{ $loan->instalment }}">{{ $loan->loan_number.' > '.$loan->name }}</option>
						      	@endforeach
						    @else
						    	@foreach($loans as $loan)
						      	<option value="{{ $loan->id }}" label="{{ $loan->instalment }}">{{ $loan->loan_number.' > '.$loan->name }}</option>
						      	@endforeach
						    @endif
					      </select>
					    </div>
					</div>
				</div>
				<div class="row form-group">
					
				  	<div class="col-12">
				    	<label>Loan Instalment</label>
				    	<input type="text" autocomplete="off" class="form-control" id="loan_instalment" readonly="readonly">
					</div>
				 </div>
				<div class="row form-group">

				  	<div class="col-12">
				    	<label>Deposit Amount</label>
				    	<input type="text" name="deposit" autocomplete="off" class="form-control" placeholder="Deposit Amount" required="required" value="{{ old('deposit') }}">
					</div>
				 </div>
				 <div class="row form-group">

				  	<div class="col-12">
				    	<label>Deposit Date</label>
				    	<input type="date" name="created_at" autocomplete="off" class="form-control" placeholder="Deposit Date" required="required" value="{{ old('created_at') }}">
					</div>
				 </div>
				 <div class="row form-group">
				  	<div class="col-12">
				    	<label>Depositor</label>
				    	<input type="text" name="depositer" autocomplete="off" class="form-control" placeholder="Name of depositor" required="required" value="{{ old('depositer') }}">
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