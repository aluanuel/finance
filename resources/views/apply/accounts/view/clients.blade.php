@extends('layouts.custom')

@section('content')
	  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Accounts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Accounts</li>
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
                <div class="card-header">
                  <h3 class="card-title">Showing Client Accounts</h3>
                  <div class="card-tools">
                    <a class="btn btn-outline-primary" href="/apply/accounts/new">NEW ACCOUNT</a>
                  </div>
                </div>
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>a/c number</th>
                        <th>a/c name</th>
                        <th>gender</th>
                        <th>telephone</th>
                        <th>occupation</th>
                        <th>account_status</th>
                        <th>created_at</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $x =1;?>
                      @foreach($accounts as $ac)
                      <tr>
                        <td><a href="/apply/account/profile/{{$ac->id}}">{{$x}}</a></td>
                        <td><a href="/apply/account/profile/{{$ac->id}}">{{ $ac->account_number }}</a></td>
                        <td><a href="/apply/account/profile/{{$ac->id}}">{{ $ac->name }}</a></td>
                        <td><a href="/apply/account/profile/{{$ac->id}}">{{ $ac->gender }}</a></td>
                        <td><a href="/apply/account/profile/{{$ac->id}}">{{ $ac->telephone }}</a></td>
                        <td><a href="/apply/account/profile/{{$ac->id}}">{{ $ac->occupation }}</a></td>
                        @switch($ac->account_status)
                          @case(0)
                          <td class="text-danger">Inactive</td>
                          @break
                          @case(1)
                          <td class="text-primary">Active</td>
                          @break
                        @endswitch
                        <td><a href="/apply/account/profile/{{$ac->id}}">{{ date('Y-m-d',strtotime($ac->created_at)) }}</a></td>
                      </tr>
                      <?php $x++;?>
                      @endforeach
                    </tbody>
                  </table>
                </div>   
              </div>
            </div>
          </div>
          <!-- row -->
        </div>
      </div>
      <!-- content -->
    </div>
    <!-- content-wrapper -->
@endsection