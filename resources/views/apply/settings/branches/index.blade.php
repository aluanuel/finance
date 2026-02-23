@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Branches</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Settings</a></li>

              <li class="breadcrumb-item active">Branches</li>
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
                <h3 class="card-title">View branch offices</h3>
                <div class="card-tools">
                  <a href="" class="btn btn-xs btn-outline-primary text-uppercase" data-toggle="modal" data-target="#create-branch">create</a>
                </div>
              </div>
                        <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example9" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>status</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i = 1 @endphp
                      @foreach($office as $off)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ $off->branch_name }}</td>
                          <td>{{ $off->location }}</td>
                          <td>{{ $off->telephone }}</td>
                          <td>{{ $off->email }}</td>
                          @if($off->branch_status == 0)
                            <td class="text-danger">Inactive</td>
                          @else
                            <td class="text-success">Active</td>
                          @endif
                          <td><a href="" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#edit-branch{{$off->id}}">Edit</a></td>
                          <div class="modal fade" id="edit-branch{{$off->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h6 class="modal-title text-uppercase" id="exampleModalLongTitle">edit branch office</h6>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                   </button>
                                </div>
                                <div class="modal-body">
                                  <form action="/apply/settings/branches/{{$off->id}}" method="post">
                                    @csrf
                                    <div class="row form-group">
                                      <div class="col-12">
                                        <label>Branch name</label>
                                        <input type="text" name="branch_name" class="form-control" required placeholder="Branch name" value="{{ $off->branch_name }}" autocomplete="off">
                                      </div>
                                      <!-- col-12 -->
                                    </div>
                                    <!-- row -->
                                    <div class="row form-group">
                                      <div class="col-12">
                                        <label>Location</label>
                                        <input type="text" name="location" class="form-control" required placeholder="Location" value="{{ $off->location }}" autocomplete="off">
                                      </div>
                                      <!-- col-12 -->
                                    </div>
                                    <!-- row -->
                                    <div class="row form-group">
                                      <div class="col-12">
                                        <label>Telephone</label>
                                        <input type="text" name="telephone" class="form-control" required placeholder="Telephone" value="{{ $off->telephone }}" autocomplete="off">
                                      </div>
                                      <!-- col-12 -->
                                    </div>
                                    <!-- row -->
                                    <div class="row form-group">
                                      <div class="col-12">
                                        <label>Email address</label>
                                        <input type="email" name="email" class="form-control" required placeholder="Email address" value="{{ $off->email }}" autocomplete="off">
                                      </div>
                                      <!-- col-12 -->
                                    </div>
                                    <!-- row -->
                                    <div class="row form-group">
                                      <div class="col-12">
                                        <label>Status</label>
                                        <div class="form-group">
                                          <select class="form-control select2bs4" name="branch_status" data-placeholder="Select" style="width: 100%;" required="required">
                                            @if($off->branch_status == 1)
                                            <option value="1">Active</option>
                                            <option value="0">Deactivate</option>
                                            @else
                                            <option value="0">Inactive</option>
                                            <option value="1">Activate</option>
                                            @endif
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- row -->
                                    <div class="row form-group d-flex justify-content-center">
                                      <button class="btn btn-outline-primary ml-2">Submit</button>
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
                </div>
                <!-- table-responsive -->
                <div class="modal fade" id="create-branch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title text-uppercase" id="exampleModalLongTitle">create a branch office</h6>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                      </div>
                      <div class="modal-body">
                        <form action="/apply/settings/branches" method="post">
                          @csrf
                          <div class="row form-group">
                            <div class="col-12">
                              <label>Branch name</label>
                              <input type="text" name="branch_name" class="form-control" required placeholder="Branch name">
                            </div>
                            <!-- col-12 -->
                          </div>
                          <!-- row -->
                          <div class="row form-group">
                            <div class="col-12">
                              <label>Location</label>
                              <input type="text" name="location" class="form-control" required placeholder="Location">
                            </div>
                            <!-- col-12 -->
                          </div>
                          <!-- row -->
                          <div class="row form-group">
                            <div class="col-12">
                              <label>Telephone</label>
                              <input type="text" name="telephone" class="form-control" required placeholder="Telephone">
                            </div>
                            <!-- col-12 -->
                          </div>
                          <!-- row -->
                          <div class="row form-group">
                            <div class="col-12">
                              <label>Email address</label>
                              <input type="email" name="email" class="form-control" required placeholder="Email address">
                            </div>
                            <!-- col-12 -->
                          </div>
                          <!-- row -->
                          <div class="row form-group d-flex justify-content-center">
                            <button class="btn btn-outline-primary ml-2">Submit</button>
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