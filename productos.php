<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-chart-bar"></i> Inventario de Productos</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /////////////////////////  INICIOOOOO DE TABLAAAA/////////////////////////   -->

    <!-- Agregar nuevo registro -->
    <?php
    if ($_SESSION['idRol_fk'] == 1) {
    ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <button id="btnNuevoProducto" type="button" class="btn btn-info" data-toggle="modal"><i class="material-icons">library_add</i> Nuevo Producto +</button>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <br>
    <!-- todo el contenido de la tabla -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <!-- inicio tabla BootStrap4    -->
                    <table id="tablaProducto" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Marca</th>
                                <th>Categoría</th>
                                <th>CU</th>
                                <th>PV</th>
                                <th>Entradas</th>
                                <th>Salidas</th>
                                <th>Stock</th>
                                <?php
                                if ($_SESSION['idRol_fk'] == 1) {
                                ?>
                                    <th>Acciones</th>
                                    <input type="hidden" name="" id="rol_input" value="1">
                                <?php
                                }
                                ?>

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

    <!--Modal para CRUD INSERTAR Y ACTUALIZAR id="modalCRUD"-->
    <!-- OJO: div más extenso -->
    <div class="modal fade" id="modalCrudProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- FORMULARIO DE REGISTRO | UPDATE -->
                <form id="formProducto">
                    <div class="modal-body modal-body-producto">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Descripción</label>
                                    <input type="text" class="form-control" id="descripcion" placeholder="Ingrese nombre del producto" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Marca</label>
                                    <input type="text" class="form-control" id="marca" placeholder="Ingrese marca">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Categoría</label>
                                    <?php
                                    include_once 'modelo/conexion.php';
                                    $query = "SELECT * from categoria";
                                    $rta = mysqli_query($conexion, $query);
                                    ?>
                                    <select class="form-control" id="categoria" onchange="ocultarInputsCat()">
                                        <option value="0">-- Seleccione categoría --</option>
                                        <?php
                                        while ($fila = mysqli_fetch_assoc($rta)) {
                                        ?>
                                            <option value="<?php echo $fila['idCategoria']; ?>"><?php echo  $fila['nombre']; ?></option>
                                        <?php
                                        }
                                        ?>
                                        <option value="agregarCat">Agregar nueva categoría</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Costo Unitario</label>
                                    <input type="number" class="form-control" id="cu" placeholder="Ingrese cu">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Precio de Venta</label>
                                    <input type="number" class="form-control" id="pv" placeholder="Ingrese pv">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                        <!-- ojo SUBMIT 'GUARDAR': id="btnGuardar" -->
                    </div>
                </form>
                <!-- FIN FORMULARIO DE REGISTRO -->

            </div>
        </div>
    </div>
    <!-- /.content -->
</div>


<!-- //////////////// MODAL AGREGAR CATEGORIA//////////////  -->
<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header-cat text-center">
                <h5 class="modal-title-cat" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- FORMULARIO AGREGAR CAT -->
                <form id="formCategoria">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nueva Categoría</label>
                        <input type="text" class="form-control" id="new_categoria" aria-describedby="emailHelp" placeholder="Ingrese nombre de categoría">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="cerrar-modal-cat">Cerrar</button>
                        <button type="submit" id="btnGuardarCat" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- //FIN MODAL AGREGAR CATEGORIA  -->