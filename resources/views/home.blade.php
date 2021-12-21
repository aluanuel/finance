@extends('layouts.custom')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @include('layouts.flash')
        <!-- Small boxes (Stat box) -->
        @switch(Auth::user()->usertype)

          @case('Loan Officer')

            @if(Auth::user()->category == 'Individual')

              @switch(Auth::user()->role)

                @case('None')

                  <div class="row">
                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-white">
                        <div class="inner">
                          <h3>{{number_format($individual_loan_application)}} <span style="font-size: 18px">Loan Applications</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                        <a href="/apply/ind/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3>{{number_format($individual_loan_approval)}} <span style="font-size: 18px">Loans Approved</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/apply/ind/assess" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3>{{number_format($individual_loan_cancelled)}} <span style="font-size: 18px">Loans Cancelled</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="/apply/ind/assess" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3>{{number_format($individual_loan_running)}} <span style="font-size: 18px">Loans Running</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="/apply/ind/processed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                  <div class="row">
                    <div class="col-4">
                      <!-- small box -->
                      <div class="small-box bg-gray">
                        <div class="inner">
                          <h3>{{number_format($individual_loan_payout)}} <span style="font-size: 18px">Loan Payouts</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                        <a href="/apply/report/loan/payout/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-4">
                      <!-- small box -->
                      <div class="small-box bg-gray">
                        <div class="inner">
                          <h3>{{number_format($individual_loan_outstanding)}} <span style="font-size: 18px">Loan Outstandings</span></h3>

                          <p>Cumulative</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/apply/report/loan/outstanding/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-4">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3>{{number_format($individual_loan_defaulted)}} <span style="font-size: 18px">Loans Defaulted</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="/apply/ind/processed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                @break

                @case('Supervisor')

                  <div class="row">
                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-white">
                        <div class="inner">
                          <h3>{{number_format($sup_individual_loan_application)}} <span style="font-size: 18px">Loan Applications</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                        <a href="/apply/ind/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3>{{number_format($sup_individual_loan_approval)}} <span style="font-size: 18px">Loans Approved</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/apply/ind/assess" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3>{{number_format($sup_individual_loan_cancelled)}} <span style="font-size: 18px">Loans Cancelled</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="/apply/ind/assess" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3>{{number_format($sup_individual_loan_running)}} <span style="font-size: 18px">Loans Running</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="/apply/ind/processed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                  <div class="row">
                    <div class="col-4">
                      <!-- small box -->
                      <div class="small-box bg-gray">
                        <div class="inner">
                          <h3>{{number_format($sup_individual_loan_payout)}} <span style="font-size: 18px">Loan Payouts</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                        <a href="/apply/report/loan/payout/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-4">
                      <!-- small box -->
                      <div class="small-box bg-gray">
                        <div class="inner">
                          <h3>{{number_format($sup_individual_loan_outstanding)}} <span style="font-size: 18px">Loan Outstandings</span></h3>

                          <p>Cumulative</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/apply/report/loan/outstanding/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-4">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3>{{number_format($sup_individual_loan_defaulted)}} <span style="font-size: 18px">Loans Defaulted</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="/apply/ind/processed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                @break

              @endswitch

            @elseif(Auth::user()->category == 'Group')

              @switch(Auth::user()->role)

                @case('None')

                  <div class="row">
                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-white">
                        <div class="inner">
                          <h3>{{number_format($group_loan_application)}} <span style="font-size: 18px">Loan Applications</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                        <a href="/apply/grp/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3>{{number_format($group_loan_approval)}} <span style="font-size: 18px">Loans Approved</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/apply/grp/assess" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3>{{number_format($group_loan_cancelled)}} <span style="font-size: 18px">Loans Cancelled</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="/apply/grp/assess" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3>{{number_format($group_loan_running)}} <span style="font-size: 18px">Loans Running</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="/apply/grp/processed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                  <div class="row">
                    <div class="col-4">
                      <!-- small box -->
                      <div class="small-box bg-gray">
                        <div class="inner">
                          <h3>{{number_format($group_loan_payout)}} <span style="font-size: 18px">Loan Payouts</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                        <a href="/apply/report/loan/payout/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-4">
                      <!-- small box -->
                      <div class="small-box bg-gray">
                        <div class="inner">
                          <h3>{{number_format($group_loan_outstanding)}} <span style="font-size: 18px">Loan Outstandings</span></h3>

                          <p>Cumulative</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/apply/report/loan/outstanding/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-4">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3>{{number_format($group_loan_defaulted)}} <span style="font-size: 18px">Loans Defaulted</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="/apply/ind/processed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                @break

                @case('Supervisor')

                  <div class="row">
                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-white">
                        <div class="inner">
                          <h3>{{number_format($sup_group_loan_application)}} <span style="font-size: 18px">Loan Applications</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                        <a href="/apply/ind/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3>{{number_format($sup_group_loan_approval)}} <span style="font-size: 18px">Loans Approved</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/apply/ind/assess" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3>{{number_format($sup_group_loan_cancelled)}} <span style="font-size: 18px">Loans Cancelled</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="/apply/ind/assess" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-3">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3>{{number_format($sup_group_loan_running)}} <span style="font-size: 18px">Loans Running</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="/apply/ind/processed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                  <div class="row">
                    <div class="col-4">
                      <!-- small box -->
                      <div class="small-box bg-gray">
                        <div class="inner">
                          <h3>{{number_format($sup_group_loan_payout)}} <span style="font-size: 18px">Loan Payouts</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                        <a href="/apply/report/loan/payout/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-4">
                      <!-- small box -->
                      <div class="small-box bg-gray">
                        <div class="inner">
                          <h3>{{number_format($sup_group_loan_outstanding)}} <span style="font-size: 18px">Loan Outstandings</span></h3>

                          <p>Cumulative</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/apply/report/loan/outstanding/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-4">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3>{{number_format($sup_group_loan_defaulted)}} <span style="font-size: 18px">Loans Defaulted</span></h3>

                          <p>This Month</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="/apply/ind/processed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                @break
                
              @endswitch

            @endif

            

          @break

          @case('Teller')

            <div class="row">
              <div class="col-3">
                  <div class="small-box bg-black">
                    <div class="inner">
                              <h3>{{number_format($individualClients)}} <span style="font-size: 18px">Individual Accounts</span></h3>

                      <p>Cumulative</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="/apply/admin/ind/accounts" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-3">
                  <div class="small-box bg-black">
                    <div class="inner">
                              <h3>{{number_format($groupClients)}} <span style="font-size: 18px">Group Accounts</span></h3>

                      <p>Cumulative</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="/apply/admin/grp/accounts" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h4>{{number_format($application)}} <span style="font-size: 18px">Application Fee</span></h4>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="/apply/report/collections/application" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h4>{{number_format($appraisal)}} <span style="font-size: 18px">Appraisal Fee</span></h4>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="/apply/report/collections/appraisal/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h4>{{number_format($processing)}} <span style="font-size: 18px">Processing Fee</span></h4>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="/apply/report/collections/procesing" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h4>{{number_format($disburse)}} <span style="font-size: 18px">Loan Disbursements</span></h4>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="/apply/report/loan/disbursements" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-gray">
                  <div class="inner">
                    <h4>{{number_format($expenses)}} <span style="font-size: 18px">Expenses</span></h4>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="/apply/report/expenses" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-gray">
                  <div class="inner">
                    <h4>{{number_format($incomes)}} <span style="font-size: 18px">Incomes</span></h4>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="/apply/report/incomes" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>

          @break

          @case('Manager')

          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Accounts Summary</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <!-- small box -->
                  <div class="small-box bg-primary">
                    <div class="inner">
                              <h3>{{number_format($clients)}} <span style="font-size: 18px">New Clients</span></h3>

                      <p>This Month</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="/apply/admin/accounts" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-3">
                  <div class="small-box bg-black">
                    <div class="inner">
                              <h3>{{number_format($individualClients)}} <span style="font-size: 18px">Individual Accounts</span></h3>

                      <p>Cumulative</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="/apply/admin/ind/accounts" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-3">
                  <div class="small-box bg-black">
                    <div class="inner">
                              <h3>{{number_format($groupClients)}} <span style="font-size: 18px">Group Accounts</span></h3>

                      <p>Cumulative</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="/apply/admin/grp/accounts" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-3">
                  <div class="small-box bg-purple">
                    <div class="inner">
                              <h3>{{number_format($groups)}} <span style="font-size: 18px">Loan Groups</span></h3>

                      <p>Cumulative</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="/apply/settings/groups" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- col -->
              </div>
              <!-- row -->
            </div>
          </div>
          <!-- card -->
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Loan Summary</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="card card-primary">
                    <div class="card-header">
                      <p class="card-title">Individual Loans</p>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <!-- small box -->
                          <div class="small-box bg-white">
                            <div class="inner">
                              <h3>{{number_format($sup_individual_loan_application)}} <span style="font-size: 18px">Loan Applications</span></h3>

                              <p>This Month</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-bag"></i>
                            </div>
                            <a href="/apply/admin/ind/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <div class="col-6">
                          <!-- small box -->
                          <div class="small-box bg-info">
                            <div class="inner">
                              <h3>{{number_format($sup_individual_loan_approval)}} <span style="font-size: 18px">Loans Approved</span></h3>

                              <p>This Month</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="/apply/admin/ind/assess" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-6">
                          <!-- small box -->
                          <div class="small-box bg-warning">
                            <div class="inner">
                              <h3>{{number_format($sup_individual_loan_cancelled)}} <span style="font-size: 18px">Loans Cancelled</span></h3>

                              <p>This Month</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="/apply/admin/ind/assess" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-6">
                          <!-- small box -->
                          <div class="small-box bg-success">
                            <div class="inner">
                              <h3>{{number_format($sup_individual_loan_running)}} <span style="font-size: 18px">Loans Running</span></h3>

                              <p>This Month</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="/apply/admin/processed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                      </div>
                      <!-- /.row -->
                      <div class="row">

                        <div class="col-12">
                          <!-- small box -->
                          <div class="small-box bg-danger">
                            <div class="inner">
                              <h3>{{number_format($sup_individual_loan_defaulted)}} <span style="font-size: 18px">Loans Defaulted</span></h3>

                              <p>This Month</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="/apply/ind/processed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                      </div>
                      <!-- /.row -->
                    </div>
                  </div>
                </div>
                <!-- col-md-6 -->
                <div class="col-md-6">
                  <div class="card card-primary">
                    <div class="card-header">
                      <p class="card-title">Group Loans</p>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <!-- small box -->
                          <div class="small-box bg-white">
                            <div class="inner">
                              <h3>{{number_format($sup_group_loan_application)}} <span style="font-size: 18px">Loan Applications</span></h3>

                              <p>This Month</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-bag"></i>
                            </div>
                            <a href="/apply/admin/grp/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <div class="col-6">
                          <!-- small box -->
                          <div class="small-box bg-info">
                            <div class="inner">
                              <h3>{{number_format($sup_group_loan_approval)}} <span style="font-size: 18px">Loans Approved</span></h3>

                              <p>This Month</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="/apply/admin/grp/assess" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-6">
                          <!-- small box -->
                          <div class="small-box bg-warning">
                            <div class="inner">
                              <h3>{{number_format($sup_group_loan_cancelled)}} <span style="font-size: 18px">Loans Cancelled</span></h3>

                              <p>This Month</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="/apply/admin/grp/assess" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-6">
                          <!-- small box -->
                          <div class="small-box bg-success">
                            <div class="inner">
                              <h3>{{number_format($sup_group_loan_running)}} <span style="font-size: 18px">Loans Running</span></h3>

                              <p>This Month</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="/apply/admin/grp/processed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                      </div>
                      <!-- /.row -->
                      <div class="row">
                        <div class="col-12">
                          <!-- small box -->
                          <div class="small-box bg-danger">
                            <div class="inner">
                              <h3>{{number_format($sup_group_loan_defaulted)}} <span style="font-size: 18px">Loans Defaulted</span></h3>

                              <p>This Month</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="/apply/ind/processed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                      </div>
                      <!-- /.row -->
                    </div>
                  </div>
                </div>
                <!-- col-md-6 -->
              </div>
              <!-- row -->
            </div>
          </div>
          <!-- card -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Finance Summary</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
              <div class="col-4">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h4>{{number_format($application)}} <span style="font-size: 18px">Application Fee</span></h4>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="/apply/report/collections" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-4">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h4>{{number_format($appraisal)}} <span style="font-size: 18px">Appraisal Fee</span></h4>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="/apply/report/collections" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-4">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h4>{{number_format($processing)}} <span style="font-size: 18px">Processing Fee</span></h4>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="/apply/report/collections" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-4">
                <!-- small box -->
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h4>{{number_format($disburse)}} <span style="font-size: 18px">Loan Disbursements</span></h4>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-4">
                <!-- small box -->
                <div class="small-box bg-gray">
                  <div class="inner">
                    <h4>{{number_format($expenses)}} <span style="font-size: 18px">Expenses</span></h4>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="/apply/report/expenses" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-4">
                <!-- small box -->
                <div class="small-box bg-gray">
                  <div class="inner">
                    <h4>{{number_format($incomes)}} <span style="font-size: 18px">Incomes</span></h4>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="/apply/report/incomes" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>
            </div>
          </div>

          @break

        @endswitch
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
