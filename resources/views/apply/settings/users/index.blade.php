@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">System Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Settings</a></li>

              <li class="breadcrumb-item active">System Users</li>
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
          <div class="col-4">
            <!-- card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">New System User</h3>
              </div>
                <!-- /.card-header -->
              <div class="card-body">

                <form method="POST" action="/apply/settings/user">
                @csrf
                        <div class="form-group row">
                            <div class="col-12">
                              <label>Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required="required" autofocus placeholder="Full Name" autocomplete="off">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-12">
                            <label>Telephone</label>
                              <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required="required" placeholder="Telephone" autocomplete="off" pattern="[0-9]{10}">
                              @error('telephone')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                              <label>Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required  placeholder="Email Address" autocomplete="off">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
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
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
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
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label>Category</label>
                                <div class="form-group">
                                  <select class="form-control select2bs4" name="category" data-placeholder="Select" style="width: 100%;" required="required">
                                    <option></option>
                                    <option value="None">None</option>
                                    <option value="Individual">Individual</option>
                                    <option value="Group">Group</option>
                                  </select>
                                </div>
                              </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-outline-primary">
                                    {{ __('Register') }}
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
          <div class="col-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Showing System Users</h3>
              </div>
                        <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th width="4">#</th>
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
                        <a href="/apply/settings/manage/{{ $user->id }}" class="btn btn-outline-primary btn-sm" ><i class="fa fa-key" aria-hidden="true"></i></a>
                      </td>
                      @else
                      <td class="text-danger">Inactive</td>
                      <td><a href="/apply/settings/manage?id={{ $user->id }}&state={{ $user->user_status}}" class="btn btn-outline-primary btn-sm"><i class="fa fa-unlock" aria-hidden="true"></i></a></td>
                      @endif
                    </tr>
                    <?php $i++;?>
                    @endforeach
                  </tbody>
                </table>
                <!-- table -->
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