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
              <li class="breadcrumb-item active">Transactions</li>
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
                <h3 class="card-title">Showing Recent Transactions</h3>
                <div class="card-tools">
                  <a class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#new_transaction">NEW TRANSACTION</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
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
                        <td></td>
                      </tr>
                      @php $i++ @endphp
                    @endforeach
                  </tbody>
                </table>
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
                          <input type="number" name="amount" class="form-control" required placeholder="Amount">
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
