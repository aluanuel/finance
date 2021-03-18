@extends('layouts.custom')

@section('content')
	  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List of Loan Applications</h1>
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
        		<div class="col-12">
        			<div class="card">
                      <div class="card-header">
                        <h3 class="card-title">{{ $client->name }} ({{ $client->telephone }})</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="overflow-x: scroll;">
                         <table class="table table-bordered table-hover">
                          <thead>
                            <tr class="text-uppercase">
                              <th style="width: 12px;">#</th>
                              <th style="width: 30px;">Number</th>
                              <th>Date</th>
                              <th>Application Fees</th>
                              <th>Fees Payment</th>
                              <th>Loan Requested</th>
                              <th>Loan Officer</th>
                              <th>Assessment</th>
                              <th>Approval</th>
                              <th>Loan Approved</th>
                              <th>Interest</th>
                              <th>Total Loan</th>
                              <th>Loan Disbursed</th>
                              <th>Loan Outstanding</th>
                              <th>Security</th>
                              <th>Start</th>
                              <th>End</th>
                              <th>Loan Status</th>
                              <th>#</th>
                            </tr>
                          </thead>
                         <tbody>
                         	<?php $x = 1;?>
                         	@foreach($loans as $loan)
                         		<tr>
                         			<td>{{ $x}}</td>
                         			<td>{{ $loan->loan_number }}</td>
                         			<td>{{ date('Y-m-d',strtotime($loan->application_date)) }}</td>
                         			<td>{{ number_format($loan->application_fee) }}</td>
                         			@if($loan->application_status == 0)
                         			<td class="text-danger">Not Paid</td>
                         			@else
                         			<td class="text-success">Paid</td>
                         			@endif
                         			<td>{{ number_format($loan->proposed_amount) }}</td>
                         			<td>{{ $loan->name }}</td>
                         			@if($loan->assessment_status == NULL)
                         			<td class="text-danger">Not Done</td>
                         			@else
                         			<td class="text-success">Done</td>
                         			@endif
                         			@if($loan->approval_status == NULL)
                         			<td class="text-danger">Not Done</td>
                         			@else
                         			<td class="text-success">Done</td>
                         			@endif
                         			<td>{{ number_format($loan->recommended_amount) }}</td>
                         			<td>{{ number_format($loan->loan_interest) }}</td>
                         			<td>{{ number_format($loan->total_loan) }}</td>
                         			<td>{{ number_format($loan->loan_amount_issued) }}</td>
                         			<td>{{ number_format($loan->loan_balance) }}</td>
                         			<td>{{ number_format($loan->security) }}</td>
                         			@if($loan->start_date == NULL)
                         			<td></td>
                         			@else
                         			<td>{{ date('Y-m-d',strtotime($loan->start_date))}}</td>                         			
                         			@endif
                         			@if($loan->end_date == NULL)
                         			<td></td>
                         			@else
                         			<td>{{ date('Y-m-d',strtotime($loan->end_date))}}</td> @endif
                         			<td>{{ $loan->loan_status }}</td>
                         			@if($loan->loan_status == 'started')
                         			<td></td>
                         			@else
                                <?php 
                                    if(is_null($loan->id_group)){
                                 ?>
                                    <td><a href="/apply/ind/assess" class="btn btn-outline-primary">Resume</a></td>
                                  <?php
                                    }else{
                                  ?>
                                    <td><a href="/apply/grp" class="btn btn-outline-primary">Resume</a></td>
                                  <?php
                                    }
                                  ?>
                         			@endif
                         			
                         		</tr>
                         		<?php $x++; ?>
                         	@endforeach
                         </tbody>
                     	</table>
                 	</div>
             	</div>
        		</div>
        	</div>
        </div>
    </div>
    <!-- main content -->
</div>
<!-- content-wrapper -->
@endsection