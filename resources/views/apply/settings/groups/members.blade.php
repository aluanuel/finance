@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Group Members</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Loan Groups</a></li>
              <li class="breadcrumb-item active">Group Members</li>
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
                  <h3 class="card-title">Showing {{$group->group_name}} ({{$group->group_code}}) Loan Group Members</h3>
                </div>
                          <!-- /.card-header -->
                <div class="card-body" style="overflow-x: scroll;">
                  <table id="example3" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>A/C</th>
                        <th>Name</th>
                        <th style="width: 20px">Gender</th>
                        <th style="width: 40px">Telephone</th>
                        <th style="width: 20px">Joined</th>
                        <th>Membership</th>
                        <th>Role</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;?>
                      @foreach($members as $member)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$member->account}}</td>
                        <td>{{$member->name}}</td>
                        <td>{{$member->gender}}</td>
                        <td>{{$member->telephone}}</td>
                        <td>{{date('Y-m-d',strtotime($member->registration_date))}}</td>
                        <td>{{$member->role}}</td>
                      </tr>
                      <?php $i++; ?>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endsection