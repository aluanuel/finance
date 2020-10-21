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
      	<div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Loan Application</h3>
              </div>
                          <!-- /.card-header -->
              <div class="card-body">
                <div class="card-header">
                <h3 class="card-title text-uppercase text-primary">Personal Data</h3>
              </div>
            <form action="/apply/ind/update/{{ $cont->id}}" method="post">
              @csrf
              <div class="row form-group">
                <div class="col-5">
                  <label>Name</label>
                  <input type="text" name="name" autocomplete="off" class="form-control" value="{{ $cont->name }}" placeholder="Full Name">
                </div>
                <div class="col-3">
                  <label>Telephone</label>
                  <input type="text" name="telephone" autocomplete="off" class="form-control" value="{{ $cont->telephone }}" placeholder="Telephone Contact">
                </div>
                <div class="col-2">
                  <label>Gender</label>
                  <div class="form-group">
                    <select class="form-control select2bs4" name="gender" data-placeholder="Select Gender" style="width: 100%;">
                      <option>{{ $cont->gender }}</option>
                      <option>Male</option>
                      <option>Female</option>
                    </select>
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label>Marital Status</label>
                    <select class="form-control select2bs4" name="marital_status" style="width: 100%;">
                      <option>{{$cont->marital_status }}</option>
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                      <option value="Widowed">Widowed</option>
                      <option value="Divorced">Divorced</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-3">
                  <label>Workplace</label>
                  <input type="text" name="work_place" autocomplete="off" class="form-control" placeholder="Workplace" value="{{ $cont->work_place }}">
                </div>
                <div class="col-3">
                  <label>Occupation</label>
                  <input type="text" name="occupation" autocomplete="off" class="form-control" placeholder="Occupation" value="{{ $cont->occupation }}">
                </div>
                <div class="col-3">
                  <label>District</label>
                  <input type="text" name="district" autocomplete="off" class="form-control" placeholder="District of work" value="{{ $cont->district }}">
                </div>
                <div class="col-3">
                  <label>Permanent Resident Village/Cell</label>
                  <input type="text" name="resident_village" autocomplete="off" class="form-control" placeholder="Village of residence" value="{{ $cont->resident_village}}">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-3">
                  <label>Parish/Ward</label>
                  <input type="text" name="resident_parish" autocomplete="off" class="form-control" placeholder="Parish" value="{{ $cont->resident_parish }}">
                </div>
                <div class="col-3">
                  <label>Subcounty/Division</label>
                  <input type="text" name="resident_division" autocomplete="off" class="form-control" placeholder="Subcounty" value="{{ $cont->resident_division }}">
                </div>
                <div class="col-3">
                  <label>District of residence</label>
                  <input type="text" name="resident_district" autocomplete="off" class="form-control" placeholder="District of residence" value="{{ $cont->resident_district }}">
                </div>
                <div class="col-3">
                  <label>Next of Kin</label>
                  <input type="text" name="next_of_kin" autocomplete="off" class="form-control" placeholder="Next of Kin" value="{{ $cont->next_of_kin }}">
                </div>
              </div>
              <div class="card-header">
                <h3 class="card-title text-uppercase text-primary">loan applied for</h3>
              </div>
              <div class="row form-group">
                <div class="col-2">
                  <label>Loan Number</label>
                  <input type="text" name="loan_number" autocomplete="off" class="form-control" readonly="readonly" value="{{ $cont->loan_number }}">
                </div>
                <div class="col-3">
                  <label>Loan Amount</label>
                  <input type="number" name="proposed_amount" autocomplete="off" class="form-control" placeholder="Loan amount to borrow">
                </div>
                <div class="col-2">
                  <label>Loan Period (Months)</label>
                  <input type="number" name="loan_period" autocomplete="off" class="form-control" placeholder="Loan Duration in Months">
                </div>
                <div class="col-5">
                  <label>Purpose of the loan</label>
                  <input type="text" name="borrowing_purpose" autocomplete="off" class="form-control" placeholder="Purpose of borrowing">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-12">
                  <label>Sources of income</label>
                  <textarea class="form-control" name="income_sources" placeholder="Type the responses, separate with comma (,)"></textarea>
                </div>
              </div>
              <div class="row form-group">
                <button class="btn btn-primary ml-2">Submit</button>
              </div>
            </form>
          </div>
          <!-- card-body -->
        </div>
        <!-- card -->
          </div>
          <!-- col -->
        </div>
        <!-- row -->
      </div>
    </div>
  <!-- main content -->
  </div>
  @endsection
