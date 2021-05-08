<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Proveedores</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <!-- /////////////////////////  INICIOOOOO DE TABLAAAA/////////////////////////   -->

    <!-- Agregar nuevo registro -->

    <?php
    if ($_SESSION['idRol_fk'] == 1) {
    ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <button id="btnNuevoProveedor" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalProveedor"><i class="material-icons">library_add</i> Nuevo +</button>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <br>
    <!-- todo el contenido de la tabla -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <!-- inicio tabla BootStrap4    -->
                    <table id="tablaProveedor" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID-PROV</th>
                                <th>Nombre|Marca</th>
                                <th>Contacto</th>
                                <th>N° Celular</th>
                                <th>Dirección</th>
                                <?php
                                    if($_SESSION['idRol_fk']==1){
                                        ?>
                                        <input type="hidden" id="input_hidden_prov" value="1">
                                             <th>Acciones</th>
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

    <!--Modal para CRUD INSERTAR Y ACTUALIZAR id="modalProveedor"-->
    <!-- OJO: div más extenso -->
    <div class="modal fade" id="modalProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- FORMULARIO DE REGISTRO | UPDATE -->
                <form id="formProveedor">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Proveedor:</label>
                                    <input type="text" class="form-control" id="nombre" placeholder="Ingrese proveedor">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Contacto</label>
                                    <input type="text" class="form-control" id="contacto" placeholder="Ingrese nombre de contacto">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">N° celular</label>
                                    <input type="text" class="form-control" id="celular" placeholder="Ejem: 954236545">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" placeholder="Opcional">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar Proveedor</button>
                        <!-- ojo SUBMIT 'GUARDAR': id="btnGuardar" -->
                    </div>
                </form>
                <!-- FIN FORMULARIO DE REGISTRO -->


            </div>
        </div>
    </div>
    <!-- /.content -->
</div>