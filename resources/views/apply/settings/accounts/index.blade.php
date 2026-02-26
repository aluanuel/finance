@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Account</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">Account</li>
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
                <h3 class="card-title">View account settings</h3>
                <div class="card-tools">
                  <a href="" class="btn btn-xs btn-outline-primary text-uppercase" data-toggle="modal" data-target="#create-fees">create</a>
                </div>
              </div>
                        <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example9" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Fees type</th>
                        <th>Amount</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($fees as $fe)
                        <tr>
                          <td>{{ $fe->fees_type}}</td>
                          <td>{{ number_format($fe->amount)}}</td>
                          <td><a href="" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#edit-branch{{$fe->id}}">Edit</a></td>
                          <div class="modal fade" id="edit-branch{{$fe->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h6 class="modal-title text-uppercase" id="exampleModalLongTitle">edit account settings</h6>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                   </button>
                                </div>
                                <div class="modal-body">
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- modal -->
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- table-responsive -->
                <div class="modal fade" id="create-fees" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title text-uppercase" id="exampleModalLongTitle">create account setting</h6>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                      </div>
                      <div class="modal-body">
                        <form action="/apply/settings/accounts" method="post">
                          @csrf
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- modal-dialog -->
                </div>
                <!-- modal -->
              </div>
              <!-- card-body -->
            </div>
            <!-- card -->
          </div>
        </div>
        <!-- row -->
      </div>
    </div>
    <!-- Main content -->
  </div>
@endsection