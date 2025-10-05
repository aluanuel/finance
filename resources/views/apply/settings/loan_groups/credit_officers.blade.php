@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Credit Officers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item"><a href="#">Loan Groups</a></li>
              <li class="breadcrumb-item active">Credit Officers</li>
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
                <h3 class="card-title">Assign credit officer to group</h3>
              </div>
                <!-- /.card-header -->
              <div class="card-body">

                <form method="post" action="/apply/settings/loan_groups/officers">
                  @csrf
                  <div class="form-group row">
                    <div class="col-12">
                      <label>Credit Officer</label>
                      <div class="form-group">
                        <select class="form-control select2bs4" name="id_credit_officer" data-placeholder="Select" style="width: 100%;" required="required">
                          <option></option>
                          @foreach($officers as $officer)
                            <option value="{{ $officer->id }}">{{ $officer->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-12">
                      <label>Loan Groups</label>
                      <div class="form-group">
                        <select class="form-control select2bs4" name="id_loan_group" data-placeholder="Select" style="width: 100%;" required="required">
                          <option></option>
                          @foreach($groups as $gp)
                            <option value="{{ $gp->id }}">{{ $gp->group_name }}</option>
                          @endforeach
                        </select>
                      </div>
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
            </div>
          </div>
          <!-- col-md-4     -->
          <div class="col-md-8 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Showing credit officers for each loan group</h3>
              </div>
                        <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-hover" id="example2">
                  <thead>
                    <tr>
                      <th>loan_group</th>
                      <th>Credit_officer</th>
                      <th>officer_role</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($assigned_groups as $group)
                      <tr>
                        <td>{{ $group->group_name }}</td>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->credit_officer_role }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- card-body -->
            </div>
            <!-- card -->
          </div>
          <!-- col-md-8 -->
        </div>
        <!-- row -->
      </div>
    </div>
    <!-- Main content -->
  </div>
@endsection