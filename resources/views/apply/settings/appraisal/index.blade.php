@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan Appraisal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Loan Appraisal</li>
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
	                        <h3 class="card-title">New Loan Appraisal Charge</h3>
	                    </div>
	                      <!-- /.card-header -->
	                    <div class="card-body">
	                    	<form action="/apply/settings/appraisal" method="post">
	                          @csrf
	                          <div class="row form-group">
	                            <div class="col-12">
	                              <label>Loan Appraisal Type</label>
	                              <div class="form-group">
	                                <select class="form-control select2bs4" name="appraisal_type" data-placeholder="Select" style="width: 100%;" required="required">
	                                	<option></option>
	                                  <option>Individual</option>
	                                  <option>Group</option>
	                                </select>
	                              </div>
	                            </div>
	                          </div>
	                          <div class="row form-group">
	                            <div class="col-12">
	                              <label>Appraisal Amount</label>
	                              <input type="text" name="appraisal_amount" autocomplete="off" class="form-control" placeholder="Appraisal Amount" required="required">
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
	                  <h3 class="card-title">Showing Loan Appraisal Fees</h3>
	              </div>
	                      <!-- /.card-header -->
	                    <div class="card-body">
	                    	<table id="example2" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                <th>#</th>
                                <th>Appraisal Type</th>
                                <th>Charge</th>
                                <th>Created at</th>
                              </tr>
                              </thead>
                              <tbody>
                              	<?php $i = 1;?>
                                @foreach($fees as $fee)
                                <tr>
                                  <td>{{$i}}</td>
                                  <td>{{ $fee->appraisal_type }}</td>
                                  <td>{{ number_format($fee->appraisal_amount) }}</td>
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