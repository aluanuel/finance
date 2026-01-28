@extends('layouts.default')
@section('content')
<!-- Automatic element centering -->
<div class="login-box">
  <div class="lockscreen-logo">
    <h1>Welcome to <br><strong>{{ config('app.name', 'Laravel') }}</strong></h1>
    <a href="{{ route('login') }}"><img class="rounded float-center" src="{{ asset('theme/dist/img/start.png')}}" alt="User Image"></a>
  </div>
</div>
<!-- /.center -->
@endsection