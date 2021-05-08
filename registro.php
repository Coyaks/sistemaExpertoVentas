<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mi tienda| Sign Up</title>
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
  <!-- sweetalert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>"ÓPTICA CABEL"</b>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Regístrate</p>

        <?php
        //capturar el email y el pass del formulario
        if (isset($_POST['registro'])) {
          $nombre = $_POST['nombre'] ?? '';
          $apellidos = $_POST['apellidos'] ?? '';
          $celular = $_POST['celular'] ?? '';

          $email = $_POST['email'] ?? '';
          $pass = $_POST['password'] ?? '';
          //$pass_e = sha1($pass);
          include_once 'modelo/conexion.php';
          $query = "INSERT into usuario(nombre, apellidos, celular, email, password, idRol_fk) values ('$nombre','$apellidos','$celular','$email', '$pass', 2)";
          $rta = mysqli_query($conexion, $query);

          if ($rta) {
        ?>
            <div class="alert alert-primary" role="alert">
              <strong>Registro exitoso </strong><a href="index.php">Ir al login</a>
            </div>
          <?php
          } else {
          ?>
            <div class="alert alert-danger" role="alert">
              Error al registrar
            </div>
        <?php
          }
        }
        ?>

        <!-- inicio de formulario -->
        <form method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" require>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Apellidos" name="apellidos" id="apellidos">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <!-- celular -->
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="N° de celular" name="celular" id="celular">
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="fas fa-mobile-alt"></i>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" id="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary" id="btnRegistrarse" name="registro">Registrarse</button>
              <a href="index.php" class="text-success float-right">Ir a Log In</a>
            </div>

            <!-- /.col -->
          </div>
        </form>
        <!-- Fin de formulario -->

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

</body>

</html>