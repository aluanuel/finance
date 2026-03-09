@extends('layouts.default')
@section('content')
<!-- Automatic element centering -->
<div class="d-flex align-items-center justify-content-center vh-100">
  <div class="card text-center">
    <div class="card-body">
      <h1>Welcome to <br><strong>{{ config('app.name', 'Laravel') }}</strong></h1>
      <hr class="bg-purple">
      <!-- <blockquote class="blockquote mb-0"> -->
        <p class="text-info h5">An intiutive app for Tier 3/4 Microfinance Institutions</p>
      <!-- </blockquote> -->
      <div class="row">
        <div class="col-6">
          <ul class="text-left text-success ml-2">
            <li>Disburse loans</li>
            <li>Track loan recovery</li>
            <li>Record daily transactions</li>
            <li>Get instant notifications</li>
            <li>Generate account statements</li>
            <li>Calculate business projections</li>
            <li>Integrate MTN Mobile Money</li>
          </ul>
        </div>
        <div class="col-6">
          <a href="{{ route('login') }}"><img class="rounded float-center" src="{{ asset('theme/dist/img/start.png')}}" alt="User Image"></a>
        </div>
    </div>
  </div>
  <div class="card-footer">
    <small>POWERED BY&nbsp;<a href="https://codestoreinvestments.com" target="blank">CSI Limited</a></small>
    <div class="float-right d-none d-sm-inline-block">
      <small class="text-info"><i class="nav-icon fas fa-phone-alt"></i>&nbsp;+256 759 255732</small>
    </div>
  </div>
</div>
<!-- /.center -->
@endsection