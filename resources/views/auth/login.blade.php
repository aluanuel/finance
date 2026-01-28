@extends('layouts.default')
@section('content')
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="/login" class="h3"><b>{{ config('app.name', 'Laravel') }}</b></a>
      </div>
      <div class="card-body">
        <p class="login-msg">Sign in to start your session</p>

        <form action="{{ route('login') }}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off" value="{{ old('email') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" required="required" autocomplete="off">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          @error('email')
            <div class="label -mt-4 mb-4">
              <span class="label-text-alt text-danger">{{ $message }}</span>
            </div>
          @enderror

          <div class="row">
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
            <div class="col-8">
              <p class="mb-1 pl-5">
                <a href="{{ route('password.request') }}">I forgot my password</a>
              </p>
            </div>
            <!-- col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection