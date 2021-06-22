@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan Processing Fee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Loan Processing Fee</li>
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
                <div class="card-header">
                  <h3 class="card-title">New Loan Processing Rate</h3>
                </div>
                  <!-- /.card-header -->
                <div class="card-body">
                  <form action="/apply/settings/processing" method="post">
                    @csrf
                    <div class="row form-group">
                      <div class="col-12">
                        <label>Loan Type</label>
                        <div class="form-group">
                          <select class="form-control select2bs4" name="loan_type" data-placeholder="Select Loan Type" style="width: 100%;" required="required">
                            <option></option>
                            <option>Individual</option>
                            <option>Group</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-12">
                        <label>Loan Processing Rate</label>
                        <input type="number" name="processing_rate" autocomplete="off" class="form-control" placeholder="Loan Processing Rate" required="required">
                      </div>
                    </div>
                    <div class="row form-group">
                              <button class="btn btn-primary ml-2">Submit</button>
                            </div>
                  </form>
                </div>
                <!-- card-body -->
              </div>
              <!-- card -->
            </div>
            <!-- col-4 -->
            <div class="col-8">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Showing Loan Processing Rates</h3>
                </div>
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr class="text-uppercase">
                        <th>#</th>
                        <th>loan type</th>
                        <th>loan processing rate</th>
                        <th>created at</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $x = 1; ?>
                      @foreach($rates as $rate)
                        <tr>
                          <td>{{ $x }}</td>
                          <td>{{ $rate->loan_type }}</td>
                          <td>{{ $rate->processing_rate }}</td>
                          <td>{{ $rate->created_at }}</td>
                        </tr>
                        <?php $x++; ?>
                      @endforeach
                    </tbody>
                  </table>
                  <!-- table -->
                </div>
              </div>
              <!-- card -->
            </div>
            <!-- col-8 -->
          </div>
        </div>
      </div>
      <!-- content -->
    </div>
    <!-- content-wrapper -->
@endsection