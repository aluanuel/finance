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
                    <div class="row">
                      <input type="date" class="form-control col-4 mr-1" name="start_date" placeholder="start date">
                      <input type="date" class="form-control col-4" name="end_date" placeholder="end date">
                      <input type="submit" name="submit" class="btn btn-sm btn-default ml-1" value="Search">
                    </div>
                  </form>
                </div>
              </div>
              <div class="card-body">
               
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th width="150">Date</th>
                      <th>loan_status</th>
                      <th>loan_number</th>
                      <th>Client_details</th>
                      <th>deposit_amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $total = 0 @endphp
                    @foreach($recovery as $loan)
                      <tr>
                        <td>{{ $loan->transaction_date }}</td>
                        <td>{{ $loan->loan_status }}</td>
                        <td>{{ $loan->loan_number }}</td>
                        <td>{{ $loan->name }}</td>
                        <td>{{ number_format($loan->amount) }}</td>
                      </tr>
                      @php $total += $loan->amount @endphp
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="4">Total</th>
                      <th>{{ number_format($total) }}</th>
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