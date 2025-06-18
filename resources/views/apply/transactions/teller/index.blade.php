@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transactions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Transactions</li>
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
          <div class="col-4">
            <div class="card">
              
            </div>
          </div>
          <!-- col-4 -->
          <div class="col-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Showing Transactions</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>loan_number</th>
                    <th>Client_name</th>
                    <th>Telephone</th>
                    <th>Group_name</th>
                    <th>#</th>
                  </tr>
                  </thead>
                </table>
              </div>
              <!-- card-body -->
            </div>
              <!-- card -->
          </div>
            <!-- col-8         -->
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection
