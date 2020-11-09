@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Personal Loan Application</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Individual</a></li>
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
          <!-- right column -->
          <div class="col-md-12">
            <!-- Form Element sizes -->
            <div class="card card-default">
              <div class="card-header">
              	<ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#nw_ind_ln" data-toggle="tab">New</a></li>
                  <li class="nav-item"><a class="nav-link" href="#cont_ind_ln" data-toggle="tab">Existing</a></li>
                  <li class="nav-item"><a class="nav-link" href="#list_ind_ln" data-toggle="tab">View Applications</a></li>
                </ul>
                <!-- <h3 class="card-title">Different Height</h3> -->
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="nw_ind_ln">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Personal Data</h3>
                      </div>
                      <div class="card-body">
                        <form action="/apply/ind" method="post">
                          @csrf
                          <div class="row form-group">
                            <div class="col-6">
                              <label>Name</label>
                              <input type="text" name="name" autocomplete="off" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="col-6">
                              <label>Telephone</label>
                              <input type="text" name="telephone" autocomplete="off" class="form-control" placeholder="Telephone Contact">
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-6">
                              <label>Gender</label>
                              <div class="form-group">
                                <select class="form-control select2bs4" name="gender" data-placeholder="Select Gender" style="width: 100%;">
                                  <option>Male</option>
                                  <option>Female</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group">
                                <label>Marital Status</label>
                                <select class="form-control select2bs4" name="marital_status" style="width: 100%;">
                                  <option value="Single">Single</option>
                                  <option value="Married">Married</option>
                                  <option value="Widowed">Widowed</option>
                                  <option value="Divorced">Divorced</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-4">
                              <label>Workplace</label>
                              <input type="text" name="work_place" autocomplete="off" class="form-control" placeholder="Workplace">
                            </div>
                            <div class="col-4">
                              <label>Occupation</label>
                              <input type="text" name="occupation" autocomplete="off" class="form-control" placeholder="Occupation">
                            </div>
                            <div class="col-2">
                              <label>Application Fee</label>
                              <input type="text" name="application_fee" autocomplete="off" class="form-control" placeholder="Application fee" readonly="readonly" value="{{$fee->appraisal_amount}}">
                            </div>
                            <div class="col-2">
                                <label>Interest Rate (%)</label>
                                <input type="text" name="interest_rate" autocomplete="off" class="form-control" placeholder="Interest rate" required="required" value="{{ ($interest->interest_rate)}}">
                            </div>
                          </div>
                          <input type="hidden" name="application_date" autocomplete="off" class="form-control" placeholder="Application date" value="<?php echo date('Y-m-d h:i:s'); ?>">
                          <input type="hidden" name="loan_number" autocomplete="off" class="form-control" value="{{ $loan }}">

                          <input type="hidden" name="registration_date" value="<?php echo date('Y-m-d'); ?>">
                          <input type="hidden" name="registered_by" value="{{ Auth()->id()}}">
                          <div class="row form-group">
                            <button class="btn btn-primary ml-2">Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="cont_ind_ln">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Personal Data</h3>
                      </div>
                      <div class="card-body">
                        <form action="/apply/ind" method="post">
                          @csrf
                          <div class="row form-group">
                            <div class="col-8">
                                <div class="form-group">
                                  <label>Select client</label>
                                  <select class="form-control select2bs4" name="id_client" style="width: 100%;">
                                    @foreach($register as $client)
                                    <option value="{{ $client->id}}">{{$client->name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            <div class="col-2">
                                <label>Application Fee</label>
                                <input type="text" name="application_fee" autocomplete="off" class="form-control" placeholder="Application fee" readonly="readonly" value="{{$fee->appraisal_amount}}">
                            </div>
                            <div class="col-2">
                                <label>Interest Rate (%)</label>
                                <input type="text" name="interest_rate" autocomplete="off" class="form-control" placeholder="Application fee" required="required" value="{{ ($interest->interest_rate)}}">
                            </div>
                              <input type="hidden" name="application_date" autocomplete="off" class="form-control" placeholder="Application date" value="<?php echo date('Y-m-d h:i:s'); ?>">
                              <input type="hidden" name="loan_number" autocomplete="off" class="form-control" value="{{ $loan }}">
                          </div>
                          <div class="row form-group">
                              <button class="btn btn-primary ml-2">Submit</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="list_ind_ln">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Showing Loan Applications</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                <th>#</th>
                                <th>Number</th>
                                <th>Name</th>
                                <th>Telephone</th>
                                <th>Gender</th>
                                <th>Marital Status</th>
                                <th>Workplace</th>
                                <th>Occupation</th>
                                <th>#</th>
                              </tr>
                              </thead>
                              <tbody>
                                <?php $i = 1;?>
                                @foreach($clients as $client)
                                <tr>
                                  <td>{{ $i }}</td>
                                  <td>{{ $client->loan_number }}</td>
                                  <td>{{$client->name}}</td>
                                  <td>{{$client->telephone}}</td>
                                  <td>{{$client->gender}}</td>
                                  <td>{{$client->marital_status}}</td>
                                  <td>{{$client->work_place}}</td>
                                  <td>{{$client->occupation}}</td>
                                  <td>
                                    <form action="/apply/ind/cont/{{ $client->id}}" method="post">
                                      @csrf
                                      <button type="submit" class="btn btn-block btn-outline-primary btn-sm">Continue</button>
                                    </form>
                                  </td>
                                  <?php $i++;?>
                                </tr>
                                @endforeach
                              </tbody>
                              <tfoot>
                              <tr>
                                <th>#</th>
                                <th>NUmber</th>
                                <th>Name</th>
                                <th>Telephone</th>
                                <th>Gender</th>
                                <th>Marital Status</th>
                                <th>Workplace</th>
                                <th>Occupation</th>
                                <th>#</th>
                              </tr>
                              </tfoot>
                            </table>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>
                </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- Main content -->
</div>
  <!-- /.content-wrapper -->


@endsection
