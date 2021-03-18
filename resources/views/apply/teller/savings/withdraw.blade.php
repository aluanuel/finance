@extends('layouts.custom')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Savings Withdrawal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item">Savings</li>
              <li class="breadcrumb-item active">Withdrawal</li>
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
          <div class="col-md-5 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Withdrawal</h3>
              </div>
              <div class="card-body">
                <form action="/apply/teller/withdrawal" method="post">
                  @csrf
                  <div class="row form-group">
                    <div class="col-12">
                      <label>Account Name / Number</label>
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
                      <label>Withdraw Amount</label>
                      <input type="number" name="amount_figures" class="form-control" required="required" autocomplete="off" placeholder="Withdraw Amount">
                    </div>
                    <div class="col-12">
                      <label>Withdraw Amount</label>
                      <textarea class="form-control" name="amount_words" placeholder="Withdraw Amount in Words" required="required" autocomplete="off"></textarea>
                    </div>
                    <div class="col-4 pt-3">
                      <button type="submit" class="btn btn-primary">Withdraw</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- col-5 -->
          <div class="col-md-7 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Showing Recent Savings Withdrawals</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Account Number</th>
                      <th>Amount Withdrawn</th>
                      <th>Transaction Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $x = 1; ?>
                    @foreach($withdraws as $wd)
                      <tr>
                        <td>{{ $x }}</td>
                        <td><a href="/apply/account/profile/{{$wd->id_client}}"> {{ $wd->account }}</a></td>
                        <td>{{ number_format($wd->amount_figures) }}</td>
                        <td>{{ $wd->created_at }}</td>
                      </tr>
                      <?php $x++; ?>
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