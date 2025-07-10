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
          <div class="col-md-4 col-sm-12">
            <a href="/apply/report/disbursements/{{ date('m')}}">
                <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h5>UGX {{ number_format($disbursement) }} &nbsp; <small class="text-uppercase">disbursements</small></h5>
                  <p class="pt-4"><small>{{ $month }}</small></p>
                </div>
              </div>
            </a>
          </div>
          <!-- col-4 -->
          <div class="col-md-4 col-sm-12">
            <a href="/apply/report/loan-recovery/{{ date('m')}}">
                <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h5>UGX {{ number_format($recovery) }} &nbsp; <small class="text-uppercase">loan recovery</small></h5>
                  <p class="pt-4"><small>{{ $month }}</small></p>
                </div>
              </div>
            </a>
          </div>
          <!-- col-4 -->
          <div class="col-md-4 col-sm-12">
            <a href="/apply/report/loans-fully-settled/{{ date('m')}}">
                <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h5>UGX {{ number_format($expense) }} &nbsp; <small class="text-uppercase">Expenditure</small></h5>
                  <p class="pt-4"><small>{{ $month }}</small></p>
                </div>
              </div>
            </a>
          </div>
          <!-- col-4 -->
        </div>
        <!-- row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
