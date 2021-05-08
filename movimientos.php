<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Seccion de movimiento -->
    <section class="content-header">
        <div class="container">
            <!-- ////////////////////////// FORMULARIO DE REGISTRO | UPDATE ////////////////////////// -->
            <div class="card card-movimiento p-0">
                <div class="card-header text-white bg-primary m-0 p-0">
                    <h5 class="text-center">Registrar nuevo movimiento </h5>
                </div>
                <div class="card-body p-0">
<!-- ////////////////////////// INICIO DE FORMULARIO //////////////////////////  -->
                    <form id="formMovimiento">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <?php
                                        //fecha actual
                                        date_default_timezone_set("America/Lima");
                                        $fecha_actual = date("Y-m-d");
                                        ?>

                                        <label for="" class="col-form-label">Fecha actual</label>
                                        <input type='date' id='fecha_hora' class='form-control' value="<?php echo $fecha_actual ?>">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <!-- OJOOOOOOOOOOO BTN BUSCAR PRODUCTO -->
                                        <label for="" class="col-form-label">Código de Producto</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="idProducto_fk" required placeholder="Buscar" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <!-- btn para abrir modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBuscarCodigo">
                                                    <!-- icon-buscar -->
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Producto</label>
                                        <input type='text' id='producto' class='form-control'>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <!-- ////////// SELECT MOVIMIENTO ///////////// -->
                                        <label for="" class="col-form-label">Movimiento</label>
                                        <select class="form-control" id="movimiento" onchange="ocultarCampoCompraVenta()">
                                            <!-- <option value="0">-- Seleccione --</option> -->
                                            <?php
                                            if ($_SESSION['idRol_fk'] == 1) {
                                            ?>
                                                <option value="compra">Compra</option>
                                            <?php
                                            }
                                            ?>
                                            <option value="venta" selected>Venta</option>
                                        </select>
                                        <p class="input-error-select-mov"></p>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Tipo de pago</label>
                                        <select class="form-control" id="tipo_pago">
                                            <option value="0">-- Seleccione --</option>
                                            <option value="Efectivo" selected>Efectivo</option>
                                            <option value="Tarjeta de débito">Tarjeta de débito</option>
                                            <option value="Tarjeta de crédito">Tarjeta de crédito</option>
                                            <option value="Yape">Yape</option>
                                        </select>
                                        <!-- <p class="input-error-select-mov"></p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- ////////////// Select CLIENTE ////////////// -->
                                <div id="id-input-cliente" class="col-2">
                                    <div class="form-group">
                                        <label for="" class="col-form-label" id="labelCliente">Cliente</label>
                                        <?php
                                        include_once 'modelo/conexion.php';
                                        $query = "SELECT * from cliente";
                                        $rta = mysqli_query($conexion, $query);
                                        ?>
                                        <select class="form-control" id="paciente" onclick="validarSelectPaciente()" style="width:100%">
                                            <option value="0">-- Seleccione --</option>
                                            <?php
                                            while ($fila = mysqli_fetch_assoc($rta)) {
                                            ?>
                                                <option value="<?php echo $fila['idPaciente']; ?>"><?php echo  $fila['nombre'] . " " . $fila['apellido_pat'] . " " . $fila['apellido_mat']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <p class="input-error-select-pac"></p>
                                    </div>
                                </div>

                                <!-- //////////// Select PROVEEDOR //////////// -->
                                <div id="id-input-proveedor" class="col-2">
                                    <div class="form-group">
                                        <label for="" class="col-form-label" id="labelCliente">Proveedor</label>
                                        <?php
                                        include_once 'modelo/conexion.php';
                                        $query = "SELECT * from proveedor";
                                        $rta = mysqli_query($conexion, $query);
                                        ?>
                                        <select class="form-control" id="proveedor" onclick="validarSelectProveedor()">
                                            <option value="0">-- Seleccione --</option>
                                            <?php
                                            while ($fila = mysqli_fetch_assoc($rta)) {
                                            ?>
                                                <option value="<?php echo $fila['idProveedor']; ?>"><?php echo  $fila['nombre'] . " | " . $fila['contacto']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <p class="input-error-select-prov"></p>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Usuario/Vendedor</label>
                                        <?php
                                        include_once 'modelo/conexion.php';
                                        $query = "SELECT * from usuario";
                                        $rta = mysqli_query($conexion, $query);
                                        ?>
                                        <select class="form-control" id="usuario" onclick="validarSelectUser()">
                                            <option value="0">-- Seleccione --</option>
                                            <?php
                                            while ($fila = mysqli_fetch_assoc($rta)) {
                                                if ($fila['idUsuario'] == $_SESSION['idUsuario']) {
                                            ?>
                                                    <option value="<?php echo $fila['idUsuario']; ?>" selected><?php echo  $fila['nombre'] . " " . $fila['apellidos']; ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?php echo $fila['idUsuario']; ?>"><?php echo  $fila['nombre'] . " " . $fila['apellidos']; ?></option>
                                                <?php
                                                }
                                                ?>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <p class="input-error-select-user"></p>
                                    </div>
                                </div>

                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad">
                                    </div>
                                </div>

                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <?php
                                        if ($_SESSION['idRol_fk'] == 1) {

                                        ?>
                                            <label for="" class="col-form-label">Costo unit.</label>
                                            <input type="number" class="form-control" id="cu">
                                        <?php

                                        } else {
                                        ?>
                                            <input type="hidden" class="form-control" id="cu">
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>

                                <div class="col-lg-1">
                                    <?php
                                    if ($_SESSION['idRol_fk'] == 1) {
                                    ?>
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Precio</label>
                                            <input type="number" class="form-control" id="pv">
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Precio</label>
                                            <input type="number" class="form-control" id="pv" readonly>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </div>

                                <!-- DESCUENTO -->
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Descuento</label>
                                        <input type="number" class="form-control" value="0.00" id="descuento">
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Subtotal</label>

                                        <?php
                                        if ($_SESSION['idRol_fk'] == 1) {

                                        ?>
                                            <div class="input-group mb-3">
                                                <div class="input-group-append">
                                                    <!-- btn para abrir modal -->
                                                    <button type="button" class="btn btn-primary">
                                                        S/
                                                    </button>
                                                </div>

                                                <input type="number" class="form-control" id="subtotal">
                                            </div>
                                        <?php

                                        } else {
                                        ?>
                                            <input type="number" class="form-control" id="subtotal" readonly>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="observaciones" placeholder="Ingrese las observaciones">
                                    </div>
                                </div>

                                <div class="col-lg-2 input-impuesto">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="igv-input" value="18.0">

                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary">
                                                %
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="ml-auto">
                                    <button type="button" class="btn btn-dark btnLimpiarCajas mr-1">Limpiar cajas</button>
                                    <button type="submit" id="btnGuardarMovimiento" class="btn btn-success">Guardar movimiento</button>

                                    <!-- <button type="submit" id="btnVender" class="btn btn-warning">Vender</button> -->
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!-- /////////////////////////  FIN FORMULARIO DE REGISTRO/////////////////////////   -->
        </div>
    </section>
    <!-- /////// NEW TABLA PRODUCTOS SELECCIÓN DE PROD MULTIPLES ///////  -->
    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaVentaMultiple" class="display nowrap table table-striped table-bordered table-condensed estilo-tabla-ajustado" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Fecha</th>
                                <th>Producto</th>
                                <th>COD-PROD</th>
                                <th>Movimiento</th>
                                <th>COD-Cliente</th>
                                <th>Pago</th>
                                <th>COD-Vendedor</th>
                                <th>Cantidad</th>
                                <th>PV</th>
                                <th>Descuento</th>
                                <th>Subtotal</th>
                                <th>Observ.</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="row">
        <div class="col-lg-8 col-subtotal-ventas-center">
            <div class="row">
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary">
                                Total sin IGV: S/
                            </button>
                        </div>
                        <input type="text" class="form-control" id="montoSinIGV" placeholder="Subtotal">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary">
                                IGV 18.0%: S/
                            </button>
                        </div>
                        <input type="text" class="form-control" id="igv" placeholder="IGV">
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary">
                                Total: S/
                            </button>
                        </div>
                        <input type="text" class="form-control" id="totalPagar" placeholder="Total a pagar">
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    <div class="row">
        <div class="col-lg-8 col-subtotal-ventas-center">
            <div class="row">
                <div class="col-lg-4">
                    <button type="button" id="btnGenerarVenta" class="btn btn-success w-100"><i class="fa fa-floppy-o"></i> Generar venta</button>                  
                </div>
                <div class="col-lg-4">

                </div>
                <div class="col-lg-4">
                    
                </div>
            </div>
        </div>
    </div> -->

    <!-- FIN NEW TABLA PRODUCTOS SELECCIÓN DE PROD MULTIPLES -->

    <!-- todo el contenido de la tabla original mov -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <!-- inicio tabla BootStrap4    -->
                    <table id="tablaMovimiento" class="display nowrap table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Producto</th>
                                <th>Movimiento</th>
                                <th>COD-Cliente</th>
                                <th>Tipo-Pago</th>
                                <th>COD-Vendedor</th>
                                <th>Cantidad</th>
                                <?php
                                if ($_SESSION['idRol_fk'] == 1) {
                                ?>
                                    <th>CU</th>
                                    <input type="hidden" id="input-cu-ocultar" value="1">
                                <?php
                                }
                                ?>
                                <th>PV</th>
                                <th>Descuento</th>
                                <th>Subtotal</th>
                                <th>Observaciones</th>
                                <th>COD-PROD</th>
                                <th>COD-PROV</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- Fin tabla BootStrap4    -->
                </div>
            </div>
        </div>
    </div>


    <!-- /////////////// Modal BUSCAR CÓDIGO PRODUCTO///////////////// -->
    <div class="modal fade " id="modalBuscarCodigo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buscar código</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    include_once 'modelo/conexion.php';

                    //OPERACION PARA SACAR EL STOCK ACTUAL FUNCIONAAA!
                    $consulta = "UPDATE producto set stock=entradas-salidas";
                    $resultado = mysqli_query($conexion, $consulta);

                    $query = "select idProducto,descripcion, cu, pv, stock from producto";
                    $rta = mysqli_query($conexion, $query);

                    ?>
                    <!-- ///////NEW TABLA DATATABLES ///////-->
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="tablaProductoBuscar" class="table table-striped table-bordered table-condensed" style="width:100%">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Código</th>
                                                <th>Descripción</th>
                                                <?php
                                                if ($_SESSION['idRol_fk'] == 1) {
                                                ?>
                                                    <input type="hidden" id="buscar-prod-admin" value="1">
                                                    <th>CU</th>
                                                <?php
                                                }
                                                ?>
                                                <th>PV</th>
                                                <th>Stock</th>
                                                <th>Agregar</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <!-- Fin tabla BootStrap4    -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ///////////////FIN Modal BUSCAR CÓDIGO////////////////////////-->

    <!-- BORRAR TODOS LOS MOVIMIENTOS -->
    <?php
    if ($_SESSION['idRol_fk'] == 1) {
    ?>
        <form id="formEliminar">
            <div class="text-center">
                <button type="submit" id="btnEliminarMovimientos" class="btn btn-danger m-5">Eliminar todos los movimientos</button>
            </div>
        </form>
    <?php

    }
    ?>

</div>