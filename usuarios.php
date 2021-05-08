<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios</h1>
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
                    <button id="btnNuevo" type="button" class="btn btn-info" data-toggle="modal"><i class="material-icons">library_add</i> Nuevo +</button>
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
                    <table id="tablaUsuario" class="table table-striped table-bordered table-condensed tabla-user" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>N° Celular</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Rol</th>
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

    <!--Modal para CRUD INSERTAR Y ACTUALIZAR id="modalCRUD"-->
    <!-- OJO: div más extenso -->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- FORMULARIO DE REGISTRO | UPDATE -->
                <form id="formUsuarios">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">N° celular</label>
                                    <input type="text" class="form-control" id="celular">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Email</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Password</label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                            </div>

                            <?php
                            if ($_SESSION['idRol_fk'] == 1) {
                            ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Rol</label>

                                        <select class="form-control" id="rol">
                                            <option value="0">-- Seleccione rol --</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Personal</option>
                                        </select>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Rol</label>
                                        <select class="form-control" id="rol">
                                            <option value="0">-- Seleccione rol --</option>
                                            <option value="2">Personal</option>
                                        </select>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>


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