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
        		<div class="col-4">
	        		<div class="card">
	                    <div class="card-header">
	                        <h3 class="card-title">New Loan Group</h3>
	                    </div>
	                      <!-- /.card-header -->
	                    <div class="card-body">
	                    	<form action="/apply/settings/groups" method="post">
	                          @csrf
	                          <div class="row form-group">
	                            <div class="col-12">
	                              <label>Group Name</label>
	                              <input type="text" name="group_name" autocomplete="off" class="form-control" placeholder="Group Name" required="required">
	                            </div>
	                          </div>
	                          <input type="hidden" name="created_by" value="{{Auth::id()}}">
	                          <div class="row form-group">
	                            <button class="btn btn-primary ml-2">Submit</button>
	                          </div>
	                        </form>
	                    </div>
	                </div>
	            </div>
	            <div class="col-8">
	        		<div class="card">
	                    <div class="card-header">
	                        <h3 class="card-title">Showing Loan Groups</h3>
	                    </div>
	                      <!-- /.card-header -->
	                    <div class="card-body">
	                    	<table id="example3" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                <th>#</th>
                                <th>Group Code</th>
                                <th>Group Name</th>
                                <th>Group Status</th>
                                <th>Created at</th>
                              </tr>
                              </thead>
                              <tbody>
                              	<?php $i = 1;?>
                                @foreach($groups as $grp)
                                <tr>
                                  <td>{{$i}}</td>
                                  <td><a href="/apply/settings/members/{{$grp->id}}"> {{$grp->group_code}}</a></td>
                                  <td><a href="/apply/settings/members/{{$grp->id}}">{{$grp->group_name}}</a></td>
                                  @if($grp->group_status == 0)
                                  <td class="text-danger">Inactive</td>
                                  @else
                                  <td class="text-success">Active</td>
                                  @endif
                                  <td>{{ date('Y-m-d',strtotime($grp->created_at))}}</td>
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