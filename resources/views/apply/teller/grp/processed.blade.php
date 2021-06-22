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
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#ln_issue" data-toggle="tab">Loans to Issue
                  </a></li>
                  <li class="nav-item"><a class="nav-link" href="#ln_running" data-toggle="tab">Running Loans</a></li>
                  <li class="nav-item"><a class="nav-link" href="#ln_complete" data-toggle="tab">Completed Loans</a></li>
                </ul>
                <!-- <h3 class="card-title">Different Height</h3> -->
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="ln_issue">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Processed loans to be issued</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="overflow-x: scroll;">
                         <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Number</th>
                              <th>Applicant</th>
                              <th>Loan Amount</th>
                              <th>Loan Outstanding</th>
                              <th>Security</th>
                              <th>Loan Payable</th>
                              <th>Period(Months)</th>
                              <th>Telephone</th>
                              <th width="150px">#</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1;?>
                            @foreach($apps as $app)
                              <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $app->loan_number }}</td>
                                <td>{{ $app->name }}</td>
                                <td>{{ number_format($app->recommended_amount)}}</td>
                                <td>{{ number_format($app->total_loan)}}</td>
                                <td>{{ number_format($app->security)}}</td>
                                <td>{{ number_format($app->loan_amount_issued)}}</td>
                                <td>{{ $app->loan_period}}</td>
                                <td>{{ $app->telephone }}</td>
                                <td>
                                  <form action="/apply/teller/process/{{$app->id}}" method="post">
                                    @csrf
                                    <input type="hidden" name="loan_period" value="{{ $app->loan_period }}">
                                    <button class="btn btn-outline-primary">Issue & start</button>
                                  </form>
                                </td>
                              </tr>
                            <?php $i++;?>
                            @endforeach
                          </tbody>

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
                        <h3 class="card-title">Running Loans</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="overflow-x: scroll;">
                         <table id="example3" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th style="width: 12px;">#</th>
                              <th style="width: 30px;">Number</th>
                              <th>Applicant</th>
                              <th>Loan Amount</th>
                              <th>Interest</th>
                              <th>Loan Outstanding</th>
                              <th>Security</th>
                              <th>Start</th>
                              <th>End</th>
                              <th>Recovered</th>
                              <th>Balance</th>
                              <th>Telephone</th>
                              <th style="width: 80px;">#</th>
                            </tr>
                          </thead>
                         <tbody>
                            <?php $i = 1;?>
                            @foreach($running as $run)
                              <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $run->loan_number }}</td>
                                <td>{{ $run->name }}</td>
                                <td>{{ number_format($run->recommended_amount) }}</td>
                                <td>{{ number_format($run->loan_interest) }}</td>
                                <td>{{ number_format($run->total_loan) }}</td>
                                <td>{{ number_format($run->security) }}</td>
                                <td>{{ date('Y-m-d', strtotime($run->start_date)) }}</td>
                                <td>{{ date('Y-m-d',strtotime($run->end_date)) }}</td>
                                <td>{{ number_format($run->loan_recovered) }}</td>
                                <td>{{ number_format($run->loan_balance) }}</td>
                                <td>{{ $run->telephone }}</td>
                                <td><a href="/apply/teller/trans/{{$run->id}}"><button class="btn btn-outline-primary">Pay</button></a></td>
                              </tr>
                            <?php $i++;?>
                            @endforeach
                        </tbody>

                      </table>
                    </div>
                    <!-- /.card-body -->
                    </div>
                  </div>
                  <!-- tab-pane -->
                  <div class="tab-pane" id="ln_complete">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Completed Loans</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="overflow-x: scroll;">
                         <table id="example4" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th style="width: 12px;">#</th>
                              <th style="width: 30px;">Number</th>
                              <th>Applicant</th>
                              <th>Loan Amount</th>
                              <th>Interest</th>
                              <th>Loan Outstanding</th>
                              <th>Security</th>
                              <th>Start</th>
                              <th>End</th>
                              <th>Recovered</th>
                              <th>Balance</th>
                              <th>Telephone</th>
                              <th>#</th>
                            </tr>
                          </thead>
                         <tbody>
                            <?php $i = 1;?>
                            @foreach($completed as $complete)
                              <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $complete->loan_number }}</td>
                                <td>{{ $complete->name }}</td>
                                <td>{{ number_format($complete->recommended_amount) }}</td>
                                <td>{{ number_format($complete->loan_interest) }}</td>
                                <td>{{ number_format($complete->total_loan) }}</td>
                                <td>{{ number_format($complete->security) }}</td>
                                <td>{{ date('Y-m-d', strtotime($complete->start_date)) }}</td>
                                <td>{{ date('Y-m-d',strtotime($complete->end_date)) }}</td>
                                <td>{{ number_format($complete->loan_recovered) }}</td>
                                <td>{{ number_format($complete->loan_balance) }}</td>
                                <td>{{ $complete->telephone }}</td>
                                @if($complete->security > 0)
                                <td><a href="/apply/teller/trans/security/{{$complete->id}}"><button class="btn btn-outline-primary">Return</button></a></td>
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