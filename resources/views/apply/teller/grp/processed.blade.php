@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Processed Loans</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Individual</a></li>
              <li class="breadcrumb-item active">Processed Loans</li>
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
            <div class="card card-default">
              <div class="card-header">
                <ul class="nav nav-pills" id="myTab">
                  <li class="nav-item"><a class="nav-link active" href="#ln_issue" data-toggle="tab">Loans to Disburse
                  </a></li>
                  <li class="nav-item"><a class="nav-link" href="#ln_running" data-toggle="tab">Running Loans</a></li>
                  <li class="nav-item"><a class="nav-link" href="#ln_complete" data-toggle="tab">Completed Loans</a></li>
                  <li class="nav-item"><a class="nav-link" href="#ln_suspended" data-toggle="tab">Suspended Loans</a></li>
                </ul>
                <!-- <h3 class="card-title">Different Height</h3> -->
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="ln_issue">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Showing Loans To Be Disbursed</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="overflow-x: scroll;">
                         <table id="example6" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>s/n</th>
                              <th>loan_Number</th>
                              <th>Group_Code</th>
                              <th>Group_name</th>
                              <th>Applicant_name</th>
                              <th>Loan_approved</th>
                              <th>interest_rate(%)</th>
                              <th>Total_Loan</th>
                              <th>Loan_Security</th>
                              <th>Loan_Period(Weeks)</th>
                              <th>Telephone</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1;

                              $loan_approved = null;
                              $total_loan = null;
                              $loan_security = null;

                            ?>
                            @foreach($apps as $app)
                              <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $app->loan_number }}</td>
                                <td>{{ $app->group_code }}</td>
                                <td>{{ $app->group_name }}</td>
                                <td>{{ $app->name }}</td>
                                <td>{{ number_format($app->recommended_amount)}}</td>
                                <td>{{ $app->interest_rate }}</td>
                                <td>{{ number_format($app->total_loan)}}</td>
                                <td>{{ number_format($app->security)}}</td>
                                <td>{{ $app->loan_period}}</td>
                                <td>{{ $app->telephone }}</td>
                                <td>
                                  <a href="/apply/teller/trans/process/{{$app->id}}" class="btn btn-outline-primary">Issue Loan</a>
                                </td>
                              </tr>
                            <?php 

                              $i++;
                              $loan_approved += $app->recommended_amount;
                              $total_loan += $app->total_loan;
                              $loan_security += $app->security;

                            ?>
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                              <th colspan="5">total</th>
                              <th>{{ number_format($loan_approved) }}</th>
                              <th></th>
                              <th>{{ number_format($total_loan) }}</th>
                              <th>{{ number_format($loan_security) }}</th>
                              <th></th>
                              <th></th>
                              <th></th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    <!-- /.card-body -->
                    </div>
                  <!-- /.card -->
                  </div>
                  <!-- tab-pane -->
                  <div class="tab-pane" id="ln_running">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Showing Running Loans</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="overflow-x: scroll;">
                         <table id="example2" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>s/n</th>
                              <th>loan_Number</th>
                              <th>Group_Code</th>
                              <th>Group_name</th>
                              <th>client_name</th>
                              <th>Loan_disbursed</th>
                              <th>Total_loan</th>
                              <th>loan_Security</th>
                              <th>loan_instalment</th>
                              <th>loan_Recovered</th>
                              <th>Loan_Outstanding</th>
                              <th>Start_date</th>
                              <th>End_date</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                         <tbody>
                            <?php 

                              $i = 1;
                              $loan_disbursed = null;
                              $total_loan = null;
                              $loan_security = null;
                              $loan_recovered = null;
                              $loan_outstanding = null;

                            ?>
                            @foreach($running as $run)
                              <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $run->loan_number }}</td>
                                <td>{{ $run->group_code }}</td>
                                <td>{{ $run->group_name }}</td>
                                <td><a href="/apply/view/profile/{{$run->id_client}}">{{ $run->name }}</a></td>
                                <td>{{ number_format($run->recommended_amount) }}</td>
                                <td>{{ number_format($run->total_loan) }}</td>
                                <td>{{ number_format($run->security) }}</td>
                                <td>{{ number_format($run->instalment) }}</td>
                                <td>{{ number_format($run->loan_recovered) }}</td>
                                <td>{{ number_format($run->loan_balance) }}</td> 
                                <td>{{ date('Y-m-d', strtotime($run->start_date)) }}</td>
                                <td>{{ date('Y-m-d',strtotime($run->end_date)) }}</td>
                                <td><a href="/apply/teller/trans/{{$run->id}}"><button class="btn btn-outline-primary">Pay</button></a></td>
                              </tr>
                            <?php 

                                $i++;
                                $loan_disbursed += $run->recommended_amount;
                                $total_loan += $run->total_loan;
                                $loan_security += $run->security;
                                $loan_recovered += $run->loan_recovered;
                                $loan_outstanding += $run->loan_balance;

                              ?>
                            @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="5">Total</th>
                            <th>{{ number_format($loan_disbursed) }}</th>
                            <th>{{ number_format($total_loan) }}</th>
                            <th>{{ number_format($loan_security) }}</th>
                            <th></th>
                            <th>{{ number_format($loan_recovered) }}</th>
                            <th>{{ number_format($loan_outstanding) }}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    </div>
                  </div>
                  <!-- tab-pane -->
                  <div class="tab-pane" id="ln_complete">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Showing Completed Loans</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="overflow-x: scroll;">
                         <table id="example4" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>s/n</th>
                              <th>loan_Number</th>
                              <th>Group_Code</th>
                              <th>Group_name</th>
                              <th>client_name</th>
                              <th>Loan_disbursed</th>
                              <th>Total_Loan</th>
                              <th>Security_Withheld</th>
                              <th>loan_instalment</th>
                              <th>loan_Recovered</th>
                              <th>Loan_Outstanding</th>
                              <th>Start_date</th>
                              <th>End_date</th>
                              <th>action</th>
                            </tr>
                          </thead>
                         <tbody>
                            <?php $i = 1;?>
                            @foreach($completed as $complete)
                              <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $complete->loan_number }}</td>
                                <td>{{ $complete->group_code }}</td>
                                <td>{{ $complete->group_name }}</td>
                                <td><a href="/apply/view/profile/{{$complete->id_client}}">{{ $complete->name }}</a></td>
                                <td>{{ number_format($complete->recommended_amount) }}</td>
                                <td>{{ number_format($complete->total_loan) }}</td>
                                <td>{{ number_format($complete->security) }}</td>
                                <td>{{ number_format($complete->instalment) }}</td> 
                                <td>{{ number_format($complete->loan_recovered) }}</td>
                                <td>{{ number_format($complete->loan_balance) }}</td>
                                <td>{{ date('Y-m-d', strtotime($complete->start_date)) }}</td>
                                <td>{{ date('Y-m-d',strtotime($complete->end_date)) }}</td>
                                @if($complete->security > 0)
                                <td><a href="/apply/teller/trans/security/{{$complete->id}}"><button class="btn btn-outline-primary btn-sm">Return</button></a></td>
                                @else
                                <td></td>
                                @endif
                              </tr>
                            <?php $i++;?>
                            @endforeach
                        </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!-- tab-pane -->
                  <div class="tab-pane" id="ln_suspended">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Showing Loans Suspended</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="overflow-x: scroll;">
                         <table id="example5" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>s/n</th>
                              <th>Loan_number</th>
                              <th>Group_Code</th>
                              <th>Group_name</th>
                              <th>Client_name</th>
                              <th>Loan_disbursed</th>
                              <th>Interest</th>
                              <th>Total_Loan</th>
                              <th>Security_withheld</th>  
                              <th>Loan_recovered</th>
                              <th>Loan_Outstanding</th>
                              <th>Start_date</th>
                              <th>End_date</th>
                              <th>action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                                $i = 1;
                                $loan_disbursed = null;
                                $loan_interest = null;
                                $total_loan = null;
                                $loan_security = null;
                                $loan_recovered = null;
                                $loan_outstanding = null;

                              ?>
                            @foreach($suspended as $suspend)
                              <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $suspend->loan_number }}</td>
                                <td>{{ $suspend->group_code }}</td>
                                <td>{{ $suspend->group_name }}</td>
                                <td>{{ $suspend->name }}</td>
                                <td>{{ number_format($suspend->recommended_amount) }}</td>
                                <td>{{ number_format($suspend->loan_interest) }}</td>
                                <td>{{ number_format($suspend->total_loan) }}</td>
                                <td>{{ number_format($suspend->security) }}</td>
                                <td>{{ number_format($suspend->loan_recovered) }}</td>
                                <td>{{ number_format($suspend->loan_balance) }}</td>
                                <td>{{ date('Y-m-d', strtotime($suspend->start_date)) }}</td>
                                <td>{{ date('Y-m-d',strtotime($suspend->end_date)) }}</td>
                                <td><a href="/apply/view/profile/{{$suspend->id_client}}"><button class="btn btn-outline-primary">View</button></a></td>
                              </tr>
                            <?php 

                                $i++;
                                $loan_disbursed += $suspend->recommended_amount;
                                $loan_interest += $suspend->loan_interest;
                                $total_loan += $suspend->total_loan;
                                $loan_security += $suspend->security;
                                $loan_recovered += $suspend->loan_recovered;
                                $loan_outstanding += $suspend->loan_balance;
                            ?>
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                              <th colspan="5">Total</th>
                              <th>{{ number_format($loan_disbursed) }}</th>
                              <th>{{ number_format($loan_interest) }}</th>
                              <th>{{ number_format($total_loan) }}</th>
                              <th>{{ number_format($loan_security) }}</th>
                              <th>{{ number_format($loan_recovered) }}</th>
                              <th>{{ number_format($loan_outstanding) }}</th>
                              <th></th>
                              <th></th>
                              <th></th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                    <!-- card -->
                  </div>
                  <!-- tab-pane -->
                </div>
                <!-- tab-content -->
              </div>
            </div>
          </div>
      </div>
      <!-- /.row -->
      </div>
    </div>
  </div>
  @endsection