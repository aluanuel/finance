@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan Payment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Loan Payment</li>
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
            @include('layouts.partials.forms.loan_payment')
          </div>
          <div class="col-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $headers}}</h3>
              </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form action="/apply/trans/search/payment" method="post">
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
                          <th style="width: 12px;">#</th>
                          <th style="width: 30px;">Date</th>
                          <th style="width: 30px;">Number</th>
                          <th style="width: 30px;">Ticket</th>
                          <th>Deposit</th>
                          <th>Depositer</th>
                          <th style="width: 30px;">#</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;?>
                        @foreach($pays as $pay)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ date('Y-m-d',strtotime($pay->created_at)) }}</td>
                          <td>{{ $pay->loan_number }}</td>
                          <td>{{ $pay->receipt_number }}</td>
                          <td>{{ number_format($pay->deposit) }}</td>
                          <td>{{ $pay->depositer}}</td>
                          <td><a href="/generate/loan/payment/receipt/{{$pay->id}}"><button type="submit" class="btn btn-block btn-outline-success btn-sm">Receipt</button></a></td>
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
    <!-- main content -->
  </div>
  <!-- content wrapper -->
  @endsection