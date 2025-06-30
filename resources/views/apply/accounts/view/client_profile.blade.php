@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Client Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Accounts</a></li>
              <li class="breadcrumb-item active">Client Profile</li>
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
            <div class="col-md-4 col-sm-12">
              <!-- card -->
              <div class="card">
                <div class="card-body box-profile">

                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                             src="{{ asset('/img/1611593817.png')}}"
                             alt="User profile picture">
                  </div>
                  <h3 class="profile-username text-center">{{ $client->name }}</h3>
                  <p class="text-muted text-center">{{ $client->gender}} | {{ $client->dob}}</p>
                      
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Account Number</b> <a class="float-right">{{ $client->account_number }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Nationality</b> <a class="float-right">{{ $client->nationality }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>NIN</b> <a class="float-right">{{ $client->id_number }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Address</b> <a class="float-right">{{ $client->permanent_address }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Telephone</b> <a class="float-right">{{ $client->telephone }} {{ $client->alt_telephone }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Loan Group</b> <a class="float-right">{{ $client->group_name }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Group Code</b> <a class="float-right">{{ $client->group_code }}</a>
                    </li>
                  </ul>
                  <a class="text-center btn btn-sm btn-default" data-toggle="modal" data-target="#edit_client_profile">EDIT</a>

                  <div class="modal fade" id="edit_client_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h6 class="modal-title justify-content-center text-uppercase" id="exampleModalLongTitle">edit client information</h6>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="/apply/account/profile/{{ $client->id }}" method="post">
                            @csrf
                            <div class="row form-group">
                              <div class="col-6">
                                <label>Name</label>
                                <input class="form-control" readonly value="{{ $client->name}}">
                              </div>
                              <div class="col-3">
                                <label>Gender</label>
                                <input class="form-control" readonly value="{{ $client->gender}}">
                              </div>
                              <div class="col-3">
                                <label>Date of Birth</label>
                                <input type="date" class="form-control" name="dob" 
                                 value="{{ $client->dob}}" required>
                              </div>
                            </div>
                            <!-- row -->
                            <div class="row form-group">
                              <div class="col-3">
                                <label>Nationality</label>
                                <input class="form-control" readonly value="{{ $client->nationality}}">
                              </div>
                              <div class="col-3">
                                <label>NIN</label>
                                <input class="form-control" name="id_number" value="{{ $client->id_number}}" required>
                              </div>
                              <div class="col-3">
                                <label>Telephone</label>
                                <input class="form-control" name="telephone" value="{{ $client->telephone}}" placeholder="Telephone" required>
                              </div>
                              <div class="col-3">
                                <label>Alt Telephone</label>
                                <input class="form-control" name="alt_telephone" value="{{ $client->alt_telephone}}" placeholder="Telephone">
                              </div>
                            </div>
                            <!-- row -->
                            <div class="row form-group"> 
                              <div class="col-6">
                                <label>Physical Address</label>
                                <input class="form-control" name="permanent_address" value="{{ $client->permanent_address}}" required placeholder="Physical Address">
                              </div>
                              <div class="col-3">
                                <label>Profile Photo</label>
                                <div class="custom-file">
                                  <input type="file" name="photo_client" class="form-control custom-file-input" id="exampleInputFile">
                                  <label class="custom-file-label" for="exampleInputFile">Upload photo</label>
                                </div>
                              </div>
                              <div class="col-3">
                                <label>Loan Group</label>
                                <div class="form-group">
                                  <select class="form-control select2bs4" name="id_loan_group" data-placeholder="Select" style="width: 100%;">
                                    <option>{{ $client->group_name }}</option>
                                    @foreach($groups as $grp)
                                      <option value="{{ $grp->id }}">{{ $grp->group_name }}</option>
                                    @endforeach
                                      <option value="None">None</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <!-- row -->
                            <div class="row form-group">
                              <div class="col-12 text-center">         
                                <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                                <button type="submit" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Cancel</button>
                              </div>
                            </div>
                            <!-- row -->
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- modal-dialog -->
                  </div>
                  <!-- modal -->
                </div>
                <!-- card-body -->
              </div> 
              <!-- card   -->                
            </div>
            <!-- col-md-4 -->
            <div class="col-md-8 col-sm-12">
              <div class="card">
                <div class="card-header text-uppercase">
                  <ul class="nav nav-pills" id="myTab">
                    <li class="nav-item"><a class="nav-link active" href="#loan_details" data-toggle="tab">Loan Details</a></li>
                    <li class="nav-item"><a class="nav-link" href="#loan_history" data-toggle="tab">Loan History</a></li>
                  </ul>
                </div>
                <!-- card-header -->
                <!-- card-body -->
                <div class="card-body">
                  <!-- tab-content -->
                  <div class="tab-content">
                    <!-- tab-pane -->
                    <div class="active tab-pane" id="loan_details">
                      @if(!empty($last_loan))
                      <div class="row">
                        <div class="card col-sm-12">
                          <div class="card-header text-uppercase">
                            <h3 class="card-title">loan number: {{ $last_loan->loan_number }}</h3>
                            <div class="card-tools">loan status: 
                              <span class="text-success">{{ $last_loan->loan_status }}</span>
                            </div>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body p-0">
                            <table class="table table-sm">
                              <tr>
                                <td>Loan application date</td>
                                <td>{{ $last_loan->date_loan_application }}</td>
                              </tr>
                              <tr>
                                <td>Loan request amount</td>
                                <td>{{ number_format($last_loan->loan_request_amount) }}</td>
                              </tr>
                              <tr>
                                <td>Purpose for borrowing</td>
                                <td>{{ $last_loan->borrowing_purpose }}</td>
                              </tr>
                              <tr>
                                <td>Loan interest rate (%) </td>
                                <td>{{ $last_loan->interest_rate }}</td>
                              </tr>
                              <tr>
                                <td>Loan processing rate (%) </td>
                                <td>{{ $last_loan->loan_processing_rate }}</td>
                              </tr>
                              <tr>
                                <td>Loan period (weeks) </td>
                                <td>{{ $last_loan->loan_period }}</td>
                              </tr>
                              <tr>
                                <td>Loan approved </td>
                                <td>{{ number_format($last_loan->loan_approved) }}</td>
                              </tr>
                              <tr>
                                <td>Total loan </td>
                                <td><a class="btn btn-primary btn-xs">{{ number_format($last_loan->total_loan) }}</a></td>
                              </tr>
                              <tr>
                                <td>Loan recovered </td>
                                <td><a class="btn btn-success btn-xs">{{ number_format($last_loan->loan_recovered) }}</a></td>
                              </tr>
                              <tr>
                                <td>Loan outstanding </td>
                                <td><a class="btn btn-danger btn-xs"> {{ number_format($last_loan->loan_outstanding) }}</a></td>
                              </tr>
                              <tr>
                                <td>Date loan disbursed </td>
                                <td>{{ $last_loan->date_loan_disbursed }}</td>
                              </tr>
                              <tr>
                                <td>Date loan fully recovered </td>
                                <td><a class="btn btn-danger btn-xs">{{ $last_loan->date_loan_fully_recovered }}</a></td>
                              </tr>
                              <tr>
                                <td>Collateral security </td>
                                <td>{{ $last_loan->collateral_security }}</td>
                              </tr>
                            </table>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="card">
                          <div class="card-header text-uppercase">
                            <h3 class="card-title">loan schedule</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <table class="table table-sm">
                              @foreach($schedule as $sch)
                                <tr>
                                  <td>{{ $sch->instalment_date}}</td>
                                  <td>{{ number_format($sch->instalment_amount) }}</td>
                                </tr>
                              @endforeach
                            </table>
                          </div>
                        </div>
                        <!-- card -->  
                        </div>
                        <!-- col-3 -->
                        <div class="col-md-6 col-sm-12">
                          <div class="card">
                          <div class="card-header text-uppercase">
                            <h3 class="card-title">loan recovery</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <table class="table table-sm">
                              <tbody>
                                @foreach($last_loan_recovery as $recovery)
                                  <tr>
                                    <td>{{ $recovery->transaction_date }}</td>
                                    <td>{{ number_format($recovery->amount) }}</td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- card -->  
                        </div>
                        <!-- col-3 -->
                      </div>
                      @endif
                    </div>
                    <!-- tab-pane -->
                    <div class="tab-pane" id="loan_history">
                      <table class="table table-hover table-bordered">
                        <thead>
                          <tr>
                            <th>number</th>
                            <th>loan_request</th>
                            <th>loan_approved</th>
                            <th>total_loan</th>
                            <th>loan_status</th>
                            <th>#</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($loans as $loan)
                              <tr>
                                <td>{{ $loan->loan_number }}</td>
                                <td>{{ number_format($loan->loan_request_amount) }}</td>
                                <td>{{ number_format($loan->loan_approved) }}</td>
                                <td>{{ number_format($loan->total_loan) }}</td>
                                <td>{{ $loan->loan_status }}</td>
                                <td> <a class="btn btn-xs btn-default" data-toggle="modal" data-target="#loan_history_{{$loan->id}}">View</a></td>
                              </tr>
                            <div class="modal fade" id="loan_history_{{$loan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h6 class="modal-title justify-content-center text-uppercase" id="exampleModalLongTitle">View details of loan number {{ $loan->loan_number }}</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <!-- <div class="card"> -->
                                      <ul class="list-group list-group-unbordered mb-3">
                                      <li class="list-group-item">
                                        <b>Loan application date</b><span class="float-right">{{ $loan->date_loan_application }}</span>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Loan request amount</b><span class="float-right">{{ number_format($loan->loan_request_amount) }}</span>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Purpose for borrowing</b><span class="float-right">{{ $loan->borrowing_purpose }}</span>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Loan interest rate (%)</b><span class="float-right">{{ $loan->interest_rate }}</span>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Loan processing rate (%)</b><span class="float-right">{{ $loan->loan_processing_rate }}</span>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Loan period (weeks)</b><span class="float-right">{{ $loan->loan_period }}</span>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Loan approved</b><span class="float-right">{{ number_format($loan->loan_approved) }}</span>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Total loan</b><span class="float-right">{{ number_format($loan->total_loan) }}</span>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Loan recovered</b><span class="float-right">{{ number_format($loan->loan_recovered) }}</span>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Loan outstanding</b><span class="float-right">{{ number_format($loan->loan_outstanding) }}</span>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Date loan approved</b><span class="float-right">{{ $loan->date_loan_approved }}</span>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Date loan disbursed</b><span class="float-right">{{ $loan->date_loan_disbursed }}</span>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Date loan fully recovered</b><span class="float-right">{{ $loan->date_loan_fully_recovered }}</span>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Collateral security</b><span class="float-right">{{ $loan->collateral_security }}</span>
                                      </li>
                                      <li class="list-group-item">
                                        <b>Loan status</b><span class="float-right">{{ $loan->loan_status }}</span>
                                      </li>
                                    </ul>
                                    <!-- </div> -->
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                    <!-- tab-pane -->
                  </div>
                  <!-- tab-content -->
                </div>
                <!-- card-body -->
              </div>
              <!-- card -->

            </div>
            <!-- col-md-8 -->
          </div>
          <!-- row -->
        </div>
      </div>
      <!-- Main content -->
    </div>
    <!-- content-wrapper -->
    @endsection