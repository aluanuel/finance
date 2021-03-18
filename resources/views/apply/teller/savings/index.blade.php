@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Savings Deposit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item">Savings</li>
              <li class="breadcrumb-item active">Deposit</li>
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
          <div class="col-md-4 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Deposit</h3>
              </div>
              <div class="card-body">
                <form action="/apply/teller/savings/" method="post">
                  @csrf
                  <div class="row form-group">
                    <div class="col-12">
                      <label>Account Number / Name</label>
                      <div class="form-group">
                        <select class="form-control select2bs4" name="id_client" style="width: 100%;" required="required">
                          <option></option>
                          @foreach($account as $acc)
                            <option value="{{$acc->id}}">{{ $acc->account }} - {{$acc->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-12">
                      <label>Deposit Amount</label>
                      <input type="number" name="amount_figures" class="form-control" required="required" autocomplete="off" placeholder="Deposit Amount">
                    </div>
                    <div class="col-12">
                      <label>Deposit Amount</label>
                      <textarea class="form-control" name="amount_words" placeholder="Deposit Amount in Words" required="required" autocomplete="off"></textarea>
                    </div>
                    <div class="col-7">
                      <label>Depositor Name</label>
                      <input type="text" name="person_name" class="form-control" required="required" autocomplete="off" placeholder="Depositor Name">
                    </div>
                    <div class="col-5">
                      <label>Telephone</label>
                      <input type="text" name="person_telephone" class="form-control" required="required" autocomplete="off" placeholder="Telephone">
                    </div>
                    <div class="col-4 pt-3">
                      <button type="submit" class="btn btn-primary">Deposit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- col-5 -->
          <div class="col-md-8 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Showing Recent Savings Deposits</h3>
              </div>
              <div class="card-body">
                <table id="example3" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Account Number</th>
                      <th>Deposit Amount</th>
                      <th>Depositor</th>
                      <th>Telephone</th>
                      <th>Transaction Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    @foreach($deposits as $depo)
                      <tr>
                        <td>{{ $i }}</td>
                        <td><a href="/apply/account/profile/{{$depo->id_client}}"> {{$depo->account }}</a></td>
                        <td>{{ number_format($depo->amount_figures) }}</td>
                        <td>{{$depo->person_name }}</td>
                        <td>{{$depo->person_telephone }}</td>
                        <td>{{$depo->created_at }}</td>
                      </tr>
                      <?php $i++; ?>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!-- card -->
          </div>
          <!-- col-7 -->
        </div>
      </div>
    </div>
    <!-- content -->
  </div>
  @endsection