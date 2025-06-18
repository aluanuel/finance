@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Rates</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">Rates</li>
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
          <div class="col-4">
            <!-- card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">New Rate</h3>
              </div>
                <!-- /.card-header -->
              <div class="card-body">

                <form method="POST" action="/apply/settings/rates">
                @csrf
                  <div class="form-group row">
                    <div class="col-12">
                      <label>Type</label>
                      <div class="form-group">
                        <select class="form-control select2bs4" name="rate_type" data-placeholder="Select" style="width: 100%;" required="required">
                          <option></option>
                          <option>Interest on Loan Borrowing</option>
                          <option>Loan Processing</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-12">
                      <label>Rate</label>
                      <input id="rate" type="text" class="form-control @error('rate') is-invalid @enderror" name="rate" value="{{ old('rate') }}" required  placeholder="Rate (%)" autocomplete="off">
                                @error('rate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                    </div>
                  </div>
                        
                  <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-outline-primary btn-sm">
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
          <div class="col-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Showing Rates</h3>
              </div>
                        <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th width="4">#</th>
                      <th>Type</th>
                      <th>Rate</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i =1 @endphp
                    @foreach($rates as $rates)
                      <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $rates -> rate_type }}</td>
                        <td>{{ $rates -> rate }}</td>
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
          <!-- row -->
        </div>
        <!-- row -->
      </div>
    </div>
    <!-- Main content -->
  </div>
@endsection