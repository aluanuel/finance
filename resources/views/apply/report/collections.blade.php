@extends('layouts.custom')

@section('content')
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Collections</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Reports</a></li>
              <li class="breadcrumb-item active">Collections</li>
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
                        <h3 class="card-title">{{$heading}}</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="overflow-x: scroll;">
                         <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Particulars</th>
                              <th width="200px;">Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><a href="/apply/report/collections/repayment">Loan repayment</a></td>
                              <td>{{number_format($loan)}}</td>
                            </tr>
                            <tr>
                              <td><a href="/apply/report/collections/apraisal">Loan Appraisal</a></td>
                              <td>{{number_format($appraisal)}}</td>
                            </tr>
                            <tr>
                              <td><a href="/apply/settings/collections/application">Loan Application</td>
                              <td>{{number_format($application)}}</td>
                            </tr>
                            <tr>
                              <td><a href="/apply/report/collections/procesing"> Loan Processing</td>
                              <td>{{number_format($processing)}}</td>
                            </tr>
                            <tr>
                              <td><a href="/apply/report/collections/passbook">Passbook</a></td>
                              <td>{{number_format($passbook)}}</td>
                            </tr>
                            <tr>
                              <td><a href="/apply/report/collections/fine"> Fine</a></td>
                              <td>{{number_format($fine)}}</td>
                            </tr>
                            <tr>
                              <td><a href="/apply/report/collections/security"> Security</a></td>
                              <td>{{number_format($security)}}</td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>Total</th>
                              <th>{{ number_format($total) }}</th>
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