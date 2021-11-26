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
	                <ul class="nav nav-pills" id="myTab">
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
					                              <label>Income Category</label>
					                              <select class="form-control select2bs4" name="id_category" data-placeholder="Select" style="width: 100%;" required="required">
					                              		<option></option>
			                                  	@foreach($inflow as $in)
			                                  		<option value="{{ $in->id }}">{{ $in->transaction_category }}</option>
			                                  	@endforeach
                                				</select>
					                            </div>
					                          </div>
					                          <div class="row form-group">
					                            <div class="col-12">
					                              <label>Income Sub Category</label>
					                              <select class="form-control select2bs4" name="id_sub_category" data-placeholder="Select" style="width: 100%;" required="required">
					                              		<option></option>
					                              		<option>{{'None'}}</option>
			                                  	@foreach($inflow_sub as $in)
			                                  		<option value="{{ $in->id }}">{{ $in->transaction_sub_category }}</option>
			                                  	@endforeach
			                                  		
                                				</select>
					                            </div>
					                          </div>
					                          <div class="row form-group">
					                            <div class="col-12">
					                              <label>Amount</label>
					                              <input type="text" name="transaction_amount" autocomplete="off" class="form-control" placeholder="Amount" required="required">
					                            </div>
					                          </div>
					                          <input type="hidden" name="transaction_type" value="income">

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
					                        <h3 class="card-title">{{$headIncome}}</h3>
					                        <div class="card-tools">
								              <a href="/generate/report/incomes" class="btn btn-primary btn-sm" title="Download" onclick="printContent('printArea')">
								                <i class="fa fa-download"></i>
								               </a>
								            </div>
					                      </div>
					                              <!-- /.card-header -->
					                      <div class="card-body">
					                      <form action="/apply/trans/search/income" method="post">
						                    @csrf
						                    <div class="row pb-3">
						                      <div class="input-group col-4">
						                        <div class="input-group-prepend">
						                          <span class="input-group-text">Start date</span>
						                        </div>
						                        <input type="date" name="start_date" class="form-control" data-mask required="required">
						                      </div>
						                      <div class="input-group col-4">
						                        <div class="input-group-prepend">
						                          <span class="input-group-text">End date</span>
						                        </div>
						                        <input type="date" name="end_date" class="form-control"  data-mask required="required">
						                      </div>
						                      <div class="col-2">
						                        <button class="btn btn-outline-primary">Search</button>
						                      </div>
						                    </div>
						                  </form>
					                      	<table class="table table-bordered table-hover">
								                <thead>
								                  <tr>
								                    <th style="width: 12px;">#</th>
								                    <th>Date</th>
								                    <th>Category</th>
								                    <th>Amount</th>
								                  </tr>
								                </thead>
								                <tbody>
								                	<?php 
								                		$i = 1;
								                		$totalIncome = null;
								                	?>
								                	@foreach($income as $inc)
								                	<tr>
								                		<td>{{ $i }}</td>
								                		<td>{{ date('Y-m-d',strtotime($inc->created_at)) }}</td>
								                		<td>{{ $inc->transaction_category }}</td>
								                		<td>{{ number_format($inc->transaction_amount) }}</td>
								                		<?php 
								                			$totalIncome += $inc->transaction_amount;
								                		?>
								                	</tr>
								                	<?php $i++;?>
								                	@endforeach
								                </tbody>
								                <tfoot>
								                	<tr>
								                		<th>#</th>
								                		<th>Total</th>
								                		<th></th>
								                		<th>{{ number_format($totalIncome) }}</th>
								                	</tr>
								                </tfoot>
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
					                              <label>Expense Category</label>
					                              <select class="form-control select2bs4" name="id_category" data-placeholder="Select" style="width: 100%;" required="required">
					                              		<option></option>
			                                  	@foreach($outflow as $out)
			                                  		<option value="{{ $out->id }}">{{ $out->transaction_category }}</option>
			                                  	@endforeach
                                				</select>
					                            </div>
					                          </div>
					                          <div class="row form-group">
					                            <div class="col-12">
					                              <label>Outflow Sub Category</label>
					                              <select class="form-control select2bs4" name="id_sub_category" data-placeholder="Select " style="width: 100%;" required="required">
					                              		<option></option>
					                              		<option>{{'None'}}</option>
			                                  	@foreach($outflow_sub as $out)
			                                  		<option value="{{ $out->id }}">{{ $out->transaction_sub_category }}</option>
			                                  	@endforeach
                                				</select>
					                            </div>
					                          </div>
					                          <div class="row form-group">
					                            <div class="col-12">
					                              <label>Amount</label>
					                              <input type="text" name="transaction_amount" autocomplete="off" class="form-control" placeholder="Amount" required="required">
					                            </div>
					                          </div>
					                          <input type="hidden" name="transaction_type" value="expense">

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
					                        <h3 class="card-title">{{$headExpense}}</h3>
					                        <div class="card-tools">
								              <a href="/generate/report/expenses" class="btn btn-primary btn-sm" title="Download" onclick="printContent('printArea')">
								                <i class="fa fa-download"></i>
								               </a>
								            </div>
					                      </div>
					                              <!-- /.card-header -->
					                      <div class="card-body">
					                      	<form action="/apply/trans/search/expense" method="post">
						                    @csrf
						                    <div class="row pb-3">
						                      <div class="input-group col-5">
						                        <div class="input-group-prepend">
						                          <span class="input-group-text">Start date</span>
						                        </div>
						                        <input type="date" name="start_date" class="form-control" data-mask required="required">
						                      </div>
						                      <div class="input-group col-5">
						                        <div class="input-group-prepend">
						                          <span class="input-group-text">End date</span>
						                        </div>
						                        <input type="date" name="end_date" class="form-control"  data-mask required="required">
						                      </div>
						                      <div class="col-2">
						                        <button class="btn btn-outline-primary">Search</button>
						                      </div>
						                    </div>
						                  </form>
					                      	<table class="table table-bordered table-hover">
								                <thead>
								                  <tr>
								                    <th style="width: 12px;">#</th>
								                    <th>Date</th>
								                    <th>Category</th>
								                    <th>Amount</th>
								                  </tr>
								                </thead>
								                <tbody>
								                	<?php 
								                			$i = 1;
								                			$totalExpense = null;
								                		?>
								                	@foreach($expense as $exp)
								                	<tr>
								                		<td>{{ $i }}</td>
								                		<td>{{ date('Y-m-d',strtotime($exp->created_at)) }}</td>
								                		<td>{{ $exp->transaction_category }}</td>
								                		<td>{{ number_format($exp->transaction_amount) }}</td>
								                	</tr>
								                	<?php 
								                			$i++;
								                			$totalExpense +=$exp->transaction_amount;
								                	?>
								                	@endforeach
								                </tbody>
								                <tfoot>
								                	<tr>
								                		<th>#</th>
								                		<th>Total</th>
								                		<th></th>
								                		<th>{{ number_format($totalExpense) }}</th>
								                	</tr>
								                </tfoot>
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