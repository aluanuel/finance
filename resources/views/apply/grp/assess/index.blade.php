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
        @include('layouts.flash')
      	<div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- Form Element sizes -->
            <div class="card card-default">
              <div class="card-header">
                <ul class="nav nav-pills" id="myTab">
                  <li class="nav-item"><a class="nav-link active" href="#fill_assess" data-toggle="tab">Fill Assessment</a></li>
                  <li class="nav-item"><a class="nav-link" href="#view_assess" data-toggle="tab">View Assessment Form</a></li>
                </ul>
                <!-- <h3 class="card-title">Different Height</h3> -->
              </div>
              <!-- card-body -->
              <div class="card-body">
                <!-- tab-content -->
                <div class="tab-content">
                  <div class="active tab-pane" id="fill_assess">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Loan Assessment Entry Form</h3>
                      </div>
                      <div class="card-body">
                        <form action="/apply/grp/assess/{{$cont->id}}" method="post">
                          @csrf
                          <div class="row form-group">
                            <div class="col-6">
                              <label>Applicant Name</label>
                              <input type="text" name="name"  autocomplete="off" class="form-control" placeholder="Name" required="required" value="{{$cont->name}}">  
                            </div>
                            <div class="col-2">
                              <label>Gender</label>
                              <select class="form-control select2bs4" name="gender" style="width: 100%;" required="required">
                                <option value="{{$cont->gender}}">{{$cont->gender}}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>  
                            </div>
                            <div class="col-2">
                              <label>Marital Status</label>
                              <select class="form-control select2bs4" name="marital_status" style="width: 100%;" required="required">
                                <option value="{{$cont->marital_status}}">{{$cont->marital_status}}</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                              </select> 
                            </div>
                            <div class="col-2">
                              <label>Telephone</label>
                              <input type="text" name="telephone"  autocomplete="off" class="form-control" placeholder="Telephone" required="required" value="{{$cont->telephone}}">  
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-3">
                                  <label>Profile Photo</label>
                                  <div class="custom-file">
                                      <input type="file" name="photo" class="form-control custom-file-input" id="exampleInputFile" required="required">
                                      <label class="custom-file-label" for="exampleInputFile">Upload Photo</label>
                                  </div>
                              </div>
                              <div class="col-3">
                                  <label>National ID Number (NIN)</label>
                                  <input type="text" autocomplete="off" class="form-control" name="nin" placeholder="National ID Number (NIN)" value="{{ old('nin')}}" required="required">
                              </div>
                              <div class="col-3">
                                  <label>Copy of National ID</label>
                                  <div class="custom-file">
                                      <input type="file" name="photo_national_id" class="form-control custom-file-input" id="exampleInputFile" required="required">
                                      <label class="custom-file-label" for="exampleInputFile">Upload</label>
                                  </div>
                              </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-3">
                              <label>Workplace</label>
                              <input type="text" name="work_place" autocomplete="off" class="form-control" placeholder="Workplace" value="{{ $cont->work_place }}" required="required">
                            </div>
                            <div class="col-3">
                              <label>Occupation</label>
                              <input type="text" name="occupation" autocomplete="off" class="form-control" placeholder="Occupation" value="{{ $cont->occupation }}" required="required">
                            </div>
                            <div class="col-3">
                              <label>District</label>
                              <input type="text" name="district" autocomplete="off" class="form-control" placeholder="District of work" value="{{ $cont->district }}" required="required">
                            </div>
                            <div class="col-3">
                              <label>Permanent Resident Village/Cell</label>
                              <input type="text" name="resident_village" autocomplete="off" class="form-control" placeholder="Village of residence" value="{{ $cont->resident_village}}" required="required">
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-3">
                              <label>Parish/Ward</label>
                              <input type="text" name="resident_parish" autocomplete="off" class="form-control" placeholder="Parish" value="{{ $cont->resident_parish }}" required="required">
                            </div>
                            <div class="col-3">
                              <label>Subcounty/Division</label>
                              <input type="text" name="resident_division" autocomplete="off" class="form-control" placeholder="Subcounty" value="{{ $cont->resident_division }}" required="required">
                            </div>
                            <div class="col-3">
                              <label>District of residence</label>
                              <input type="text" name="resident_district" autocomplete="off" class="form-control" placeholder="District of residence" value="{{ $cont->resident_district }}" required="required">
                            </div>
                            <div class="col-3">
                              <label>Household Head</label>
                              <input type="text" name="house_head" autocomplete="off" class="form-control" placeholder="Household Head" value="{{ $cont->house_head }}" required="required">
                            </div>
                          </div>
                          <div class="card-header">
                            <h3 class="card-title title col-11 text-primary text-uppercase">Description of family property</h3>
                            <button class="btn btn-outline-primary btn-sm ml-12" id="add_new_row_family" title="Add new row"><i class="fa fa-plus"></i></button>
                          </div>
                          <div class="row form-group mt-1">
                            <div class="input-group col-5">
                              <div class="input-group-prepend">
                                <span class="input-group-text">1</span>
                              </div>
                                <input type="text" class="form-control" name="security_name[]" placeholder="Property name" autocomplete="off" required="required">
                              </div>
                              <div class="col-3">
                                <input type="text" class="form-control" name="security_number[]" placeholder="Quantity" autocomplete="off" required="required">
                              </div>
                              <div class="col-3">
                                <input type="text" class="form-control" name="security_value[]" placeholder="Estimated value" autocomplete="off" required="required">
                              </div>
                              <!-- <div class="input-group col-3">
                                <div class="custom-file">
                                  <input type="file" name="security_attachment[]" required="required" class="form-control custom-file-input" id="exampleInputFile">
                                  <label class="custom-file-label" for="exampleInputFile">Upload attachment</label>
                                </div>
                              </div> -->
                          </div>
                          <div class="add_security_family"></div>
                          <div class="card-header">
                            <h3 class="card-title text-uppercase text-primary">loan applied for</h3>
                          </div>
                          <div class="row form-group">
                            <div class="col-2">
                              <label>Loan Number</label>
                              <input type="text" name="loan_number" autocomplete="off" class="form-control" readonly="readonly" value="{{ $cont->loan_number }}">
                            </div>
                            <div class="col-3">
                              <label>Loan Amount</label>
                              <input type="text" name="proposed_amount" autocomplete="off" class="form-control" placeholder="Loan amount to borrow" required="required" value="{{ old('proposed_amount') }}">
                            </div>
                            <div class="col-2">
                              <label>Loan Period (Weeks)</label>
                              <input type="number" name="loan_period" autocomplete="off" class="form-control" placeholder="Loan period" required="required" value="{{ old('loan_period')}}" min="1">
                            </div>
                            <div class="col-5">
                              <label>Purpose of the loan</label>
                              <textarea class="form-control" name="borrowing_purpose" placeholder="Purpose of borrowing" required="required">{{ old('borrowing_purpose') }}</textarea>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-3">
                              <label>Type of of the business</label>
                              <input type="text" name="business_type" autocomplete="off" class="form-control" placeholder="Type of business" required="required" value="{{ old('business_type') }}">
                            </div>
                            <div class="col-3">
                              <label>Principle owner of business</label>
                              <input type="text" name="business_owner" autocomplete="off" class="form-control" placeholder="Name of business owner" required="required" value="{{ old('business_owner') }}">
                            </div>
                            <div class="col-3">
                              <label>Location of the business</label>
                              <input type="text" name="business_location" autocomplete="off" class="form-control" placeholder="Location of the business" required="required" value="{{ old('business_location')}}">
                            </div>
                            <div class="col-3">
                              <label>Who will use the loan?</label>
                              <input type="text" name="loan_user" autocomplete="off" class="form-control" placeholder="Loan user" required="required" value="{{ old('loan_user') }}">
                            </div>
                            
                          </div>
                          <div class="row form-group">
                            <div class="col-3">
                              <label>Present Investment</label>
                              <input type="text" name="present_investment" autocomplete="off" class="form-control" placeholder="Present Investment" required="required" value="{{ old('present_investment') }}">
                            </div>
                            <div class="col-3">
                              <label>Present Profits</label>
                              <input type="text" name="present_profit" autocomplete="off" class="form-control" placeholder="Present Profit" required="required" value="{{ old('present_profit') }}">
                            </div>
                            <div class="col-3">
                              <label>Monthly Family Expenditure</label>
                              <input type="text" name="monthly_expenditure" autocomplete="off" class="form-control" placeholder="Family Expenditure" required="required" value="{{ old('monthly_expenditure') }}">
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-3">
                              <label>Source of Capital</label>
                              <textarea class="form-control" name="capital_source" placeholder="Enter sources of capital and separate them with comma (,)" required="required">{{ old('capital_source') }}</textarea>
                            </div>
                            <div class="col-3">
                              <label>Inventory that day</label>
                              <input type="text" name="present_inventory" autocomplete="off" class="form-control" placeholder="Inventory" required="required" value="{{ old('present_inventory') }}" >
                            </div>
                            <div class="col-3">
                              <label>Cash at hand that day</label>
                              <input type="text" name="cash_at_hand" autocomplete="off" class="form-control" placeholder="Cash at hand" required="required" value="{{ old('cash_at_hand')}}">
                            </div>
                            <div class="col-3">
                              <label>Fixed Assets</label>
                              <textarea class="form-control" name="fixed_assets" placeholder="Enter Fixed Assets and separate them with comma (,)" required="required">{{ old('fixed_assets') }}</textarea>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-3">
                              <label>Total sales in last 7 days</label>
                              <input type="text" name="sales_seven_days" autocomplete="off" class="form-control" placeholder="Sales in last 7 days" required="required" value="{{ old('sales_seven_days')}}">
                            </div>
                            <div class="col-3">
                              <label>Member's Residence</label>
                              <input type="text" name="member_location" autocomplete="off" class="form-control" placeholder="Member's residence" required="required" value="{{ old('member_location')}}">
                            </div>
                            <div class="col-3">
                              <label>Name of known person</label>
                              <input type="text" name="known_person_name" autocomplete="off" class="form-control" placeholder="Name of any person known in the community" required="required" value="{{ old('known_person_name')}}">
                            </div>
                            <div class="col-3">
                              <label>Telephone of known person</label>
                              <input type="text" name="known_person_telephone" autocomplete="off" class="form-control" placeholder="Telephone" required="required" value="{{ old('known_person_telephone')}}">
                            </div>
                          </div>
                          <div class="card-header">
                            <h6 class="card-title text-uppercase text-primary">witnesses</h6>
                          </div>
                          <div class="row form-group">
                            <div class="col-4">
                              <label>Name</label>
                              <input type="text" name="witness_name[]" autocomplete="off" class="form-control" placeholder="Name" required="required">
                            </div>
                            <div class="col-4">
                              <label>Relationship</label>
                              <input type="text" name="witness_relationship[]" autocomplete="off" class="form-control" placeholder="Relationship" required="required">
                            </div>
                            <div class="col-4">
                              <label>Date</label>
                              <input type="date" name="witness_on[]" autocomplete="off" class="form-control" placeholder="Date" required="required" min="01/01/2020">
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-4">
                              <label>Name</label>
                              <input type="text" name="witness_name[]" autocomplete="off" class="form-control" placeholder="Name" required="required">
                            </div>
                            <div class="col-4">
                              <label>Relationship</label>
                              <input type="text" name="witness_relationship[]" autocomplete="off" class="form-control" placeholder="Relationship" required="required">
                            </div>
                            <div class="col-4">
                              <label>Date</label>
                              <input type="date" name="witness_on[]" autocomplete="off" class="form-control" placeholder="Date" required="required" min="01/01/2020">
                            </div>
                          </div>
                          <div class="card-header">
                              <h6 class="card-title text-uppercase text-primary">guarantors</h6>
                          </div>
                          <div class="row form-group mt-1">
                            <div class="input-group col-5">
                              <div class="input-group-prepend">
                                <span class="input-group-text">1</span>
                              </div>
                              <input type="text" class="form-control" placeholder="Guarantor name" name="guarantor_name[]" autocomplete="off" required="required">
                            </div>
                            <div class="col-3">
                              <input type="text" name="guarantor_address[]" autocomplete="off" class="form-control" placeholder="Address" required="required">
                            </div>
                            <div class="col-2">
                              <input type="text" class="form-control" name="guarantor_telephone[]" autocomplete="off" placeholder="Telephone number" required="required" pattern="[0-9]{10}">
                            </div>
                            <div class="input-group col-2">
                                <div class="custom-file">
                                  <input type="file" name="guarantor_photo[]" required="required" class="form-control custom-file-input" id="exampleInputFile">
                                  <label class="custom-file-label" for="exampleInputFile">Guarantor Photo</label>
                                </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="input-group col-5">
                              <div class="input-group-prepend">
                                <span class="input-group-text">2</span>
                              </div>
                              <input type="text" class="form-control" placeholder="Guarantor name" name="guarantor_name[]" autocomplete="off" required="required">
                            </div>
                            <div class="col-3">
                              <input type="text" name="guarantor_address[]" autocomplete="off" class="form-control" placeholder="Address" required="required">
                            </div>
                            <div class="col-2">
                              <input type="text" class="form-control" name="guarantor_telephone[]" autocomplete="off" placeholder="Telephone number" required="required" pattern="[0-9]{10}">
                            </div>
                            <div class="input-group col-2">
                                <div class="custom-file">
                                  <input type="file" name="guarantor_photo[]" required="required" class="form-control custom-file-input" id="exampleInputFile">
                                  <label class="custom-file-label" for="exampleInputFile">Guarantor Photo</label>
                                </div>
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
                  <!-- tab-pane -->
                  <div class="tab-pane" id="view_assess">
                    <div class="card" id="printArea">
                      <div class="card-header">
                        <h3 class="card-title">Loan Assessment Form</h3>
                        <!-- card tools -->
                        <div class="card-tools">

                          <button class="btn btn-default btn-sm"><?php echo date('Y-m-d'); ?></button>
                          <button type="button" class="btn btn-primary btn-sm" title="Print form" onclick="printContent('printArea')">
                            <i class="fa fa-print"></i>
                           </button>
                        </div>
                         <!-- /.card-tools -->
                      </div>
                      <div class="card-body" >
                        <div class="col-12">
                          <h2 class="text-center text-uppercase">member admission form</h2>
                            <div class="post">
                              <h4>1. Personal Information</h4>
                              <div class="row">
                                <div class="col-3">
                                  <p>
                                  <i>Name:</i> {{$cont->name}}
                                  </p>
                                </div>
                                <div class="col-3">
                                  <p>
                                  <i> Gender:</i> {{$cont->gender}}
                                  </p>
                                </div>
                                <div class="col-3">
                                  <p>
                                  <i> Telephone:</i> {{$cont->telephone}}
                                  </p>
                                </div>
                                <div class="col-3">
                                  <p>
                                  <i> Status:</i> {{$cont->marital_status}}
                                  </p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-3">
                                  <p>
                                  <i> Date of Birth:</i> {{$cont->dob}}
                                  </p>
                                </div>
                                <div class="col-3">
                                  <p>
                                  <i> Occupation:</i> {{$cont->occupation}}
                                  </p>
                                </div>
                                <div class="col-3">
                                  <p>
                                  <i> Next of Kin:</i> {{$cont->next_of_kin}}
                                  </p>
                                </div>
                                <div class="col-3">
                                  <p>
                                  <i> Household Head:</i> {{$cont->house_head}}
                                  </p>
                                </div>
                              </div>
                               <h6 class="text-uppercase">residence</h6>
                              <div class="row">
                                <div class="col-3">
                                  <p>
                                    <i> Village:</i> {{$cont->resident_village}}
                                  </p>
                                </div>
                                <div class="col-3">
                                  <p>
                                    <i> Parish:</i> {{$cont->resident_parish}}
                                  </p>
                                </div>
                                <div class="col-3">
                                  <p>
                                    <i> Subcounty:</i> {{$cont->resident_division}}
                                  </p>
                                </div>
                                <div class="col-3">
                                  <p>
                                    <i> District:</i> {{$cont->resident_district}}
                                  </p>
                                </div>
                              </div>
                               <h6 class="text-uppercase">Group Information</h6>
                              <div class="row">
                                <div class="col-6">
                                  <p >
                                    <i>Group Name:</i> {{$cont->group_name}}
                                  </p>
                                </div>
                                <div class="col-3">
                                  <p >
                                    <i>Group Code:</i> {{$cont->group_code}}
                                  </p>
                                </div>
                              </div>
                              <h6 class="text-uppercase">Family Details</h6>
                              <p>Description of other properties in the family<br>
                               a) ..................................................................................................... Number ......................................................... Value .......................................................<br>
                               b) ..................................................................................................... Number ......................................................... Value .......................................................<br>
                               c) ..................................................................................................... Number ......................................................... Value .......................................................
                              </p>
                              <p>
                               i) Have the family got any loan (Yes/No)? ..........................
                              </p>
                              <p>
                               ii) If yes, how much was the loan? <br>
                               ....................................................................................................................................................................................................................................................
                              </p>
                              <p>
                               iii) From which institution? <br>
                               ....................................................................................................................................................................................................................................................
                              </p>
                              <h6 class="text-uppercase">Recommendation for membership</h6>
                              <p>
                               Recommended to join {{$cont->group_name}} loan group (Yes/No)? ..........................
                              </p>
                              <p>
                                Name of group leader ................................................................................................. Signature ............................................... Date ...................................
                              </p>
                            </div>
                            <div class="post">
                              <h4>For Official Use Only</h4>
                              <p>1. Recommendation by Credit Officer</p>
                              <p>
                                 i) Applicant was a group member for {{ config('app.name', 'Laravel') }} (Yes/No)? ...........................................................                                
                              </p>
                              <p>
                                 ii) If yes, did he / she receive a loan (Yes/No)? ...........................................................
                              </p>
                              <p>
                                 iii) If yes, did he / she repay installment regulary (Yes/No)? ...........................................................
                              </p>
                              <p>
                                iv) Cause of withdrawal of membership (comments) <br>
                                ....................................................................................................................................................................................................................................................<br>
                                ....................................................................................................................................................................................................................................................
                              </p>
                              <p>
                                Name of Credit Officer ................................................................................................. Signature ............................................... Date ...................................
                              </p>
                              <p>
                                2. Approved for Membership (Yes/No)? ...........................................................
                              </p>
                              <p>
                                Name of Branch Manager ........................................................................................... Signature ............................................... Date ...................................
                              </p>
                              <p>
                                 3. For re-admission in the group
                              </p>
                              <p>
                                Comments of credit officer <br>
                                ....................................................................................................................................................................................................................................................
                              </p>
                              <p>
                                Comments of branch manager <br>
                                ....................................................................................................................................................................................................................................................
                              </p>
                              <p>
                                Comments of area manager <br>
                                ....................................................................................................................................................................................................................................................
                              </p>
                              <h6 class="text-uppercase">to be completed by branch accounts officer</h6>
                              <p>
                                Deposit for membership (UGX ...........................................................
                              </p>
                              <p>
                                Membership number ...................................................................... Group code <strong style="margin-right: 150px; margin-left: 20px;">{{$cont->group_code}}</strong> Passbook Number ...................................
                              </p>
                              <p>
                                I hereby declare that I will follow all regulations and discipline of the organization and will not do such things or encourage others to do such which are against the interest of the institution
                              </p>
                              <p>
                                <i><strong>Signature/Thumb print</strong></i> ............................................................................................................................................. <i><strong>Date</strong></i>.......................................................
                              </p>
                            </div>
                          <h2 class="text-center text-uppercase">loan application</h2>
                          <div class="post">
                            <p>
                                 Proposed loan Amount (UGX) ...........................................................                                
                            </p>
                            <p>
                                Loan amount in words <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                Loan number e.g. 1<sup>st</sup>, 2<sup>nd</sup>, 3<sup>rd</sup> <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                Name of Applicant <strong class="pl-2">{{$cont->name}}</strong> <span class="pl-4">Signature ............................................... Date ...................................</span> 
                            </p>
                            <p>
                                Purpose of loan <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                Where is the business? <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                Who is the principle owner? <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                Who will use the loan? <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                Present investment in the business <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                Present profit of the business <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                Monthly repayment of loan <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                Monthly expenditure of the family <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <h6 class="text-uppercase">loan recommendation</h6>
                            <p>
                                Name of Credit Officer ................................................................................................. Signature ............................................... Date ...................................
                            </p>
                            <h6 class="text-uppercase">loan approval</h6>
                            <p>
                                Recommended Amount (UGX) ...........................................................                                
                            </p>
                            <p>
                                Loan amount in words <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                Comments <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                Name of Branch Manager ........................................................................................... Signature ............................................... Date ...................................
                            </p>
                          </div>
                          <h2 class="text-center text-uppercase">basic information sheet, of a prospective borrower</h2>
                          <div class="post">
                            <p>
                                1. Location & type of business <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                2. Sources of capital <br>
                                ....................................................................................................................................................................................................................................................<br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                3. Inventory on that day <br>
                                ....................................................................................................................................................................................................................................................<br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                4. Cash in hand that day <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                5. Fixed assets of business <br>
                                ....................................................................................................................................................................................................................................................<br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                6. Total sales in the last seven days <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                7. Location of member's residence <br>
                                ....................................................................................................................................................................................................................................................
                            </p>
                            <p>
                                8. Any locally renowned person who knows this member<br>

                                Name ...................................................................................... Telephone ................................... Signature ..................................... Date ............................
                            </p>
                            <p>
                                Signature of branch Manager ............................................................................................................................................................ Date .............................
                            </p>
                          </div>
                          <h2 class="text-center text-uppercase">promissory note</h2>
                          <div class="post">
                            <p>
                                I ............................................................................................................ father/mother/husband/wife ...................................................................................
                            </p>
                            <p>
                                Village .............................................................................................................. Parish ............................................................................................................
                            </p>
                            <p>
                                Subcounty ....................................................................... County ............................................................... District ..............................................................
                            </p>
                            <p>
                              1. I Declare that from the day of  ......................................., I will pay my whole borrowed money with {{ $interest->interest_rate}}% for ..................... weeks, instalment of UGX ..................................................... Total number of instalment will be ................................ and total amount  of UGX .................................................... will be paid within .................. weeks.
                            </p>
                            <p>
                              2. I will invest the loan money for income generating activities encouraged by {{ config('app.name', 'Laravel') }}. I will not spend the money in anything else. In case of losses, {{ config('app.name', 'Laravel') }} will not be responsible, I will pay my instalments in time.
                            </p>
                            <p>
                              3. In case I fail to pay my loan amount, {{ config('app.name', 'Laravel') }} can sell off my property with other group members anytime without first going to courts of law and can sue me in case of failure to realize the borrowed money with interest and extra charges. 
                            </p>
                            <p>
                              4. I promise to undertake my enterprise taking an account of the existing environment and send concerns including safe operations of machines compliance with current land regulations and rules, proper waste management.
                            </p>
                            <p>5. I understand the above conditions clearly and received the full loan amount and append my signature without any pressure from any body.</p>
                            <p>
                              Signature of borrower ................................................................................................................................. Date ...................................................................
                            </p>
                            <h6 class="text-uppercase">Witnesses</h6>
                            <p>
                              1. Signature ...................................... Name ....................................................................... Husband/Wife ................................ Date ...................................
                            </p>
                            <p>
                              2. Signature ...................................... Name ....................................................................... Husband/Wife ................................ Date ...................................
                            </p>
                            <h6 class="text-uppercase">Guarantors</h6>
                            <p>1<sup>st</sup> Guarantor</p>
                            <p>
                                Name .........................................................................................................................................................................................................................................<br>
                                Relationship ..............................................................................................................................................................................................................................<br>
                                Occupation ...............................................................................................................................................................................................................................<br>
                                Contact .....................................................................................................................................................................................................................................<br>
                                Signature ..................................................................................................................................................................................................................................<br>
                                Date ..........................................................................................................................................................................................................................................
                            </p>
                            <p>
                              Security of Guarantor <br>
                              1. ...............................................................................................................................................................................................................................................<br>
                              2. ...............................................................................................................................................................................................................................................<br>
                              3. ...............................................................................................................................................................................................................................................<br>
                              4. ...............................................................................................................................................................................................................................................
                            </p>
                            <p>2<sup>nd</sup> Guarantor</p>
                            <p>
                                Name .........................................................................................................................................................................................................................................<br>
                                Relationship ..............................................................................................................................................................................................................................<br>
                                Occupation ...............................................................................................................................................................................................................................<br>
                                Contact .....................................................................................................................................................................................................................................<br>
                                Signature ..................................................................................................................................................................................................................................<br>
                                Date ..........................................................................................................................................................................................................................................
                            </p>
                            <p>
                              Security of Guarantor <br>
                              1. ...............................................................................................................................................................................................................................................<br>
                              2. ...............................................................................................................................................................................................................................................<br>
                              3. ...............................................................................................................................................................................................................................................<br>
                              4. ...............................................................................................................................................................................................................................................
                            </p>
                          </div>
                          <h2 class="text-center text-uppercase">group resolution for lending money</h2>
                          <div class="post">
                            <p>
                              We the members of {{ $cont->group_name }} group, group code {{$cont->group_code}} have agreed to lend money in our group. We know him/her well as a permanent resident of our village. Money given for a period of ......................... months in ......................................... village who has a business in ................................................... market ................................................ village and his/her business is .......................................... we agreed by signing.
                            </p>
                            <table class="table">
                              <thead>
                                <tr>
                                  <th style="width: 20px;">S/NO</th>
                                  <th>MEMBER'S NAME</th>
                                  <th style="width: 200px;">MEMBERSHIP NUMBER</th>
                                  <th style="width: 250px;">CONTACT NUMBER</th>
                                  <th style="width: 100px;">SIGNATURE</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>3</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>4</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>5</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>6</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>7</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>8</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>9</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>10</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>11</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>12</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>13</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>14</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>15</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>16</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>17</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>18</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>19</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td>20</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- tab-pane -->
                </div>
                <!-- tab-content -->
              </div>
              <!-- card-body -->
            </div>
            <!-- card -->
          </div>
          <!-- col-12 -->
        </div>
      </div>
    </div>
    <!-- main-content -->
  </div>
  <!-- content-wrapper -->
  @endsection