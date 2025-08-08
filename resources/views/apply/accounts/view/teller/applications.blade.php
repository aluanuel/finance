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
                  <h3 class="card-title">Showing New Accounts Pending Activation</h3>
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
                        <th>Fees</th>
                        <th>created_at</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $x =1;?>
                      @foreach($accounts as $ac)
                      <tr>
                        <td>{{$x}}</td>
                        <td>{{ $ac->account_number }}</td>
                        <td>{{ $ac->name }}</td>
                        <td>{{ $ac->gender }}</td>
                        <td>{{ $ac->telephone }}</td>
                        <td>{{ number_format($ac->registration_fee) }}</td>
                        <td>{{ date('Y-m-d',strtotime($ac->created_at)) }}</td>

                        <td><a class="btn btn-xs btn-outline-danger" data-toggle="modal" data-target="#activate_client_account{{$ac->id}}">Activate</a></td>
                        <div class="modal fade" id="activate_client_account{{$ac->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                          <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h6 class="modal-title justify-content-center text-uppercase" id="exampleModalLongTitle">client account activation</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="/apply/accounts/applications/{{$ac->id }}" method="post">
                                  @csrf
                                  <div class="row form-group">
                                    <div class="col-12 text-center"> 
                                      <label>Enter your password</label>
                                      <input type="password" class="form-control" name="user_password" required placeholder="Enter your password">
                                      <input type="hidden" name="registration_fee" value="{{ $ac->registration_fee }}">
                                    </div>
                                  </div>
                                  <!-- row -->
                                  <div class="row form-group">
                                    <div class="col-12 text-center">         
                                      <button type="submit" class="btn btn-sm btn-outline-primary">Activate</button>
                                      <button type="submit" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Cancel</button>
                                    </div>
                                  </div>
                                  <!-- row -->
                                </form>
                              </div>
                              <!-- modal-body -->
                            </div>
                            <!-- modal-content -->
                          </div>
                          <!-- modal-dialog -->
                        </div>
                        <!-- modal -->
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