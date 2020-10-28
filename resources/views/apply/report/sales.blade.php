@extends('layouts.custom')

@section('content')
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sales</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Reports</a></li>
              <li class="breadcrumb-item active">Sales</li>
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
                        <h3 class="card-title">Showing Recent Sales</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="overflow-x: scroll;">
                         <table id="example2" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th style="width: 8px">#</th>
                              <th style="width: 20px">Date</th>
                              <th>Details</th>
                              <th style="width: 120px">Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1;?>
                            @foreach($sales as $sale)
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{date('Y-m-d', strtotime($sale->start_date))}}</td>
                              <td>{{$sale->loan_number }}</td>
                              <td>{{number_format($sale->recommended_amount)}}</td>
                            </tr>
                            <?php $i++;?>
                            @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          	</div>
          </div>
      </div>
  </div>
</div>
@endsection