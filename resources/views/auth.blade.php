{{-- Author Umar A --}}
<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body class="hold-transition login-page pace-purple">
  <div class="login-box">
    @include('partials.alert')
    <!-- /.login-logo -->
    <div class="card card-outline card-maroon">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>StopUno</b></a>
      </div>
      <div class="card-body">
        @yield('auth_content')
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  @include('layouts.scripts')
</body>

</html>
