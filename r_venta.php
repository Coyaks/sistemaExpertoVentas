<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center titulo-negrita">FILTROS, BÚSQUEDAS Y REPORTES DINÁMICOS</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <!-- fecha inicial -->
                            <input type="text" class="form-control" id="start_date1" placeholder="Fecha de inicio" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <!-- fecha final -->
                            <input type="text" class="form-control" id="end_date1" placeholder="Fecha final" readonly>
                        </div>
                    </div>
                </div>
                <div>
                    <button id="filterVenta" class="btn btn-outline-info btn-sm">Filtrar</button>
                    <button id="resetVenta" class="btn btn-outline-warning btn-sm">Reset Tabla</button>
                </div>

            </div>
        </div>
        <!-- /////////  div tabla general  ///////// -->
        <div class="row mt-3">
            <div class="col-lg-12">
                <!-- Table -->
                <div class="table-responsive">
                    <!-- /////////////////// tabla: records ///////////////////  -->
                    <table id="tablaVenta" class="display nowrap tablaVenta table table-striped table-bordered tablaSeg table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Fecha y hora</th>
                                <th>Producto</th>
                                <th>Movimiento</th>
                                <th>Cliente</th>
                                <th>Vendedor</th>
                                <th>Cantidad</th>
                                <th>CU</th>
                                <th>PV</th>
                                <th>Descuento</th>
                                <th>Subtotal</th>
                                <th>Observaciones</th>
                                <th>COD-PROD</th>
                                <th>Tipo-Pago</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>