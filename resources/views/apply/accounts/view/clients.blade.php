@extends('layouts.custom')

@section('content')
	  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Client Accounts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Client Accounts</li>
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
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Showing Client Accounts</h3>
                  <div class="card-tools">
                    <a href="" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#new-account">NEW CLIENT</a>
                  </div>
                </div>
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>a/c number</th>
                        <th>a/c name</th>
                        <th>gender</th>
                        <th>telephone</th>
                        <th>occupation</th>
                        <th>account_status</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $x =1;?>
                      @foreach($accounts as $ac)
                      <tr>
                        <td><a href="/apply/account/profile/{{$ac->id}}">{{$x}}</a></td>
                        <td><a href="/apply/account/profile/{{$ac->id}}">{{ $ac->account_number }}</a></td>
                        <td><a href="/apply/account/profile/{{$ac->id}}">{{ $ac->name }}</a></td>
                        <td><a href="/apply/account/profile/{{$ac->id}}">{{ $ac->gender }}</a></td>
                        <td><a href="/apply/account/profile/{{$ac->id}}">{{ $ac->telephone }}</a></td>
                        <td><a href="/apply/account/profile/{{$ac->id}}">{{ $ac->occupation }}</a></td>
                        @switch($ac->account_status)
                          @case(0)
                          <td class="text-danger">Inactive</td>
                          <td></td>
                          @break
                          @case(1)
                          <td class="text-primary">Active</td>
                          <td><a href="" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#groupLoanApplication{{$ac->id}}">New Loan</a></td>
                            <div class="modal fade" id="groupLoanApplication{{$ac->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h6 class="modal-title justify-content-center text-uppercase" id="exampleModalLongTitle">new loan application</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="/apply/grp/{{$ac->id}}" method="POST">
                                      @csrf
                                      <div class="row form-group">
                                        <div class="col-md-4">
                                          <div class="card">
                                            <div class="card-body box-profile">
                                                  <div class="text-center">
                                                    <img class="profile-user-img img-fluid img-circle"
                                                         src="{{ asset('/img/1611593817.png')}}"
                                                         alt="User profile picture">
                                                  </div>

                                                  <h3 class="profile-username text-center">{{ $ac->name }}</h3>
                                                  <p class="text-muted text-center"> {{ $ac->gender }} | {{ $ac->nationality}} | {{$ac->id_number}}</p>
                                                  <ul class="list-group list-group-unbordered mb-3">
                                                    <li class="list-group-item">
                                                      <b>Address</b> <a class="float-right">{{ $ac->permanent_address }}</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                      <b>Telephone</b> <a class="float-right">{{ $ac->telephone }} {{ $ac->alt_telephone }}</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                      <b>Loan Group</b> <a class="float-right">{{ $ac->group_name }}</a>
                                                    </li>
                                                  </ul>
                                                </div>
                                          </div> 
                                        </div>

                                        <div class="col-md-8">
                                          <!-- row -->
                                          <div class="row form-group">
                                            <div class="col-3">
                                              <label>Loan Request</label>
                                              <input type="number" name="loan_request_amount" class="form-control" required="required" placeholder="Loan request" autocomplete="off">
                                            </div>
                                            <!-- col-3 -->
                                            <div class="col-3">
                                              <label>Loan Period (Weeks)</label>
                                              <input type="number" name="loan_period" class="form-control" required="required" placeholder="Loan period in weeks" autocomplete="off">
                                            </div>
                                            <!-- col-3 -->
                                            <div class="col-3">
                                              <label>Interest Rate (%)</label>
                                              <input type="text" name="interest_rate" class="form-control" placeholder="Interest rate" value="{{ $interest->rate }}" readonly>
                                            </div>
                                            <!-- col-3 -->
                                            <div class="col-3">
                                              <label>Application Date</label>
                                              <input type="date" name="date_loan_application" class="form-control" placeholder="Date" required>
                                            </div>
                                            <!-- col-3 -->
                                          </div>
                                          <!-- row -->
                                          <div class="row form-group">
                                            <div class="col-12">
                                              <label>Borrowing Purpose</label>
                                              <textarea class="form-control" name="borrowing_purpose" required placeholder="Purpose for borrowing" autocomplete="off"></textarea>
                                            </div>
                                          </div>
                                          <!-- row -->
                                          <!-- <div class="row form-group">
                                            <div class="col-6">
                                              <label>Primary Source of Income</label>
                                              <input type="text" class="form-control" name="main_income_source" required placeholder="Primary source of income" autocomplete="off">
                                            </div>
                                            <div class="col-6">
                                              <label>Other Sources of Income</label>
                                              <input type="text" class="form-control" name="other_income_sources" required placeholder="Other sources of income" autocomplete="off">
                                            </div>
                                          </div> -->
                                          <!-- row -->
                                          <!-- <div class="row form-group">
                                            <div class="col-6">
                                              <label>Total Monthly Income</label>
                                              <input type="text" class="form-control" name="total_monthly_income" required placeholder="Monthly income" autocomplete="off">
                                            </div>
                                            <div class="col-6">
                                              <label>Total Monthly Expenditure</label>
                                              <input type="text" class="form-control" name="total_monthly_expenditure" required placeholder="Monthly expenditure" autocomplete="off">
                                            </div>
                                          </div> -->
                                          <!-- row -->
                                          <div class="row form-group">
                                            <label>Collateral Security</label>
                                            <textarea class="form-control" name="collateral_security" required placeholder="List collateral security" autocomplete="off"></textarea>
                                          </div>
                                          <!-- row -->
                                          <div class="row form-group">
                                            <div class="col-12 text-center">         
                                              <button type="submit" class="btn btn-sm btn-outline-primary">Apply</button>
                                              <button type="submit" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Cancel</button>
                                            </div>
                                          </div>
                                          <!-- row -->
                                        </div>
                                        <!-- col-md-8 -->
                                      </div>
                                      <!-- row -->
                                    </form>
                                    <!-- form -->
                                  </div>
                                  <!-- modal-body -->
                                </div>
                              </div>
                            </div>
                            <!-- modal -->
                          @break
                        @endswitch
                        
                        


                      </tr>
                      <?php $x++;?>
                      @endforeach
                    </tbody>
                  </table>
                  <div class="modal fade" id="new-account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h6 class="modal-title justify-content-center text-uppercase" id="exampleModalLongTitle">Client Registration Form</h6>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="/apply/accounts/new/" method="post">
                            @csrf
                            <div class="row form-group">
                              <div class="col-6">
                                <label>Full Name</label>
                                <input type="text" name="name" autocomplete="off" class="form-control" placeholder="Full Name" required="required">
                              </div>
                              <div class="col-3">
                                <label>Gender</label>
                                <div class="form-group">
                                  <select class="form-control select2bs4" name="gender" data-placeholder="Select" style="width: 100%;" required="required">
                                    <option></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-3">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" autocomplete="off" class="form-control" placeholder="Date of Birth" required="required">
                              </div>

                            </div>
                            <!-- <div class="row form-group">
                              <div class="col-3">
                                <label>District of Residence</label>
                                <input type="text" name="resident_district" autocomplete="off" class="form-control" placeholder="District of Residence" required="required">
                              </div>
                              <div class="col-3">
                                <label>Division of Residence</label>
                                <input type="text" name="resident_division" autocomplete="off" class="form-control" placeholder="Division of Residence" required="required">
                              </div>
                              <div class="col-3">
                                <label>Parish/Ward of Residence</label>
                                <input type="text" name="resident_parish" autocomplete="off" class="form-control" placeholder="Parish of Residence" required="required">
                              </div>
                              <div class="col-3">
                                <label>Village/Cell of Residence</label>
                                <input type="text" name="resident_village" autocomplete="off" class="form-control" placeholder="Village of Residence" required="required">
                              </div>
                            </div> -->
                            
                            <div class="row form-group">
                              <div class="col-3">
                                <label>Telephone Number</label>
                                <input type="text" name="telephone" autocomplete="off" class="form-control" placeholder="Telephone Number" required="required">
                              </div>
                              <div class="col-3">
                                <label>Nationality</label>
                                <input type="text" name="nationality" autocomplete="off" class="form-control" value="Ugandan" readonly>
                              </div>
                              <div class="col-3">
                                <label>Identity Type</label>
                                <input type="text" name="id_type" autocomplete="off" class="form-control" value="National ID" readonly>
                              </div>
                              <div class="col-3">
                                <label>ID Number</label>
                                <input type="text" name="id_number" autocomplete="off" class="form-control" placeholder="Identity Number" required="required">
                              </div>
                              
                            </div>
                            <div class="row form-group">
                              <div class="col-12">
                                <label>Residence Address</label>
                                <textarea class="form-control" style="line-height: 11px;" autocomplete="off" placeholder="Residence Address" name="permanent_address" required></textarea>
                              </div>
                            </div>
                            
                            <div class="row form-group">
                              <div class="col-3">
                                <label>Copy of National ID</label>
                                <div class="custom-file">
                                    <input type="file" name="photo_id" class="form-control custom-file-input" id="exampleInputFile" required="required">
                                    <label class="custom-file-label" for="exampleInputFile">Upload ID</label>
                                  </div>
                              </div>
                              <div class="col-3">
                                <label>Passport Photo</label>
                                <div class="custom-file">
                                    <input type="file" name="photo_client" class="form-control custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Upload ID</label>
                                  </div>
                              </div>
                              <div class="col-3">
                                <label>Loan Group</label>
                                <div class="form-group">
                                  <select class="form-control select2bs4" name="id_loan_group" data-placeholder="Select" style="width: 100%;" required="required">
                                    <option></option>
                                    @foreach($groups as $grp)
                                      <option value="{{ $grp->id }}">{{ $grp->group_name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-3">
                                <label>Registration Fee</label>
                                <input type="text" name="registration_fee" autocomplete="off" class="form-control" value="{{ number_format($fees->amount)}}" readonly>
                              </div>
                            </div>
                            <div class="row form-group d-flex justify-content-center">
                              <button class="btn btn-primary ml-2">Submit</button>
                            </div>
                        </form>
                        </div>
                        <!-- modal-body -->
                      </div>
                    </div>
                  </div>
                  <!-- modal -->
                </div>   
              </div>
            </div>
          </div>
          <!-- row -->
        </div>
      </div>
      <!-- content -->
    </div>
    <!-- content-wrapper -->
@endsection