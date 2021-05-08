<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- <div class="row">
            <div class="col-md-12">
                <h2 class="text-center titulo-negrita">ASISTENTE VIRTUAL</h2>
                <hr>
            </div>
        </div> -->

        <!-- ///////////////// CARD SISTEMA EXPERTO /////////////////  -->
        <div class="container-fluid">
            <div class="box-encuesta">
                <div class="card border-primary car-principal ">
                    <div class="card-header bg-primary text-white text-center pb-0">
                        <strong class="titulo-encu">SISTEMA EXPERTO | CONSULTAS DE MOVIMIENTOS</strong>
                    </div>
                    <div class="card-body">
                        <div class="img-logo-fruta"><img src="img/logo.png" alt=""></div>

                        <form id="formEnviarEncuesta">
                            <div class="form-group">
                                <i class="far fa-grin-beam icon-carita"></i>
                                <label for="exampleInputEmail1">Seleccione opción</label>

                                <select class="form-control" id="movimiento1">
                                    <option value="0">-- Seleccione --</option>
                                    <option value="1">Ventas</option>
                                    <option value="2">Compras</option>
                                    <option value="3">Clientes</option>
                                </select>

                            </div>

                            <div class="form-group">
                                <div id="rtaPuntos"></div>
                            </div>

                            <!-- RADIO BUTTON VENTAS-->
                            <div class="select_ventas">
                                <div class="form-check">
                                    <!-- radio 1 -->
                                    <input class="form-check-input" type="radio" name="consultaVenta" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label">
                                        Ver todas las ventas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <!-- radio 2 -->
                                    <input class="form-check-input" type="radio" name="consultaVenta" id="exampleRadios2" value="option2">
                                    <label class="form-check-label">
                                        Ver la cantidad de ventas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <!-- radio 3 -->
                                    <input class="form-check-input" type="radio" name="consultaVenta" id="exampleRadios3" value="option3">
                                    <label class="form-check-label" for="exampleRadios3">
                                        Ver el producto más vendido
                                    </label>
                                </div>

                                <div class="form-check">
                                    <!-- radio 4 -->
                                    <input class="form-check-input" type="radio" name="consultaVenta" id="exampleRadios3" value="option4">
                                    <label class="form-check-label" for="exampleRadios3">
                                        Ver el costo total
                                    </label>
                                </div>

                                <div class="form-check">
                                    <!-- radio 5 -->
                                    <input class="form-check-input" type="radio" name="consultaVenta" id="exampleRadios3" value="option5">
                                    <label class="form-check-label" for="exampleRadios3">
                                        Ver los ingresos totales
                                    </label>
                                </div>

                                <div class="form-check">
                                    <!-- radio 6 -->
                                    <input class="form-check-input" type="radio" name="consultaVenta" id="exampleRadios3" value="option6">
                                    <label class="form-check-label" for="exampleRadios3">
                                        Ver la utilidad actual
                                    </label>
                                </div>

                                <div class="form-check">
                                    <!-- radio 7 -->
                                    <input class="form-check-input" type="radio" name="consultaVenta" id="exampleRadios3" value="option7">
                                    <label class="form-check-label" for="exampleRadios3">
                                        Predicción de ventas
                                    </label>
                                </div>

                                <div class="form-check">
                                    <!-- radio 8 -->
                                    <input class="form-check-input" type="radio" name="consultaVenta" id="exampleRadios3" value="option8">
                                    <label class="form-check-label" for="exampleRadios3">
                                        Problemas con ventas
                                    </label>
                                </div>
                            </div>

                            <!-- FIN RADIO BUTTON VENTAS-->

                            <!-- RADIO BUTTON COMPRAS-->
                            <div class="select_compras">
                                <div class="form-check">
                                    <!-- radio 1 -->
                                    <input class="form-check-input" type="radio" name="consultaCompra" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Ver todas las compras
                                    </label>
                                </div>
                                <div class="form-check">
                                    <!-- radio 2 -->
                                    <input class="form-check-input" type="radio" name="consultaCompra" id="exampleRadios2" value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Ver la cantidad de compras
                                    </label>
                                </div>
                                <div class="form-check">
                                    <!-- radio 3 -->
                                    <input class="form-check-input" type="radio" name="consultaCompra" id="exampleRadios3" value="option3">
                                    <label class="form-check-label" for="exampleRadios3">
                                        Ver la cantidad de compras
                                    </label>
                                </div>
                            </div>

                            <!-- FIN RADIO BUTTON COMPRAS-->


                            <!-- PRODUCTO ESTRELLA     -->
                            <?php
                            include_once 'modelo/conexion.php';

                            $queryEstrella = "SELECT descripcion, max(salidas) as numVentas from producto where salidas=(SELECT max(salidas) from producto)";
                            $rtaEstrella = mysqli_query($conexion, $queryEstrella);
                            $filaEstrella = mysqli_fetch_assoc($rtaEstrella);

                            $descripcionEstrella = $filaEstrella['descripcion'];
                            $numVentasEstrella = $filaEstrella['numVentas'];

                            //UTILIDAD ACTUAL
                            $queryUtilidad = "SELECT sum(cantidad*pv)-sum(cantidad*CU) as 'utilidad_actual' from movimiento WHERE movimiento='venta'";
                            $rtaUtilidad = mysqli_query($conexion, $queryUtilidad);

                            $filaUtilidad = mysqli_fetch_assoc($rtaUtilidad);
                            $UtilidadTotal = $filaUtilidad['utilidad_actual'];


                            //INGRESOS TOTALES
                            $queryIngresos = "SELECT sum(cantidad*pv) as 'ingreso_total' from movimiento WHERE movimiento='venta'";
                            $rtaIngresos = mysqli_query($conexion, $queryIngresos);

                            $filaIngresos = mysqli_fetch_assoc($rtaIngresos);
                            $IngresoTotal = $filaIngresos['ingreso_total'];


                            //Costo total
                            include_once 'modelo/conexion.php';
                            $queryCostoTotal = "SELECT sum(cantidad*CU) as 'costo_total' from movimiento WHERE movimiento='venta'";
                            $rtaCosto = mysqli_query($conexion, $queryCostoTotal);

                            $filaCosto = mysqli_fetch_assoc($rtaCosto);
                            $costoTotal = $filaCosto['costo_total'];
                            ?>
                            <div class="col-lg-3  producto_estrella mt-5">
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


                            <div class="col-lg-3 utilidad_actual">
                                <!-- small box -->
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

                            <div class="col-lg-3 ingresos_actuales">
                                <!-- small box -->
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


                            <div class="col-lg-3 costos_actuales">
                                <!-- small box -->
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



                            <div class="row mt-5">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-success" id="btnRealizarConsultas">REALIZAR CONSULTA</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- <div class="select_compras">
    <div class="form-check">
        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
        <label class="form-check-label" for="exampleRadios1">
            Default radio
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
        <label class="form-check-label" for="exampleRadios2">
            Second default radio
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>
        <label class="form-check-label" for="exampleRadios3">
            Disabled radio
        </label>
    </div>
</div> -->