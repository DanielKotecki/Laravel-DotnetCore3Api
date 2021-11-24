<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rejestracja</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h1><b>Farm</b>Man</h1>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Rejestracja nowego użytkownika</p>
      @if (session('message'))
      <div class="alert alert-danger" role="alert">
        {{session('message')}}
      </div>
      
      @endif
     
 
      <form action="register" method="post">
        @csrf
        @error('Email')
        <div class="alert alert-danger" role="alert">
         {{ $message }}
        </div>
        @enderror
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="Email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
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
        @error('terms')
        <div class="alert alert-danger" role="alert">
         Za akceptuj warunki aby ukończyć rejestrację.
        </div>
        @enderror
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               Akceptuję <a href="{{asset('conditions')}}">warunki</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Utwórz</button>
          </div>
          <!-- /.col -->
        </div>
      </form>



      <a href="{{asset('')}}" class="text-center">Posiadam już konto</a>
    </div>
    <!-- /.form-box -->
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