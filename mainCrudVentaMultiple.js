$(document).ready(function () {

  var subtotalAcum=0;
  var i=0;
  var igv_input, opcion;

  //  $("#formMovimiento2").submit(function (e) {
  //   alert("Alert");
  // //   //idMov = null;
  // //   // opcion=1;
    
  // //   // fecha_hora = $.trim($("#fecha_hora").val());
  // //   // idProducto_fk = $.trim($("#idProducto_fk").val());
  // //   // producto = $.trim($("#producto").val());
  // //   // movimiento = $.trim($("#movimiento").val());
  // //   // tipo_pago = $("#tipo_pago").val();
  // //   // paciente = $.trim($("#paciente").val());
  // //   // usuario = $.trim($("#usuario").val());

  // //   // cantidad = $.trim($("#cantidad").val());
  // //   // //COSTO OPCIONAL
  // //   // //cu = $.trim($("#cu").val());

  // //   // pv = $.trim($("#pv").val());
  // //   // descuento = $.trim($("#descuento").val());

  // //   // subtotal = parseFloat($("#subtotal").val());
  // //   // observaciones = $.trim($("#observaciones").val());
    

  // //   //class="badge badge-success"
  // //   // i++; //contador para asignar id al boton que borrara la fila
  // //   // var fila = '<tr id="row' + i + '"><td>' + fecha_hora + '</td><td class="bg-success"><span >' + producto + '</span></td><td>' + idProducto_fk+ '</td><td>' + movimiento+ '</td><td>' + paciente+ 
  // //   // '</td><td>' + tipo_pago+ '</td><td>' + usuario+ '</td><td class="bg-success"><span>' +cantidad+'</span></td><td>' + pv+ '</td><td>' + descuento+ 
  // //   // '</td><td class="bg-success"><span>' + subtotal+ '</span></td><td>' + observaciones+ 
  // //   //  '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"><i class="fas fa-trash"></i></button></td></tr>'; //esto seria lo que contendria 
     

  // //   // $("#tablaVentaMultiple tr:last").after(fila);
    
  // //   //Acumular Subtotal
  // //   // subtotalAcum+=subtotal;
  // //   // $("#totalPagar").val(subtotalAcum);
  // //   // //Calcular IGV
  // //   // igv_input=parseFloat($('#igv-input').val())/100;
  // //   // igv=(subtotalAcum*igv_input).toFixed(2);
  // //   // $('#igv').val(igv);
  // //   // //Calcular monto sin igv
  // //   // montoSinIGV=(subtotalAcum-igv).toFixed(2);
  // //   // $('#montoSinIGV').val(montoSinIGV);
  // //   // alert("Hola");

  // //   // limpiarCajas();

  // //   //ENVIAR DATA A BASE DE DATOS AJAX

  // //   // $.ajax({
  // //   //   type: "POST",
  // //   //   url: "crud_movimientos/crudMovimientos.php",
  // //   //   datatype: "json",
  // //   //   data: {
  // //   //     //idMov: idMov,
  // //   //     fecha_hora: fecha_hora,
  // //   //     idProducto_fk: idProducto_fk,
  // //   //     producto: producto,
  // //   //     movimiento: movimiento,

  // //   //     tipo_pago:tipo_pago,
  // //   //     //idProveedor_fk: idProveedor_fk,
  // //   //     paciente: paciente,
  // //   //     usuario: usuario,
  // //   //     cantidad: cantidad,
  // //   //     cu: cu,
  // //   //     pv: pv,
  // //   //     descuento: descuento,
  // //   //     subtotal: subtotal,
  // //   //     observaciones: observaciones,
  // //   //     opcion: opcion,
  // //   //   },
  // //   //   success: function (data) {
  // //   //     if (data==11) {

  // //   //       Swal.fire({
  // //   //         icon: "error",
  // //   //         title: "Oops...",
  // //   //         text: "Error al registrar, verifique que esté lleno todos los campos",
  // //   //       });
         
  // //   //     } else {
  // //   //       Swal.fire({
  // //   //         icon: "success",
  // //   //         title: "Movimiento registrado correctamente!",
  // //   //       });
  // //   //       //tablaUsuarios.ajax.reload(null, false);
  // //   //       //location.reload();
  // //   //     }
        
  // //   //   },
  // //   // });

  // //   //FIN ENVIAR DATA A BASE DE DATOS AJAX


   
  //  });

  $(document).on('click', '.btn_remove', function () {
    var button_id = $(this).attr("id");
    console.log("Valor de button_id: "+button_id);
    //cuando da click obtenemos el id del boton
    $('#row' + button_id + '').remove(); //borra la fila

    //Capturar el subtotal de la fila eliminada
    fila = $(this).closest("tr");
    sub=parseFloat(fila.find("td:eq(10)").text());
    //alert("Sub de la fila: "+sub);
    subtotalAcum-=sub;
    $("#totalPagar").val(subtotalAcum);

    igv=(subtotalAcum*igv_input).toFixed(2);
    $('#igv').val(igv);
    //Calcular monto sin igv
    montoSinIGV=(subtotalAcum-igv).toFixed(2);
    $('#montoSinIGV').val(montoSinIGV);

});

  // function limpiarCajas(){
  // }
});
