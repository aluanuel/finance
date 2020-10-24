@extends('layouts.custom')

@section('content')
	  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan Schedule</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Loan Schedule</li>
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
		          <div class="col-md-3">

		            <!-- Profile Image -->
		            <div class="card card-primary card-outline">
		              <div class="card-body box-profile">
		                <div class="text-center">
		                  <img class="profile-user-img img-fluid img-circle"
		                       src="{{ asset('theme/dist/img/user4-128x128.jpg')}}"
		                       alt="User profile picture">
		                </div>

		                <h3 class="profile-username text-center">{{ $schedule->name}}</h3>

		                <p class="text-muted text-center">{{ $schedule->occupation }}</p>

		                <ul class="list-group list-group-unbordered mb-3">
		                  <li class="list-group-item">
		                    <b>Telephone</b> <a class="float-right">{{ $schedule->telephone }}</a>
		                  </li>
		                </ul>
		              </div>
		              <!-- /.card-body -->
		            </div>
		            <!-- /.card -->
		          </div>
		          <!-- /.col -->
		          <div class="col-md-9">
		            <div class="card">
		              <div class="card-header p-2">
		                <ul class="nav nav-pills">
		                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Payment Schedule for Loan - {{ $schedule->loan_number }}</a></li>
		                </ul>
		              </div><!-- /.card-header -->
		              <div class="card-body">
		                <div class="tab-content">
		                  <div class="active tab-pane" id="activity">
		                  	<div class="row">
		                  		<div class="card-body p-0">
					                <table class="table ">
					                  <thead>
					                    <tr>
					                      <th>Month</th>
					                      <th style="width: 40px">Instalment</th>
					                    </tr>
					                  </thead>
					                  <tbody>
					                  	@foreach($instalment as $instal)
					                  	<tr>
					                  		<td>{{ $instal->deadline }}</td>
					                  		<td>{{ number_format($instal->instalment) }}</td>
					                  	</tr>
					                  	@endforeach
					                  </tbody>

					                </table>
					            </div>
		                  	</div>
		                  </div>
		                  <!-- /.tab-pane -->
		                </div>
		                <!-- /.tab-content -->
		              </div><!-- /.card-body -->
		            </div>
		            <!-- /.card -->
		          </div>
		          <!-- /.col -->
		        </div>
        </div>
    </div>
    <!-- main content -->
</div>
<!-- content-wrapper -->
@endsection