@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Client Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Client Profile</li>
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
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ asset('theme/dist/img/user4-128x128.jpg')}}"
                         alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-center">{{$loan->name}}</h3>

                  <p class="text-muted text-center">{{$loan->occupation}}</p>
                  <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b><i class="fas fa-phone mr-1"></i> Phone</b> <a class="float-right">{{$loan->telephone }}</a>
                  </li>
                  <li class="list-group-item">
                    <b><i class="fas fa-venus-mars mr-1"></i> Gender</b> <a class="float-right">{{$loan->gender }}</a>
                  </li>
                  <li class="list-group-item">
                    <b><i class="fas fa-venus-double mr-1"></i> Marital Status</b> <a class="float-right">{{$loan->marital_status }}</a>
                  </li>
                  <li class="list-group-item">
                    <b><i class="fas fa-laptop-house mr-1"></i> Workplace</b> <a class="float-right">{{$loan->work_place }}</a>
                  </li>
                  <li class="list-group-item">
                    <b><i class="fas fa-building mr-1"></i> District of Work</b> <a class="float-right">{{$loan->district }}</a>
                  </li>
                  <li class="list-group-item">
                    <b><i class="fas fa-map-marker-alt mr-1"></i> Village</b> <a class="float-right">{{$loan->resident_village }}</a>
                  </li>
                  <li class="list-group-item">
                    <b><i class="fas fa-map-marker-alt mr-1"></i> Parish</b> <a class="float-right">{{$loan->resident_parish }}</a>
                  </li>
                  <li class="list-group-item">
                    <b><i class="fas fa-map-marker-alt mr-1"></i> Sub county</b> <a class="float-right">{{$loan->resident_division }}</a>
                  </li>
                  <li class="list-group-item">
                    <b><i class="fas fa-map-marker-alt mr-1"></i> District of Residence</b> <a class="float-right">{{$loan->resident_district }}</a>
                  </li>
                  <li class="list-group-item">
                    <b><i class="fas fa-user-friends mr-1"></i>Loan Group</b> <a class="float-right">{{$loan->id_group }}</a>
                  </li>
                  <li class="list-group-item">
                    <b><i class="fas fa-user mr-1"></i> Group Leader</b> <a class="float-right">{{$loan->role }}</a>
                  </li>
                </ul>

                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#ln_activity" data-toggle="tab">Loan Activity</a></li>
                    <li class="nav-item"><a class="nav-link" href="#ln_history" data-toggle="tab">Loan History</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="ln_activity">
                      <!-- card -->
                        <div class="card">
                          <div class="card-header">
                            <h4 class="card-title text-primary">Loan Details</h4>
                          </div>
                          <div class="card-body">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th style="width: 40px">Number</th>
                                  <th>Loan Request</th>
                                  <th>Loan Outstanding</th>
                                  <th>Security</th>
                                  <th>Loan Recovered</th>
                                  <th>Loan Balance</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>{{$loan->loan_number}}</td>
                                  <td>{{number_format($loan->proposed_amount)}}</td>
                                  <td>{{number_format($loan->total_loan)}}</td>
                                  <td>{{number_format($loan->security)}}</td>
                                  <td>{{number_format($loan->loan_recovered)}}</td>
                                  <td>{{number_format($loan->loan_balance)}}</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                     <!-- card -->
                        <div class="card">
                          <div class="card-header">
                            <h4 class="card-title text-primary">Ledger Book</h4>
                          </div>
                          <div class="card-body">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th style="width: 40px">Ticket</th>
                                  <th style="width: 60px">Date</th>
                                  <th>Loan Instalment</th>
                                  <th>Paid By</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($ledger as $pay)
                                <tr>
                                  <td>{{$pay->receipt_number}}</td>
                                  <td>{{date('Y-m-d',strtotime($pay->created_at))}}</td>
                                  <td>{{number_format($pay->deposit)}}</td>
                                  <td>{{$pay->depositer}}</td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- card -->
                        <div class="card">
                          <div class="card-header">
                            <h4 class="card-title text-primary">Payment Schedule</h4>
                          </div>
                        </div>
                        <!-- card -->

                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="ln_history">
                      @foreach($history as $hist)
                      <div class="card card-success">
                        <div class="card-header">
                          <h3 class="card-title">{{ $hist->loan_number }}</h3>

                          <div class="card-tools">
                            <span title="3 New Messages" class="badge badge-warning">{{$hist->loan_status}}</span>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- card -->
                            <div class="card">
                              <div class="card-header">
                                <h4 class="card-title text-primary">Loan Details</h4>
                              </div>
                              <div class="card-body">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th style="width: 40px">Number</th>
                                      <th>Loan Request</th>
                                      <th>Loan Outstanding</th>
                                      <th>Security</th>
                                      <th>Loan Recovered</th>
                                      <th>Loan Balance</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>{{$hist->loan_number}}</td>
                                      <td>{{number_format($hist->proposed_amount)}}</td>
                                      <td>{{number_format($hist->total_loan)}}</td>
                                      <td>{{number_format($hist->security)}}</td>
                                      <td>{{number_format($hist->loan_recovered)}}</td>
                                      <td>{{number_format($hist->loan_balance)}}</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                         <!-- card -->


                        </div>
                        <!-- /.card-body -->
                      </div>
                      @endforeach

                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
      </div>
    </div>
  </div>
  <!-- content wrapper -->
@endsection