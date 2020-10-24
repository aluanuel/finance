@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan Assessment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Individual</a></li>
              <li class="breadcrumb-item active">Loan Assessment</li>
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
                  <li class="nav-item"><a class="nav-link active" href="#nw_assess" data-toggle="tab">Loans Awaiting Assessment
                  </a></li>
                  <li class="nav-item"><a class="nav-link" href="#ln_to_approve" data-toggle="tab">Loans Awaiting Approval</a></li>
                  <li class="nav-item"><a class="nav-link" href="#nw_approve" data-toggle="tab">Approved Loans</a></li>
                  <li class="nav-item"><a class="nav-link" href="#nw_cancel" data-toggle="tab">Cancelled Loans</a></li>
                </ul>
                <!-- <h3 class="card-title">Different Height</h3> -->
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="nw_assess">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Loans Awaiting Assessment</h3>
                      </div>
                              <!-- /.card-header -->
                      <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 12px;">#</th>
                                    <th style="width: 30px;">Number</th>
                                    <th>Applicant</th>
                                    <th>Amount</th>
                                    <th style="width: 120px;">#</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $x = 1;?>
                              @foreach($loan as $loans)
                                <tr>
                                  <td>{{ $x }}</td>
                                  <td>{{ $loans->loan_number }}</td>
                                  <td>{{ $loans->name }}</td>
                                  <td>{{ number_format($loans->proposed_amount) }}</td>
                                  <td>
                                    <div class="row">
                                      <div class="col-6">
                                        <a href="/apply/assess/{{$loans->id}}">
                                          <button type="submit" class="btn btn-block btn-outline-primary btn-sm">Assess</button>
                                        </a>
                                      </div>
                                      <div class="col-6">
                                        <form action="/apply/ind/assess/{{$loans->id}}" method="post">
                                              @csrf
                                          <button type="submit" class="btn btn-block btn-outline-primary btn-sm">View</button>
                                        </form>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              <?php $x++;?>
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="ln_to_approve">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Loans Awaiting Approval</h3>
                      </div>
                              <!-- /.card-header -->
                      <div class="card-body">
                        <table id="example3" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 12px;">#</th>
                                    <th style="width: 30px;">Number</th>
                                    <th>Applicant</th>
                                    <th>Amount</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $x = 1;?>
                              @foreach($approve as $app)
                                <tr>
                                  <td>{{ $x }}</td>
                                  <td>{{ $app->loan_number }}</td>
                                  <td>{{ $app->name }}</td>
                                  <td>{{ number_format($app->proposed_amount) }}</td>
                                  <td></td>
                                </tr>
                              <?php $x++;?>
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>


                  <div class="tab-pane" id="nw_approve">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Approved Loans</h3>
                      </div>
                              <!-- /.card-header -->
                      <div class="card-body">
                        <table id="example3" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 8px;">#</th>
                                    <th style="width: 30px;">Number</th>
                                    <th>Amount</th>
                                    <th>Period</th>
                                    <th>Applicant</th>
                                    <th>Telephone</th>
                                    <th style="width: 80px;">#</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $x = 1;?>
                              @foreach($approved as $app)
                                <tr>
                                  <td>{{ $x }}</td>
                                  <td>{{ $app->loan_number }}</td>
                                  <td>{{ number_format($app->recommended_amount) }}</td>
                                  <td>{{ $app->loan_period }}</td>
                                  <td>{{ $app->name}}</td>
                                  <td>{{ $app->telephone}}</td>
                                  <td>
                                    <a href="/app/ind/schedule/{{$app->id}}"><button class="btn btn-outline-primary btn-sm">Schedule</button></a>
                                  </td>
                                </tr>
                              <?php $x++;?>
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="nw_cancel">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Cancelled Loans</h3>
                      </div>
                      <div class="card-body">
                        <table id="example4" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 8px;">#</th>
                                    <th style="width: 30px;">Number</th>
                                    <th>Applicant</th>
                                    <th>Telephone</th>
                                    <th>Loan Request</th>
                                    <th>Period (Months)</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $x = 1;?>
                              @foreach($cancelled as $app)
                                <tr>
                                  <td>{{ $x }}</td>
                                  <td>{{ $app->loan_number }}</td>
                                  <td>{{ $app->name}}</td>
                                  <td>{{ $app->telephone}}</td>
                                  <td>{{ number_format($app->proposed_amount) }}</td>
                                  <td>{{ $app->loan_period }}</td>
                                </tr>
                              <?php $x++;?>
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
  			</div>
      </div>
    </div>
</div>
<!-- content wrapper -->
@endsection