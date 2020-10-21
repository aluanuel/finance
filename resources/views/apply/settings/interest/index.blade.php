@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Interest on Loans</h1>
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
	                        <h3 class="card-title">New Interest rate on Loans</h3>
	                    </div>
	                      <!-- /.card-header -->
	                    <div class="card-body">
	                    	<form action="/apply/settings/interest" method="post">
	                          @csrf
	                          <div class="row form-group">
	                            <div class="col-12">
	                              <label>Loan Type</label>
	                              <div class="form-group">
	                                <select class="form-control select2bs4" name="loan_type" data-placeholder="Select Gender" style="width: 100%;">
	                                  <option>Individual</option>
	                                  <option>Group</option>
	                                </select>
	                              </div>
	                            </div>
	                          </div>
	                          <div class="row form-group">
	                            <div class="col-12">
	                              <label>Interest rate</label>
	                              <input type="number" name="interest_rate" autocomplete="off" class="form-control" placeholder="Interest Rate (%)" required="required">
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
	                        <h3 class="card-title">View Interest rates on Loans</h3>
	                    </div>
	                      <!-- /.card-header -->
	                    <div class="card-body">
	                    	<table id="example2" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                <th>#</th>
                                <th>Loan Type</th>
                                <th>Interest Rate</th>
                                <th>Created at</th>
                              </tr>
                              </thead>
                              <tbody>
                              	<?php $i = 1;?>
                              	@foreach($interest as $int)
                              	<tr>
                              		<td>{{ $i }}</td>
                              		<td>{{ $int->loan_type }}</td>
                              		<td>{{ ($int->interest_rate) *  100 }}</td>
                              		<td>{{ date('Y-m-d',strtotime($int->created_at))}}</td>
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