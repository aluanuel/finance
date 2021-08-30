@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan Security</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Loan Security</li>
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
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Collateral Return Form</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8 col-sm-12">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Details</th>
                          <th>Est. Value</th>
                          <th>Attachment</th>
                          <th>Status</th>
                          <th>Agreement</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($security as $sec)
                          <tr>
                            <td>{{ $sec->security_name}}</td>
                            <td>{{ $sec->security_number}}</td>
                            <td>{{ number_format($sec->security_value)}}</td>
                            <td><a href="/admin/download/collateral/{{ $sec->security_attachment }}" class="btn btn-outline-success btn-sm">View</a></td>
                            @if($sec->security_status == 0)
                            <td>Not taken</td>
                            <td></td>
                            @else
                            <td>Taken</td>
                            <td><a href="{{ asset('storage/app/public/'.$sec->security_agreement)}}" class="btn btn-outline-primary btn-sm">View</a></td>
                            @endif
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Collateral Return Agreement</h3>
                <ul class="nav nav-pills ml-auto p-2" id="myTab">
                  <li class="nav-item"><a class="nav-link active" href="#view_agreement" data-toggle="tab">View Agreement</a></li>
                  <li class="nav-item"><a class="nav-link" href="#upload_agreement" data-toggle="tab">Upload Agreement</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="view_agreement">
                    <div id="print_area">
                      <h3 class="title">Collateral Return Agreement</h3>
                      <p>
                        I <strong>{{ $loan->name }}</strong> do hereby agree to withdraw my security from <strong>{{ config('app.name', 'Laravel') }}</strong> that I offered to acquire a loan of <strong>{{ 'UGX'}} {{ number_format($loan->recommended_amount) }}</strong> at an interest rate of <strong>{{$loan->interest_rate }}{{ '%'}}</strong> from this institution.
                      </p>
                      <p>My securities to withdraw are listed herein as;<br>
                        <?php $i = 1; ?>
                        @foreach($security as $sec)
                        {{$i }}. {{$sec->security_name}}<br>
                        <?php $i++; ?>
                        @endforeach
                      </p>
                      <p><strong>Declaration</strong></p>
                      <div class="row">
                        <div class="col-12">
                          <p>I have received my security in good condition.</p>
                        </div>
                        <div class="col-6">
                      
                        <p>Received by ................................................<br>
                        Signature ....................................................<br>
                        Date.............................................................</p>
                      </div>
                      <div class="col-6">
                      
                        <p>Issued by ....................................................<br>
                        Signature ....................................................<br>
                        Date.............................................................</p>
                      </div>
                      </div>
                    </div>
                    <button class="btn btn-outline-success btn-sm" onclick="printDiv()">Print Agreement</button>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="upload_agreement">
                    <form action="/apply/admin/collateral/{{$loan->id}}" enctype="multipart/form-data" method="post">
                      @csrf
                      <div class="form-group">
                        <label>Upload Signed Agreement</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="security_agreement" class="form-control custom-file-input" id="exampleInputFile" required="required">
                            <label class="custom-file-label" for="exampleInputFile">Upload Signed Agreement</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <button class="btn btn-outline-primary">Submit</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
                  </div>
                  <div class="col-sm-12 col-md-4">
                    <div class="card bg-navy">
                      <div class="card-header">
                        <h5 class="card-title text-uppercase">{{'Loan Number:' }} {{ $loan->loan_number }}</h5>
                      </div>
                      <div class="card-body">
                        <p>Client: <span class="pl-4">{{$loan->name}}</span> <br>Loan Approved: <span class="pl-4">{{ number_format($loan->recommended_amount) }} </span><br>Loan Issued: <span class="pl-4">{{ number_format($loan->loan_amount_issued) }}</span> <br>Interest on Loan: <span class="pl-4">{{ number_format($loan->loan_interest) }}</span><br>Total Loan: <span class="pl-4">{{ number_format($loan->total_loan) }}</span><br>Security Withheld: <span class="pl-4">{{ number_format($loan->security) }}</span><br>Loan Recovered: <span class="pl-4">{{ number_format($loan->loan_recovered) }}</span>
                          <br>Loan Status: <span class="ml-4 badge badge-info">{{ $loan->loan_status }}</span></p>
                      </div>
                      <div class="card-footer text-uppercase">
                        @if($loan->id_group == NULL)
                        <small>Loan Period: <span class="pl-4">{{ $loan->loan_period }} {{ 'Months'}}</span><br>start date: <span class="pl-4">{{ date('Y-m-d',strtotime($loan->start_date)) }}<br>end date: <span class="pl-4">{{ date('Y-m-d',strtotime($loan->end_date)) }}
                        </small>
                        @else
                        <small>Loan Period: <span class="pl-4">{{ $loan->loan_period }} {{ 'Weeks'}}</span>
                        </small>
                        @endif

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- card -->
          </div>
        </div>
      </div>
    </div>
    <!-- content -->
  </div>
@endsection