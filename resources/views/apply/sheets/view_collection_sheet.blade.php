@extends('layouts.custom')

@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Collection sheets</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Collection sheets</li>
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
                    <form action="/apply/sheets/view-collections" method="POST">
                    @csrf
                      <div class="input-group">
                        <div class="input-group-prepend" id="button-addon3">
                          <input type="date" name="period" class="form-control" placeholder="Select date" required>
                        </div>
                        <select class="form-control select2bs4" style="width: auto;" id="inputGroupSelect04" data-placeholder="Select" name="category" required>
                          <option></option>
                          <option >All collection</option>
                          <option >Missed repayment</option>
                        </select>
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
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>loan</th>
                          <th>name</th>
                          <th>telephone</th>
                          <th>total_loan</th>
                          <th>outstanding</th>
                          <th>instalment</th>
                          <th>deposit</th>
                        </tr>
                      </thead>
                      @php

                      $sum_instalment = 0;
                      $sum_amount = 0;

                      @endphp
                      <tbody>
                        @foreach($collection as $col )
                        <tr>
                          <td>{{ $col['loan_number'] }}</td>
                          <td>{{ $col['name'] }}</td>
                          <td>{{ $col['telephone'] }}</td>
                          <td>{{ number_format($col['total_loan']) }}</td>
                          <td>{{ number_format($col['loan_outstanding']) }}</td>
                          <td>{{ number_format($col['instalment_amount']) }}</td>
                          <td>{{ number_format($col['amount']) }}</td>
                        </tr>
                        @php

                          $sum_instalment += $col['instalment_amount'];
                          $sum_amount = $col['amount'];

                        @endphp
                        @endforeach
                      </tbody>
                      <!-- tbody -->
                      <tfoot>
                        <tr>
                          <th colspan="5">Total</th>
                          <th>{{ number_format($sum_instalment); }}</th>
                          <th>{{ number_format($sum_amount); }}</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- table-responsive -->
                </div>  
              </div>
            </div>
          </div>
          <!-- row -->
        </div>
      </div>
      <!-- content -->
    </div>
    <!-- content-wrapper -->
@endsection