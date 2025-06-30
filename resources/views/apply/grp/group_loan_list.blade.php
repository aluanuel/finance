@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Group Loans</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Loans</a></li>
              <li class="breadcrumb-item active">Group Loans</li>
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
                <h3 class="card-title">Showing Group Loans</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>loan_number</th>
                    <th>Client_name</th>
                    <th>Group_name</th>
                    <th>Loan_request</th>
                    <th>Loan_approved</th>
                    <th>total_loan</th>
                    <th>loan_recovered</th>
                    <th>loan_outstanding</th>
                    <th>date_loan_recovery</th>
                    <th>Loan_status</th>
                    <th>action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php $x = 1 @endphp
                    @foreach($loan as $loan)
                      <tr>
                        <td>{{ $x }}</td>
                        <td><a href="/apply/account/profile/{{$loan->id_client}}">{{ $loan->loan_number }}</a></td>
                        <td><a href="/apply/account/profile/{{$loan->id_client}}">{{ $loan->name }}</a></td>
                        <td>{{ $loan->group_name }}</td>
                        <td>{{ number_format($loan->loan_request_amount) }}</td>
                        <td>{{ number_format($loan->loan_approved) }}</td>
                        <td>{{ number_format($loan->total_loan) }}</td>
                        <td>{{ number_format($loan->loan_recovered) }}</td>
                        <td>{{ number_format($loan->loan_outstanding) }}</td>
                        <td>{{ $loan->date_loan_fully_recovered }}</td>
                        <td>{{ $loan->loan_status }}</td>

                        @if($loan->loan_status == "Pending Assessment")
                          <td><a href="" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#groupLoanApplication{{$loan->id}}">Assess</a></td>
                          <div class="modal fade" id="groupLoanApplication{{$loan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h6 class="modal-title justify-content-center text-uppercase" id="exampleModalLongTitle">Assess loan {{ $loan->loan_number }}</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <!-- modal-head -->
                                <div class="modal-body">
                                  <!-- form -->
                                  <form action="/apply/grp/loan/assess/{{ $loan->id }}" method="post">
                                    @csrf
                                    <div class="row form-group">
                                      <!-- col-3 -->
                                      <div class="col-3">
                                        <label>Client Name</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->name }}">
                                      </div>
                                      <!-- col-3 -->
                                      <div class="col-3">
                                        <label>Telephone</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->telephone }}">
                                      </div>
                                      <!-- col-3 -->
                                      <div class="col-3">
                                        <label>Group Name</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->group_name }}">
                                      </div>
                                      <!-- col-3 -->
                                      <div class="col-3">
                                        <label>Group Code</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->group_code }}">
                                      </div>
                                      <!-- col-3 -->
                                    </div>
                                    <!-- row -->
                                    <div class="row form-group">
                                      <!-- col-3 -->
                                      <div class="col-3">
                                        <label>Loan Request</label>
                                        <input type="text" class="form-control" readonly value="{{ number_format($loan->loan_request_amount) }}">
                                      </div>
                                      <!-- col-3 -->
                                      <div class="col-2">
                                        <label>Interest Rate</label>
                                        <input type="text" class="form-control" name="interest_rate" value="{{ $loan->interest_rate }}" required>
                                      </div>
                                      <!-- col-2 -->
                                      <div class="col-2">
                                        <label>Loan Period (Weeks)</label>
                                        <input type="text" class="form-control" name="loan_period" value="{{ $loan->loan_period }}" required>
                                      </div>
                                      <!-- col-2 -->
                                      <div class="col-2">
                                        <label>Loan Application Date</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->date_loan_application }}">
                                      </div>
                                      <!-- col-2 -->
                                      <div class="col-3">
                                        <label>Total Loan</label>
                                        <input type="text" class="form-control" readonly value="{{ number_format($loan->total_loan) }}">
                                      </div>
                                      <!-- col-3 -->
                                    </div>
                                    <!-- row -->
                                    <div class="row form-group">
                                      <div class="col-4">
                                        <label>Purpose for borrowing</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->borrowing_purpose }}"> 
                                      </div>
                                      <!-- col-4 -->
                                      <div class="col-4">
                                        <label>Sources of Income</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->main_income_source }}, {{ $loan->other_income_sources }}"> 
                                      </div>
                                      <!-- col-4 -->
                                      <div class="col-2">
                                        <label>Monthly Income</label>
                                        <input type="text" class="form-control" readonly value="{{ number_format($loan->total_monthly_income) }}"> 
                                      </div>
                                      <!-- col-2 -->
                                      <div class="col-2">
                                        <label>Monthly Expenditure</label>
                                        <input type="text" class="form-control" readonly value="{{ number_format($loan->total_monthly_expenditure) }}"> 
                                      </div>
                                      <!-- col-2 -->
                                    </div>
                                    <!-- row -->
                                    <div class="row form-group">
                                      <div class="col-4">
                                        <label>Collateral security</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->collateral_security }}"> 
                                      </div>
                                      <!-- col-4 -->
                                      <div class="col-3">
                                        <label>Loan Amount to Approve</label>
                                        <input type="number" class="form-control" required name="loan_approved" placeholder="Loan amount to approve"> 
                                      </div>
                                      <!-- col-3 -->
                                      <div class="col-3">
                                        <label>Loan Approval</label>
                                        <div class="form-group">
                                          <select class="form-control select2bs4" name="loan_status" data-placeholder="Select" style="width: 100%;" required="required">
                                            <option></option>
                                            <option>Approved</option>
                                            <option>Cancelled</option>
                                          </select>
                                        </div>
                                      </div>
                                      <!-- col-3 -->
                                      <div class="col-2">
                                        <label>Approval Date</label>
                                        <input type="date" class="form-control" required name="date_loan_approved" placeholder="Enter date"> 
                                      </div>
                                      <!-- col-2 -->
                                    </div>
                                    <!-- row -->
                                    <div class="row form-group">
                                      <div class="col-12 text-center">         
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                                        <button type="submit" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Cancel</button>
                                      </div>
                                    </div>
                                    <!-- row -->
                                  </form>
                                  <!-- form -->
                                </div>
                                <!-- modal-body -->
                              </div>
                              <!-- modal-content -->
                            </div>
                            <!-- modal-dialog -->
                          </div>
                          <!-- modal -->
                        @elseif($loan->loan_status == "Approved")
                          <td><a href="" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#groupLoanApplication{{$loan->id}}">Disburse</a></td>
                          <div class="modal fade" id="groupLoanApplication{{$loan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h6 class="modal-title justify-content-center text-uppercase" id="exampleModalLongTitle">Disburse loan {{ $loan->loan_number }}</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <!-- modal-head -->
                                <div class="modal-body">
                                  <!-- form -->
                                  <form action="/apply/grp/loan/disburse/{{ $loan->id }}" method="post">
                                    @csrf
                                    <div class="row form-group">
                                      <!-- col-3 -->
                                      <div class="col-3">
                                        <label>Client Name</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->name }}">
                                      </div>
                                      <!-- col-3 -->
                                      <div class="col-3">
                                        <label>Telephone</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->telephone }}">
                                      </div>
                                      <!-- col-3 -->
                                      <div class="col-3">
                                        <label>Group Name</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->group_name }}">
                                      </div>
                                      <!-- col-3 -->
                                      <div class="col-3">
                                        <label>Group Code</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->group_code }}">
                                      </div>
                                      <!-- col-3 -->
                                    </div>
                                    <!-- row -->
                                    <div class="row form-group">
                                      <!-- col-3 -->
                                      <div class="col-3">
                                        <label>Loan Request</label>
                                        <input type="text" class="form-control" readonly value="{{ number_format($loan->loan_request_amount) }}">
                                      </div>
                                      <!-- col-3 -->
                                      <div class="col-2">
                                        <label>Interest Rate</label>
                                        <input type="text" class="form-control" name="interest_rate" value="{{ $loan->interest_rate }}" readonly>
                                      </div>
                                      <!-- col-2 -->
                                      <div class="col-2">
                                        <label>Loan Period (Weeks)</label>
                                        <input type="text" class="form-control" name="loan_period" value="{{ $loan->loan_period }}" readonly>
                                      </div>
                                      <!-- col-2 -->
                                      <div class="col-2">
                                        <label>Loan Application Date</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->date_loan_application }}">
                                      </div>
                                      <!-- col-2 -->
                                      <div class="col-3">
                                        <label>Total Loan</label>
                                        <input type="text" class="form-control" readonly value="{{ number_format($loan->total_loan) }}">
                                      </div>
                                      <!-- col-3 -->
                                    </div>
                                    <!-- row -->
                                    <div class="row form-group">
                                      <div class="col-4">
                                        <label>Purpose for borrowing</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->borrowing_purpose }}"> 
                                      </div>
                                      <!-- col-4 -->
                                      <div class="col-4">
                                        <label>Sources of Income</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->main_income_source }}, {{ $loan->other_income_sources }}"> 
                                      </div>
                                      <!-- col-4 -->
                                      <div class="col-2">
                                        <label>Monthly Income</label>
                                        <input type="text" class="form-control" readonly value="{{ number_format($loan->total_monthly_income) }}"> 
                                      </div>
                                      <!-- col-2 -->
                                      <div class="col-2">
                                        <label>Monthly Expenditure</label>
                                        <input type="text" class="form-control" readonly value="{{ number_format($loan->total_monthly_expenditure) }}"> 
                                      </div>
                                      <!-- col-2 -->
                                    </div>
                                    <!-- row -->
                                    <div class="row form-group">
                                      <div class="col-4">
                                        <label>Collateral security</label>
                                        <input type="text" class="form-control" readonly value="{{ $loan->collateral_security }}"> 
                                      </div>
                                      <!-- col-6 -->
                                      <div class="col-2">
                                        <label>Loan Approved</label>
                                        <input type="text" class="form-control" value="{{number_format($loan->loan_approved) }}" readonly> 
                                      </div>
                                      <!-- col-2 -->          
                                      @php 
                                        $loan_processing_fee = ($loan->loan_processing_rate/100)*$loan->loan_approved
                                      @endphp

                                      <div class="col-2">
                                        <label>Loan Processing Fee</label>
                                        <input type="text" class="form-control" name="loan_processing_fee" value="{{ number_format($loan_processing_fee) }}" readonly>
                                      </div>
                                      <!-- col-2 -->
                                      <div class="col-2">
                                        <label>Amount to disburse</label>
                                        <input type="text" class="form-control" value="{{ number_format($loan->loan_approved - $loan_processing_fee) }}" readonly>
                                      </div>
                                      <!-- col-2 -->
                                      <div class="col-2">
                                        <label>Loan Status</label>
                                        <input type="text" class="form-control" value="{{ $loan->loan_status }}" readonly>
                                      </div>
                                      <!-- col-2 -->
                                    </div>
                                    <!-- row -->
                                    <div class="row form-group">
                                      <div class="col-12 text-center">         
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Disburse</button>
                                        <button type="submit" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Cancel</button>
                                      </div>
                                    </div>
                                    <!-- row -->
                                  </form>
                                  <!-- form -->
                                </div>
                                <!-- modal-body -->
                              </div>
                              <!-- modal-content -->
                            </div>
                            <!-- modal-dialog -->
                          </div>
                          <!-- modal -->  
                        @elseif($loan->loan_status == "Running")  
                          <td><a href="" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#loan_repayment{{$loan->id}}">Repay</a></td>
                            <div class="modal fade" id="loan_repayment{{$loan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h6 class="modal-title justify-content-center text-uppercase" id="exampleModalLongTitle"> Repaying loan {{ $loan->loan_number }} - <span class="badge bg-info">{{ $loan->loan_status }} up to {{ $loan->date_loan_fully_recovered }}</span> </h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="/apply/loan/repayment/{{$loan->id}}" method="post">
                                      @csrf
                                      <div class="row form-group">
                                        <div class="col-4">
                                          <label>Client Name</label>
                                          <input type="text" class="form-control" value="{{ $loan->name }}" readonly>
                                        </div>
                                        <!-- col-4 -->
                                        <div class="col-4">
                                          <label>Telephone</label>
                                          <input type="text" class="form-control" value="{{ $loan->telephone }}" readonly>
                                        </div>
                                        <!-- col-4 -->
                                        <div class="col-4">
                                          <label>Group Name</label>
                                          <input type="text" class="form-control" value="{{ $loan->group_name }}" readonly>
                                        </div>
                                        <!-- col-4 -->
                                      </div>
                                      <!-- row -->
                                      <div class="row form-group">
                                        <div class="col-4">
                                          <label>Total Loan</label>
                                          <input type="text" class="form-control" value="{{ number_format($loan->total_loan) }}" readonly>
                                        </div>
                                        <!-- col-4 -->
                                        <div class="col-4">
                                          <label>Loan Recovered</label>
                                          <input type="text" class="form-control" value="{{ number_format($loan->loan_recovered) }}" readonly>
                                        </div>
                                        <!-- col-4 -->
                                        <div class="col-4">
                                          <label>Loan Outstanding</label>
                                          <input type="text" class="form-control" value="{{ number_format($loan->loan_outstanding) }}" readonly>
                                        </div>
                                        <!-- col-4 -->
                                      </div>
                                      <!-- row -->
                                      <div class="row form-group">

                                        <div class="col-4">
                                          <label>Loan Repayment</label>
                                          <input type="number" class="form-control" required name="loan_repayment" placeholder="Loan Repayment">
                                        </div>
                                        <!-- col-4 -->
                                        <div class="col-4">
                                          <label>Repayment Date</label>
                                          <input type="date" class="form-control" required name="repayment_date" placeholder="Date">
                                        </div>
                                        <!-- col-4 -->
                                      </div>
                                      <!-- row -->
                                      <div class="row form-group">
                                      <div class="col-12 text-center">         
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                                        <button type="submit" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Cancel</button>
                                      </div>
                                    </div>
                                    <!-- row -->
                                    </form>
                                  </div>
                                  <!-- modal-body -->
                                </div>
                                <!-- modal_content -->
                              </div>
                              <!-- modal-dialog -->
                            </div>
                            <!-- modal -->
                        @endif
                      </tr>
                      @php $x++ @endphp
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- card-body -->
            </div>
              <!-- card -->
          </div>
                    
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection
