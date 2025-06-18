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
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item"><a href="/apply/settings/loan/groups">Loan Groups</a></li>
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
          
          <!-- col-12 -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Showing Members of {{$group->group_name}} {{'Loan Group'}}</h3>
              </div>
                        <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th width="4">#</th>
                      <th>A/c_number</th>
                      <th>Name</th>
                      <th>Telephone</th>
                      <th>Resident_Address</th>
                      <th>Member_Role</th>
                      <th>A/c_status</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i = 1 @endphp
                    @foreach($members as $member)
                      <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $member->account_number }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->telephone }} {{ $member->alt_telephone}}</td>
                        <td>{{ $member->resident_village }}, {{ $member->resident_parish }}, {{ $member->resident_division }}, {{ $member->resident_district }}</td>
                        <td>{{ $member->role_group }}</td>
                        @if($member->account_status == 0)
                        <td class="text-danger">Inactive</td>
                        @else
                        <td class="text-success">Active</td>
                        @endif
                        <td><a href="" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#groupMemberInfo{{$member->id}}">Edit</a></td>
                        <div class="modal fade" id="groupMemberInfo{{$member->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h6 class="modal-title text-uppercase" id="exampleModalLongTitle">update group member record</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="/apply/settings/loan/group/members/{{$member->id}}" method="POST">
                                  @csrf
                                  <div class="row form-group">
                                    <div class="col-md-6">
                                      <label>Name</label>
                                      <input type="text" class="form-control" readonly value="{{ $member->name}}">
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Member Role</label>
                                        <select class="form-control select2bs4" name="role_group" data-placeholder="Select" style="width: 100%;">
                                          <option></option>
                                          <option>Chairperson</option>
                                          <option>Secretary</option>
                                          <option>Member</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-12 text-center">         
                                      <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
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
                      </tr>
                      @php $i++ @endphp
                    @endforeach
                  </tbody>
                  
                </table>
                <!-- table -->
              </div>
              <!-- card-body -->
            </div>
            <!-- card -->
          </div>
          <!-- col-12 -->
        </div>
        <!-- row -->
      </div>
    </div>
    <!-- Main content -->
  </div>
@endsection