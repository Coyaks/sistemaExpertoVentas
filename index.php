<?php
session_start();
include_once 'modelo/conexion.php';

if (isset($_POST['login'])) {
  $email = $_POST['email'] ?? '';
  $pass = $_POST['password'] ?? '';

  $pass_e = sha1($pass);

  $query = "SELECT * from usuario where email='$email' and password='$pass'";

  //$queryAdmin = "SELECT * from usuario where email='$email' and password='$pass_e'";

  $rta = mysqli_query($conexion, $query);

  if ($rta->num_rows > 0) {
    $fila = mysqli_fetch_assoc($rta);
    $_SESSION['idRol_fk'] = $fila['idRol_fk'];
    $_SESSION['idUsuario'] = $fila['idUsuario'];
    $_SESSION['email'] = $fila['email'];
    $_SESSION['nombre'] = $fila['nombre'];
    $_SESSION['apellidos'] = $fila['apellidos'];

    if ($fila['idRol_fk'] == 1) {
      header("location: admin.php");
    } else if ($fila['idRol_fk'] == 2) {
      header("location: admin.php?modulo=movimientos");
    }
  } else {
?>
    <div class="alert alert-danger" role="alert">
      <strong>Datos incorrectos</strong>
    </div>
<?php

  }
}

?>



<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="css/main-style.css">
</head>

<body class="hold-transition login-page">
  <!-- LOGIN DEL ADMIN -->
  <div class="login-box">
    <div class="login-logo">
      <img src="img/logo_login.png" alt="Logo" id="logo-login" class="border border-primary">
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Iniciar Sesión</p>
        <!-- inicio de formulario -->
        <form method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Email" name="email">
            <div class="input-group-append">
              <div class="input-group-text border border-primary">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text border border-primary">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block" name="login"><i class="fas fa-sign-in-alt icon-login"></i> Ingresar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <!-- Fin de formulario -->
      </div>
    </div>
  </div>
  <footer>
    <div><span>2021 &copy; Todos los derechos reservados</span></div>
    <div><span>|</span></div>
    <div><span><a href="https://www.linkedin.com/in/coyaks-p%C3%A9rez-quispe-043494175/" target="_blank">Created by Coyaks Perez</a></span></div>
  </footer>

  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

</body>

</html>