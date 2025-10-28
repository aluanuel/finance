@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Performance Loan Groups</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Metrics</a></li>
              <li class="breadcrumb-item active">Performance Loan Groups</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $heading }}</h3>
                <div class="card-tools">
                  <form action="/apply/metrics/group/loans/" method="post">
                    @csrf
                    <div class="row">
                      <div class="form-group mr-2">
                        <div class="input-group mb-3">
                          <select class="form-control select2bs4" style="width: auto;" id="inputGroupSelect2" name="calendar_day" data-placeholder="Select day" required>
                            <option></option>
                            <option>Monday</option>
                            <option>Tuesday</option>
                            <option>Wednesday</option>
                            <option>Thursday</option>
                            <option>Friday</option>
                            <option>Saturday</option>
                            <option>Entire week</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group mr-2">
                        <div class="input-group mb-3">
                          <select class="form-control select2bs4" style="width: auto;" id="inputGroupSelect02" name="period" data-placeholder="Select week" required>
                            <option></option>
                            @foreach($weekly_calendar as $week)
                            <option>{{ $week['period'] }}</option>
                            @endforeach
                          </select>
                          <input type="submit" name="submit" class="btn btn-sm btn-default btn-flat" value="Search">
                        </div>

                      </div>
                      <!-- <input type="submit" name="submit" class="btn btn-sm btn-default ml-1" value="Search"> -->
                    </div>
                  </form>
                </div>
              </div>
              <div class="card-body">
                    <div class="table-responsive">
                      <table id="example1" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>name</th>
                            <th>target_recovery</th>
                            <th>deficit_target_recovery</th>
                            <th>actual_recovery</th>
                            <th>calendar_day</th>
                            <th>credit_officer</th>
                          </tr>
                        </thead>
                        <tbody>
                    @php $tue_target=0; $tue_actual = 0;  @endphp
                    @foreach($disbursement as $mon)
                      <tr>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ $mon['group_name'] }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ number_format($mon['target_recovery']) }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ number_format($mon['balance_recent_target_recovery']) }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ number_format($mon['actual_recovery']) }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ $mon['recovery_day'] }}</a></td>
                        <td><a href="/apply/metrics/group/single_loan_group/{{ $mon['id']}}">{{ $mon['lead_credit_officer'] }}</a></td>
                      </tr>
                      @php
                        $tue_target += $mon['target_recovery'];
                        $tue_actual += $mon['actual_recovery'];
                      @endphp
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Total</th>
                      <th>{{ number_format($tue_target) }}</th>
                      <th>{{ number_format($tue_actual) }}</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot> 
                      </table>
                    </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- container-fluid -->
    </div>
    <!-- content -->
  </div>
@endsection