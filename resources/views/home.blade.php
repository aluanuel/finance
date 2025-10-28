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
        <div class="card card-gray">
          <div class="card-header">
            <h3 class="card-title text-uppercase">weekly loan recovery schedule</h3>
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
              <div class="col-md-6 col-sm-12 table-responsive">
                <h6 class="text-center text-info text-uppercase">{{ $day_one_of_week }}</h6>
                <table class="table table-bordered table-hover" id="example9">
                  <thead class="text-uppercase">
                    <tr>
                      <th>group_name</th>
                      <th>target_recovery</th>
                      <th>actual_recovery</th>
                      <th>credit_officer</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $mon_target=0; $mon_actual = 0; $mon_deficit = 0; @endphp
                    @foreach($monday_disbursement as $mon)
                      <tr>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ $mon['group_name'] }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ number_format($mon['target_recovery']) }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ number_format($mon['actual_recovery']) }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ $mon['lead_credit_officer'] }}</a></td>
                      </tr>
                      @php
                        $mon_target += $mon['target_recovery'];
                        $mon_actual += $mon['actual_recovery'];
                        $mon_deficit += $mon['recent_deficit'];
                      @endphp
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td><a href="/apply/metrics/group/loans/" class="text-danger">* Deficit in target</a></td>
                      <td><a href="/apply/metrics/group/loans/">{{ number_format($mon_deficit) }}</a></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <th>{{ number_format($mon_target + $mon_deficit) }}</th>
                      <th>{{ number_format($mon_actual) }}</th>
                      <th></th>
                    </tr>
                  </tfoot> 
                </table>
              </div>
              <div class="col-md-6 col-sm-12 table-responsive">
                <h6 class="text-center text-info text-uppercase">{{ $day_two_of_week }}</h6>
                <table class="table table-bordered table-hover" id="example10">
                  <thead class="text-uppercase">
                    <tr>
                      <th>group_name</th>
                      <th>target_recovery</th>
                      <th>actual_recovery</th>
                      <th>credit_officer</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $tue_target=0; $tue_actual = 0; $tue_deficit = 0;  @endphp
                    @foreach($tuesday_disbursement as $mon)
                      <tr>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ $mon['group_name'] }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ number_format($mon['target_recovery']) }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ number_format($mon['actual_recovery']) }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ $mon['lead_credit_officer'] }}</a></td>
                      </tr>
                      @php
                        $tue_target += $mon['target_recovery'];
                        $tue_actual += $mon['actual_recovery'];
                        $tue_deficit +=$mon['recent_deficit'];
                      @endphp
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td><a href="/apply/metrics/group/loans/" class="text-danger">* Deficit in target</a></td>
                      <td><a href="/apply/metrics/group/loans/">{{ number_format($tue_deficit) }}</a></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <th>{{ number_format($tue_target + $tue_deficit) }}</th>
                      <th>{{ number_format($tue_actual) }}</th>
                      <th></th>
                    </tr>
                  </tfoot> 
                </table>
              </div>
            </div>
            <!-- row -->
            <div class="row">
              <div class="col-md-6 col-sm-12 table-responsive">
                <h6 class="text-center text-info text-uppercase">{{ $day_three_of_week }}</h6>
                <table class="table table-bordered table-hover" id="example11">
                  <thead class="text-uppercase">
                    <tr>
                      <th>group_name</th>
                      <th>target_recovery</th>
                      <th>actual_recovery</th>
                      <th>credit_officer</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $wed_target =0; $wed_actual = 0; $wed_deficit = 0;  @endphp
                    @foreach($wednesday_disbursement as $mon)
                      <tr>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ $mon['group_name'] }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ number_format($mon['target_recovery']) }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ number_format($mon['actual_recovery']) }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ $mon['lead_credit_officer'] }}</a></td>
                      </tr>
                      @php
                        $wed_target += $mon['target_recovery'];
                        $wed_actual += $mon['actual_recovery'];
                        $wed_deficit +=$mon['recent_deficit'];
                      @endphp
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td><a href="/apply/metrics/group/loans/" class="text-danger">* Deficit in target</a></td>
                      <td><a href="/apply/metrics/group/loans/">{{ number_format($wed_deficit) }}</a></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <th>{{ number_format($wed_target + $wed_deficit) }}</th>
                      <th>{{ number_format($wed_actual) }}</th>
                      <th></th>
                    </tr>
                  </tfoot>  
                </table>
              </div>
              <div class="col-md-6 col-sm-12 table-responsive">
                <h6 class="text-center text-info text-uppercase">{{ $day_four_of_week }}</h6>
                <table class="table table-bordered table-hover" id="example12">
                  <thead class="text-uppercase">
                    <tr>
                      <th>group_name</th>
                      <th>target_recovery</th>
                      <th>actual_recovery</th>
                      <th>credit_officer</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $thur_target =0; $thur_actual = 0; $thur_deficit = 0;  @endphp
                    @foreach($thursday_disbursement as $mon)
                      <tr>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ $mon['group_name'] }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ number_format($mon['target_recovery']) }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ number_format($mon['actual_recovery']) }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ $mon['lead_credit_officer'] }}</a></td>
                      </tr>
                      @php
                        $thur_target += $mon['target_recovery'];
                        $thur_actual += $mon['actual_recovery'];
                        $thur_deficit +=$mon['recent_deficit'];
                      @endphp
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td><a href="/apply/metrics/group/loans/" class="text-danger">* Deficit in target</a></td>
                      <td><a href="/apply/metrics/group/loans/">{{ number_format($thur_deficit) }}</a></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <th>{{ number_format($thur_target + $thur_deficit) }}</th>
                      <th>{{ number_format($thur_actual) }}</th>
                      <th></th>
                    </tr>
                  </tfoot>   
                </table>
              </div>
            </div>
            <!-- row -->
            <div class="row">
              <div class="col-md-6 col-sm-12 table-responsive">
                <h6 class="text-center text-info text-uppercase">{{ $day_five_of_week }}</h6>
                <table class="table table-bordered table-hover" id="example2">
                  <thead class="text-uppercase">
                    <tr>
                      <th>group_name</th>
                      <th>target_recovery</th>
                      <th>actual_recovery</th>
                      <th>credit_officer</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $fri_target =0; $fri_actual = 0; $fri_deficit = 0;  @endphp
                    @foreach($friday_disbursement as $mon)
                      <tr>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ $mon['group_name'] }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ number_format($mon['target_recovery']) }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ number_format($mon['actual_recovery']) }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ $mon['lead_credit_officer'] }}</a></td>
                      </tr>
                      @php
                        $fri_target += $mon['target_recovery'];
                        $fri_actual += $mon['actual_recovery'];
                        $fri_deficit +=$mon['recent_deficit'];
                      @endphp
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td><a href="/apply/metrics/group/loans/" class="text-danger">* Deficit in target</a></td>
                      <td><a href="/apply/metrics/group/loans/">{{ number_format($fri_deficit) }}</a></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <th>{{ number_format($fri_target + $fri_deficit) }}</th>
                      <th>{{ number_format($fri_actual) }}</th>
                      <th></th>
                    </tr>
                  </tfoot> 
                </table>
              </div>
              <div class="col-md-6 col-sm-12 table-responsive">
                <h6 class="text-center text-info text-uppercase">{{ $day_six_of_week }}</h6>
                <table class="table table-bordered table-hover" id="example8">
                  <thead class="text-uppercase">
                    <tr>
                      <th>group_name</th>
                      <th>target_recovery</th>
                      <th>actual_recovery</th>
                      <th>credit_officer</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $sat_target =0; $sat_actual = 0; $sat_deficit = 0;  @endphp
                    @foreach($saturday_disbursement as $mon)
                      <tr>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ $mon['group_name'] }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ number_format($mon['target_recovery']) }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ number_format($mon['actual_recovery']) }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ $mon['lead_credit_officer'] }}</a></td>
                      </tr>
                      @php
                        $sat_target += $mon['target_recovery'];
                        $sat_actual += $mon['actual_recovery'];
                        $sat_deficit +=$mon['recent_deficit'];
                      @endphp
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td><a href="/apply/metrics/group/loans/" class="text-danger">* Deficit in target</a></td>
                      <td><a href="/apply/metrics/group/loans/">{{ number_format($sat_deficit) }}</a></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <th>{{ number_format($sat_target + $sat_deficit) }}</th>
                      <th>{{ number_format($sat_actual) }}</th>
                      <th></th>
                    </tr>
                  </tfoot>     
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
