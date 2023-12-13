@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Group Loan Application</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Group Loan</a></li>
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
              	<ul class="nav nav-pills" id="myTab">
                  <li class="nav-item"><a class="nav-link active" href="#grp_existing" data-toggle="tab">Loan Application</a></li>
                  <li class="nav-item"><a class="nav-link" href="#grp_apply" data-toggle="tab">View Loan Applications</a></li>
                </ul>
                <!-- <h3 class="card-title">Different Height</h3> -->
              </div>
              <!-- card-body -->
              <div class="card-body">
                <!-- tab-content -->
                <div class="tab-content">
                  <div class="active tab-pane" id="grp_existing">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Personal Data</h3>
                      </div>
                      <div class="card-body">
                        <form action="/apply/grp" method="post">
                          @csrf
                          <div class="row form-group">
                            <div class="col-8">
                                <div class="form-group">
                                  <label>Select Client</label>
                                  <select class="form-control select2bs4" name="id_client" id="id_client_with_group" data-placeholder="Search By Client Name | Client Telephone | Group Name | Group Code" style="width: 100%;">
                                    <option></option>
                                    @foreach($register as $client)
                                    <option value="{{ $client->id}}" label="{{ $client->id_group}}">[ {{$client->name}} - {{$client->telephone}} ] [ {{$client->group_name}} - {{$client->group_code}} ] </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            <div class="col-2">
                                <label>Application Fee</label>
                                <input type="text" name="application_fee" autocomplete="off" class="form-control" placeholder="Application fee" readonly="readonly" value="{{$fee->application_amount}}">
                            </div>
                            <div class="col-2">
                                <label>Interest Rate (%)</label>
                                <input type="text" name="interest_rate" autocomplete="off" class="form-control" placeholder="Application fee" required="required" value="{{ ($interest->interest_rate)}}">
                            </div>
                              <input type="hidden" name="application_date" autocomplete="off" class="form-control" placeholder="Application date" value="<?php echo date('Y-m-d h:i:s'); ?>">
                              <input type="hidden" name="loan_number" autocomplete="off" class="form-control" value="{{ $loanNumber }}">
                              <input type="hidden" name="id_group" id="id_group" autocomplete="off">
                          </div>
                          <div class="row form-group">
                              <button class="btn btn-primary ml-2">Submit</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- tab-pane -->
                  <div class="tab-pane" id="grp_apply">
                   <!--  <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Showing Loan Applications</h3>
                      </div>
                      <div class="card-body">
                        <form action="/apply/ind" method="post">
                          @csrf
                        </form>
                      </div>
                    </div> -->
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Showing Loan Applications</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body" style="overflow-x: scroll;">
                            <table id="example1" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                <th>#</th>
                                <th>Number</th>
                                <th>Group</th>
                                <th>Group Code</th>
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
                                @foreach($loan as $ln) 
                                <tr>
                                  <td>{{ $i }}</td>
                                  <td>{{ $ln->loan_number }}</td>
                                  <td>{{ $ln->group_name }}</td>
                                  <td>{{ $ln->group_code }}</td>
                                  <td>{{ $ln->name }}</td>
                                  <td>{{ $ln->telephone }}</td>
                                  <td>{{ $ln->gender }}</td>
                                  <td>{{ $ln->marital_status }}</td>
                                  <td>{{ $ln->employer }}</td>
                                  <td>{{ $ln->occupation }}</td>
                                  <td><a href="/apply/grp/assess/{{$ln->id}}" class="btn btn-outline-primary">Assess</a></td>
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
                    </div>
                  </div>
                  <!-- tab-pane -->
                </div>
                <!-- tab-content -->
              </div>
              <!-- card-body -->
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
  <!-- /.content-wrapper -->


@endsection
