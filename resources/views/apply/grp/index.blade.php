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
              <li class="breadcrumb-item"><a href="#">Group</a></li>
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
      	<div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- Form Element sizes -->
            <div class="card card-default">
              <div class="card-header">
              	<ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#grp_nw" data-toggle="tab">New</a></li>
                  <li class="nav-item"><a class="nav-link" href="#grp_existing" data-toggle="tab">Existing</a></li>
                  <li class="nav-item"><a class="nav-link" href="#grp_apply" data-toggle="tab">View Applications</a></li>
                </ul>
                <!-- <h3 class="card-title">Different Height</h3> -->
              </div>
              <!-- card-body -->
              <div class="card-body">
                <!-- tab-content -->
                <div class="tab-content">
                  <div class="active tab-pane" id="grp_nw">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Personal Data</h3>
                      </div>
                      <div class="card-body">
                        <form action="/apply/grp" method="post">
                          @csrf
                          <div class="row form-group">
                            <div class="col-3">
                              <div class="form-group">
                                <label>Loan Group</label>
                                <select class="form-control select2bs4" name="id_group" style="width: 100%;" required="required">
                                  @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->group_code.' - '. $group->group_name}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-6">
                              <label>Name</label>
                              <input type="text" name="name" autocomplete="off" class="form-control" placeholder="Full Name" required="required">
                            </div>
                            <div class="col-1">
                              <label>Gender</label>
                              <div class="form-group">
                                <select class="form-control select2bs4" name="gender" data-placeholder="Select Gender" style="width: 100%;" required="required">
                                  <option>Male</option>
                                  <option>Female</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-2">
                              <label>Date of Birth</label>
                              <input type="date" name="dob" autocomplete="off" class="form-control" placeholder="Date of Birth" required="required">
                            </div>
                            
                          </div>
                          <div class="row form-group">
                            <div class="col-2">
                              <div class="form-group">
                                <label>Marital Status</label>
                                <select class="form-control select2bs4" name="marital_status" style="width: 100%;" required="required">
                                  <option value="Single">Single</option>
                                  <option value="Married">Married</option>
                                  <option value="Widowed">Widowed</option>
                                  <option value="Divorced">Divorced</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-3">
                              <label>Telephone</label>
                              <input type="text" name="telephone" autocomplete="off" class="form-control" placeholder="Telephone" required="required">
                            </div>
                            <div class="col-4">
                              <label>Next of Kin</label>
                              <input type="text" name="next_of_kin" autocomplete="off" class="form-control" placeholder="Name of Husband/Wife/Father/Mother" required="required">
                            </div>
                            <div class="col-3">
                              <label>Household Head</label>
                              <input type="text" name="house_head" autocomplete="off" class="form-control" placeholder="Name of Household Head" required="required">
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col-3">
                              <label>Workplace</label>
                              <input type="text" name="work_place" autocomplete="off" class="form-control" placeholder="Workplace" required="required">
                            </div>
                            <div class="col-3">
                              <label>Occupation</label>
                              <input type="text" name="occupation" autocomplete="off" class="form-control" placeholder="Occupation" required="required">
                            </div>
                            <div class="col-3">
                              <label>District</label>
                              <input type="text" name="district" autocomplete="off" class="form-control" placeholder="District of work" required="required">
                            </div>
                          </div>
                          <div class="row form-group">

                            <div class="col-3">
                              <label>District of residence</label>
                              <input type="text" name="resident_district" autocomplete="off" class="form-control" placeholder="District of residence" required="required">
                            </div>
                            <div class="col-3">
                              <label>Subcounty/Division</label>
                              <input type="text" name="resident_division" autocomplete="off" class="form-control" placeholder="Subcounty" required="required">
                            </div>
                            <div class="col-3">
                              <label>Parish/Ward</label>
                              <input type="text" name="resident_parish" autocomplete="off" class="form-control" placeholder="Parish" required="required">
                            </div>
                            <div class="col-3">
                              <label>Village/Cell</label>
                              <input type="text" name="resident_village" autocomplete="off" class="form-control" placeholder="Village of residence" required="required">
                            </div>
                          </div>
                          <div class="row form-group">
                            <button class="btn btn-primary ml-2">Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- tab-pane -->
                  <div class="tab-pane" id="grp_existing">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Personal Data</h3>
                      </div>
                      <div class="card-body">
                        <form action="/apply/ind" method="post">
                          @csrf
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- tab-pane -->
                  <div class="tab-pane" id="grp_apply">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Showing Loan Applications</h3>
                      </div>
                      <div class="card-body">
                        <form action="/apply/ind" method="post">
                          @csrf
                        </form>
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
