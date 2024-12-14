<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jayacom</title>
  {{-- <link rel='icon' href="{{ asset('uploads/Ageecom.jpg')}}" sizes="192x192"> --}}
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<style>
  body{background: url('/uploads/bg-toko.jpg');}
  .sign{
    cursor: pointer;
    border-radius: 5em;
    color: #fff;
    background: linear-gradient(to right, #2735b0, #40d6fb);
    border: 0;
    padding-left: 20px;
    padding-right: 20px;
    padding-bottom: 10px;
    padding-top: 10px;
    font-family: 'Ubuntu', sans-serif;
    margin-left: 1%;
    font-size: 13px;
    box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.04);
  }
  .back{
    cursor: pointer;
    border-radius: 5em;
    color: #fff;
    background: linear-gradient(to right, #01020162, #3d5358);
    border:0;
    padding-left: 20px;
    padding-right: 20px;
    padding-bottom: 10px;
    padding-top: 10px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    margin-left: 1px;
    font-size: 13px;
    box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.04);
  }
  .login-logo{
    padding-top:10px;
    color: rgb(0, 217, 255);
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 30px;
    font-weight: bold;
  }
</style>
<body class="hold-transition login-page">
<div class="login-box">
  @if(session('success'))
  <div class="alert alert-success" role="alert">
    {{session('success')}}
  </div>
  @elseif(session('error'))
  <div class="alert alert-danger" role="alert">
    {{session('error')}}
  </div>
  @endif
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <div class="login-logo">
        <a>Login</a>
      </div>
      <form method="post" action="{{ url('login/check') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="name" name="name" placeholder="nama">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="sign" align="center">Sign In</button>
            <a href="{{ url('/')}}" class="back" align="center">Back</a>
            {{-- <button type="submit" class="btn btn-primary btn-block">Sign In</button> --}}
          </div>
        </div>
      </form>
      <!-- /.social-auth-links -->

      {{-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> --}}
      <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">Belum Punya Akun?</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>