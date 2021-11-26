@extends('layouts.custom')

@section('content')
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cashbook</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Reports</a></li>
              <li class="breadcrumb-item active">Cashbook</li>
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
          	<div class="card" id="printArea">
              <div class="card-header">
                <h3 class="card-title">{{$heading}}</h3>
                <div class="card-tools">
                  <!-- <a href="/generate/report/cashbook" title="Download Report">
                    <i class="fa fa-download"></i>
                  </a> -->

                  <button type="button" class="btn btn-primary btn-sm" title="Print form" onclick="printContent('printArea')">
                <i class="fa fa-print"></i>
               </button>
                </div>
              </div>
              <div class="card-body">
                <form action="/apply/report/cbook/search" method="post" class="pb-2">
                  @csrf
                  <div class="row">
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
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th width="100">Date</th>
                      <th>Particulars</th>
                      <th width="120">Debit</th>
                      <th width="120">Credit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $debit = null;
                          $credit = null;
                     ?>
                    @foreach($incomes as $income)
                      <tr>
                        <td>{{ date('Y-m-d',strtotime($income->created_at)) }}</td>
                        <td>{{ $income->transaction_category }}</td>
                        <td>{{ number_format($income->transaction_amount) }}</td>
                        <td></td>
                        <?php $debit += $income->transaction_amount; ?>
                      </tr>
                    @endforeach

                    @foreach($expenses as $expense)
                      <tr>
                        <td>{{ date('Y-m-d',strtotime($expense->created_at)) }}</td>
                        <td>{{ $expense->transaction_category }}</td>
                        <td></td>
                        <td>{{ number_format($expense->transaction_amount) }}</td>
                        <?php $credit += $expense->transaction_amount; ?>
                      </tr>
                    @endforeach
                    
                    @foreach($repayments as $repay)
                      <tr>
                        <td>{{ date('Y-m-d',strtotime($repay->created_at)) }}</td>
                        <td>Loan repayment ({{ $repay->depositer }})</td>
                        <td>{{ number_format($repay->deposit) }}</td>
                        <td></td>
                        <?php $debit += $repay->deposit; ?>
                      </tr>
                    @endforeach
                    @foreach($appraisal as $appraise)
                      <tr>
                        <td>{{ date('Y-m-d',strtotime($appraise->created_at)) }}</td>
                        <td>Loan appraisal</td>
                        <td>{{ number_format($appraise->appraisal_fee) }}</td>
                        <td></td>
                        <?php $debit += $appraise->appraisal_fee; ?>
                      </tr>
                    @endforeach
                    @foreach($application as $app)
                      <tr>
                        <td>{{ date('Y-m-d',strtotime($app->created_at)) }}</td>
                        <td>Loan application</td>
                        <td>{{ number_format($app->application_fee) }}</td>
                        <td></td>
                        <?php $debit += $app->application_fee; ?>
                      </tr>
                    @endforeach
                    @foreach($loan as $ln)
                      <tr>
                        <td>{{ date('Y-m-d',strtotime($ln->start_date)) }}</td>
                        <td>Loan disbursement ({{ $ln->name }})</td>
                        <td></td>
                        <td>{{ number_format($ln->recommended_amount) }}</td>
                        <?php $credit += $ln->recommended_amount; ?>
                      </tr>
                    @endforeach
                      
                    @foreach($loan as $security)
                      <tr>
                        <td>{{ date('Y-m-d',strtotime($security->start_date)) }}</td>
                        <td>Loan Security ({{ $security->name }})</td>
                        <td>{{ number_format($security->security) }}</td>
                        <td></td>
                        <?php $debit += $security->security; ?>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                      <tr>
                        <th>{{ date('Y-m-d')}}</th>
                        <th>Balance c/d</th>
                        @if( $debit > $credit )
                        <th></th>
                        <th>{{ number_format( $debit - $credit ) }}</th>
                        <?php $credit += ( $debit - $credit ); ?>
                        @elseif($credit > $debit)
                        <th>{{ number_format( $credit - $debit ) }}</th>
                        <?php $debit += ( $credit - $debit ) ?>
                        <th></th>
                        @else
                        <th></th>
                        <th></th>
                        @endif
                      </tr>
                      <tr>
                        <th>#</th>
                        <th></th>
                        <th>{{ number_format($debit) }}</th>
                        <th>{{ number_format($credit) }}</th>
                      </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <!-- col-12 -->
        </div>
      </div>
      <!-- container-fluid -->
    </div>
  </div>
  <!-- content-wrapper -->
  @endsection