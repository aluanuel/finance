@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan Application</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Loan Application</li>
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
	                        <h3 class="card-title">New Loan Application Charge</h3>
	                    </div>
	                      <!-- /.card-header -->
	                    <div class="card-body">
	                    	<form action="/apply/settings/application" method="post">
	                          @csrf
	                          <div class="row form-group">
	                            <div class="col-12">
	                              <label>Loan Application Type</label>
	                              <div class="form-group">
	                                <select class="form-control select2bs4" name="application_type" data-placeholder="Select" style="width: 100%;" required="required">
	                                	<option></option>
	                                  <option>Individual</option>
	                                  <option>Group</option>
	                                </select>
	                              </div>
	                            </div>
	                          </div>
	                          <div class="row form-group">
	                            <div class="col-12">
	                              <label>Application Amount</label>
	                              <input type="text" name="application_amount" autocomplete="off" class="form-control" placeholder="Application Amount" required="required">
	                            </div>
	                          </div>
	                          <input type="hidden" name="created_by" value="{{Auth::id()}}">
	                          <div class="row form-group">
	                            <button class="btn btn-primary ml-2">Submit</button>
	                          </div>
	                        </form>
	                    </div>
	                </div>
	            </div>
	            <div class="col-8">
	        		<div class="card">
	              <div class="card-header">
	                  <h3 class="card-title">Showing Loan Application Fees</h3>
	              </div>
	                      <!-- /.card-header -->
	                    <div class="card-body">
	                    	<table id="example2" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                <th>#</th>
                                <th>Applicatio Type</th>
                                <th>Charge</th>
                                <th>Created at</th>
                              </tr>
                              </thead>
                              <tbody>
                              	<?php $i = 1;?>
                                @foreach($fees as $fee)
                                <tr>
                                  <td>{{$i}}</td>
                                  <td>{{ $fee->application_type }}</td>
                                  <td>{{ number_format($fee->application_amount) }}</td>
                                  <td>{{ date('Y-m-d',strtotime($fee->created_at)) }}</td>
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