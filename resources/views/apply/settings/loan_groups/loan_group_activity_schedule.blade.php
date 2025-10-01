@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan Groups Activity Schedule</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">Loan Groups Activity Schedule</li>
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
          <!-- col-4 -->
          <div class="col-md-4 col-sm-12">
            <!-- card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">New Schedule</h3>
              </div>
                <!-- /.card-header -->
              <div class="card-body">

                <form id="submitForm1" method="POST" action="/apply/settings/loan/groups">
                </form>
              </div>
            </div>
          </div>
          <!-- col-md-4     -->
          <div class="col-md-8 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Showing Loan Groups Activity Schedule</h3>
              </div>
                        <!-- /.card-header -->
              <div class="card-body">
              </div>
              <!-- card-body -->
            </div>
            <!-- card -->
          </div>
          <!-- col-md-8 -->
        </div>
        <!-- row -->
      </div>
    </div>
    <!-- Main content -->
  </div>
@endsection