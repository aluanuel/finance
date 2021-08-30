@extends('layouts.default')
@section('content')
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="#"><small>Welcome to</small><br> <b>{{ config('app.name', 'Laravel') }}</b></a>
  </div>
  <div class="text-center">
   <a href="{{ route('login') }}"> <img class="rounded float-center" src="{{ asset('theme/dist/img/start.png')}}" alt="User Image"></a>
</div>

</div>
<!-- /.center -->
@endsection