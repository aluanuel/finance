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
              <li class="breadcrumb-item"><a href="#">Group Loan</a></li>
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
                  <!-- <li class="nav-item"><a class="nav-link active" href="#admin_grp_assess" data-toggle="tab">Loans Awating Assessment</a></li> -->
                  <li class="nav-item"><a class="nav-link active" href="#admin_grp_approve" data-toggle="tab">Loans Awating Approval</a></li>
                  <li class="nav-item"><a class="nav-link" href="#admn_grp_approved" data-toggle="tab">Approved Loans</a></li>
                  <li class="nav-item"><a class="nav-link" href="#admn_grp_cancelled" data-toggle="tab">Cancelled Loans</a></li>
                </ul>
                <!-- <h3 class="card-title">Different Height</h3> -->
              </div>
              <div class="card-body">
                <div class="tab-content">
                  
                  <div class="active tab-pane" id="admin_grp_approve">
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
                                <th style="width: 30px;">Code</th>
                                <th>Group Name</th>
                                <th>Applicant</th>
                                <th>Amount</th>
                                <th>#</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $i = 1;?>
                              @foreach($approve as $app)
                                <tr>
                                  <td>{{$i}}</td>
                                  <td>{{ $app->loan_number }}</td>
                                  <td>{{ $app->group_code }}</td>
                                  <td>{{ $app->group_name }}</td>
                                  <td>{{ $app->name }}</td>
                                  <td>{{ number_format($app->proposed_amount) }}</td>
                                  <td>
                                    <a href="/apply/admin/grp/assess/{{$app->id}}" class="btn btn-outline-primary btn-sm">Assess</a>
                                  </td>
                                </tr>
                                <?$i++;?>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <!-- card -->
                    </div>
                    <!-- tab-pane -->
                    <div class="tab-pane" id="admn_grp_approved">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Approved Loans</h3>
                        </div>
                                <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example4" class="table table-bordered table-hover">
                             <thead>
                                <tr>
                                  <th style="width: 12px;">#</th>
                                  <th style="width: 30px;">Number</th>
                                  <th style="width: 30px;">Code</th>
                                  <th>Group Name</th>
                                  <th>Applicant</th>
                                  <th>Amount</th>
                                  <th>Period(Weeks)</th>
                                  <th>Telephone</th>
                                  <th style="width: 80px;">#</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($approved as $appr)
                                <?php $k = 1;?>
                                  <tr>
                                    <td>{{$k}}</td>
                                    <td>{{$appr->loan_number }}</td>
                                    <td>{{$appr->group_code }}</td>
                                    <td>{{$appr->group_name }}</td>
                                    <td>{{$appr->name }}</td>
                                    <td>{{number_format($appr->recommended_amount) }}</td>
                                    <td>{{$appr->loan_period }}</td>
                                    <td>{{$appr->telephone }}</td>
                                    <td><a href="/app/ind/schedule/{{$appr->id}}" class="btn btn-outline-primary btn-sm">Schedule</td>
                                  </tr>
                                <?php $k++?>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                          <!-- card-body -->
                        </div>
                        <!-- card -->
                    </div>
                      <!-- tab-pan -->
                    <div class="tab-pane" id="admn_grp_cancelled">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Cancelled Loans</h3>
                        </div>
                                <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example5" class="table table-bordered table-hover">
                             <thead>
                                <tr>
                                  <th style="width: 12px;">#</th>
                                  <th style="width: 30px;">Number</th>
                                  <th style="width: 30px;">Code</th>
                                  <th>Group Name</th>
                                  <th>Applicant</th>
                                  <th>Amount</th>
                                  <th style="width: 80px;">#</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($cancelled as $cancel)
                                <?php $i = 1;?>
                                  <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $cancel->loan_number }}</td>
                                    <td>{{ $cancel->group_code }}</td>
                                    <td>{{ $cancel->group_name }}</td>
                                    <td>{{ $cancel->name }}</td>
                                    <td>{{ number_format($cancel->proposed_amount) }}</td>
                                    <td>
                                      <div class="row">
                                        <div class="col-6">
                                          <form action="" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-block btn-outline-warning">Allow</button>
                                          </form>
                                        </div>
                                        <div class="col-6">
                                          <form action="" method="post">
                                          @csrf
                                          <button type="submit" class="btn btn-block btn-outline-danger">Delete</button>
                                        </form>
                                        </div>
                                      </div>
                                    </td>
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
                      <!-- tab-pane -->
                </div>
                <!-- tab-content -->
              </div>
            </div>
            <!-- card -->
          </div>
          <!-- col-12 -->
        </div>
        <!-- row -->
      </div>
      <!-- container-fluid -->
    </div>
    <!-- content -->
  </div>
  <!-- content-wrapper -->
  @endsection