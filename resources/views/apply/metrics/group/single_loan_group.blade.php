@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan Group Performance</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Metrics</a></li>
              <li class="breadcrumb-item active">Loan Group Performance</li>
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
                  <form action="/apply/metrics/group/single_loan_group/{{$group->id }}" method="post">
                    @csrf
                    <div class="row">
                      <div class="form-group mr-2">
                        <div class="input-group mb-3">
                          <select class="form-control select2bs4" style="width: 8rem;" id="inputGroupSelect01" name="period" data-placeholder="Select category" required>
                            <option></option>
                            <option>Running</option>
                            <option>Defaulted</option>
                          </select>
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
                <div class="row">
                  <div class="col-md-9 col-sm-12">
                    <div class="table-responsive">
                      <table id="example10" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>date</th>
                            <th>name</th>
                            <th>target_recovery</th>
                            <th>cumm_recovery_deficit</th>
                            <th>actual_recovery</th>
                            <th>loan_status</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          @foreach($single_member_loan_details as $recovery)

                            
                            <tr>
                              <td>{{ $recovery['created_at'] }}</td>
                              <td>{{ $recovery['name'] }}</td>
                              <td>{{ number_format($recovery['instalment_amount']) }}</td>
                              <td>{{ number_format($recovery['deficit_loan_recovery']) }}</td>
                              <td>{{ number_format($recovery['amount']) }}</td>
                              <td>{{ $recovery['loan_status'] }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                        
                      </table>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <table class="table table-hover">
                      <tbody>
                        <tr>
                          <th colspan="2">Group outstanding balance</th>
                        </tr>
                        <tr>
                          <td>Loan outstanding</td>
                          <td>{{ number_format($outstanding) }}</td>
                        </tr>
                        <tr>
                          <th colspan="2">Group Credit Officers</th>
                        </tr>
                        @foreach($officers as $o)
                          <tr>
                            <td>{{ $o->name }}</td>
                            <td>{{ $o->credit_officer_role }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- card-body  -->
            </div>
          </div>
          <!-- col-12          -->
        </div>
        <!-- row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection
