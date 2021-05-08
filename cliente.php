<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Clientes</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- /////////////////////////  INICIOOOOO DE TABLAAAA/////////////////////////   -->

    <!-- todo el contenido de la tabla -->
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-lg-12">
                <button id="btnNuevoPaciente" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalPaciente">
                    <i class="material-icons">library_add</i> Nuevo +</button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <!-- inicio tabla BootStrap4    -->
                    <table id="tablaCliente" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>COD</th>
                                <th>Fecha Atenc.</th>
                                <th>Tipo</th>
                                <th>Documento</th>
                                <th>Fecha Nac.</th>
                                <th>Nombre</th>
                                <th>Apell. Pat</th>
                                <th>Apell. Mat</th>
                                <!-- <th>Placa</th>
                                <th>Kilometraje</th> -->
                                <th>Edad</th>
                                <th>Razon Social</th>
                                <th>Celular</th>
                                <th>Domicilio</th>
                                <th>Deuda</th>
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

    <!--Modal para CRUD INSERTAR Y ACTUALIZAR id="modalPaciente"-->
    <!-- OJO: div más extenso -->
    <div class="modal fade" id="modalPaciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- FORMULARIO DE REGISTRO | UPDATE -->
                <form id="formPacientes">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php
                                    //fecha actual
                                    date_default_timezone_set("America/Lima");
                                    $fecha_actual = date("Y-m-d");
                                    ?>
                                    <label for="" class="col-form-label">Fecha de atención</label>
                                    <input type="date" class="form-control" id="fecha_atencion" value="<?php echo $fecha_actual?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Tipo de persona</label>
                                    <select class="form-control" id="tipo_persona" onchange="tipoPersona()">
                                        <option value="0">-- Seleccione --</option>
                                        <option value="Natural">Natural</option>
                                        <option value="Juridica">Jurídica</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="" class="col-form-label" id="labelTipoPer">Documento</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="documento" placeholder="Click en icono para buscar">

                                    <div class="input-group-append">
                                        <!-- ///////////////////btn para abrir modal/////////////////// -->
                                        <button type="button" class="btn btn-primary btnBuscarDoc2">
                                            <!-- icon-buscar -->
                                            <i class="fas fa-search"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 hide-datos-personales">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" id="fecha_nac">
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-lg-4 ">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Nombres</label>
                                    <input type="text" class="form-control" id="nombre_cli">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Apellido Pat.</label>
                                    <input type="text" class="form-control" id="apellido_pat">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Apellido Mat.</label>
                                    <input type="text" class="form-control" id="apellido_mat">
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row">
                            <div class="col-6">
                                <label for="" class="col-form-label">Placa</label>
                                <input type="text" class="form-control" id="placa" placeholder="Ingresa placa de vehiculo">
                            </div>
                            <div class="col-6">
                                <label for="" class="col-form-label">Kilometraje</label>
                                <input type="text" class="form-control" id="kilometraje" placeholder="Ingresa kilometraje">
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-lg-4 hide-datos-personales">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Edad</label>
                                    <input type="text" class="form-control" id="edad">
                                </div>
                            </div>
                            <div class="col-lg-8 hide-razon-social" id="razon-social">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Razón Social</label>
                                    <input type="text" class="form-control" id="razon_social">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Celular</label>
                                    <input type="text" class="form-control" id="celular">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Domicilio</label>
                                    <input type="text" class="form-control" id="domicilio">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Deuda</label>
                                    <input type="text" class="form-control" value="0" id="deuda">
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