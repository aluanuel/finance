@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Restore loan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Restore loan</li>
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
        <!-- <div class="row"> -->
          <!-- right column -->
          <div class="card">
            <div class="card-body">
              <form action="/apply/restore/previous/loan" method="post">
                            @csrf
                            <div class="row form-group">
                              <div class="col-6">
                                <label>Full Name</label>
                                <input type="text" name="name" autocomplete="off" class="form-control" placeholder="Full Name" required="required">
                              </div>
                              <div class="col-3">
                                <label>Gender</label>
                                <div class="form-group">
                                  <select class="form-control select2bs4" name="gender" data-placeholder="Select" style="width: 100%;" required="required">
                                    <option></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-3">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" autocomplete="off" class="form-control" placeholder="Date of Birth">
                              </div>

                            </div>
                          
                            <div class="row form-group">
                              <div class="col-3">
                                <label>Loan Group</label>
                                <div class="form-group">
                                  <select class="form-control select2bs4" name="id_loan_group" data-placeholder="Select" style="width: 100%;" required="required">
                                    <option></option>
                                    @foreach($groups as $grp)
                                      <option value="{{ $grp->id }}">{{ $grp->group_name }}</option>
                                    @endforeach
                                    <option>None</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-3">
                                <label>Nationality</label>
                                <input type="text" name="nationality" autocomplete="off" class="form-control" value="Ugandan" readonly>
                              </div>
                              <div class="col-3">
                                <label>Identity Type</label>
                                <input type="text" name="id_type" autocomplete="off" class="form-control" value="National ID" readonly>
                              </div>
                              <div class="col-3">
                                <label>ID Number</label>
                                <input type="text" name="id_number" autocomplete="off" class="form-control" placeholder="Identity Number">
                              </div>
                              
                            </div>
                  
                            <hr>
                            <div class="row form-group">
                              <div class="col-3">
                                <label>Date loan taken</label>
                                <input type="date" name="date_loan_disbursed" autocomplete="off" class="form-control" required="required" name="date_loan_disbursed">
                              </div>
                              <div class="col-3">
                                <label>Interest rate %</label>
                                <input type="text" name="interest_rate" autocomplete="off" class="form-control" placeholder="Interest rate" required="required">
                              </div>
                              <div class="col-3">
                                <label>Amount disbursed</label>
                                <input type="number" name="loan_approved" autocomplete="off" class="form-control" placeholder="Amount disbursed" required="required">
                              </div>
                              <div class="col-3">
                                <label>Loan period (weeks)</label>
                                <input type="number" name="loan_period" autocomplete="off" class="form-control" placeholder="Loan period" required="required">
                              </div>

                            </div>
                            <!-- row -->
                            <div class="row form-group">
                              <div class="col-3">
                                <label>Processing fee %</label>
                                <input type="text" name="loan_processing_rate" autocomplete="off" class="form-control" placeholder="Processing fee" required="required">
                              </div>
                              <div class="col-3">
                                <label>Loan amount recovered</label>
                                <input type="text" name="loan_recovered" autocomplete="off" class="form-control" placeholder="Loan amount recovered" required="required">
                              </div>
                              <div class="col-3">
                                <label>Loan status</label>
                                <div class="form-group">
                                  <select class="form-control select2bs4" name="loan_status" data-placeholder="Select" style="width: 100%;" required="required">
                                    <option></option>
                                    <option>Running</option>
                                    <option>Completed</option>
                                    <option>Defaulted</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <!-- row -->
                            <div class="row form-group d-flex justify-content-center">
                              <button class="btn btn-primary ml-2">Submit</button>
                            </div>
                        </form>
                      </div>
                    </div>  
      <!-- </div> -->
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- Main content -->
</div>
  <!-- /.content-wrapper -->


@endsection
