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
        <div class="card card-purple">
          <div class="card-header">
            <h3 class="card-title text-uppercase">weekly loan recovery schedule</h3>
            <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 col-sm-12 table-responsive">
                <h6 class="text-center text-info text-uppercase">Monday</h6>
                <table class="table table-bordered table-hover bg-dark">
                  <thead class="text-uppercase">
                    <tr>
                      <th class="text-white">group_name</th>
                      <th class="text-white">target_recovery</th>
                      <th class="text-white">actual_recovery</th>
                      <th class="text-white">credit_officer</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($monday_disbursement as $mon)
                      <tr>
                        <td>{{ $mon['group_name'] }}</td>
                        <td>{{ number_format($mon['target_recovery']) }}</td>
                        <td>{{ number_format($mon['actual_recovery']) }}</td>
                        <td>{{ $mon['lead_credit_officer'] }}</td>
                      </tr>
                    @endforeach
                  </tbody>  
                </table>
              </div>
              <div class="col-md-6 col-sm-12 table-responsive">
                <h6 class="text-center text-info text-uppercase">tuesday</h6>
                <table class="table table-bordered table-hover bg-dark">
                  <thead class="text-uppercase">
                    <tr>
                      <th class="text-white">group_name</th>
                      <th class="text-white">target_recovery</th>
                      <th class="text-white">actual_recovery</th>
                      <th class="text-white">credit_officer</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($tuesday_disbursement as $mon)
                      <tr>
                        <td>{{ $mon['group_name'] }}</td>
                        <td>{{ number_format($mon['target_recovery']) }}</td>
                        <td>{{ number_format($mon['actual_recovery']) }}</td>
                        <td>{{ $mon['lead_credit_officer'] }}</td>
                      </tr>
                    @endforeach
                  </tbody>  
                </table>
              </div>
            </div>
            <!-- row -->
            <div class="row">
              <div class="col-md-6 col-sm-12 table-responsive">
                <h6 class="text-center text-info text-uppercase">wednesday</h6>
                <table class="table table-bordered table-hover bg-dark">
                  <thead class="text-uppercase">
                    <tr>
                      <th class="text-white">group_name</th>
                      <th class="text-white">target_recovery</th>
                      <th class="text-white">actual_recovery</th>
                      <th class="text-white">credit_officer</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($wednesday_disbursement as $mon)
                      <tr>
                        <td>{{ $mon['group_name'] }}</td>
                        <td>{{ number_format($mon['target_recovery']) }}</td>
                        <td>{{ number_format($mon['actual_recovery']) }}</td>
                        <td>{{ $mon['lead_credit_officer'] }}</td>
                      </tr>
                    @endforeach
                  </tbody>  
                </table>
              </div>
              <div class="col-md-6 col-sm-12 table-responsive">
                <h6 class="text-center text-info text-uppercase">thursday</h6>
                <table class="table table-bordered table-hover bg-dark">
                  <thead class="text-uppercase">
                    <tr>
                      <th class="text-white">group_name</th>
                      <th class="text-white">target_recovery</th>
                      <th class="text-white">actual_recovery</th>
                      <th class="text-white">credit_officer</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($thursday_disbursement as $mon)
                      <tr>
                        <td>{{ $mon['group_name'] }}</td>
                        <td>{{ number_format($mon['target_recovery']) }}</td>
                        <td>{{ number_format($mon['actual_recovery']) }}</td>
                        <td>{{ $mon['lead_credit_officer'] }}</td>
                      </tr>
                    @endforeach
                  </tbody>   
                </table>
              </div>
            </div>
            <!-- row -->
            <div class="row">
              <div class="col-md-6 col-sm-12 table-responsive">
                <h6 class="text-center text-info text-uppercase">friday</h6>
                <table class="table table-bordered table-hover bg-dark border-white">
                  <thead class="text-uppercase">
                    <tr>
                      <th class="text-white">group_name</th>
                      <th class="text-white">target_recovery</th>
                      <th class="text-white">actual_recovery</th>
                      <th class="text-white">credit_officer</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($friday_disbursement as $mon)
                      <tr>
                        <td>{{ $mon['group_name'] }}</td>
                        <td>{{ number_format($mon['target_recovery']) }}</td>
                        <td>{{ number_format($mon['actual_recovery']) }}</td>
                        <td>{{ $mon['lead_credit_officer'] }}</td>
                      </tr>
                    @endforeach
                  </tbody> 
                </table>
              </div>
              <div class="col-md-6 col-sm-12 table-responsive">
                <h6 class="text-center text-info text-uppercase">Saturday</h6>
                <table class="table table-bordered table-hover bg-dark">
                  <thead class="text-uppercase">
                    <tr>
                      <th class="text-white">group_name</th>
                      <th class="text-white">target_recovery</th>
                      <th class="text-white">actual_recovery</th>
                      <th class="text-white">credit_officer</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($friday_disbursement as $mon)
                      <tr>
                        <td>{{ $mon['group_name'] }}</td>
                        <td>{{ number_format($mon['target_recovery']) }}</td>
                        <td>{{ number_format($mon['actual_recovery']) }}</td>
                        <td>{{ $mon['lead_credit_officer'] }}</td>
                      </tr>
                    @endforeach
                  </tbody>    
                </table>
              </div>
            </div>
            <!-- row -->
          </div>
        </div>
            <!-- card -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
