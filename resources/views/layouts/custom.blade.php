<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
@include('layouts.partials.header')
@include('layouts.partials.nav')
@yield('content')
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('layouts.partials.footer')

</div>
<!-- ./wrapper -->
@include('layouts.partials.footer-scripts')

</body>
</html>
