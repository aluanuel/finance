@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">System User Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">System User Profile</li>
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
              <div class="card">
                <div class="row">
                  <div class="col-4">
                    <div class="card-body box-profile">
                      <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ asset('/img/'.$user->photo)}}"
                             alt="User profile picture">
                      </div>

                      <h3 class="profile-username text-center">{{$user->name}}</h3>

                      <p class="text-muted text-center">{{$user->usertype}} - {{$user->role}}</p>
                    </div>
                  </div>
                  <!-- col-4 -->
                  <div class="col-md-8">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <h3 class="profile-username text-center">Profile Information</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item">
                                <b><i class="fas fa-phone mr-1"></i> Phone</b> <a class="float-right">{{$user->telephone }}</a>
                              </li>
                              <li class="list-group-item">
                                <b><i class="fas fa-envelope mr-1"></i> Email</b> <a class="float-right">{{$user->email }}</a>
                              </li>
                              <li class="list-group-item">
                                <b><i class="fas fa-clock mr-1"></i> Joined</b> <a class="float-right">{{ date('Y-m-d',strtotime($user->created_at)) }}</a>
                              </li>
                            </ul>
                        </div>
                        <div class="col-6">
                          <h3 class="profile-username text-center">Account Information</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item text-center">
                                <button class="btn btn-outline-primary btn-sm" id="btnChangePassword">Change Password</button>
                              </li>
                              <li class="list-group-item text-center">
                                <button class="btn btn-outline-primary btn-sm" id="btnChangePhoto">Change Photo</button>
                              </li>
                            </ul>
                        </div>
                        <!-- col-6 -->
                      </div>
                      <!-- row -->
                      <form action="/apply/user/update/{{$user->id}}" method="post" id="formChangePassword">
                              @csrf
                              <div class="row form-group">
                                <!-- <div class="col-12 text-center" id="infoPassword">
                                  <label class="text-center text-danger">Password mismatch</label>
                                </div> -->
                                <div class="col-3">
                                  <input class="form-control" type="password" name="password_old" placeholder="Old password" required="required" autofocus>
                                </div>
                                <div class="col-4">
                                  <input class="form-control" type="password" name="password" placeholder="New password" id="password1" required="required">
                                </div>
                                <div class="col-4">
                                  <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm new password" id="password2" required="required">
                                </div>
                                <div class="col-1">
                                  <button class="btn btn-outline-primary">Save</button>
                                </div>
                              </div>  
                            </form>
                            <form action="/apply/user/update/photo/{{$user->id}}" method="post" id="formChangePhoto" enctype="multipart/form-data">
                              @csrf
                              <div class="row form-group">
                                <div class="col-10 input-group">
                                  <div class="custom-file">
                                    <input type="file" name="photo" class="form-control custom-file-input" id="exampleInputFile" required="required" accept="image/png, image/jpeg">
                                    <label class="custom-file-label" for="exampleInputFile">Upload Photo</label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <button class="btn btn-outline-primary">Change</button>
                                </div>
                              </div>
                            </form>
                    </div>
                  
                </div>
                </div>
                <!-- row -->
              </div>
              <!-- col-12 -->
            </div>
          </div>
          <!-- row -->
        </div>
      </div>
      <!-- Main content -->
    </div>
    <!-- content-wrapper -->
    @endsection