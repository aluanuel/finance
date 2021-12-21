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
              <li class="breadcrumb-item"><a href="#">Group Loan</a></li>
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
                  <li class="nav-item"><a class="nav-link active" href="#admin_grp_ln_issue" data-toggle="tab">Loans to Disburse
                  </a></li>
                  <li class="nav-item"><a class="nav-link" href="#admin_grp_ln_running" data-toggle="tab">Running Loans</a></li>
                  <li class="nav-item"><a class="nav-link" href="#admin_grp_ln_complete" data-toggle="tab">Completed Loans</a></li>
                  <li class="nav-item"><a class="nav-link" href="#admin_grp_ln_suspended" data-toggle="tab">Suspended Loans</a></li>
                </ul>
                <!-- <h3 class="card-title">Different Height</h3> -->
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="admin_grp_ln_issue">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Showing Loans Ready For Disbursement</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="overflow-x: scroll;">
                         <table id="example2" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>s/n</th>
                              <th>Loan_Number</th>
                              <th>Group_Code</th>
                              <th>Group_Name</th>
                              <th>Applicant</th>
                              <th>Loan_Approved</th>
                              <th>Total_Loan</th>
                              <th>Security</th>
                              <th>Processing_Fee</th>
                              <th>Loan_Payable</th>
                              <th>Loan_Period(Weeks)</th>
                              <th>Telephone</th>
                              <th>action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1;

                              $loan_approved = null;
                              $total_loan = null;
                              $security = null;
                              $processing_fee = null;
                              $loan_payable = null;

                            ?>
                            @foreach($apps as $app)
                              <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $app->loan_number }}</td>
                                <td>{{ $app->group_code }}</td>
                                <td>{{ $app->group_name }}</td>
                                <td>{{ $app->name }}</td>
                                <td>{{ number_format($app->recommended_amount)}}</td>
                                <td>{{ number_format($app->total_loan)}}</td>
                                <td>{{ number_format($app->security)}}</td>
                                <td>{{ number_format($app->loan_processing_fee)}}</td>
                                <td>{{ number_format($app->loan_amount_issued)}}</td>
                                <td>{{ $app->loan_period}}</td>
                                <td>{{ $app->telephone }}</td>
                                <td><a href="#"><button class="btn btn-outline-primary">View</button></a></td>

                                <?php

                                  $loan_approved += $app->recommended_amount;
                                  $total_loan += $app->total_loan;
                                  $security += $app->security;
                                  $processing_fee += $app->loan_processing_fee;
                                  $loan_payable += $app->loan_amount_issued;

                                ?>

                              </tr>
                            <?php $i++;?>
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                              <th colspan="5">Total</th>
                              <th>{{ number_format($loan_approved) }}</th>
                              <th>{{ number_format($total_loan) }}</th>
                              <th>{{ number_format($security) }}</th>
                              <th>{{ number_format($processing_fee) }}</th>
                              <th>{{ number_format($loan_payable) }}</th>
                              <th></th>
                              <th></th>
                              <th></th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!-- tab-pane -->
                  <div class="tab-pane" id="admin_grp_ln_running">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Showing Running Loans</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="overflow-x: scroll;">
                         <table id="example6" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>S/N</th>
                              <th>loan_Number</th>
                              <th>Group_Code</th>
                              <th>Group_Name</th>
                              <th>Applicant</th>
                              <th>loan_disbursed</th>
                              <th>Interest</th>
                              <th>total_loan</th>
                              <th>Security_withheld</th> 
                              <th>loan_Recovered</th>
                              <th>Loan_Outstanding</th>
                              <th>Start_date</th>
                              <th>End_date</th>
                              <th>Telephone</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1;

                            $loan_disbursed = null;

                            $loan_interest = null;

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
                                <td>{{ $run->name }}</td>
                                <td>{{ number_format($run->recommended_amount) }}</td>
                                <td>{{ number_format($run->loan_interest) }}</td>
                                <td>{{ number_format($run->total_loan) }}</td>
                                <td>{{ number_format($run->security) }}</td>
                                <td>{{ number_format($run->loan_recovered) }}</td>
                                <td>{{ number_format($run->loan_balance) }}</td>  
                                <td>{{ date('Y-m-d', strtotime($run->start_date)) }}</td>
                                <td>{{ date('Y-m-d',strtotime($run->end_date)) }}</td>
                                <td>{{ $run->telephone }}</td>
                                <td><a href="/apply/view/profile/{{$run->id_client}}"><button class="btn btn-outline-primary btn-sm">View</button></a></td>

                                <?php

                                $loan_disbursed += $run->recommended_amount;

                                $loan_interest += $run->loan_interest;

                                $total_loan += $run->total_loan;

                                $loan_security += $run->security;

                                $loan_recovered += $run->loan_recovered;

                                $loan_outstanding += $run->loan_balance;

                                ?>

                              </tr>
                            <?php $i++;?>
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
                            <th></th>
                          </tr>
                        </tfoot>
                        </table>
                      </div>
                    </div>
                    <!-- card -->
                  </div>
                  <!-- tab-pane -->
                  <div class="tab-pane" id="admin_grp_ln_complete">
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
                              <th>loan_number</th>
                              <th>group_Code</th>
                              <th>group_name</th>
                              <th>Applicant</th>
                              <th>loan_disbursed</th>
                              <th>Interest</th>
                              <th>total_Loan</th>
                              <th>Security_withheld</th>
                              <th>loan_Recovered</th>
                              <th>loan_outstanding</th>
                              <th>Start_date</th>
                              <th>End_date</th>
                              <th>Telephone</th>
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
                                <td>{{ $complete->name }}</td>
                                <td>{{ number_format($complete->recommended_amount) }}</td>
                                <td>{{ number_format($complete->loan_interest) }}</td>
                                <td>{{ number_format($complete->total_loan) }}</td>
                                <td>{{ number_format($complete->security) }}</td>
                                <td>{{ number_format($complete->loan_recovered) }}</td>
                                <td>{{ number_format($complete->loan_balance) }}</td>
                                <td>{{ date('Y-m-d', strtotime($complete->start_date)) }}</td>
                                <td>{{ date('Y-m-d',strtotime($complete->end_date)) }}</td>
                                <td>{{ $complete->telephone }}</td>
                                <td><a href="/apply/view/profile/{{$complete->id_client}}"><button class="btn btn-outline-primary btn-sm">View</button></a></td>
                              </tr>
                            <?php $i++;?>
                            @endforeach
                        </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- card -->
                  </div>
                  <!-- tab-pane -->
                  <div class="tab-pane" id="admin_grp_ln_suspended">
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
                              <th>Loan_Number</th>
                              <th>Group_Code</th>
                              <th>Group_Name</th>
                              <th>Applicant</th>
                              <th>loan_disbursed</th>
                              <th>Interest</th>
                              <th>Total_loan</th>
                              <th>Security_withheld</th>
                              <th>Loan_Recovered</th>
                              <th>Loan_outstanding</th>
                              <th>Start_date</th>
                              <th>End_date</th>
                              <th>Telephone</th>
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
                                <td>{{ $suspend->telephone }}</td>
                                <td><a href="/apply/view/profile/{{$suspend->id_client}}"><button class="btn btn-outline-primary btn-sm">View</button></a></td>
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
              <!-- card-body -->
            </div>
            <!-- card -->
          </div>
          <!-- col-12 -->
        </div>
        <!-- row -->
      </div>
      <!-- container-fluid -->
    </div>
    <!-- content -->
  </div>
  <!-- content-wrapper -->
  @endsection
