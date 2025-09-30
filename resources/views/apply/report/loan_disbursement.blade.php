@extends('layouts.custom')

@section('content')
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan disbursement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Reports</a></li>
              <li class="breadcrumb-item active">Loan disbursement</li>
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
        <div class="row" style="overflow-x: scroll;">
          <div class="col-12">
          	<div class="card" id="printArea">
              <div class="card-header">
                <h3 class="card-title">{{ $heading }}</h3>
                <div class="card-tools">
                  <form action="/apply/report/disbursements" method="post">
                    @csrf
                    <div class="row">
                      <input type="date" class="form-control col-4 mr-1" name="start_date" placeholder="start date">
                      <input type="date" class="form-control col-4" name="end_date" placeholder="end date">
                      <input type="submit" name="submit" class="btn btn-sm btn-default ml-1" value="Search">
                    </div>
                  </form>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <th>Date</th>
                        <th>loan_status</th>
                        <th>loan_number</th>
                        <th>client_details</th>
                        <th>amount_disbursed</th>
                        <th>processing_fee</th>
                        <th>loan_interest</th>
                        <th>total_loan</th>              
                        </tr>
                    </thead>
                    <tbody>

                        @php 

                            $total_disbursed = 0;

                            $total_processing_fee = 0;

                            $total_loan_interest = 0;

                            $total_borrowing = 0;

                        @endphp

                        @foreach($loan as $loan)
                        <tr>
                            <td>{{ date('d-m-Y',strtotime($loan->date_loan_disbursed)) }}</td>
                            <td>{{ $loan->loan_status }}</td>
                            <td>{{ $loan->loan_number }}</td>
                            <td>{{ $loan->account_number }} - {{ $loan->name }}</td>
                            <td>{{ number_format($loan->loan_approved) }}</td>
                            <td>{{ number_format(($loan->loan_processing_rate/100) * $loan->loan_approved) }}</td>
                            <td>{{ number_format(($loan->interest_rate/100) * $loan->loan_approved) }}</td>
                            <td>{{ number_format($loan->total_loan )}}</td>
                        </tr>

                        @php 

                            $total_disbursed += $loan->loan_approved;

                            $total_processing_fee += ($loan->loan_processing_rate/100) * $loan->loan_approved;

                            $total_loan_interest += ($loan->interest_rate/100) * $loan->loan_approved;

                            $total_borrowing += $loan->total_loan;

                        @endphp

                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <th colspan="4">Total</th>
                        <th>{{ number_format($total_disbursed) }}</th>
                        <th>{{ number_format($total_processing_fee) }}</th>
                        <th>{{ number_format($total_loan_interest) }}</th>
                        <th>{{ number_format($total_borrowing) }}</th>
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