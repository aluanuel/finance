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
        <div class="row">
          <div class="col-4">
            <!-- small box -->
            <div class="small-box bg-info">
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
          <div class="col-4">
            <!-- small box -->
            <div class="small-box bg-success">
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
          <div class="col-4">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{number_format($groups)}} <span style="font-size: 18px">Active Loan Groups</span></h3>

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
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Sales</h3>
                </div>
              </div>
              <div class="card-body">
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="myChart" height="100"></canvas>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
