@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Group Loan Application</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Group</a></li>
              <li class="breadcrumb-item active">Loan Assessment</li>
            </ol>
          </div>
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      	<div class="row">
          <!-- right column -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Loan Assessment Entry Form</h3>
              </div>
              <div class="card-body">
                        <form action="/apply/admin/grp/assess/{{$cont->id}}" method="post">
                          @csrf
                          <div class="row form-group">
                            <div class="col-6">
                              <label>Applicant Name</label>
                              <input type="text"  autocomplete="off" class="form-control" placeholder="Name" value="{{$cont->name}}" readonly="readonly">  
                            </div>
                            <div class="col-2">
                              <label>Gender</label>
                              <input type="text"  autocomplete="off" class="form-control" placeholder="Name" value="{{$cont->gender}}" readonly="readonly"> 
                            </div>
                            <div class="col-2">
                              <label>Marital Status</label>
                              <input type="text"  autocomplete="off" class="form-control" value="{{$cont->marital_status}}" readonly="readonly">  
                            </div>
                            <div class="col-2">
                              <label>Telephone</label>
                              <input type="text"  autocomplete="off" class="form-control" value="{{$cont->telephone}}" readonly="readonly">  
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-3">
                              <label>Profile Photo</label><br>
                              <a class="btn btn-outline-primary btn-sm" href="#">View Attachment</a>  
                            </div>
                            <div class="col-3">
                              <label>National ID Number(NIN)</label>
                              <input type="text"  autocomplete="off" class="form-control" placeholder="Name" value="{{$cont->nin}}" readonly="readonly"> 
                            </div>
                            <div class="col-3">
                              <label>Photo National ID</label><br>
                              <a class="btn btn-outline-primary btn-sm" href="#">View Attachment</a>  
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-3">
                              <label>Workplace</label>
                              <input type="text"  autocomplete="off" class="form-control" value="{{$cont->work_place}}" readonly="readonly"> 
                            </div>
                            <div class="col-3">
                              <label>Occupation</label>
                              <input type="text"  autocomplete="off" class="form-control" value="{{$cont->occupation}}" readonly="readonly"> 
                            </div>
                            <div class="col-3">
                              <label>District</label>
                              <input type="text"  autocomplete="off" class="form-control" value="{{$cont->district}}" readonly="readonly"> 
                            </div>
                            <div class="col-3">
                              <label>Permanent Resident Village/Cell</label>
                              <input type="text"  autocomplete="off" class="form-control" value="{{$cont->resident_village}}" readonly="readonly"> 
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-3">
                              <label>Parish/Ward</label>
                              <input type="text"  autocomplete="off" class="form-control" value="{{$cont->resident_parish}}" readonly="readonly"> 
                            </div>
                            <div class="col-3">
                              <label>Subcounty/Division</label>
                              <input type="text"  autocomplete="off" class="form-control" value="{{$cont->resident_division}}" readonly="readonly">
                            </div>
                            <div class="col-3">
                              <label>District of residence</label>
                              <input type="text"  autocomplete="off" class="form-control" value="{{$cont->resident_district}}" readonly="readonly">
                            </div>
                            <div class="col-3">
                              <label>Household Head</label>
                             <input type="text"  autocomplete="off" class="form-control" value="{{$cont->house_head}}" readonly="readonly"> 
                            </div>
                          </div>
                          <div class="card-header mb-2">
                            <h3 class="card-title title col-11 text-primary text-uppercase">Description of family property</h3>
                          </div>
                          <?php $i = 1;?>
                          @foreach($security as $sec)
                          <div class="row form-group">
                            <div class="input-group col-6">
                              <div class="input-group-prepend">
                                <span class="input-group-text">{{ $i }}</span>
                              </div>
                                <input type="text" class="form-control" value="{{$sec->security_name}}" readonly="readonly">
                              </div>
                              <div class="col-3">
                                <input type="text" class="form-control" value="{{$sec->security_number}}" readonly="readonly">
                              </div>
                              <div class="col-3">
                                <input type="text" class="form-control" value="{{ number_format($sec->security_value)}}" readonly="readonly">
                              </div>
                              <!-- <div class="input-group col-2">
                                <a href="#" class="btn btn-outline-primary">View attachment</a>
                              </div> -->
                          </div>
                          <?php $i++;?>
                          @endforeach
                          <div class="card-header">
                            <h3 class="card-title text-uppercase text-primary">loan applied for</h3>
                          </div>
                          <div class="row form-group">
                            <div class="col-2">
                              <label>Loan Number</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ $cont->loan_number }}">
                            </div>
                            <div class="col-3">
                              <label>Loan Amount</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ number_format($cont->proposed_amount) }}">
                            </div>
                            <div class="col-2">
                              <label>Loan Period (Weeks)</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ $cont->loan_period }}">
                            </div>
                            <div class="col-5">
                              <label>Purpose of the loan</label>
                              <textarea class="form-control" name="borrowing_purpose" placeholder="Purpose of borrowing" disabled="disabled">{{ $cont->borrowing_purpose }}</textarea>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-3">
                              <label>Type of of the business</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ $cont->business_type }}">
                            </div>
                            <div class="col-3">
                              <label>Principle owner of business</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ $cont->business_owner }}">
                            </div>
                            <div class="col-3">
                              <label>Location of the business</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ $cont->business_location }}">                            </div>
                            <div class="col-3">
                              <label>Who will use the loan?</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ $cont->loan_user }}">
                            </div>
                            
                          </div>
                          <div class="row form-group">
                            <div class="col-3">
                              <label>Present Investment</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ number_format($cont->present_investment) }}">
                            </div>
                            <div class="col-3">
                              <label>Present Profits</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ number_format($cont->present_profit) }}">
                            </div>
                            <div class="col-3">
                              <label>Monthly Family Expenditure</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ number_format($cont->monthly_expenditure) }}">
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-3">
                              <label>Source of Capital</label>

                              <textarea class="form-control" name="capital_source" readonly="readonly">{{ $cont->capital_source}}</textarea>
                            </div>
                            <div class="col-3">
                              <label>Inventory that day</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ number_format($cont->present_inventory) }}">
                            </div>
                            <div class="col-3">
                              <label>Cash at hand that day</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ number_format($cont->cash_at_hand) }}">
                            </div>
                            <div class="col-3">
                              <label>Fixed Assets</label>
                              <textarea class="form-control" name="fixed_assets" readonly="readonly">{{ $cont->fixed_assets}}</textarea>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-3">
                              <label>Total sales in last 7 days</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ number_format($cont->sales_seven_days) }}">
                            </div>
                            <div class="col-3">
                              <label>Member's Residence</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ $cont->member_location }}">
                            </div>
                            <div class="col-3">
                              <label>Name of known person</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ $cont->known_person_name }}">
                            </div>
                            <div class="col-3">
                              <label>Telephone of known person</label>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ $cont->known_person_telephone }}">
                            </div>
                          </div>
                          <div class="card-header mb-2">
                            <h6 class="card-title text-uppercase text-primary">witnesses</h6>
                          </div>
                          <div class="row form-group">
                            <div class="col-4">
                              <label>Name</label>
                            </div>
                            <div class="col-4">
                              <label>Relationship</label>
                            </div>
                            <div class="col-4">
                              <label>Date</label>
                            </div>
                          </div>

                          @foreach($witnesses as $witness)
                          <div class="row form-group">
                            <div class="col-4">
                              <input type="text" autocomplete="off" class="form-control" placeholder="Name" value="{{ $witness->witness_name}}" readonly="readonly">
                            </div>
                            <div class="col-4">
                              <input type="text" autocomplete="off" class="form-control" placeholder="Relationship" value="{{ $witness->witness_relationship }}" readonly="readonly">
                            </div>
                            <div class="col-4">
                              <input type="text" autocomplete="off" class="form-control" placeholder="Date" value="{{ $witness->witness_on}}" readonly="readonly">
                            </div>
                          </div>
                          @endforeach
                          <div class="card-header mb-2">
                              <h6 class="card-title text-uppercase text-primary">guarantors</h6>
                          </div>
                          <?php $i = 1;?>
                          @foreach($guarantors as $guarantor)
                          <div class="row form-group">
                            <div class="input-group col-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text">{{ $i}}</span>
                              </div>
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ $guarantor->guarantor_name }}">
                            </div>
                            <div class="col-3">
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ $guarantor->guarantor_address }}">
                            </div>
                            <div class="col-3">
                              <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="{{ $guarantor->guarantor_telephone }}">
                            </div>
                            <div class="col-2">
                              <a href="#" class="btn btn-outline-primary">View Photo</a>
                            </div>
                          </div>
                          <?php $i++; ?>
                          @endforeach
                          <div class="card-header mb-2">
                              <h6 class="card-title text-uppercase text-primary">Assessment by the company</h6>
                          </div>
                          <div class="row form-group">
                            <div class="col-3">
                              <label>Recommended loan amount</label>
                              <input type="text" name="recommended_amount" class="form-control" id="recommended_amount" required="required" autocomplete="off" placeholder="Recommended loan amount" value="{{ number_format($cont->proposed_amount) }}">
                            </div>
                            <div class="col-1">
                              <label>Rate(%)</label>
                              <input type="number" name="interest_rate" id="interest_rate" class="form-control" required="required" autocomplete="off" placeholder="Interest rate" value="{{ $cont->interest_rate}}">
                            </div>
                            <div class="col-2">
                              <label>Interest</label>
                              <input type="text" id="loan_interest" class="form-control" readonly="readonly" autocomplete="off" placeholder="Interest on loan">
                            </div>
                            <div class="col-2">
                              <label>Loan Period (Weeks)</label>
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
                          <div class="row form-group" id="invoke_auth">
                            <button class="btn btn-outline-primary ml-2" id="btn_invoke_auth">Save</button>
                          </div>
                          <div class="row form-group col-3" id="auth_user">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required="required" placeholder="Type your password">
                          </div>
                          <div class="row form-group" id="submit_input">
                            <button class="btn btn-primary ml-2">Continue</button>
                          </div>
                        </form>
                      </div>
                      <!-- card-body -->
                    </div>
                    <!-- card -->
          </div>
        </div>
      </div>
    </div>
    <!-- content -->
  </div>
@endsection