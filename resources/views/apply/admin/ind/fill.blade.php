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
        		<form action="/apply/admin/assess/{{ $cont->id}}" accept="form/multipart" method="post">
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
                   			<input type="text" autocomplete="off" class="form-control" value="{{$cont->applicant_type}}" readonly="readonly">
                   		</div>
                      <div class="col-3">
                        <label>Type of Business</label>
                        <input type="text" autocomplete="off" class="form-control" value="{{$cont->business_type}}" readonly="readonly">
                      </div>
                   		<div class="col-3">
                            <label>Monthly Income</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->monthly_income)}}" readonly="readonly">
                        </div>
                        <div class="col-3">
                            <label>Other Income Sources</label>
                            <textarea name="income_sources" class="form-control" readonly="readonly" autocomplete="off" placeholder="{{ $cont->income_sources }}" ></textarea>
                        </div>
                   	</div>
                   	<div class="row form-group">
                   		<div class="col-3">
                            <label>Monthly Income (other sources)</label>
                             <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->monthly_income_others)}}" readonly="readonly">
                        </div>
                        <div class="col-3">
                            <label>Total Monthly Income</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->total_monthly_income)}}" readonly="readonly">
                        </div>
                   	</div>
                   	<div class="row"><h4 class="title col-12 text-primary">Monthly Expenditures</h4></div>
                   	<div class="row form-group">
                        <div class="col-3">
                            <label>Feeding</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->food)}}" readonly="readonly">
                        </div>
                        <div class="col-3">
                            <label>Rent</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->rent)}}" readonly="readonly">
                        </div>
                        <div class="col-3">
                            <label>Medicals</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->medical)}}" readonly="readonly">
                        </div>
                        <div class="col-3">
                            <label>Electricity</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->electricity)}}" readonly="readonly">
                        </div>
                   	</div>
                   	<div class="row form-group">
                        <div class="col-2">
                            <label>School fees</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->school_fees)}}" readonly="readonly">
                        </div>
                        <div class="col-2">
                            <label>Leisure</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->leisure)}}" readonly="readonly">
                        </div>
                        <div class="col-2">
                            <label>Others</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->others)}}" readonly="readonly">
                        </div>
                        <div class="col-3">
                            <label>Total Monthly Expenditure</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->total_monthly_expense)}}" readonly="readonly">
                        </div>
                        <div class="col-3">
                            <label>Monthly Surplus (If Any)</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->monthly_surplus)}}" readonly="readonly">
                        </div>
                   	</div>
                   	<div class="row form-group">
                   		<h4 class="title col-12 text-primary">Loan status</h4>
                   	</div>
                   	<div class="row form-group">
                   		<div class="col-2">
                        <label>Every Borrowed Loan?</label>
                        @if($cont->borrowed_money == 0)
                        <input type="text" autocomplete="off" class="form-control" value="
                        {{ 'No'}}" readonly="readonly">
                        @else
                        <input type="text" autocomplete="off" class="form-control" value="
                        {{'Yes'}}" readonly="readonly">
                        @endif
                   		</div>
                   		<div class="col-2">
                            <label>From</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{$cont->start_date}}" readonly="readonly">
                        </div>
                        <div class="col-2">
                            <label>To</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{$cont->end_date}}" readonly="readonly">
                        </div>
                        <div class="col-2">
                            <label>Loan Amount borrowed</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->amount_borrowed)}}" readonly="readonly">
                        </div>
                        <div class="col-4">
                            <label>Lending Institution</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{$cont->money_lender}}" readonly="readonly">
                        </div>
                   	</div>
                   	<div class="row form-group">
                   		<div class="col-2">
                            <label>Loan duration (months)</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{$cont->loan_period_borrowed}}" readonly="readonly">
                        </div>
                        <div class="col-2">
                            <label>Monthly Instalment</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->monthly_instalment)}}" readonly="readonly">
                        </div>
                     		<div class="col-2">
                     			<label>Other personal loan?</label>
                     			@if($cont->other_personal_loan == 0)
                          <input type="text" autocomplete="off" class="form-control" value="
                          {{ 'No'}}" readonly="readonly">
                          @else
                          <input type="text" autocomplete="off" class="form-control" value="
                          {{'Yes'}}" readonly="readonly">
                          @endif
                     		</div>
                   		<div class="col-4">
                            <label>Lender of personal loan</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{$cont->money_lender_personal}}" readonly="readonly">
                        </div>
                        <div class="col-2">
                            <label>Amount Outstanding</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->amount_outstanding)}}" readonly="readonly">
                        </div>
                   	</div>
                   	<div class="row form-group"><h4 class="title col-12 text-primary">Personal Ventures</h4></div>
                   	<div class="row form-group">
                   		<div class="col-2">
                   			<label>Have running projects?</label>
                   			@if($cont->running_project == 0)
                          <input type="text" autocomplete="off" class="form-control" value="
                          {{ 'No'}}" readonly="readonly">
                          @else
                          <input type="text" autocomplete="off" class="form-control" value="
                          {{'Yes'}}" readonly="readonly">
                          @endif
                   		</div>
                   		<div class="col-4">
                            <label>Details of the running projects (if Yes)</label>
                            <textarea autocomplete="off" class="form-control" readonly="readonly" autocomplete="off" name="project_name">{{$cont->project_name}}</textarea>
                        </div>
                        <div class="col-3">
                            <label>Project budget</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->project_budget)}}" readonly="readonly">
                        </div>
                        <div class="col-3">
                            <label>Monthly project expense</label>
                            <input type="text" autocomplete="off" class="form-control" value="{{number_format($cont->monthly_project_expense)}}" readonly="readonly">
                        </div>
                   	</div>
                   	<div class="row form-group">
                      <h4 class="title col-11 text-primary">Collaterals / Security attachments</h4>
                    </div>
                    <?php $x = 1;?>
                    @foreach($security as $sec)
                      <div class="row form-group">
                        <div class="input-group col-8">
                          <div class="input-group-prepend">
                            <span class="input-group-text">{{$x }}</span>
                          </div>
                          <input type="text" autocomplete="off" class="form-control" value="{{$sec->security_name}}" readonly="readonly">
                        </div>
                        <div class="col-3">
                          <input type="text" autocomplete="off" class="form-control" value="{{ number_format($sec->security_value)}}" readonly="readonly">
                        </div>
                        <div class="input-group col-1">
                            <a href=""><button type="button" class="btn btn-outline-primary">View</button></a>
                       </div>
                      </div>
                    <?php $x++;?>
                    @endforeach

                    <div class="add_security"></div>
                   	<div class="row form-group"><h4 class="title col-12 text-primary">Guarantors</h4></div>
                    <?php $i = 1;?>
                    @foreach($guarantors as $gtr )
                      <div class="row form-group">
                        <div class="input-group col-5">
                          <div class="input-group-prepend">
                            <span class="input-group-text">{{ $i}}</span>
                          </div>
                          <input type="text" autocomplete="off" class="form-control" value="{{$gtr->guarantor_name}}" readonly="readonly">
                        </div>
                        <div class="col-4">
                          <input type="text" autocomplete="off" class="form-control" value="{{$gtr->guarantor_address}}" readonly="readonly">
                        </div>
                        <div class="col-3">
                          <input type="text" autocomplete="off" class="form-control" value="{{$gtr->guarantor_telephone}}" readonly="readonly">
                        </div>
                      </div>
                    <?php $i++;?>
                    @endforeach

                   	<div class="row form-group"><h4 class="title col-12 text-primary">Assessment by the Company</h4></div>
                   	<div class="row form-group">
                   		<div class="col-3">
                   			<label>Recommended loan amount</label>
                   			<input type="number" name="recommended_amount" class="form-control" required="required" autocomplete="off" placeholder="Recommended loan amount" value="{{$cont->proposed_amount}}">
                   		</div>
                      <div class="col-1">
                        <label>Rate(%)</label>
                        <input type="number" name="interest_rate" class="form-control" required="required" autocomplete="off" placeholder="Interest rate" value="{{ $cont->interest_rate}}">
                      </div>
                      <div class="col-2">
                        <label>Interest</label>
                        <input type="text" class="form-control" readonly="readonly" autocomplete="off" placeholder="Interest" value="{{ $cont->loan_interest}}">
                      </div>
                      <div class="col-2">
                        <label>Loan Period (Months)</label>
                        <input type="number" name="loan_period" class="form-control" required="required" autocomplete="off" value="{{ $cont->loan_period }}" placeholder="Loan Period">
                      </div>
                      <div class="col-2">
                        <label>Assessment comment</label>
                        <select class="form-control select2bs4" name="assessment_status" data-placeholder="Select" style="width: 100%;">
                                  <option value="1">Process loan</option>
                                  <option value="0">Cancel loan</option>
                            </select>
                      </div>
                      <div class="col-2">
                        <label>Assessment date</label>
                        <input type="date" name="assessment_date" class="form-control" required="required" autocomplete="off" placeholder="Assessment date">
                      </div>
                   	</div>
                   	<div class="row form-group">
                        <button class="btn btn-outline-primary ml-2">Save</button>
                    </div>
        		</form>
        	</div>
        </div>
      </div>
  </div>
</div>
@endsection