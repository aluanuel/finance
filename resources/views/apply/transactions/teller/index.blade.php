@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transactions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Transactions</a></li>
              <li class="breadcrumb-item active">View transactions</li>
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
                <h3 class="card-title">View transactions</h3>
                <div class="card-tools sm-hidden">
                  <form action="/apply/loans/all" method="POST">
                    @csrf
                    <div class="input-group">
                      <div class="input-group-prepend" id="button-addon3">
                        <a href="" class="btn btn-flat btn-outline-default" data-toggle="modal" data-target="#new_transaction">Add</a>
                      </div>
                      <select class="form-control select2bs4" style="width: auto;" id="inputGroupSelect04" data-placeholder="Select" name="id" required>
                        <!-- <option selected>Choose...</option> -->
                        <option></option>
                        <option >Loan disbursement</option>
                        <option >Loan repayment</option>
                        <option >Penalties</option>
                        <option >Expenses</option>
                        <option >Incomes</option>
                      </select>
                      <div class="input-group-append">
                        <button type="submit" name="submit" class="btn btn-default">
                          <i class="fa fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>date</th>
                      <th>category</th>
                      <th>narration</th>
                      <th>amount</th>
                      <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                      @php $i = 1 @endphp
                      @foreach($transaction as $item)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ date('Y-m-d',strtotime($item->created_at)) }}</td>
                          <td>{{ $item->transaction_type }}</td>
                          <td>{{ $item->transaction_detail }}</td>
                          <td>{{ number_format($item->amount) }}</td>
                          <td><a href="" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#edit_transaction{{ $item->id}}">Edit</a></td>
                            <div class="modal fade" id="edit_transaction{{ $item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h6 class="modal-title justify-content-center" id="exampleModalLongTitle"> EDIT TRANSACTION: ID - {{ $item->id }} </h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="/apply/teller/transaction/{{ $item->id}}" method="post">
                                      @csrf
                                      <div class="row form-group">
                                        <div class="col-12">
                                          <label>Transaction Date</label>
                                          <input type="date" class="form-control" value="{{ date('Y-m-d',strtotime($item->created_at)) }}" readonly>
                                        </div>
                                        <!-- col-12 -->
                                      </div>
                                      <!-- row -->
                                      <div class="row form-group">
                                        <div class="col-12">
                                          <label>Narration</label>
                                          <input type="text" class="form-control" name="transaction_detail" value="{{ $item->transaction_detail }}" readonly>
                                        </div>
                                        <!-- col-12 -->
                                      </div>
                                      <!-- row -->
                                      <div class="row form-group">
                                        <div class="col-12">
                                          <label>Amount</label>
                                          <input type="text" class="form-control" name="amount" value="{{ number_format($item->amount) }}" required>
                                        </div>
                                        <!-- col-12 -->
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
                              </div>
                              <!-- modal-dialog -->
                            </div>
                        </tr>
                        @php $i++ @endphp
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- card-body -->
            </div>
              <!-- card -->
            <div class="modal fade" id="new_transaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h6 class="modal-title justify-content-center text-uppercase" id="exampleModalLongTitle">new transaction</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="row form-group">
                        <div class="col-12">
                          <label>Transaction Category</label>
                          <div class="form-group">
                            <select class="form-control select2bs4" name="transaction_category" data-placeholder="Select" style="width: 100%;" required="required" id="transaction_category">
                              <option></option>
                              <option>Income</option>
                              <option>Expenditure</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row form-group">
                        <div class="col-12">
                          <label>Transaction Type</label>
                          <div class="form-group">
                            <select class="form-control select2bs4" name="transaction_type" data-placeholder="Select" style="width: 100%;" required="required">
                              <option></option>
                              <optgroup id="income">
                                <option>Income</option>
                                <option>Expenditure</option>
                              </optgroup>
                              <optgroup id="expense">
                                <option>Office supplies</option>
                                <option>Transport</option>
                                <option>Allowance</option>
                              </optgroup>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row form-group">
                        <div class="col-12">
                          <label>Narration</label>
                          <input type="text" name="transaction_detail" class="form-control" required placeholder="Narration">
                        </div>
                      </div>
                      <div class="row form-group">
                        <div class="col-6">
                          <label>Amount</label>
                          <input type="number" name="amount" class="form-control" required placeholder="Amount" onautocomplete="off">
                        </div>
                        <div class="col-6">
                          <label>Date</label>
                          <input type="date" name="transaction_date" class="form-control" required placeholder="Date">
                        </div>
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
                </div>
              </div>
            </div>
            <!-- modal -->
          </div>
            <!-- col-12         -->
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection
