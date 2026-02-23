@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan groups</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">Loan groups</li>
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
                <h3 class="card-title">View loan groups</h3>
                <div class="card-tools">
                  <a href="" class="btn btn-xs btn-outline-primary text-uppercase" data-toggle="modal" data-target="#create-group">create</a>
                </div>
              </div>
                        <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i = 1 @endphp
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

                          <td><a href="" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#edit-group{{$group->id}}">Edit</a></td>
                          <div class="modal fade" id="edit-group{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h6 class="modal-title text-uppercase" id="exampleModalLongTitle">edit loan group</h6>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                   </button>
                                </div>
                                <div class="modal-body">
                                  <form method="POST" action="/apply/settings/loan/groups/{{$group->id}}">
                                    @csrf
                                    <div class="form-group row">
                                      <div class="col-12">
                                        <label>Group code</label>
                                        <input type="text" class="form-control" value="{{ $group->group_code }}" readonly  placeholder="Group name" autocomplete="off">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <div class="col-12">
                                        <label>Group name</label>
                                        <input type="text" class="form-control" name="group_name" value="{{ $group->group_name }}" required  placeholder="Group name" autocomplete="off">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <div class="col-12">
                                        <label>Group description</label>
                                        <input type="text" class="form-control" name="group_description" value="{{ $group->group_description }}" required  placeholder="Group description" autocomplete="off">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <div class="col-12">
                                        <label>Group address</label>
                                        <input type="text" class="form-control" name="group_address" value="{{ $group->group_address }}" required  placeholder="Group address" autocomplete="off">
                                      </div>
                                    </div>
                                          
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
                        </tr>
                        @php $i++ @endphp
                      @endforeach
                    </tbody>
                  </table>
                  <!-- table -->
                </div>
                <!-- table-responsive -->
                <div class="modal fade" id="create-group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title text-uppercase" id="exampleModalLongTitle">create a loan group</h6>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="/apply/settings/loan/groups">
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
                                
                          <div class="row form-group">
                            <div class="col-12 text-center">         
                              <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                              <button type="submit" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Cancel</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- modal-body -->
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