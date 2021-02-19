@extends('layouts.custom')

@section('content')
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Income</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Reports</a></li>
              <li class="breadcrumb-item active">Income</li>
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
                        <h3 class="card-title">{{$headIncome}}</h3>
                        <div class="card-tools">
                          <a href="/generate/report/incomes" class="btn btn-primary btn-sm" title="Download Report">
                            <i class="fa fa-download"></i>
                          </a>
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="overflow-x: scroll;">
                        <form action="/apply/report/incomes/search" method="post">
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
                         <table id="example3" class="table table-bordered table-hover">
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
                            @foreach($incomes as $income)
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{ date('Y-m-d',strtotime($income->created_at))}}</td>
                              <td>{{ $income->payment_name }}</td>
                              <td>{{ number_format($income->payment_amount)}}</td>
                              <?php $total += $income->payment_amount?>
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