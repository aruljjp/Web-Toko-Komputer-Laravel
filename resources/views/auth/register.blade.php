<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jayacom</title>
  <link rel='icon' href="{{ asset('uploads/Ageecom.jpg')}}" sizes="192x192">
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
  body{background: url('/uploads/bg-toko.jpg')}
</style>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a>Register</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <form method="post" action="{{ url('/register/save') }}" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-2">
          <input type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="name" name="name" placeholder="nama">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        @error('name')
          <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="input-group mb-2">
          <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" name="email" placeholder="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('email')
          <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="input-group mb-2">
          <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" name="password" placeholder="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password')
          <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="form-group">
          <label for="exampleInputFile">Select Avatar</label>
          <input type="file" class="form-control" id="foto" name="foto">
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-0">
        <a href="{{ route('login') }}" class="text-center">Sudah Punya Akun?</a>
      </p>
    </div>
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
