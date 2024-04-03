@extends('layouts.custom')

@section('content')
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cashbook</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Reports</a></li>
              <li class="breadcrumb-item active">Cashbook</li>
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
                <h3 class="card-title">{{$heading}}</h3>
                <div class="card-tools">
                  <!-- <a href="/generate/report/cashbook" title="Download Report">
                    <i class="fa fa-download"></i>
                  </a> -->

                  <button type="button" class="btn btn-primary btn-sm" title="Print form" onclick="printContent('printArea')">
                <i class="fa fa-print"></i>
               </button>
                </div>
              </div>
              <div class="card-body">
               
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th width="150">Date</th>
                      <th>Particulars</th>
                      <th width="120">Debit</th>
                      <th width="120">Credit</th>
                    </tr>
                  </thead>
                  @php
                    $debit = 0;
                    $credit = 0;
                  @endphp

                  @foreach($trans as $tra )

                    @if($tra->transaction_type == 'Income')

                      <tr>
                        <td>{{ date('Y-m-d h:i:s',strtotime($tra->created_at)) }}</td>
                        <td>{{ $tra->transaction_name }}</td>
                        <td>{{ number_format($tra->amount,2) }}</td>
                        <td></td>
                      </tr>
                      @php
                        $debit += $tra->amount
                      @endphp
                    @elseif($tra->transaction_type == 'Expense')

                      <tr>
                        <td>{{ date('Y-m-d h:i:s',strtotime($tra->created_at)) }}</td>
                        <td>{{ $tra->transaction_name }}</td>
                        <td></td>
                        <td>{{ number_format($tra->amount,2) }}</td>
                      </tr>
                      @php
                        $credit += $tra->amount
                      @endphp
                    @endif

                  @endforeach
                    <tfoot>
                      <tr>
                        <th>TOTAL</th>
                        <th></th>
                        <th>{{ number_format($debit,2) }}</th>
                        <th>{{ number_format($credit,2) }}</th>
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