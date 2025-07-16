@extends('layouts.custom')

@section('content')
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loans fully settled</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Reports</a></li>
              <li class="breadcrumb-item active">Loans fully settled</li>
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
              </div>
              <div class="card-body">
               
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>date</th>
                      <th>loan_number</th>
                      <th>client_name</th>
                      <th>total_loan</th>
                      <th>loan_recovered</th>
                      <th>period(weeks)</th>
                      <th>start_date</th>
                      <th>end_date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($loan as $ln)
                      <tr>
                        <td>{{ $ln->date_loan_fully_recovered }}</td>
                        <td><a href="/apply/account/profile/{{$ln->id_client}}">{{ $ln->loan_number }}</a></td>
                        <td><a href="/apply/account/profile/{{$ln->id_client}}"> {{ $ln->name }}</a></td>
                        <td>{{ number_format($ln->total_loan) }}</td>
                        <td>{{ number_format($ln->loan_recovered) }}</td>
                        <td>{{ $ln->loan_period }}</td>
                        <td>{{ $ln->loan_start_date }}</td>
                        <td>{{ $ln->loan_end_date }}</td>
                      </tr>
                    @endforeach
                  </tbody>
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