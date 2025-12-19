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
                  <h5> {{ number_format($completed) }} &nbsp; <small class="text-uppercase">Loans fully settled</small></h5>
                  <p class="pt-4"><small>{{ $month }}</small></p>
                </div>
              </div>
            </a>
          </div>
          <!-- col-4 -->
        </div>
        <!-- row -->
        <div class="card">
          <div class="card-header">
            <!-- <div class="d-flex justify-content-center pb-3"> -->
              <h6 class="card-title text-uppercase text-success">loan recovery schedule for {{ $day_one_of_week }}</h6>
            <!-- </div> -->
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover" id="example9">
                    <thead class="text-uppercase">
                      <tr class="text-center">
                        <th colspan="5" class="text-muted">running loans</th>
                      </tr>
                      <tr>
                        <th>group_name</th> 
                        <th>target_recovery</th>
                        <th>cumm_deficit</th>
                        <th>actual_recovery</th> 
                        <th>credit_officer</th>                
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($monday_running_loans as $mon)
                      <tr>
                        <td>{{ $mon['group_name'] }}</td>
                        <td>{{ number_format($mon['target_recovery_running_loan']) }}</td>
                        <td>{{ number_format($mon['deficit_loan_recovery_running_loan']) }}</td>
                        <td>{{ number_format($mon['actual_recovery_running_loan']) }}</td>
                        <td>{{ $mon['lead_credit_officer'] }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- col-md-6               -->
               
            </div>
          </div>
        </div>
        <!-- card -->
        <div class="card">
          <div class="card-header">
            <!-- <div class="d-flex justify-content-center pb-3"> -->
              <h6 class="card-title text-uppercase text-success">loan recovery schedule for {{ $day_two_of_week }}</h6>
            <!-- </div> -->
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover" id="example9">
                    <thead class="text-uppercase">
                      <tr class="text-center">
                        <th colspan="5" class="text-muted">running loans</th>
                      </tr>
                      <tr>
                        <th>group_name</th> 
                        <th>target_recovery</th>
                        <th>cumm_deficit</th>
                        <th>actual_recovery</th> 
                        <th>credit_officer</th>                
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($tuesday_running_loans as $mon)
                      <tr>
                        <td>{{ $mon['group_name'] }}</td>
                        <td>{{ number_format($mon['target_recovery_running_loan']) }}</td>
                        <td>{{ number_format($mon['deficit_loan_recovery_running_loan']) }}</td>
                        <td>{{ number_format($mon['actual_recovery_running_loan']) }}</td>
                        <td>{{ $mon['lead_credit_officer'] }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- col-md-6               -->
               
            </div>
          </div>
        </div>
        <!-- card -->
        <!-- card -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
