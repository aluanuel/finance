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

            <div class="row">
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-white">
                  <div class="inner">
                    <h3>{{number_format($individualLoans)}} <span style="font-size: 18px">Running Individual Loans</span></h3>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="/apply/view" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-white">
                  <div class="inner">
                    <h3>{{number_format($groupLoans)}} <span style="font-size: 18px">Running Group Loans</span></h3>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="/apply/view" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-white">
                  <div class="inner">
                    <h3>{{number_format($groups)}} <span style="font-size: 18px">Active Loan Groups</span></h3>

                    <p>{{number_format($groupClients)}} Group Members</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="/apply/settings/groups" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{number_format($groups)}} <span style="font-size: 18px">Pending Tasks</span></h3>

                    <p>Today</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="/apply/settings/groups" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-gray">
                  <div class="inner">
                    <h3>{{number_format($individualLoans)}} <span style="font-size: 18px">Loan Disbursements</span></h3>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="/apply/view" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-gray">
                  <div class="inner">
                    <h3>{{number_format($groupLoans)}} <span style="font-size: 18px">Loan Recovery</span></h3>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="/apply/view" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>{{number_format($groups)}} <span style="font-size: 18px">Loan Overdue</span></h3>

                    <p>{{number_format($groupClients)}} Group Members</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  @if(Auth::user()->usertype == 'Manager')
                  <a href="/apply/settings/groups" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  @else
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  @endif
                </div>
              </div>
              <!-- ./col -->
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-gray">
                  <div class="inner">
                    <h3>{{number_format($groups)}} <span style="font-size: 18px">Loan Outstandings</span></h3>

                    <p>{{number_format($groupClients)}} Group Members</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  @if(Auth::user()->usertype == 'Manager')
                  <a href="/apply/settings/groups" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  @else
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  @endif
                </div>
              </div>
              <!-- ./col -->
            </div>
            <!-- /.row -->

          @break

          @case('Teller')

            <div class="row">
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{number_format($individualLoans)}} <span style="font-size: 18px">Application Fee</span></h3>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="/apply/view" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{number_format($groupLoans)}} <span style="font-size: 18px">Appraisal Fee</span></h3>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="/apply/view" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{number_format($groups)}} <span style="font-size: 18px">Processing Fee</span></h3>

                    <p>{{number_format($groupClients)}} Group Members</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="/apply/settings/groups" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{number_format($groups)}} <span style="font-size: 18px">Pending Tasks</span></h3>

                    <p>Today</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="/apply/settings/groups" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-gray">
                  <div class="inner">
                    <h3>{{number_format($individualLoans)}} <span style="font-size: 18px">Loan Disbursements</span></h3>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="/apply/view" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-gray">
                  <div class="inner">
                    <h3>{{number_format($groupLoans)}} <span style="font-size: 18px">Loan Recovery</span></h3>

                    <p>This Month</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="/apply/view" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>{{number_format($groups)}} <span style="font-size: 18px">Loan Overdue</span></h3>

                    <p>{{number_format($groupClients)}} Group Members</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  @if(Auth::user()->usertype == 'Manager')
                  <a href="/apply/settings/groups" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  @else
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  @endif
                </div>
              </div>
              <!-- ./col -->
              <div class="col-3">
                <!-- small box -->
                <div class="small-box bg-gray">
                  <div class="inner">
                    <h3>{{number_format($groups)}} <span style="font-size: 18px">Loan Outstandings</span></h3>

                    <p>{{number_format($groupClients)}} Group Members</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  @if(Auth::user()->usertype == 'Manager')
                  <a href="/apply/settings/groups" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  @else
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  @endif
                </div>
              </div>
              <!-- ./col -->
            </div>

          @break

          @case('Manager')

        @endswitch
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
