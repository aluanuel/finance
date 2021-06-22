@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      	<div class="card">
          	<div class="card-header">
            	<h3 class="card-title">Loan Assessment Form</h3>
        	</div>
        	<div class="card-body">
        		<form action="/apply/assess/{{ $cont->id}}" accept="form/multipart" method="post">
        			@csrf
              <input type="hidden" name="id_client" value="{{ $cont->id_client }}">
        			<div class="row form-group">
                        <div class="col-3">
                            <label>Loan Number</label>
                            <input type="text" autocomplete="off" class="form-control" placeholder="Loan Number" value="{{ $cont->loan_number }}" readonly="readonly">
                        </div>
                        <div class="col-3">
                            <label>Loan Amount Requested</label>
                            <input type="text" autocomplete="off" class="form-control" placeholder="Loan Amount Requested" value="{{number_format($cont->proposed_amount) }}" readonly="readonly" >
                        </div>
                        <div class="col-3">
                            <label>Applicant Name</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{$cont->name}}" placeholder="Name" readonly="readonly" >
                        </div>
                        <div class="col-3">
                            <label>Telephone</label>
                            <input type="text" autocomplete="off" class="form-control" placeholder="Telephone" value="{{$cont->telephone}}" readonly="readonly">
                        </div>
                   	</div>
                   	<div class="row"><h4 class="title col-12 text-primary">Monthly Incomes</h4></div>
                   	<div class="row form-group">
                   		<div class="col-3">
                   			<label>Type of Applicant</label>
                   			<select class="form-control select2bs4" name="applicant_type" style="width: 100%;" id="applicant_type" required="required">
                          <option>{{ old('applicant_type') }}</option>
                          <option>Civil servant</option>
                          <option>Business person</option>
                          <option>Salaried person</option>
                        </select>
                   		</div>
                   		<div class="col-3">
                            <label>Monthly Income</label>
                            <input type="number" name="monthly_income" autocomplete="off" class="form-control" placeholder="Monthly Income" required="required" value="{{ old('monthly_income')}}">
                        </div>
                        <div class="col-6">
                            <label>Other Income Sources</label>
                            <textarea name="income_sources" class="form-control" placeholder="List sources, separate each source with a comma(,)" autocomplete="off"></textarea>
                        </div>
                   	</div>
                    <div class="row form-group" id="business_type">
                          <div class="col-12">
                            <input type="text" class="form-control" name="business_type" placeholder="Type of business" autocomplete="off" value="{{ old('business_type')}}">
                          </div>
                        </div>
                   	<div class="row form-group">
                   		<div class="col-3">
                            <label>Monthly Income (other sources)</label>
                            <input type="number" name="monthly_income_others" autocomplete="off" class="form-control" placeholder="Monthly Income" required="required">
                        </div>
                        <div class="col-3">
                            <label>Total Monthly Income</label>
                            <input type="number" name="total_monthly_income" autocomplete="off" class="form-control" placeholder="Monthly Income" required="required">
                        </div>
                   	</div>
                   	<div class="row"><h4 class="title col-12 text-primary">Monthly Expenditures</h4></div>
                   	<div class="row form-group">
                        <div class="col-3">
                            <label>Feeding</label>
                            <input type="number" autocomplete="off" class="form-control" name="food" placeholder="Feeding" required="required">
                        </div>
                        <div class="col-3">
                            <label>Rent</label>
                            <input type="number" autocomplete="off" name="rent" class="form-control" placeholder="Rent" required="required" >
                        </div>
                        <div class="col-3">
                            <label>Medicals</label>
                            <input type="number" autocomplete="off" class="form-control" name="medical" placeholder="Medicals" required="required">
                        </div>
                        <div class="col-3">
                            <label>Electricity</label>
                            <input type="number" autocomplete="off" class="form-control" placeholder="Electricity" name="electricity" required="required" >
                        </div>
                   	</div>
                   	<div class="row form-group">
                        <div class="col-3">
                            <label>School fees</label>
                            <input type="number" autocomplete="off" class="form-control" name="school_fees" placeholder="School fees" required="required" value="{{ old('school_fees')}}">
                        </div>
                        <div class="col-3">
                            <label>Leisure</label>
                            <input type="number" autocomplete="off" name="leisure" class="form-control" placeholder="Leisure" required="required" value="{{ old('leisure') }}" >
                        </div>
                        <div class="col-3">
                            <label>Others</label>
                            <input type="number" autocomplete="off" class="form-control" name="others" placeholder="Others" required="required" value="{{ old('others')}}">
                        </div>
                        <div class="col-3">
                            <label>Total Monthly Expenditure</label>
                            <input type="number" autocomplete="off" class="form-control" placeholder="Total Monthly Expenditure" name="total_monthly_expense" required="required" value="{{ old('total_monthly_expense') }}" >
                        </div>
                   	</div>
                   	<div class="row form-group">
                   		<h4 class="title col-12 text-primary">Loan status</h4>
                   	</div>
                   	<div class="row form-group">
                   		<div class="col-2">
                   			<label>Every Borrowed Loan?</label>
                   			<select class="form-control select2bs4" name="borrowed_money" data-placeholder="Select" style="width: 100%;" required="required">
                                  <option>{{ old('borrowed_money')}}</option>
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                            </select>
                   		</div>
                   		<div class="col-2">
                            <label>From</label>
                            <input type="date" autocomplete="off" class="form-control" placeholder="Start of the loan" name="start_date">
                        </div>
                        <div class="col-2">
                            <label>To</label>
                            <input type="date" autocomplete="off" class="form-control" placeholder="End of the loan" name="end_date">
                        </div>
                        <div class="col-2">
                            <label>Amount borrowed</label>
                            <input type="number" autocomplete="off" class="form-control" placeholder="Loan Amount" name="amount_borrowed">
                        </div>
                        <div class="col-4">
                            <label>Lending Institution</label>
                            <input type="text" autocomplete="off" class="form-control" placeholder="Name of Lending Institution" name="money_lender">
                        </div>
                   	</div>
                   	<div class="row form-group">
                   		<div class="col-2">
                            <label>Loan period (months)</label>
                            <input type="number" autocomplete="off" class="form-control" placeholder="Duration of the loan" name="loan_period_borrowed">
                        </div>
                        <div class="col-2">
                            <label>Monthly Instalment</label>
                            <input type="number" autocomplete="off" class="form-control" placeholder="Monthly Instalment" name="monthly_instalment">
                        </div>
                   		<div class="col-2">
                   			<label>Other personal loan?</label>
                   			<select class="form-control select2bs4" name="other_personal_loan" data-placeholder="Select" style="width: 100%;" required="required">
                                  <option></option>
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                            </select>
                   		</div>
                   		<div class="col-4">
                            <label>Lender of personal loan</label>
                            <input type="text" autocomplete="off" class="form-control" placeholder="Lender of personal loan" name="money_lender_personal">
                        </div>
                        <div class="col-2">
                            <label>Amount Outstanding</label>
                            <input type="number" autocomplete="off" class="form-control" placeholder="Amount Outstanding" name="amount_outstanding">
                        </div>
                   	</div>
                   	<div class="row form-group"><h4 class="title col-12 text-primary">Personal Ventures</h4></div>
                   	<div class="row form-group">
                   		<div class="col-2">
                   			<label>Have running projects?</label>
                   			<select class="form-control select2bs4" name="running_project" data-placeholder="Select" style="width: 100%;" required="required">
                                  <option></option>
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                            </select>
                   		</div>
                   		<div class="col-4">
                            <label>Details of the running projects (if Yes)</label>
                            <textarea autocomplete="off" class="form-control" placeholder="Details of the running projects" autocomplete="off" name="project_name"></textarea>
                        </div>
                        <div class="col-3">
                            <label>Project budget</label>
                            <input type="number" autocomplete="off" class="form-control" placeholder="Project budget" name="project_budget">
                        </div>
                        <div class="col-3">
                            <label>Monthly project expense</label>
                            <input type="number" autocomplete="off" class="form-control" placeholder="Monthly project expense" name="monthly_project_expense">
                        </div>
                   	</div>
                   	<div class="row form-group">
                      <h4 class="title col-11 text-primary">Collaterals / Security attachments</h4>
                      <button class="btn btn-outline-primary btn-sm ml-12" id="add_new_row" title="Add new row"><i class="fa fa-plus"></i></button>
                    </div>
                   	<div class="row form-group">
  						        <div class="input-group col-6">
  		                  <div class="input-group-prepend">
  		                    <span class="input-group-text">1</span>
  		                  </div>
  		                  <input type="text" class="form-control" name="security_name[]" placeholder="Security name" autocomplete="off">
  		                  </div>
  		                  <div class="col-3">
  		                	<input type="text" class="form-control" name="security_value[]" placeholder="Estimated security value" autocomplete="off">
  		                  </div>
  		                  <div class="input-group col-3">
  	                      <div class="custom-file">
  	                        <input type="file" name="security_attachment[]" class="form-control custom-file-input" id="exampleInputFile" required="required">
  	                        <label class="custom-file-label" for="exampleInputFile">Upload security</label>
  	                      </div>
  	                    </div>
                   	</div>
                    <div class="add_security"></div>
                   	<div class="row form-group"><h4 class="title col-12 text-primary">Guarantors</h4></div>
                   	<div class="row form-group">
  						        <div class="input-group col-5">
  		                  <div class="input-group-prepend">
  		                    <span class="input-group-text">1</span>
  		                  </div>
  		                  <input type="text" class="form-control" placeholder="Guarantor name" name="guarantor_name[]" autocomplete="off" required="required">
  		                </div>
  		                <div class="col-4">
  		                	<input type="text" name="guarantor_address[]" autocomplete="off" class="form-control" placeholder="Address" required="required">
  		                </div>
  		                <div class="col-3">
  		                	<input type="text" class="form-control" name="guarantor_telephone[]" autocomplete="off" placeholder="Telephone number" required="required">
  		                </div>
                   	</div>
                   	<div class="row form-group">
  						        <div class="input-group col-5">
  		                  <div class="input-group-prepend">
  		                    <span class="input-group-text">2</span>
  		                  </div>
  		                  <input type="text" class="form-control" placeholder="Guarantor name" name="guarantor_name[]" autocomplete="off" required="required">
  		                </div>
  		                <div class="col-4">
  		                	<input type="text" name="guarantor_address[]" autocomplete="off" class="form-control" placeholder="Address" required="required">
  		                </div>
  		                <div class="col-3">
  		                	<input type="text" class="form-control" name="guarantor_telephone[]" autocomplete="off" placeholder="Telephone number" required="required">
		                  </div>
                   	</div>
                   	<div class="row form-group">
  						        <div class="input-group col-5">
  		                  <div class="input-group-prepend">
  		                    <span class="input-group-text">3</span>
  		                  </div>
  		                  <input type="text" class="form-control" placeholder="Guarantor name" name="guarantor_name[]" autocomplete="off" required="required">
  		                </div>
  		                <div class="col-4">
  		                	<input type="text" name="guarantor_address[]" class="form-control" placeholder="Address" required="required" autocomplete="off">
  		                </div>
  		                <div class="col-3">
  		                	<input type="text" class="form-control" name="guarantor_telephone[]" autocomplete="off" placeholder="Telephone number" required="required">
  		                </div>
                   	</div>
                   	<div class="row form-group" id="invoke_auth">
                        <button class="btn btn-outline-primary ml-2" id="btn_invoke_auth">Save</button>
                    </div>
                    <div class="row form-group" id="auth_user">
                        <div class="col-4">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required="required" placeholder="Type your password">
                        </div>
                    </div>
                    <div class="row form-group" id="submit_input">
                        <button class="btn btn-primary ml-2">Continue to save</button>
                    </div>
        		</form>
        	</div>
        </div>
      </div>
  </div>
</div>
@endsection