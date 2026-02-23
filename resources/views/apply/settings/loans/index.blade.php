@extends('layouts.custom')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">Loan settings</li>
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
                <h3 class="card-title">View loan products</h3>
                <div class="card-tools">
                  <a href="" class="btn btn-xs btn-outline-primary text-uppercase" data-toggle="modal" data-target="#create-product">create</a>
                </div>
              </div>
                        <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Category</th>
                        <th>name</th>
                        <th>Description</th>
                        <th>interest_rate</th>
                        <th>processing_rate</th>
                        <th>rate_defaulting</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i = 1 @endphp

                      @foreach($pdt as $pdt)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ $pdt->loan_category }}</td>
                          <td>{{ $pdt->product_name }}</td>
                          <td>{{ $pdt->product_description }}</td>
                          <td>{{ $pdt->interest_rate }}</td>
                          <td>{{ $pdt->processing_rate }}</td>
                          <td>{{ $pdt->rate_defaulting }}</td>
                          <td><a href="" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#edit-product{{$pdt->id}}">Edit</a></td>
                          <div class="modal fade" id="edit-product{{$pdt->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h6 class="modal-title text-uppercase" id="exampleModalLongTitle">edit loan product</h6>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                   </button>
                                </div>
                                <div class="modal-body">
                                  <form action="/apply/settings/loans/{{$pdt->id}}" method="post">
                                    @csrf
                                    <div class="row form-group">
                                      <div class="col-lg-4 col-md-12">
                                        <label>Loan category</label>
                                        <div class="form-group">
                                          <select class="form-control select2bs4" name="loan_category" data-placeholder="Select" style="width: 100%;" required="required">
                                            <option>{{ $pdt->loan_category }}</option>
                                            <option>Individual</option>
                                            <option>Group</option>
                                          </select>
                                        </div>
                                      </div>
                                      <!-- col-lg-4 -->
                                      <div class="col-lg-4 col-md-12">
                                        <label>Product name</label>
                                        <input type="text" name="product_name" class="form-control" required placeholder="Product name" value="{{ $pdt->product_name }}">
                                      </div>
                                      <!-- col-lg-4 -->
                                      <div class="col-lg-4 col-md-12">
                                        <label>Product description</label>
                                        <input type="text" name="product_description" class="form-control" required placeholder="Product name" value="{{ $pdt->product_description }}">
                                      </div>
                                      <!-- col-lg-4 -->
                                    </div>
                                    <!-- row -->
                                    <div class="row form-group">
                                      <div class="col-lg-4 col-md-12">
                                        <label>Interest rate</label>
                                        <input type="text" name="interest_rate" class="form-control" required placeholder="Interest rate" value="{{ $pdt->interest_rate }}">
                                      </div>
                                      <!-- col-lg-4 -->
                                      <div class="col-lg-4 col-md-12">
                                        <label>Processing rate</label>
                                        <input type="text" name="processing_rate" class="form-control" required placeholder="Processing rate" value="{{ $pdt->processing_rate }}">
                                      </div>
                                      <!-- col-lg-4 -->
                                      <div class="col-lg-4 col-md-12">
                                        <label>Interest on defaulting</label>
                                        <input type="text" name="rate_defaulting" class="form-control" required placeholder="Interest on defaulting" value="{{ $pdt->rate_defaulting }}">
                                      </div>
                                      <!-- col-lg-4 -->
                                    </div>
                                    <!-- row -->
                                    <div class="row form-group d-flex justify-content-center">
                                      <button class="btn btn-outline-primary ml-2">Submit</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- modal -->
                        </tr>
                        @php $i++ @endphp
                      @endforeach
                    </tbody>
                  </table>
                  <!-- table -->
                </div>
                <div class="modal fade" id="create-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title text-uppercase" id="exampleModalLongTitle">create a loan product</h6>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                      </div>
                      <div class="modal-body">
                        <form action="/apply/settings/loans" method="post">
                          @csrf
                          <div class="row form-group">
                            <div class="col-lg-4 col-md-12">
                              <label>Loan category</label>
                              <div class="form-group">
                                <select class="form-control select2bs4" name="loan_category" data-placeholder="Select" style="width: 100%;" required="required">
                                  <option></option>
                                  <option>Default</option>
                                  <option>Individual</option>
                                  <option>Group</option>
                                </select>
                              </div>
                            </div>
                            <!-- col-lg-4 -->
                            <div class="col-lg-4 col-md-12">
                              <label>Product name</label>
                              <input type="text" name="product_name" class="form-control" required placeholder="Product name">
                            </div>
                            <!-- col-lg-4 -->
                            <div class="col-lg-4 col-md-12">
                              <label>Product description</label>
                              <input type="text" name="product_description" class="form-control" required placeholder="Product name">
                            </div>
                            <!-- col-lg-4 -->
                          </div>
                          <!-- row -->
                          <div class="row form-group">
                            <div class="col-lg-4 col-md-12">
                              <label>Interest rate</label>
                              <input type="text" name="interest_rate" class="form-control" required placeholder="Interest rate">
                            </div>
                            <!-- col-lg-4 -->
                            <div class="col-lg-4 col-md-12">
                              <label>Processing rate</label>
                              <input type="text" name="processing_rate" class="form-control" required placeholder="Processing rate">
                            </div>
                            <!-- col-lg-4 -->
                            <div class="col-lg-4 col-md-12">
                              <label>Interest on defaulting</label>
                              <input type="text" name="rate_defaulting" class="form-control" required placeholder="Interest on defaulting">
                            </div>
                            <!-- col-lg-4 -->
                          </div>
                          <!-- row -->
                          <div class="row form-group d-flex justify-content-center">
                            <button class="btn btn-outline-primary ml-2">Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- modal -->
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