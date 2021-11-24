<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reset hasła</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h1><b>Farm</b>Man</h1>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Wpisz nowe hasło które będziesz mógł użyć podczas logowania</p>
      <form action="/reset/{{$mail}}/{{$token}}" method="post">
        @csrf
        @error('password')
        <div class="alert alert-danger" role="alert">
         {{ $message }}
        </div>
        @enderror
        <small  class="form-text text-muted">Hasło musi mieć od 6 do 12 znaków i posiadać minimum wielka litere i liczbę</small>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Hasło">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('confirm_password')
        <div class="alert alert-danger" role="alert">
         {{ $message }}
        </div>
        @enderror
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="confirm_password" placeholder="Powtórz hasło">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Zmień hasło</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{asset('/')}}">Zaloguj</a>
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
