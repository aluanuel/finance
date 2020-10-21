@extends('layouts.custom')

@section('content')
	  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Record Transaction</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Record Transaction</li>
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
	            <div class="card card-default">
	              <div class="card-header">
	                <ul class="nav nav-pills">
	                  <li class="nav-item"><a class="nav-link active" href="#nw_income" data-toggle="tab">Record Income
	                  </a></li>
	                  <li class="nav-item"><a class="nav-link" href="#nw_expense" data-toggle="tab">Record Expense</a></li>
	                </ul>
	                <!-- <h3 class="card-title">Different Height</h3> -->
	              </div>
	              <div class="card-body">
	                	<div class="tab-content">
	                  		<div class="active tab-pane" id="nw_income">
	                  			<div class="row">
	                  				<div class="col-4">
					                    <div class="card">
					                      <div class="card-header">
					                        <h3 class="card-title">Record New Income</h3>
					                      </div>
					                              <!-- /.card-header -->
					                      <div class="card-body">
					                      	<form action="/trans/record" method="post">
					                          @csrf
					                          <div class="row form-group">
					                            <div class="col-12">
					                              <label>Income source</label>
					                              <input type="text" name="payment_name" autocomplete="off" class="form-control" placeholder="Income source" required="required">
					                            </div>
					                          </div>
					                          <div class="row form-group">
					                            <div class="col-12">
					                              <label>Amount</label>
					                              <input type="number" name="payment_amount" autocomplete="off" class="form-control" placeholder="Amount" required="required">
					                            </div>
					                          </div>
					                          <input type="hidden" name="payment_category" value="income">

					                          <input type="hidden" name="recorded_by" value="{{Auth::id()}}">
					                          <div class="row form-group">
					                            <button class="btn btn-primary ml-2">Submit</button>
					                          </div>
					                        </form>
					                      </div>
					                      <!-- card-body -->
					                  	</div>
					                      <!-- card -->
					                </div>
					                <div class="col-8">
					                    <div class="card">
					                      <div class="card-header">
					                        <h3 class="card-title">View Transaction History</h3>
					                      </div>
					                              <!-- /.card-header -->
					                      <div class="card-body">
					                      	<table id="example2" class="table table-bordered table-hover">
								                <thead>
								                  <tr>
								                    <th style="width: 12px;">#</th>
								                    <th>Date</th>
								                    <th>Details</th>
								                    <th>Amount</th>
								                  </tr>
								                </thead>
								                <tbody>
								                	<?php $i = 1;?>
								                	@foreach($income as $inc)
								                	<tr>
								                		<td>{{ $i }}</td>
								                		<td>{{ date('Y-m-d',strtotime($inc->created_at)) }}</td>
								                		<td>{{ $inc->payment_name }}</td>
								                		<td>{{ number_format($inc->payment_amount) }}</td>
								                	</tr>
								                	<?php $i++;?>
								                	@endforeach
								                </tbody>
								            </table>
					                      </div>
					                      <!-- card-body -->
					                  	</div>
					                      <!-- card -->
					                </div>
				                </div>
			                  </div>
			                  <div class="tab-pane" id="nw_expense">
			                    <div class="row">
	                  				<div class="col-4">
					                    <div class="card">
					                      <div class="card-header">
					                        <h3 class="card-title">Record New Expense</h3>
					                      </div>
					                              <!-- /.card-header -->
					                      <div class="card-body">
					                      	<form action="/trans/record" method="post">
					                          @csrf
					                          <div class="row form-group">
					                            <div class="col-12">
					                              <label>Expense source</label>
					                              <input type="text" name="payment_name" autocomplete="off" class="form-control" placeholder="Expense source" required="required">
					                            </div>
					                          </div>
					                          <div class="row form-group">
					                            <div class="col-12">
					                              <label>Amount</label>
					                              <input type="number" name="payment_amount" autocomplete="off" class="form-control" placeholder="Amount" required="required">
					                            </div>
					                          </div>
					                          <input type="hidden" name="payment_category" value="expense">

					                          <input type="hidden" name="recorded_by" value="{{Auth::id()}}">
					                          <div class="row form-group">
					                            <button class="btn btn-primary ml-2">Submit</button>
					                          </div>
					                        </form>
					                      </div>
					                      <!-- card-body -->
					                  	</div>
					                      <!-- card -->
					                </div>
					                <div class="col-8">
					                    <div class="card">
					                      <div class="card-header">
					                        <h3 class="card-title">View Transaction History</h3>
					                      </div>
					                              <!-- /.card-header -->
					                      <div class="card-body">
					                      	<table id="example2" class="table table-bordered table-hover">
								                <thead>
								                  <tr>
								                    <th style="width: 12px;">#</th>
								                    <th>Date</th>
								                    <th>Details</th>
								                    <th>Amount</th>
								                  </tr>
								                </thead>
								                <tbody>
								                	<?php $i = 1;?>
								                	@foreach($expense as $exp)
								                	<tr>
								                		<td>{{ $i }}</td>
								                		<td>{{ date('Y-m-d',strtotime($exp->created_at)) }}</td>
								                		<td>{{ $exp->payment_name }}</td>
								                		<td>{{ number_format($exp->payment_amount) }}</td>
								                	</tr>
								                	<?php $i++;?>
								                	@endforeach
								                </tbody>
								            </table>
					                      </div>
					                      <!-- card-body -->
					                  	</div>
					                      <!-- card -->
					                </div>
				                </div>
			                  </div>
			              	</div>
			          </div>
			      </div>
			  </div>
			</div>
      	</div>
    </div>
      <!-- main-content -->
  </div>
  <!-- content-wrapper -->
@endsection