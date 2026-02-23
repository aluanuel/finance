@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">System users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Settings</a></li>

              <li class="breadcrumb-item active">System users</li>
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
          <!-- col-8 -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">View system users</h3>
                <div class="card-tools">
                  <a href="" class="btn btn-xs btn-outline-primary text-uppercase" data-toggle="modal" data-target="#create-user">create</a>
                </div>
              </div>
                        <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;?>
                      @foreach($user as $user)
                      <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->telephone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->usertype }}</td>
                        <td>{{ $user->role }}</td>
                        @if($user->user_status == 1)
                        <td class="text-success">Active</td>
                        <td>
                          <a href="/apply/settings/manage/{{ $user->id }}" class="btn btn-outline-danger btn-sm" title="Generate password"><i class="fa fa-key" aria-hidden="true"></i></a>
                          <a class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#edit-user{{ $user->id }}">Edit</a>
                        </td>
                        @else
                        <td class="text-danger">Inactive</td>
                        <td>
                          <a class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#edit-user{{ $user->id }}">Edit</a>
                        </td>
                        @endif
                        <div class="modal fade" id="edit-user{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                          <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h6 class="modal-title text-uppercase" id="exampleModalLongTitle">edit user</h6>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="/apply/settings/user/{{$user->id}}">
                          @csrf
                          <div class="form-group row">
                            <div class="col-lg-4 col-md-12">
                              <label>Name</label>
                              <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required="required" autofocus placeholder="Full name" autocomplete="off">
                            </div>
                            <!-- col-lg-4 -->
                            <div class="col-lg-4 col-md-12">
                              <label>Telephone</label>
                                <input id="telephone" type="text" class="form-control" name="telephone" value="{{ $user->telephone }}" required="required" placeholder="Telephone" autocomplete="off" pattern="[0-9]{10}">
                            </div>
                            <!-- col-lg-4 -->
                            <div class="col-lg-4 col-md-12">
                              <label>Email</label>
                              <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required  placeholder="Email address" autocomplete="off">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-lg-3 col-md-12">
                              <label>Usertype</label>
                              <div class="form-group">
                                <select class="form-control select2bs4" name="usertype" data-placeholder="Select" style="width: 100%;" required="required">
                                  <option>{{ $user->usertype }}</option>
                                  <option value="Loan Officer">Loan Officer</option>
                                  <option value="Teller">Teller</option>
                                  <option value="Manager">Manager</option>
                                </select>
                              </div>
                            </div>
                              <!-- col-lg-3 -->
                            <div class="col-lg-3 col-md-12">
                              <label>User role</label>
                              <div class="form-group">
                                <select class="form-control select2bs4" name="role" data-placeholder="Select" style="width: 100%;" required="required">
                                  <option>{{ $user->role }}</option>
                                  <option value="None">None</option>
                                  <option value="Supervisor">Supervisor</option>
                                  <option value="Manager">Manager</option>
                                </select>
                              </div>
                            </div>
                              <!-- col-lg-3 -->
                            <div class="col-lg-3 col-md-12">
                              <label>Branch</label>
                              <div class="form-group">
                                <select class="form-control select2bs4" name="id_branch" data-placeholder="Select" style="width: 100%;" required="required">
                                  <option></option>
                                  @foreach($branches as $off)
                                    <option value="{{ $off->id}}">{{ $off->branch_name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <!-- col-lg-3 -->
                            <div class="col-lg-3 col-md-12">
                              <label>User status</label>
                              <div class="form-group">
                                <select class="form-control select2bs4" name="user_status" data-placeholder="Select" style="width: 100%;" required="required">
                                  @if($user->user_status == 0)
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                  @elseif($user->user_status == 1)
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                  @endif
                                </select>
                              </div>
                            </div>
                          </div>
                          <hr>
                            <!-- row -->
                          <div class="form-group row">
                              <div class="col-12">
                              </div>                          
                          </div>
                          <!-- row -->
                          <div class="row form-group">
                            <div class="col-12 text-center">         
                              <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                              <button type="submit" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Cancel</button>
                            </div>
                          </div>
                        </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- modal -->
                      </tr>
                      <?php $i++;?>
                      @endforeach
                    </tbody>
                  </table>
                  <!-- table -->
                </div>
                <!-- table-responsive -->
                <div class="modal fade" id="create-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title text-uppercase" id="exampleModalLongTitle">Register system user</h6>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="/apply/settings/user">
                          @csrf
                          <div class="form-group row">
                            <div class="col-lg-4 col-md-12">
                              <label>Name</label>
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required="required" autofocus placeholder="Full name" autocomplete="off">
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <!-- col-lg-4 -->
                            <div class="col-lg-4 col-md-12">
                              <label>Telephone</label>
                                <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required="required" placeholder="Telephone" autocomplete="off" pattern="[0-9]{10}">
                                @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- col-lg-4 -->
                            <div class="col-lg-4 col-md-12">
                                <label>Email</label>
                                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required  placeholder="Email address" autocomplete="off">
                                  @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-lg-4 col-md-12">
                              <label>Usertype</label>
                                  <div class="form-group">
                                    <select class="form-control select2bs4" name="usertype" data-placeholder="Select" style="width: 100%;" required="required">
                                      <option></option>
                                      <option value="Loan Officer">Loan Officer</option>
                                      <option value="Teller">Teller</option>
                                      <option value="Manager">Manager</option>
                                    </select>
                                  </div>
                            </div>
                              <!-- col-lg-4 -->
                            <div class="col-lg-4 col-md-12">
                                  <label>User role</label>
                                  <div class="form-group">
                                    <select class="form-control select2bs4" name="role" data-placeholder="Select" style="width: 100%;" required="required">
                                      <option></option>
                                      <option value="None">None</option>
                                      <option value="Supervisor">Supervisor</option>
                                      <option value="Manager">Manager</option>
                                    </select>
                                  </div>
                              </div>
                              <!-- col-lg-4 -->
                              <div class="col-lg-4 col-md-12">
                                  <label>Branch</label>
                                  <div class="form-group">
                                    <select class="form-control select2bs4" name="category" data-placeholder="Select" style="width: 100%;" required="required">
                                      <option></option>
                                      <option value="Main">Main</option>
                                    </select>
                                  </div>
                                </div>
                          </div>
                          <hr>
                            <!-- row -->
                          <div class="form-group row">
                              <div class="col-12">
                                <div class="form-group">
                                  <div class="checkbox">
                                    <!-- <span> -->
                                      <input type="checkbox" class="pb-1" required style="vertical-align: middle;">&nbsp;Register user with default permissions
                                    <!-- </span> -->
                                  </div>
                                </div>
                              </div>                          
                          </div>
                          <!-- row -->
                          <div class="row form-group">
                            <div class="col-12 text-center">         
                              <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                              <button type="submit" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Cancel</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- modal -->
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