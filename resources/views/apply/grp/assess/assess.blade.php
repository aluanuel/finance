@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Group Loan Assessment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Group</a></li>
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
            <!-- Form Element sizes -->
            <div class="card card-default">
              <div class="card-header">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#grp_ln_approve" data-toggle="tab">Loans Awaiting Approval</a></li>
                  <li class="nav-item"><a class="nav-link" href="#grp_ln_approved" data-toggle="tab">Approved Loans</a></li>
                  <li class="nav-item"><a class="nav-link" href="#grp_ln_cancelled" data-toggle="tab">Cancelled Loans</a></li>
                </ul>
                <!-- <h3 class="card-title">Different Height</h3> -->
              </div>
              <!-- card-body -->
              <div class="card-body">
                <!-- tab-content -->
                <div class="tab-content">
                  <div class="active tab-pane" id="grp_ln_approve">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Loans Awaiting Approval</h3>
                      </div>
                      <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 12px;">#</th>
                                    <th style="width: 30px;">Number</th>
                                    <th style="width: 30px;">Code</th>
                                    <th>Group Name</th>
                                    <th>Applicant</th>
                                    <th>Loan Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $x = 1;?>
                              @foreach($approve as $app)
                              <tr>
                                <td>{{$x}}</td>
                                <td>{{ $app->loan_number}}</td>
                                <td>{{ $app->group_code}}</td>
                                <td>{{ $app->group_name}}</td>
                                <td>{{ $app->name}}</td>
                                <td>{{ number_format($app->proposed_amount)}}</td>
                              </tr>
                              <?$x++;?>
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                <!-- tab-pane -->
                  <div class="tab-pane" id="grp_ln_approved">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Approved Loans</h3>
                      </div>
                      <div class="card-body">
                        <table id="example3" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 12px;">#</th>
                                    <th style="width: 30px;">Number</th>
                                    <th style="width: 30px;">Code</th>
                                    <th>Group Name</th>
                                    <th>Applicant</th>
                                    <th>Loan Amount</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $x = 1;?>
                              @foreach($approved as $approve)
                              <tr>
                                <td>{{$x}}</td>
                                <td>{{ $approve->loan_number}}</td>
                                <td>{{ $approve->group_code}}</td>
                                <td>{{ $approve->group_name}}</td>
                                <td>{{ $approve->name}}</td>
                                <td>{{ number_format($approve->proposed_amount)}}</td>
                                <td><a href="" class="button btn-outline-primary btn-sm">Schedule</a> </td>
                              </tr>
                              <?$x++;?>
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                <!-- tab-pane -->
                  <div class="tab-pane" id="grp_ln_cancelled">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Cancelled Loans</h3>
                      </div>
                      <div class="card-body">
                        <table id="example3" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 12px;">#</th>
                                    <th style="width: 30px;">Number</th>
                                    <th style="width: 30px;">Code</th>
                                    <th>Group Name</th>
                                    <th>Applicant</th>
                                    <th>Loan Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $x = 1;?>
                              @foreach($cancelled as $cancel)
                              <tr>
                                <td>{{$x}}</td>
                                <td>{{ $cancel->loan_number}}</td>
                                <td>{{ $cancel->group_code}}</td>
                                <td>{{ $cancel->group_name}}</td>
                                <td>{{ $cancel->name}}</td>
                                <td>{{ number_format($cancel->proposed_amount)}}</td>
                              </tr>
                              <?$x++;?>
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                      <!-- card-body -->
                    </div>
                  </div>
                  <!-- tab-pane -->
                </div>
                <!-- tab-content -->
              </div>
              <!-- card-body -->
            </div>
            <!-- card -->
          </div>
          <!-- col-12 -->
        </div>
        <!-- row -->
      </div>
    </div>
    <!-- Main content -->
  </div>
  <!-- content-wrapper -->
  @endsection