  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <?php

          if ($_SESSION['idRol_fk'] == 1) {
          ?>
            <div class="col-sm-12">
              <div class="text-center">
                <h1 class="m-0 text-dark">INDICADORES (KPIS)</h1>
              </div>
            </div>
          <?php
          } else {
          ?>
            <div class="col-sm-12">
              <div class="text-center">
                <h1 class="m-0 text-dark"></h1>
              </div>
            </div>
          <?php
          }
          ?>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- /////////////////////////////////INICIO KPI /////////////////////////////////-->
        <?php
        //Costo total
        include_once 'modelo/conexion.php';
        $queryCostoTotal = "SELECT sum(cantidad*CU) as 'costo_total' from movimiento WHERE movimiento='venta'";
        $rtaCosto = mysqli_query($conexion, $queryCostoTotal);

        $filaCosto = mysqli_fetch_assoc($rtaCosto);
        $costoTotal = $filaCosto['costo_total'];

        //INGRESOS TOTALES
        $queryIngresos = "SELECT sum(cantidad*pv) as 'ingreso_total' from movimiento WHERE movimiento='venta'";
        $rtaIngresos = mysqli_query($conexion, $queryIngresos);

        $filaIngresos = mysqli_fetch_assoc($rtaIngresos);
        $IngresoTotal = $filaIngresos['ingreso_total'];

        //UTILIDAD TOTAL
        $queryUtilidad = "SELECT sum(cantidad*pv)-sum(cantidad*CU) as 'utilidad_actual' from movimiento WHERE movimiento='venta'";
        $rtaUtilidad = mysqli_query($conexion, $queryUtilidad);

        $filaUtilidad = mysqli_fetch_assoc($rtaUtilidad);
        $UtilidadTotal = $filaUtilidad['utilidad_actual'];

        //PRODUCTO MÁS VENDIDO
        //$queryEstrella = "SELECT nombre,descripcion, max(salidas) as numVentas from producto";

        $queryEstrella = "SELECT descripcion, max(salidas) as numVentas from producto where salidas=(SELECT max(salidas) from producto)";
        $rtaEstrella = mysqli_query($conexion, $queryEstrella);
        $filaEstrella = mysqli_fetch_assoc($rtaEstrella);
        //$nombreEstrella = $filaEstrella['nombre'];
        $descripcionEstrella = $filaEstrella['descripcion'];
        $numVentasEstrella = $filaEstrella['numVentas'];
        if ($_SESSION['idRol_fk'] == 1) {
        ?>
          <!-- <div class="row">
            <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>S/ <?php echo $costoTotal ?></h3>

                  <p>Costo total</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>
          
            <div class="col-lg-3 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>S/ <?php echo $IngresoTotal ?></h3>

                  <p>Ingresos totales</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>S/ <?php echo $UtilidadTotal ?></h3>

                  <p>Utilidad total actual</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h4><?php echo $descripcionEstrella . " | " ?> <span style="font-size: 14px;"><?php echo $descripcionEstrella ?></span class=""></h4>

                  <p>Producto más vendido! con <span style="font-size: 16px;"><strong><?php echo $numVentasEstrella ?></strong> ventas</span></p>

                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
              </div>
            </div>
          </div> -->
        <?php
        }
        ?>

        <div class="row mt-4">

          <div class="col-lg-6">
            <h2 class="text-center mb-3">Top 10 productos más vendidos</h2>
            <!-- //////////// inicio de tabla ////////////  -->
            <table class="table table-bordered table-striped table-hover table-condensed">
              <thead class="thead-dark text-center">
                <tr class="center">
                  <th scope="col">#</th>
                  <th scope="col">Producto</th>
                  <th scope="col">Salidas/Ventas</th>
                </tr>
              </thead>
              <tbody class="thead-dark text-center">
                <?php
                $queryTop10 = "SELECT descripcion, salidas from producto order by salidas DESC limit 10";
                $rtaTop = mysqli_query($conexion, $queryTop10);

                $incremento = 0;
                while ($filaTop = mysqli_fetch_assoc($rtaTop)) {
                  $incremento++;
                ?>
                  <?php
                  if ($incremento == 1) {
                  ?>
                    <tr class="table-success">
                      <td><?php echo $incremento ?></td>
                      <td><?php echo $filaTop['descripcion'] ?></td>
                      <td><?php echo $filaTop['salidas'] ?></td>
                    </tr>
                  <?php
                  } else {
                  ?>
                    <tr>
                      <td><?php echo $incremento ?></td>
                      <td><?php echo $filaTop['descripcion'] ?></td>
                      <td><?php echo $filaTop['salidas'] ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                <?php
                }
                ?>
              </tbody>
            </table>

          </div>
          <!-- ////////////// Col ventas por mes //////////////  -->
          <div class="col-lg-6">
            <h2 class="text-center mb-3">Ventas X Mes</h2>
            <!-- //////////// inicio de tabla ////////////  -->
            <table class="table table-bordered table-striped table-hover table-condensed">
              <thead class="thead-dark text-center">
                <tr class="center">
                  <th scope="col">#</th>
                  <th scope="col">Mes</th>
                  <th scope="col">Ventas Totales</th>
                </tr>
              </thead>
              <tbody class="thead-dark text-center">
                <?php

                $inglesEsp="SET lc_time_names = 'es_ES'";
                mysqli_query($conexion, $inglesEsp);

                $queryTop10 = "SELECT MONTHNAME(fecha) as MES, sum(subtotal) AS
                VENTAS FROM movimiento where year(fecha)='2021' group by MES ORDER BY MES ASC";
                $rtaTop = mysqli_query($conexion, $queryTop10);

                $incremento = 0;
                while ($filaTop = mysqli_fetch_assoc($rtaTop)) {
                  $incremento++;
                ?>
                  <?php
                  if ($incremento == 1) {
                  ?>
                    <tr class="table-success">
                      <td><?php echo $incremento ?></td>
                      <td><?php echo $filaTop['MES'] ?></td>
                      <td><?php echo $filaTop['VENTAS'] ?></td>
                    </tr>
                  <?php
                  } else {
                  ?>
                    <tr>
                      <td><?php echo $incremento ?></td>
                      <td><?php echo $filaTop['MES'] ?></td>
                      <td><?php echo $filaTop['VENTAS'] ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                <?php
                }
                ?>
              </tbody>
            </table>

          </div>

        </div>
      </div>
    </section>
  </div>