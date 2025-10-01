@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan Groups</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">Loan Groups</li>
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
          <!-- col-4 -->
          <div class="col-md-4 col-sm-12">
            <!-- card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">New Loan Group</h3>
              </div>
                <!-- /.card-header -->
              <div class="card-body">

                <form id="submitForm1" method="POST" action="/apply/settings/loan/groups">
                @csrf
                  
                  <div class="form-group row">
                    <div class="col-12">
                      <label>Group Name</label>
                      <input id="group_name" type="text" class="form-control @error('group_name') is-invalid @enderror" name="group_name" value="{{ old('group_name') }}" required  placeholder="Group name" autocomplete="off">
                                @error('group_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-12">
                      <label>Group Description</label>
                      <input id="group_description" type="text" class="form-control @error('group_description') is-invalid @enderror" name="group_description" value="{{ old('group_description') }}" required  placeholder="Group description" autocomplete="off">
                                @error('group_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-12">
                      <label>Group Address</label>
                      <input id="group_address" type="text" class="form-control @error('group_address') is-invalid @enderror" name="group_address" value="{{ old('group_address') }}" required  placeholder="Group address" autocomplete="off">
                                @error('group_address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                    </div>
                  </div>
                  
                  <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-sm btn-outline-primary">
                                    {{ __('Submit') }}
                      </button>
                    </div>
                  </div>
                </form>


              </div>
              <!-- card-body -->
            </div>
            <!-- card -->
          </div>
          <!-- col-8 -->
          <div class="col-md-8 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Showing Loan Groups</h3>
              </div>
                        <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Code</th>
                        <th>Group_Name</th>
                        <th>Group_Description</th>
                        <th>Group_Address</th>
                        <th>Status</th>
                        <th>Disbursement</th>
                        <th>recovery</th>
                        <th>credit_officer</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i =1 @endphp
                      @foreach($groups as $group)
                        <tr>
                          <td>{{ $group->group_code }}</td>
                          <td><a href="/apply/settings/loan/group/members/{{$group->id}}">{{ $group->group_name }}</a></td>
                          <td>{{ $group->group_description}}</td>
                          <td>{{ $group->group_address }}</td>

                          @if($group->group_status == 1)
                            <td class="text-success">Active</td>
                          @else
                            <td class="text-danger">Inactive</td>
                          @endif
                          <td>{{ $group->day_loan_disbursement }}</td>
                          <td>{{ $group->day_loan_recovery }}</td>
                          <td>{{ $group->name }}</td>
                          <td><a href="" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#loan_group{{$group->id}}">Edit</a></td>
                            <div class="modal fade" id="loan_group{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h6 class="modal-title justify-content-center text-uppercase" id="exampleModalLongTitle">edit loan group</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="POST" action="/apply/settings/loan/groups/{{ $group->id }}">
                                    @csrf
                                      
                                      <div class="form-group row">
                                        <div class="col-12">
                                          <label>Group Name</label>
                                          <input class="form-control" name="group_name" value="{{ $group->group_name  }}" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <div class="col-12">
                                          <label>Group Description</label>
                                          <input class="form-control" name="group_description" value="{{ $group->group_description  }}" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <div class="col-12">
                                          <label>Group Address</label>
                                          <textarea name="group_address" class="form-control" required placeholder="Group Address">{{ $group->group_address  }}</textarea>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <div class="col-md-6 col-sm-12">
                                          <label>Loan Disbursement Day</label>
                                          <div class="form-group">
                                            <select class="form-control select2bs4" name="day_loan_disbursement" data-placeholder="Select" style="width: 100%;" required="required">
                                              <option></option>
                                              <option>Monday</option>
                                              <option>Tuesday</option>
                                              <option>Wednesday</option>
                                              <option>Thursday</option>
                                              <option>Friday</option>
                                              <option>Saturday</option>
                                            </select>
                                          </div>
                                        </div>
                                        <!-- col-6 -->
                                        <div class="col-md-6 col-sm-12">
                                          <label>Loan Recovery Day</label>
                                          <div class="form-group">
                                            <select class="form-control select2bs4" name="day_loan_recovery" data-placeholder="Select" style="width: 100%;" required="required">
                                              <option></option>
                                              <option>Monday</option>
                                              <option>Tuesday</option>
                                              <option>Wednesday</option>
                                              <option>Thursday</option>
                                              <option>Friday</option>
                                              <option>Saturday</option>
                                            </select>
                                          </div>
                                        </div>
                                        <!-- col-6 -->
                                      </div>
                                      <div class="form-group row">
                                        <div class="col-12">
                                          <label>Lead Credit Officer</label>
                                          <div class="form-group">
                                            <select class="form-control select2bs4" name="id_lead_credit_officer" data-placeholder="Select" style="width: 100%;" required="required">
                                              <option></option>
                                              @foreach($officers as $officer)
                                              <option value="{{ $officer->id }}">{{ $officer->name }}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row form-group d-flex justify-content-center">
                                        <button class="btn btn-primary ml-2">Submit</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <!-- table -->
                </div>
              </div>
              <!-- card-body -->
            </div>
            <!-- card -->
          </div>
          <!-- row -->
        </div>
        <!-- row -->
      </div>
    </div>
    <!-- Main content -->
  </div>
@endsection