@extends('layouts.custom')

@section('content')
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan recovery</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Reports</a></li>
              <li class="breadcrumb-item active">Loan recovery</li>
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
          	<div class="card" id="printArea">
              <div class="card-header">
                <h3 class="card-title"> {{ $heading }}</h3>
                <div class="card-tools">
                  <form action="/apply/report/loan-recovery" method="post">
                    @csrf
                    <div class="input-group">
                        <div class="input-group-prepend" id="button-addon3">
                          <input type="date" name="start_date" class="form-control" placeholder="Select date" required>
                        </div>
                        <input type="date" name="end_date" class="form-control" placeholder="Select date" required>
                        <div class="input-group-append">
                          <button type="submit" name="submit" class="btn btn-default">
                            <i class="fa fa-search"></i>
                          </button>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example9" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>status</th>
                        <th>loan</th>
                        <th>name</th>
                        <th>total_loan</th>
                        <th>recovered</th>
                        <th>outstanding</th>
                        <th>deposit</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php 

                        $sum_amount = 0;
                        $sum_recovered = 0;
                        $sum_outstanding = 0;

                      @endphp
                      @foreach($recovery as $loan)
                        <tr>
                          <td>{{ $loan->transaction_date }}</td>
                          <td>{{ $loan->loan_status }}</td>
                          <td>{{ $loan->loan_number }}</td>
                          <td>{{ $loan->name }}</td>
                          <td>{{ number_format($loan->total_loan) }}</td>
                          <td>{{ number_format($loan->loan_recovered) }}</td>
                          <td>{{ number_format($loan->loan_outstanding) }}</td>
                          <td>{{ number_format($loan->amount) }}</td>
                        </tr>
                        @php 

                          $sum_amount += $loan->amount;
                          $sum_recovered += $loan->loan_recovered;
                          $sum_outstanding += $loan->loan_outstanding;

                        @endphp
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="5">Total</th>
                        <th>{{ number_format($sum_recovered) }}</th>
                        <th>{{ number_format($sum_outstanding) }}</th>
                        <th>{{ number_format($sum_amount) }}</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- col-12 -->
        </div>
      </div>
      <!-- container-fluid -->
    </div>
  </div>
  <!-- content-wrapper -->
  @endsection