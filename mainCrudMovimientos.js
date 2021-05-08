var selectPac = $("#movimiento").val();

if (selectPac == 'venta') {
  $("#selectCliente").text("Cliente");

  $('#id-input-proveedor').css("display", "none");
  $("#id-input-cliente").css("display", "block");
  $("#id-input-cliente").attr('class', 'col-4');
  
}
//OJOOOO
function ocultarCampoCompraVenta() {
  var selectPac = $("#movimiento").val();

    if (selectPac == "compra") {
      $("#selectCliente").text("Proveedor");

      $("#id-input-cliente").css( "display", "none" );
      $('#id-input-proveedor').css("display", "block");

      $("#id-input-proveedor").attr('class', 'col-4');

      $(".input-impuesto").css({ visibility: "hidden" });
    } else {
      //venta
      $("#selectCliente").text("Cliente");
      $("#id-input-cliente").css("display", "block");
      $('#id-input-proveedor').css("display", "none");

      $("#id-input-cliente").attr('class', 'col-4');

      $(".input-impuesto").css({ visibility: "visible" });
    }
  
}

$(document).ready(function () {
  var idMov, opcion;
  opcion = 4;
  var valor_cu=$('#input-cu-ocultar').val();
  if(valor_cu==1){
    tablaMovimiento = $("#tablaMovimiento").DataTable({
      language: {
        lengthMenu: "Mostrar _MENU_ registros",
        zeroRecords: "No se encontraron resultados",
        info:
          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
        infoFiltered: "(filtrado de un total de _MAX_ registros)",
        sSearch: "Buscar:",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        sProcessing: "Procesando...",
      },
  
      ajax: {
        url: "crud_movimientos/crudMovimientos.php",
        method: "POST", //usamos el metodo POST
        data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
        dataSrc: "",
      },
      columns: [
        { data: "idMov" },
        { data: "fecha" },
        { data: "producto" },
        { data: "movimiento" },
        { data: "idPaciente_fk" },
        { data: "tipo_pago" },
        { data: "idUsuario_fk" },
        { data: "cantidad" },
        { data: "cu" },
        { data: "pv" },
        { data: "descuento" },
        { data: "subtotal" },
        { data: "observaciones" },
        { data: "idProducto_fk" },
        { data: "idProveedor_fk" },
        {
          defaultContent:
            "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btn-sm btnBorrarMovimiento'><i class='material-icons'>delete</i></button></div></div>",
        },
      ],
    });
  }else{
    //USER VENDEDOR
    tablaMovimiento = $("#tablaMovimiento").DataTable({
      language: {
        lengthMenu: "Mostrar _MENU_ registros",
        zeroRecords: "No se encontraron resultados",
        info:
          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
        infoFiltered: "(filtrado de un total de _MAX_ registros)",
        sSearch: "Buscar:",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        sProcessing: "Procesando...",
      },
  
      ajax: {
        url: "crud_movimientos/crudMovimientos.php",
        method: "POST", //usamos el metodo POST
        data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
        dataSrc: "",
      },
      columns: [
        { data: "idMov" },
        { data: "fecha" },
        { data: "producto" },
        { data: "movimiento" },
        { data: "idPaciente_fk" },
        { data: "tipo_pago" },
        { data: "idUsuario_fk" },
        { data: "cantidad" },
        { data: "pv" },
        { data: "descuento" },
        { data: "subtotal" },
        { data: "observaciones" },
        { data: "idProducto_fk" },
        { data: "idProveedor_fk" },
        {
          defaultContent:
            "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btn-sm btnBorrarMovimiento'><i class='material-icons'>delete</i></button></div></div>",
        },
      ],
    });
  }

 

  function limpiarCajas() {
    $("#idProducto_fk").val(null);
    $("#idProveedor_fk").val(null);
    $("#producto").val(null);
    $("#movimiento").val(0);
    $("#paciente").val(0);
    $("#usuario").val(0);
    $("#cantidad").val(null);
    $("#cu").val(null);
    $("#pv").val(null);
    $("#subtotal").val(null);
    $("#observaciones").val(null);
    $("#tipo_pago").val(0);
    
  }

  var fila; //captura la fila, para editar o eliminar
  //submit para el AÑADIR NEW USER = Alta y Actualización
  $("#formMovimiento").submit(function (e) {
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    opcion = 1; //añadir usuario
    idMov = null;
    fecha_hora = $.trim($("#fecha_hora").val());
    idProducto_fk = $.trim($("#idProducto_fk").val());
    idProveedor_fk = $.trim($("#proveedor").val());
    producto = $.trim($("#producto").val());
    movimiento = $.trim($("#movimiento").val());

    paciente = $.trim($("#paciente").val());
    usuario = $.trim($("#usuario").val());

    cantidad = $.trim($("#cantidad").val());
    cu = $.trim($("#cu").val());
    pv = $.trim($("#pv").val());
    descuento = $.trim($("#descuento").val());
    subtotal = $.trim($("#subtotal").val());
    observaciones = $.trim($("#observaciones").val());
    tipo_pago = $("#tipo_pago").val();

    //CAPTURAR VALORES DE PRODUCTOS SELECCIONADOS
    //tablaVentaMultiple

    $.ajax({
      type: "POST",
      url: "crud_movimientos/crudMovimientos.php",
      datatype: "json",
      data: {
        idMov: idMov,
        fecha_hora: fecha_hora,
        idProducto_fk: idProducto_fk,
        producto: producto,
        movimiento: movimiento,

        tipo_pago:tipo_pago,
        idProveedor_fk: idProveedor_fk,
        paciente: paciente,
        usuario: usuario,
        cantidad: cantidad,
        cu: cu,
        pv: pv,
        descuento: descuento,
        subtotal: subtotal,
        observaciones: observaciones,
        opcion: opcion,
      },
      success: function (data) {
        if (data==11) {

          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Error al registrar, verifique que esté lleno todos los campos",
          });
         
        } else {
          Swal.fire({
            icon: "success",
            title: "Movimiento registrado correctamente!",
          });
          tablaUsuarios.ajax.reload(null, false);
          location.reload();
        }
        
      },
    });
    limpiarCajas();
  });

  //ELIMINAR TODOS LOS REGISTROS
  $("#formEliminar").submit(function (e) {
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    fila = $(this).closest("tr");
    opcion = 5; //eliminar
    var respuesta = confirm("¿Está seguro de eliminar todos los movimientos");
    if (respuesta) {
      $.ajax({
        url: "crud_movimientos/crudMovimientos.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion },
        success: function (data) {
          if (data == 5) {
            Swal.fire({
              icon: "error",
              title: "Se eliminó todos los registros",
            });
            tablaMovimiento.ajax.reload();
          }
        },
      });
    }
  });

  //Borrar solo un registrooo
  $(document).on("click", ".btnBorrarMovimiento", function () {
    fila = $(this);
    idMov = parseInt($(this).closest("tr").find("td:eq(0)").text());
    opcion = 3; //eliminar
    var respuesta = confirm(
      "¿Está seguro de borrar el registro " + idMov + "?"
    );
    if (respuesta) {
      $.ajax({
        url: "crud_movimientos/crudMovimientos.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, idMov: idMov },
        success: function () {
          tablaMovimiento.row(fila.parents("tr")).remove().draw();
        },
      });
    }
  });
});
