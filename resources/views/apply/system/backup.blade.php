@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Backup</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">System</a></li>
              <li class="breadcrumb-item active">Backup</li>
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
        <!-- <div class="row"> -->
          <!-- right column -->
          <div class="card">
            <div class="card-body">
              <form action="/apply/system/backup" method="post">
                @csrf
                <div class="text-center">
                  <h4>Click the button below to backup system files</h4>
                </div>
                  <div class="d-flex justify-content-center align-items-center p-4">
                    <input type="submit" name="submit" class="btn btn-outline-primary btn-lg" value="Backup Data">
                  </div>    
              </form>
            </div>
          </div> 
          <!-- card  -->
      </div>
    <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection
