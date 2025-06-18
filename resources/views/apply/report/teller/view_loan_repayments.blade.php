@extends('layouts.custom')

@section('content')
	  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan Repayment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Loans</a></li>
              <li class="breadcrumb-item active">Loan Repayment</li>
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
                  <h3 class="card-title">Showing loans due for repayment</h3>
                </div>
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>loan_number</th>
                        <th>name</th>
                        <th>group</th>
                        <th>loan_disbursed</th>
                        <th>loan_recovered</th>
                        <th>borrow_date</th>
                        <th>end_date</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $x = 1 @endphp
                      @foreach($loans as $loan)
                        <tr>
                          <td>{{ $x }}</td>
                          <td><a href="/apply/account/profile/{{$loan->id_client}}">{{ $loan->loan_number }}</a></td>
                          <td><a href="/apply/account/profile/{{$loan->id_client}}"> {{ $loan->name }}</a></td>
                          <td>{{ $loan->group_name }}</td>
                          <td>{{ number_format($loan->total_loan) }}</td>
                          <td>{{ number_format($loan->loan_recovered) }}</td>
                          <td>{{ $loan->loan_start_date }}</td>
                          <td>{{ $loan->loan_end_date }}</td>
                          <td><a href="" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#loan_repayment{{$loan->id}}">Reimburse</a></td>
                            <div class="modal fade" id="loan_repayment{{$loan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h6 class="modal-title justify-content-center text-uppercase" id="exampleModalLongTitle"> reimbursing loan {{ $loan->loan_number }} - <span class="badge bg-info">{{ $loan->loan_status }} up to {{ $loan->loan_end_date }}</span> </h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="/apply/loan/repayment/{{$loan->id}}" method="post">
                                      @csrf
                                      <div class="row form-group">
                                        <div class="col-4">
                                          <label>Client Name</label>
                                          <input type="text" class="form-control" value="{{ $loan->name }}" readonly>
                                        </div>
                                        <!-- col-4 -->
                                        <div class="col-4">
                                          <label>Telephone</label>
                                          <input type="text" class="form-control" value="{{ $loan->telephone }}" readonly>
                                        </div>
                                        <!-- col-4 -->
                                        <div class="col-4">
                                          <label>Group Name</label>
                                          <input type="text" class="form-control" value="{{ $loan->group_name }}" readonly>
                                        </div>
                                        <!-- col-4 -->
                                      </div>
                                      <!-- row -->
                                      <div class="row form-group">
                                        <div class="col-4">
                                          <label>Total Loan</label>
                                          <input type="text" class="form-control" value="{{ number_format($loan->total_loan) }}" readonly>
                                        </div>
                                        <!-- col-4 -->
                                        <div class="col-4">
                                          <label>Loan Recovered</label>
                                          <input type="text" class="form-control" value="{{ number_format($loan->loan_recovered) }}" readonly>
                                        </div>
                                        <!-- col-4 -->
                                        <div class="col-4">
                                          <label>Loan Outstanding</label>
                                          <input type="text" class="form-control" value="{{ number_format($loan->loan_outstanding) }}" readonly>
                                        </div>
                                        <!-- col-4 -->
                                      </div>
                                      <!-- row -->
                                      <div class="row form-group">

                                        <div class="col-4">
                                          <label>Loan Repayment</label>
                                          <input type="number" class="form-control" required name="loan_repayment" placeholder="Loan Repayment">
                                        </div>
                                        <!-- col-4 -->
                                        <div class="col-4">
                                          <label>Repayment Date</label>
                                          <input type="date" class="form-control" required name="repayment_date" placeholder="Date">
                                        </div>
                                        <!-- col-4 -->
                                      </div>
                                      <!-- row -->
                                      <div class="row form-group">
                                      <div class="col-12 text-center">         
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                                        <button type="submit" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Cancel</button>
                                      </div>
                                    </div>
                                    <!-- row -->
                                    </form>
                                  </div>
                                  <!-- modal-body -->
                                </div>
                                <!-- modal_content -->
                              </div>
                              <!-- modal-dialog -->
                            </div>
                            <!-- modal -->
                        </tr>
                      @php $x++ @endphp
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