<?php
session_start();
include_once 'modelo/conexion.php';
//evitar vulnerabilidad por técnica 'hijacking'
//session_regenerate_id(true);
if (isset($_REQUEST['sesion']) && $_REQUEST['sesion'] == 'cerrar') {
  session_destroy();
  header("location: index.php");
}

//evitar que se ingrese directamente al admin sin estar logueados
if (isset($_SESSION['idUsuario']) == false) {
  header("location: index.php");
}
$modulo = $_REQUEST['modulo'] ?? '';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <!-- icono a pestaña -->
  <link rel="icon" href="img/ferre_ico.ico">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome LOCAL-->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Daterange picker CSS-->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

  <!-- style personalizado coy -->
  <link rel="stylesheet" href="css/main-style.css">
  <link rel="stylesheet" href="css/estilosExperto.css">


  <!-- DATATABLES BUTTONS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"> -->

    <!-- DataTables CSS-->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <!-- iconos de material io -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


  <!-- //////////////////// DATE RANGE PICKER 2////////////////////  -->
  <!-- Datepicker -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- iconos de fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- ESTILOS PROPIOS PARA TABLA -->
  <link rel="stylesheet" href="css/estilosTablas.css">
  <!-- ////////// LIBRERIA SELECT2 //////////  -->
  <link rel="stylesheet" href="css/select2.min.css">
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="js/select2.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <div class="dropdown">
          <!-- icono q permite desplazar -->
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-user"></i></a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <!-- item editar usuario -->
            <a class="nav-link" id="hover-editar-user" href="admin.php?modulo=usuarios">Editar perfil</a>

            <div class="dropdown-divider"></div>
            <!-- item 2 cerrar sesion -->
            <a class="nav-link" id="hover-cerrar-sesion-user" href="admin.php?modulo=&sesion=cerrar" title="cerrar sesión">Cerrar Sesión</i>
            </a>
          </div>
        </div>

        <!-- <i class="fas fa-door-closed"> -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- //////////////////////////// INICIO BARRA LATERAL 'ASIDE' //////////////////////////// -->

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="dist/img/bitsware_blanco.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light text-admin">Admin</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-0 d-flex">
          <div class="image">
            <img src="img/man.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="pull-left info mb-0">
            <p class="text-white mb-0"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidos']; ?></p>
            <a href="#" class="text-online"><i class="fa fa-circle mr-1 text-success"></i>Online</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link active">
                <i class="fa fa-shopping-cart nav-icon" aria-hidden="true"></i>
                <p>Dashboard</p>
                <!-- <i class="fas fa-caret-down nav-icon ml-5"></i> -->
                <i class="right fas fa-angle-left"></i>
              </a>
              <ul class="nav nav-treeview">

                <!-- CONTENIDO DE LA BARRA LATERAL  -->

                <!-- MODULO ESTADÍSTICAS -->
                <?php
                if ($_SESSION['idRol_fk'] == 1) {
                ?>
                  <li class="nav-item">
                    <!-- para activar la opción seleccionada lo hacemos con php -->
                    <a href="admin.php?modulo=estadisticas" class="nav-link <?php echo ($modulo == 'estadisticas' || $modulo == '') ? "color-link-sidebar" : " "; ?>">
                      <i class="fas fa-chart-bar nav-icon"></i>
                      <p>Estadísticas</p>
                    </a>
                  </li>
                <?php
                }
                ?>

                <!-- MODULO USUARIOS -->
                <?php
                if ($_SESSION['idRol_fk'] == 1) {
                ?>
                  <li class="nav-item">
                    <a href="admin.php?modulo=usuarios" class="nav-link <?php echo ($modulo == 'usuarios') ? "color-link-sidebar" : " "; ?>">
                      <i class="far fa-user nav-icon"></i>
                      <p>Usuarios</p>
                    </a>
                  </li>
                <?php
                }
                ?>

                <!-- MODULO CLIENTES -->
                <li class="nav-item">
                  <a href="admin.php?modulo=cliente" class="nav-link <?php echo ($modulo == 'cliente') ? "color-link-sidebar" : " "; ?>">
                    <i class="far fa-address-card nav-icon"></i>
                    <p>
                      Clientes
                    </p>
                  </a>
                </li>
                <!-- Street view PRODUCTOS ///////////-->

                <li class="nav-item">
                  <a href="admin.php?modulo=productos" class="nav-link <?php echo ($modulo == 'productos') ? "color-link-sidebar" : " "; ?>">
                    <i class="fa fa-shopping-bag nav-icon"></i>
                    <p>Productos</p>
                  </a>
                </li>

                <!-- MODULO MOVIMIENTOS -->
                <li class="nav-item">
                  <a href="admin.php?modulo=movimientos" class="nav-link <?php echo ($modulo == 'movimientos') ? "color-link-sidebar" : " "; ?>">
                    <!-- <i class="fa fa-table nav-icon" aria-hidden="true"></i> -->
                    <i class="fas fa-balance-scale nav-icon"></i>
                    <p>Movimientos</p>
                  </a>
                </li>

                <!-- MODULO PROVEEDORES -->
                <li class="nav-item">
                  <a href="admin.php?modulo=proveedor" class="nav-link <?php echo ($modulo == 'proveedor') ? "color-link-sidebar" : " "; ?>">
                    <!-- <i class="fa fa-table nav-icon" aria-hidden="true"></i> -->
                    <i class="fas fa-user-tie nav-icon"></i>
                    <p>Proveedores</p>
                  </a>
                </li>
                <!-- ///////SISTEMA EXPERTO/////// -->
                <li class="nav-item">
                  <a href="admin.php?modulo=experto" class="nav-link <?php echo ($modulo == 'experto') ? "color-link-sidebar" : " "; ?>">
                    <!-- <i class="fa fa-table nav-icon" aria-hidden="true"></i> -->
                    <i class="fas fa-user-tie nav-icon"></i>
                    <p>Sistema Experto</p>
                  </a>
                </li>

                <!-- MODULO REPORTES -->
                <li class="nav-item menu-<?php echo ($modulo == 'r_venta' || $modulo == 'r_compra') ? "open" : "close" ?>">
                  <a href="#" class="nav-link">
                    <!-- <i class="fa fa-table nav-icon" aria-hidden="true"></i> -->
                    <i class="far fa-file-pdf nav-icon"></i>
                    <p>Reportes
                      <i class="right fas fa-angle-right"></i>
                      <span class="badge badge-info right">2</span>
                    </p>

                  </a>
                  <ul class="nav nav-treeview">

                    <li class="nav-item ml-3">
                      <a href="admin.php?modulo=r_venta" class="nav-link <?php echo ($modulo == 'r_venta') ? "color-link-sidebar" : " "; ?>">
                        <i class="fa fa-table nav-icon" aria-hidden="true"></i>
                        <p>Ventas</p>
                      </a>
                    </li>

                    <li class="nav-item ml-3">
                      <a href="admin.php?modulo=r_compra" class="nav-link <?php echo ($modulo == 'r_compra') ? "color-link-sidebar" : " "; ?>">
                        <i class="fa fa-table nav-icon" aria-hidden="true"></i>
                        <p>Compras</p>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
        </nav>

      </div>
    </aside>
    <!-- //////////////////////////// FIN BARRA LATERAL 'ASIDE' //////////////////////////// -->

    <!-- INICIO CONTENIDO DEL DASHBOARD -->
    <?php
    if (isset($_REQUEST['mensaje'])) {
    ?>
      <div class="alert alert-primary alert-dismissible fade show float-right" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <?php echo $_REQUEST['mensaje'] ?>
      </div>
    <?php
    }
    //MÓDULOS
    if ($modulo == 'estadisticas' || $modulo == "") {
      include_once 'estadisticas.php';
    }
    if ($modulo == 'usuarios') {
      include_once 'usuarios.php';
    }
    if ($modulo == 'cliente') {
      include_once 'cliente.php';
    }

    //IMPORTANT MODULO
    if ($modulo == 'productos') {
      include_once 'productos.php';

      include_once 'modelo/conexion.php';
      $consulta = "UPDATE producto set stock_actual=entradas-salidas;";
      $resultado = mysqli_query($conexion, $consulta);
    }
    //CARWASH
    if ($modulo == 'proveedor') {
      include_once 'proveedor.php';
    }
    if ($modulo == 'movimientos') {
      include_once 'movimientos.php';
    }
    if ($modulo == 'experto') {
      include_once 'experto.php';
    }
    if ($modulo == 'r_venta') {
      include_once 'r_venta.php';
    }
    if ($modulo == 'r_compra') {
      include_once 'r_compra.php';
    }

    //OPERACION PARA SACAR EL STOCK ACTUAL
    $consulta = "UPDATE producto set stock_actual=entradas-salidas;";
    $resultado = mysqli_query($conexion, $consulta);

    ?>

  </div>
  <!-- SELECT2 -->
  <script>
    $(document).ready(function () {
      $('#paciente').select2();
    });
  </script>
  
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>

  <!-- ////////////// RANGOS DE FECHAS JS //////////////  -->
  <!-- Datepicker -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>

  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <!-- //////////////// para usar botones en datatables JS ////////////////  -->
  <script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>
  <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
  <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
  <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

  <!-- datatables JS -->
  <script type="text/javascript" src="datatables/datatables.min.js"></script>

  <!-- LIBRERIA DE ALERTAS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script src="mainCrudUsuarios.js"></script>
  <script src="mainCrudCliente.js"></script>
  <script src="mainCrudProveedor.js"></script>

  <!-- ////////////// RANGOS DE FECHAS //////////////  -->
  <script src="dateRangeReporteVentas.js"></script>
  <script src="dateRangeReporteCompras.js"></script>

  <script src="mainCrudProductos.js"></script>
  <script src="mainCrudProductosBuscar.js"></script>

  <script src="mainCrudVentas.js"></script>

  <script src="mainCrudCompras.js"></script>

  <script src="mainCrudMovimientos.js"></script>
  <!-- VENTAS MULTIPLES -->
  <script src="mainCrudVentaMultiple.js"></script>
  <script src="consultasSistema.js"></script>

  <script src="js/agregarFilaInput.js"></script>
  <script src="js/agregarCategoria.js"></script>

</body>

</html>