@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Personal Loan Application</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Loan Application</li>
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
                <h3 class="card-title">Showing Loan Applications</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th style="width: 12px;">#</th>
                    <th style="width: 30px;">Number</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Telephone</th>
                    <th>Gender</th>
                    <th>Fee</th>
                    <th>Status</th>
                    <th>#</th>
                  </tr>
                  </thead>
                 <tbody>
                    <?php $i = 1;?>
                    @foreach($apps as $app)
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $app->loan_number }}</td>
                    <td>{{ date('Y-m-d',strtotime($app->application_date)) }}</td>
                    <td>{{ $app->name }}</td>
                       <td>{{ $app->telephone }}</td>
                       <td>{{ $app->gender }}</td>
                       <td>{{ number_format($app->application_fee) }}</td>
                       @if($app->application_status == 0)
                       <td><p class="text-danger"> {{ 'Inactive' }}</p></td>
                       <td>
                                    <form action="/apply/ind/{{$app->id}}" method="post">
                                      @csrf
                                      <button type="submit" class="btn btn-block btn-outline-primary">Activate</button>
                                    </form>
                                  </td>
                                  @elseif($app->application_status == 1)
                                  <td><p class="text-success">{{ 'Active' }}</p></td>
                                  <td><a href="/generate/loan/application/{{$app->id}}" class="btn btn-outline-success btn-sm"> Receipt</a></td>
                                  @endif
                                  <!-- <td></td> -->
                                </tr>
                                <?php $i++;?>
                                @endforeach
                              </tbody>
                              <tfoot>
                              </tfoot>
                            </table>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
      </div>
    </div>
  </div>
  @endsection