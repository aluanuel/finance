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
                        <th width="4">#</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Address</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i =1 @endphp
                      @foreach($groups as $group)
                        <tr>
                          <td>{{ $i }}</td>
                          <td><a href="/apply/settings/loan/group/members/{{$group->id}}">{{ $group->group_name }}</a></td>
                          <td>{{ $group->group_code }}</td>
                          <td>{{ $group->group_description}}</td>
                          <td>{{ $group->group_address }}</td>

                          @if($group->group_status == 1)
                            <td class="text-success">Active</td>
                          @else
                            <td class="text-danger">Inactive</td>
                          @endif
                        </tr>
                        @php $i++ @endphp
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