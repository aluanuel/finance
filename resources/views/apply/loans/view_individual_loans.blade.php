@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Individual loans</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Loans</a></li>
              <li class="breadcrumb-item active">Individual loans</li>
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
                <h3 class="card-title">{{ $heading }}</h3>
                <div class="card-tools">
                  <form action="/apply/loans/individual" method="POST">
                    @csrf
                    <div class="input-group">
                      <!-- <div class="input-group-prepend" id="button-addon3">
                        <a href="" class="btn btn-flat btn-outline-default" data-toggle="modal" data-target="#AddNewLoan">Add</a>
                      </div> -->
                      <select class="form-control select2bs4" style="width: auto;" id="inputGroupSelect04" data-placeholder="Select" name="id" required>
                        <!-- <option selected>Choose...</option> -->
                        <option></option>
                        <option >Approved</option>
                        <option >Running</option>
                        <option >Completed</option>
                        <option >Defaulted</option>
                      </select>
                      <div class="input-group-append">
                        <button type="submit" name="submit" class="btn btn-default">
                          <i class="fa fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>loan</th>
                        <th>Client_name</th>
                        <th>request</th>
                        <th>approved</th>
                        <th>total_loan</th>
                        <th>recovered</th>
                        <th>outstanding</th>
                        <th>due_date</th>
                        <th>status</th>
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
                          <td>{{ number_format($loan->loan_request_amount) }}</td>
                          <td>{{ number_format($loan->loan_approved) }}</td>
                          <td>{{ number_format($loan->total_loan) }}</td>
                          <td>{{ number_format($loan->loan_recovered) }}</td>
                          <td>{{ number_format($loan->loan_outstanding) }}</td>
                          <td>{{ $loan->loan_end_date }}</td>
                          <td>{{ $loan->loan_status }}</td>

                          @if($loan->loan_status == "Pending Assessment")
                            <td><a href="" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#groupLoanApplication{{$loan->id}}">Assess</a></td>
                            <div class="modal fade" id="groupLoanApplication{{$loan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                  <div class="modal-body">
                                    <div class="box box-default">
                                      <div class="alert alert-dismissible text-center">
                                        <h5 class="text-uppercase text-primary">loan assessment form</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <!-- form -->
                                      <form action="/apply/loan/assess/{{ $loan->id }}" method="post">
                                        @csrf
                                        <div class="row form-group">
                                          <div class="col-lg-6 col-md-12">
                                            <label>Client Name</label>
                                            <input type="text" class="form-control" readonly value="{{ $loan->name }}">
                                          </div>
                                          <!-- col-lg-6 -->
                                          <div class="col-lg-6 col-md-12">
                                            <label>Loan Number</label>
                                            <input type="text" class="form-control" readonly value="{{ $loan->loan_number }}">
                                          </div>
                                          <!-- col-lg-6 -->
                                          
                                        </div>
                                        <!-- row -->
                                        <div class="row form-group">
                                          <!-- col-3 -->
                                          <div class="col-lg-3 col-md-6">
                                            <label>Loan Request</label>
                                            <input type="text" class="form-control" readonly value="{{ number_format($loan->loan_request_amount) }}">
                                          </div>
                                          <!-- col-3 -->
                                          <div class="col-lg-2 col-md-6">
                                            <label>Interest Rate</label>
                                            <input type="text" class="form-control" name="interest_rate" value="{{ $loan->interest_rate }}" required>
                                          </div>
                                          <!-- col-2 -->
                                          <div class="col-lg-2 col-md-6">
                                            <label>Loan Period (Weeks)</label>
                                            <input type="text" class="form-control" name="loan_period" value="{{ $loan->loan_period }}" required>
                                          </div>
                                          <!-- col-2 -->
                                          <div class="col-lg-2 col-md-6">
                                            <label>Loan Application Date</label>
                                            <input type="text" class="form-control" readonly value="{{ $loan->date_loan_application }}">
                                          </div>
                                          <!-- col-2 -->
                                          <div class="col-lg-2 col-md-12">
                                            <label>Total Loan</label>
                                            <input type="text" class="form-control" readonly value="{{ number_format($loan->total_loan) }}">
                                          </div>
                                          <!-- col-3 -->
                                        </div>
                                        <!-- row -->
                                        <div class="row form-group">
                                          <div class="col-lg-4 col-md-12">
                                            <label>Purpose for borrowing</label>
                                            <input type="text" class="form-control" readonly value="{{ $loan->borrowing_purpose }}"> 
                                          </div>
                                          <!-- col-4 -->
                                          <div class="col-lg-4 col-md-12">
                                            <label>Sources of Income</label>
                                            <input type="text" class="form-control" readonly value="{{ $loan->main_income_source }}, {{ $loan->other_income_sources }}"> 
                                          </div>
                                          <!-- col-4 -->
                                          <div class="col-lg-2 col-md-6">
                                            <label>Monthly Income</label>
                                            <input type="text" class="form-control" readonly value="{{ number_format($loan->total_monthly_income) }}"> 
                                          </div>
                                          <!-- col-2 -->
                                          <div class="col-lg-2 col-md-6">
                                            <label>Monthly Expenditure</label>
                                            <input type="text" class="form-control" readonly value="{{ number_format($loan->total_monthly_expenditure) }}"> 
                                          </div>
                                          <!-- col-2 -->
                                        </div>
                                        <!-- row -->
                                        <div class="row form-group">
                                          <div class="col-lg-4 col-md-12">
                                            <label>Collateral security</label>
                                            <input type="text" class="form-control" readonly value="{{ $loan->collateral_security }}"> 
                                          </div>
                                          <!-- col-4 -->
                                          <div class="col-lg-3 col-md-12">
                                            <label>Loan Amount to Approve</label>
                                            <input type="text" class="form-control" required name="loan_approved" placeholder="Loan amount to approve"> 
                                          </div>
                                          <!-- col-3 -->
                                          <div class="col-lg-3 col-md-6">
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
                                          <div class="col-lg-2 col-md-6">
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
                                    <!-- box -->
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
                                  <div class="modal-body">
                                    <div class="box box-default">
                                      <div class="alert alert-dismissible text-center">
                                        <h5 class="text-uppercase text-primary">loan disbursement form</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <!-- form -->
                                      <form action="/apply/loan/disburse/{{ $loan->id }}" method="post">
                                        @csrf
                                        <div class="row form-group">
                                          <!-- col-3 -->
                                          <div class="col-lg-6 col-md-12">
                                            <label>Client Name</label>
                                            <input type="text" class="form-control" readonly value="{{ $loan->name }}">
                                          </div>
                                          <!-- col-lg-6 -->
                                          <div class="col-lg-3 col-md-6">
                                            <label>Telephone</label>
                                            <input type="text" class="form-control" readonly value="{{ $loan->telephone }}">
                                          </div>
                                          <!-- col-lg-3 -->
                                          <div class="col-lg-3 col-md-6">
                                            <label>Loan number</label>
                                            <input type="text" class="form-control" readonly value="{{ $loan->loan_number }}">
                                          </div>
                                          <!-- col-lg-3 -->
                                        </div>
                                        <!-- row -->
                                        <div class="row form-group">
                                          <!-- col-3 -->
                                          <div class="col-lg-3 col-md-12">
                                            <label>Loan Request</label>
                                            <input type="text" class="form-control" readonly value="{{ number_format($loan->loan_request_amount) }}">
                                          </div>
                                          <!-- col-3 -->
                                          <div class="col-lg-2 col-md-6">
                                            <label>Interest Rate</label>
                                            <input type="text" class="form-control" name="interest_rate" value="{{ $loan->interest_rate }}" readonly>
                                          </div>
                                          <!-- col-2 -->
                                          <div class="col-lg-2 col-md-6">
                                            <label>Loan Period (Weeks)</label>
                                            <input type="text" class="form-control" name="loan_period" value="{{ $loan->loan_period }}" readonly>
                                          </div>
                                          <!-- col-2 -->
                                          <div class="col-lg-3 col-md-12">
                                            <label>Total Loan</label>
                                            <input type="text" class="form-control" readonly value="{{ number_format($loan->total_loan) }}">
                                          </div>
                                          <!-- col-3 -->
                                          <div class="col-lg-2 col-md-12">
                                            <label>Loan Application Date</label>
                                            <input type="text" class="form-control" readonly value="{{ $loan->date_loan_application }}">
                                          </div>
                                          <!-- col-2 -->
                                        </div>
                                        <!-- row -->
                                        <div class="row form-group">
                                          <div class="col-lg-4 col-md-12">
                                            <label>Purpose for borrowing</label>
                                            <input type="text" class="form-control" readonly value="{{ $loan->borrowing_purpose }}"> 
                                          </div>
                                          <!-- col-4 -->
                                          <div class="col-lg-4 col-md-12">
                                            <label>Sources of Income</label>
                                            <input type="text" class="form-control" readonly value="{{ $loan->main_income_source }}, {{ $loan->other_income_sources }}"> 
                                          </div>
                                          <!-- col-4 -->
                                          <div class="col-lg-2 col-md-6">
                                            <label>Monthly Income</label>
                                            <input type="text" class="form-control" readonly value="{{ number_format($loan->total_monthly_income) }}"> 
                                          </div>
                                          <!-- col-2 -->
                                          <div class="col-lg-2 col-md-6">
                                            <label>Monthly Expenditure</label>
                                            <input type="text" class="form-control" readonly value="{{ number_format($loan->total_monthly_expenditure) }}"> 
                                          </div>
                                          <!-- col-2 -->
                                        </div>
                                        <!-- row -->
                                        <div class="row form-group">
                                          <div class="col-lg-4 col-md-12">
                                            <label>Collateral security</label>
                                            <input type="text" class="form-control" readonly value="{{ $loan->collateral_security }}"> 
                                          </div>
                                          <!-- col-6 -->
                                          <div class="col-lg-2 col-md-6">
                                            <label>Loan Approved</label>
                                            <input type="text" class="form-control" value="{{number_format($loan->loan_approved) }}" readonly> 
                                          </div>
                                          <!-- col-2 -->          
                                          @php 
                                            $loan_processing_fee = ($loan->loan_processing_rate/100)*$loan->loan_approved
                                          @endphp

                                          <div class="col-lg-2 col-md-6">
                                            <label>Loan Processing Fee</label>
                                            <input type="text" class="form-control" name="loan_processing_fee" value="{{ number_format($loan_processing_fee) }}" readonly>
                                          </div>
                                          <!-- col-2 -->
                                          <div class="col-lg-2 col-md-6">
                                            <label>Amount to disburse</label>
                                            <input type="text" class="form-control" value="{{ number_format($loan->loan_approved - $loan_processing_fee) }}" readonly>
                                          </div>
                                          <!-- col-2 -->
                                          <div class="col-lg-2 col-md-6">
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
                                    <!-- box -->
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
                                    <div class="modal-body">
                                      <div class="box box-default">
                                        <div class="alert alert-dismissible text-center">
                                          <h5 class="text-uppercase text-primary"><i class="icon fa fa-edit"></i> Loan repayment form</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <form action="/apply/loan/repayment/{{$loan->id}}" method="post">
                                          @csrf
                                          <div class="row form-group">
                                            <div class="col-lg-4 col-sm-12">
                                              <label>Client Name</label>
                                              <input type="text" class="form-control" value="{{ $loan->name }}" readonly>
                                            </div>
                                            <!-- col-lg-4 -->
                                            <div class="col-lg-4 col-sm-12">
                                              <label>Loan number</label>
                                              <input type="text" class="form-control" value="{{ $loan->loan_number }}" readonly>
                                            </div>
                                            <!-- col-lg-4 -->
                                            <div class="col-lg-4 col-sm-12">
                                              <label>Loan end date</label>
                                              <input type="text" class="form-control" value="{{ $loan->loan_end_date }}" readonly>
                                            </div>
                                            <!-- col-lg-4 --> 
                                          </div>
                                          <!-- row -->
                                          <div class="row form-group">
                                            <div class="col-lg-4 col-sm-12">
                                              <label>Total Loan</label>
                                              <input type="text" class="form-control" value="{{ number_format($loan->total_loan) }}" readonly>
                                            </div>
                                            <!-- col-4 -->
                                            <div class="col-lg-4 col-sm-12">
                                              <label>Loan Recovered</label>
                                              <input type="text" class="form-control" value="{{ number_format($loan->loan_recovered) }}" readonly>
                                            </div>
                                            <!-- col-4 -->
                                            <div class="col-lg-4 col-sm-12">
                                              <label>Loan Outstanding</label>
                                              <input type="text" class="form-control" value="{{ number_format($loan->loan_outstanding) }}" readonly>
                                            </div>
                                            <!-- col-4 -->
                                          </div>
                                          <!-- row -->
                                          <div class="row form-group">

                                            <div class="col-lg-6 col-sm-12">
                                              <label>Loan Repayment</label>
                                              <input type="text" class="form-control" required name="loan_repayment" placeholder="Loan Repayment">
                                            </div>
                                            <!-- col-4 -->
                                            <div class="col-lg-6 col-sm-12">
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
                                    </div>
                                    <!-- modal-body -->
                                  </div>
                                  <!-- modal_content -->
                                </div>
                                <!-- modal-dialog -->
                              </div>
                              <!-- modal -->
                          @elseif($loan->loan_status == "Cancelled")
                            <td><a href="" class="btn btn-xs btn-outline-danger" data-toggle="modal" data-target="#loan_delete{{$loan->id}}">Delete</a></td>
                            <div class="modal fade" id="loan_delete{{$loan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog modal-md" role="document">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                      <div class="box box-default">
                                        <form action="/apply/loan/delete/{{$loan->id}}" method="post">
                                          @csrf
                                          <div class="row form-group">
                                            <div class="alert alert-dismissible text-center">
                                              <h5 class="text-danger"><i class="icon fa fa-warning"></i>Attention!</h5>
                                                Deleting loan record {{$loan->loan_number}}, {{ $loan->name}}. Proceed?
                                            </div>
                                              <!-- /.alert -->
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
                                      <!-- box -->
                                    </div>
                                    <!-- modal-body -->
                                  </div>
                                  <!-- modal_content -->
                              </div>
                                <!-- modal-dialog -->
                            </div>
                          @elseif($loan->loan_status == "Completed")
                            <td></td>
                          @elseif($loan->loan_status == "Defaulted")
                            <td><a href="" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#loan_reinstate{{$loan->id}}">Reinstate</a></td>
                            <div class="modal fade" id="loan_reinstate{{$loan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                      <div class="box box-default">
                                        <div class="alert alert-dismissible text-center">
                                          <h5 class="text-uppercase text-primary">Loan reinstatement form</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <form action="/apply/loan/reinstate/{{$loan->id}}" method="post">
                                          @csrf
                                          <div class="row form-group">
                                            <!-- col-3 -->
                                            <div class="col-lg-6 col-md-12">
                                              <label>Client Name</label>
                                              <input type="text" class="form-control" readonly value="{{ $loan->name }}">
                                            </div>
                                            <!-- col-lg-6 -->
                                            <div class="col-lg-3 col-md-6">
                                              <label>Loan number</label>
                                              <input type="text" class="form-control" readonly value="{{ $loan->loan_number }}">
                                            </div>
                                            <!-- col-lg-3 -->
                                            <div class="col-lg-3 col-md-6">
                                              <label>Loan status</label>
                                              <input type="text" class="form-control" readonly value="{{ $loan->loan_status }}">
                                            </div>
                                            <!-- col-lg-3 -->
                                          </div>
                                          <!-- row -->
                                          <div class="row form-group">
                                            <!-- col-3 -->
                                            <div class="col-lg-4 col-md-12">
                                              <label>Loan</label>
                                              <input type="text" class="form-control" name="total_loan" readonly value="{{ number_format($loan->total_loan) }}">
                                            </div>
                                            <!-- col-lg-6 -->
                                            <div class="col-lg-4 col-md-12">
                                              <label>Loan recovered</label>
                                              <input type="text" class="form-control" name="loan_recovered" readonly value="{{ number_format($loan->loan_recovered) }}">
                                            </div>
                                            <!-- col-lg-3 -->
                                            <div class="col-lg-4 col-md-12">
                                              <label>Loan outstanding</label>
                                              <input type="text" class="form-control" readonly name="loan_outstanding" value="{{ number_format($loan->loan_outstanding) }}">
                                            </div>
                                            <!-- col-lg-3 -->
                                          </div>
                                          <!-- row -->
                                           @php

                                              $end_date = strtotime($loan->loan_end_date);

                                              $today = strtotime(date('Y-m-d'));

                                              $difference = $today - $end_date;

                                              $default_days = floor($difference / (60 * 60 * 24));

                                              $loan_outstanding = $loan->loan_outstanding;

                                              $rate_on_defaulting = $loan->interest_on_defaulting;

                                              $penalty = (($rate_on_defaulting/100) * $loan_outstanding) * $default_days;

                                              $total_loan_outstanding = $loan_outstanding +  $penalty;


                                          @endphp
                                          <div class="row form-group">
                                            <!-- col-3 -->
                                            <div class="col-lg-3 col-md-12">
                                              <label>Days defaulted</label>
                                              <input type="text" class="form-control" readonly value="{{ number_format($default_days) }}">
                                            </div>
                                            <!-- col-lg-3 -->
                                            <div class="col-lg-3 col-md-12">
                                              <label>Interest on defaulting</label>
                                              <input type="text" class="form-control" readonly value="{{ number_format($penalty) }}">
                                            </div>
                                            <!-- col-lg-3 -->
                                            <div class="col-lg-3 col-md-12">
                                              <label>Total loan</label>
                                              <input type="text" class="form-control" readonly value="{{ number_format($total_loan_outstanding) }}">
                                            </div>
                                            <!-- col-lg-3 -->
                                            <div class="col-lg-3 col-md-12">
                                              <label>Deposit amount</label>
                                              <input type="text" class="form-control" name="amount" required placeholder="Deposit amount">
                                            </div>
                                            <!-- col-lg-3 -->
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
                                      <!-- box -->
                                    </div>
                                    <!-- modal-body -->
                                  </div>
                                  <!-- modal_content -->
                              </div>
                                <!-- modal-dialog -->
                            </div>
                          @endif
                        </tr>
                        @php $x++ @endphp
                      @endforeach
                    </tbody>
                  </table>
                  <!-- table -->
                </div>

                <!-- modal add new loan-->
                <div class="modal fade" id="AddNewLoan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title justify-content-center text-uppercase" id="exampleModalLongTitle">New loan request</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                                  </button>
                      </div>
                       <!-- modal-head -->
                      <div class="modal-body">
                        <!-- form -->
                                  
                        <!-- form -->
                      </div>
                      <!-- modal-body -->
                    </div>
                    <!-- modal-content -->
                  </div>
                  <!-- modal-dialog -->
                </div>
                <!-- modal -->
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
