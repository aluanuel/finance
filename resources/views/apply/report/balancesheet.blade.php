@extends('layouts.custom')

@section('content')
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Balance Sheet</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Reports</a></li>
              <li class="breadcrumb-item active">Balance Sheet</li>
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
                <h3 class="card-title">Showing Balance Sheet as at October 30, 2021</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-primary btn-sm" title="Download Report">
                    <i class="fa fa-download"></i>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-stripped">
                  <thead>
                    <tr>
                      <th>Particulars</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="2"><h4>ASSETS</h4></td>
                    </tr>
                    <tr>
                      <td>Fixed Assets</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Current Assets</td>
                      <td>{{ number_format($currentAssets) }}</td>
                    </tr>
                    <tr>
                      <td colspan="2"><h4>LIABILITIES</h4></td>
                    </tr>
                    <tr>
                      <td>Non Current Liabilities</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Current Liabilities</td>
                      <td>{{ number_format($currentLiabilities) }}</td>
                    </tr>
                    <tr>
                      <td colspan="2"><h4>EQUITY</h4></td>
                    </tr>
                    <tr>
                      <td>Share Capital</td>
                      <td></td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
                
              </div>
            </div>
          </div>
          <!-- col-12 -->
        </div>
        <!-- row -->
      </div>
    </div>
    <!-- content -->
  </div>
  <!-- content-wrapper -->
  @endsection