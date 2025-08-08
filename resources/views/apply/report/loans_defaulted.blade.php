@extends('layouts.custom')

@section('content')
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loans defaulted</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Reports</a></li>
              <li class="breadcrumb-item active">Loans defaulted</li>
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
                <h3 class="card-title">{{ $heading }}</h3>
                <!-- <div class="card-tools">
                  <form action="/apply/report/loans-fully-settled" method="post">
                    @csrf
                    <div class="row">
                      <input type="date" class="form-control col-4 mr-1" name="start_date" placeholder="start date">
                      <input type="date" class="form-control col-4" name="end_date" placeholder="end date">
                      <input type="submit" name="submit" class="btn btn-sm btn-default ml-1" value="Search">
                    </div>
                  </form>
                </div> -->
              </div>
              <div class="card-body">
               
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>loan_number</th>
                      <th>client_name</th>
                      <th>total_loan</th>
                      <th>loan_outstanding</th>
                      <th>period(weeks)</th>
                      <th>end_date</th>
                      <th>default(days)</th>
                      <th>penalty</th>
                    </tr>
                  </thead>
                    @php

                      $sum_total_loan = 0;

                      $sum_loan_outstanding = 0;

                      $sum_penalty = 0;

                    @endphp
                  <tbody>
                    @foreach($loan as $ln)

                      @php

                        $loan_outstanding = $ln->loan_outstanding;

                        $rate_on_defaulting = $ln->interest_on_defaulting;

                        $end_date = $ln->loan_end_date;

                        $days_defaulted = floor((strtotime(date('Y-m-d')) - strtotime($end_date))/ (60 * 60 * 24));

                        $penalty = (($rate_on_defaulting/100) * $loan_outstanding) * $days_defaulted;


                        $sum_total_loan += $ln->total_loan;

                        $sum_loan_outstanding += $loan_outstanding;

                        $sum_penalty +=$penalty;

                      @endphp

                      <tr>
                        <td><a href="/apply/account/profile/{{$ln->id_client}}">{{ $ln->loan_number }}</a></td>
                        <td><a href="/apply/account/profile/{{$ln->id_client}}"> {{ $ln->name }}</a></td>
                        <td>{{ number_format($ln->total_loan) }}</td>
                        <td>{{ number_format($loan_outstanding) }}</td>
                        <td>{{ $ln->loan_period }}</td>
                        <td>{{ $ln->loan_end_date }}</td>
                        <td>{{ $days_defaulted }}</td>
                        <td>{{ number_format($penalty) }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="2">total</th>
                      <th>{{ number_format($sum_total_loan) }}</th>
                      <th>{{ number_format($sum_loan_outstanding) }}</th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th>{{ number_format($sum_penalty) }}</th>
                    </tr>
                  </tfoot>
                </table>
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