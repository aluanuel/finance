@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">System Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">Fees</li>
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
                <h3 class="card-title">New Fee</h3>
              </div>
                <!-- /.card-header -->
              <div class="card-body">

                <form method="POST" action="/apply/settings/fees">
                @csrf
                  <div class="form-group row">
                    <div class="col-12">
                      <label>Fees Type</label>
                      <div class="form-group">
                        <select class="form-control select2bs4" name="fees_type" data-placeholder="Select" style="width: 100%;" required="required">
                          <option></option>
                          <option>Registration Fee</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-12">
                      <label>Amount</label>
                      <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required  placeholder="Amount" autocomplete="off">
                                @error('amount')
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
                <h3 class="card-title">Showing Fees</h3>
              </div>
                        <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th width="4">#</th>
                        <th>Fees Type</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i = 1 @endphp

                      @foreach($fees as $fee)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ $fee -> fees_type }}</td>
                          <td>{{ $fee -> amount }}</td>
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