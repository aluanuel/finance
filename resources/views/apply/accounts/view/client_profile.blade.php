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
              <li class="breadcrumb-item"><a href="#">Accounts</a></li>
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
            <div class="col-md-4 col-sm-12">
              <!-- card -->
              <div class="card">
                <div class="card-body box-profile">
                      <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ asset('/img/1611593817.png')}}"
                             alt="User profile picture">
                      </div>

                      <h3 class="profile-username text-center">{{ $client->name }}</h3>
                      <p class="text-muted text-center">{{ $client->occupation}}</p>
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Followers</b> <a class="float-right">1,322</a>
                        </li>
                        <li class="list-group-item">
                          <b>Following</b> <a class="float-right">543</a>
                        </li>
                        <li class="list-group-item">
                          <b>Friends</b> <a class="float-right">13,287</a>
                        </li>
                      </ul>
                    </div>
              </div> 
              <!-- card   -->
                <!-- About Me Box -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">About Me</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <strong><i class="fas fa-book mr-1"></i> Education</strong>

                  <p class="text-muted">
                    B.S. in Computer Science from the University of Tennessee at Knoxville
                  </p>

                  <hr>

                  <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                  <p class="text-muted">Malibu, California</p>

                  <hr>

                  <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                  <p class="text-muted">
                    <span class="tag tag-danger">UI Design</span>
                    <span class="tag tag-success">Coding</span>
                    <span class="tag tag-info">Javascript</span>
                    <span class="tag tag-warning">PHP</span>
                    <span class="tag tag-primary">Node.js</span>
                  </p>

                  <hr>

                  <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                  <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- col-md-4 -->
            <div class="col-md-8 col-sm-12">
              <div class="card">
                <div class="card-header text-uppercase">
                  <ul class="nav nav-pills" id="myTab">
                    <li class="nav-item"><a class="nav-link active" href="#loan_details" data-toggle="tab">Loan Details</a></li>
                    <li class="nav-item"><a class="nav-link" href="#loan_history" data-toggle="tab">Loan History</a></li>
                  </ul>
                </div>
                <!-- card-header -->
                <!-- card-body -->
                <div class="card-body">
                  <!-- tab-content -->
                  <div class="tab-content">
                    <!-- tab-pane -->
                    <div class="active tab-pane" id="loan_details">
                    </div>
                    <!-- tab-pane -->
                    <div class="tab-pane" id="loan_history">
                    </div>
                    <!-- tab-pane -->
                  </div>
                  <!-- tab-content -->
                </div>
                <!-- card-body -->
              </div>
              <!-- card -->
            </div>
            <!-- col-md-8 -->
          </div>
          <!-- row -->
        </div>
      </div>
      <!-- Main content -->
    </div>
    <!-- content-wrapper -->
    @endsection