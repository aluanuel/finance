@extends('layouts.custom')

@section('content')
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Expenses</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Reports</a></li>
              <li class="breadcrumb-item active">Expenses</li>
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
                        <h3 class="card-title">{{$headExpense}}</h3>
                        <div class="card-tools" id="admin-only">
                          <a href="/generate/report/expenses" title="Download Report">
                                <i class="fa fa-download"></i>
                          </a>
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="overflow-x: scroll;">
                        <form action="/apply/report/expenses/search" method="post">
                                @csrf
                                <div class="row">
                                  <div class="input-group col-5">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Start date</span>
                                    </div>
                                    <input type="date" name="start_date" class="form-control" data-mask required="required">
                                  </div>
                                  <div class="input-group col-5">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">End date</span>
                                    </div>
                                    <input type="date" name="end_date" class="form-control"  data-mask required="required">
                                  </div>
                                  <div class="col-2">
                                    <button class="btn btn-outline-primary">Search</button>
                                  </div>
                                </div>
                              </form>
                         <table id="example1" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th style="width: 8px">#</th>
                              <th style="width: 20px">Date</th>
                              <th>Details</th>
                              <th style="width: 120px">Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                                  $i = 1;
                                  $total = null;
                                  ?>
                            @foreach($expenses as $expense)
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{ date('Y-m-d',strtotime($expense->created_at))}}</td>
                              <td>{{ $expense->payment_name }}</td>
                              <td>{{ number_format($expense->payment_amount)}}</td>
                              <?php $total += $expense->payment_amount?>
                            </tr>
                            <?php $i++;?>
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>#</th>
                              <th>#</th>
                              <th>Total</th>
                              <th>{{number_format($total)}}</th>
                            </tr>
                          </tfoot>
                      </table>
                  </div>
              </div>
          	</div>
          </div>
      </div>
  </div>
</div>
@endsection