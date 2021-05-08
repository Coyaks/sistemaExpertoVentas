function validarSelectPac() {
  var selectPac = $("#idPaciente_fk").val();
  if (selectPac == 0) {
    //alert('Seleccionar paciente');
    //Marcar de rojo select
    $("#idPaciente_fk").css({ border: "3px solid red" });
    $(".input-error-select-pac").text("Es necesario seleccionar un cliente!");
    $(".input-error-select-pac").css({ color: "red" });
  } else {
    //$('.input-error-select-pac').css({"display":"none"});
    $("#idPaciente_fk").css({ border: "3px solid green" });
    $(".input-error-select-pac").text("");
  }
}
//SELECT PACIENTE EN MOVIMIENTO

function validarSelectPaciente() {
  var selectPac = $("#paciente").val();
  if (selectPac == 0) {
    //alert('Seleccionar paciente');
    //Marcar de rojo select
    $("#paciente").css({ border: "3px solid red" });
    $(".input-error-select-pac").text("Es necesario seleccionar un cliente!");
    $(".input-error-select-pac").css({ color: "red" });
  } else {
    //$('.input-error-select-pac').css({"display":"none"});
    $("#paciente").css({ border: "3px solid green" });
    $(".input-error-select-pac").text("");
  }
}
//NEWWWWWWW
function validarSelectProveedor() {
  var selectPac = $("#proveedor").val();
  if (selectPac == 0) {
    //alert('Seleccionar paciente');
    //Marcar de rojo select
    $("#proveedor").css({ border: "3px solid red" });
    $(".input-error-select-prov").text("Es necesario seleccionar un proveedor!");
    $(".input-error-select-prov").css({ color: "red" });
  } else {
    //$('.input-error-select-pac').css({"display":"none"});
    $("#proveedor").css({ border: "3px solid green" });
    $(".input-error-select-prov").text("");
  }
}

function validarSelectUser() {
  var selectPac = $("#usuario").val();
  if (selectPac == 0) {
    //alert('Seleccionar paciente');
    //Marcar de rojo select
    $("#usuario").css({ border: "3px solid red" });
    $(".input-error-select-user").text("Es necesario seleccionar un usuario!");
    $(".input-error-select-user").css({ color: "red" });
  } else {
    //$('.input-error-select-pac').css({"display":"none"});
    $("#usuario").css({ border: "3px solid green" });
    $(".input-error-select-user").text("");
  }
}

$(document).ready(function () {

  ////////// Sacar el subtotal MOVIMIENTO en tiempo real //////////////
  $("input#cantidad").on("keyup", function () {
    var cantidad = parseFloat($(this).val());
    var pv = parseFloat($("#pv").val());
    var subtotal = cantidad * pv;
    
    //$('#subtotal').attr(attributeName, value);
    $('#subtotal').css({"background-color":"#c2f0c2"});

    $("#subtotal").val(subtotal);
  });

  $("input#descuento").on("keyup", function () {
    var cantidad = parseFloat($("#cantidad").val());
    var pv = parseFloat($("#pv").val());
    var desc = parseFloat($("#descuento").val());
    var subtotal = cantidad * pv - desc;

    $("#subtotal").val(subtotal);
  });

  //-------------------CALCULAR SUBTOTAL INGRESANDO PRECIO CARWAH-----------------------
  $("input#pv").on("keyup", function () {
    var cantidad = parseFloat($("#cantidad").val());
    var pv = parseFloat($("#pv").val());
    var subtotal = cantidad * pv;

    $("#subtotal").val(subtotal);
  });


  ////////////////////////// sacar la edad actual ////////////////////////
  $("input#fecha_nac").on("change", function () {
    var fecha_nac = $(this).val(); //fecha de nac
    parte_fecha = fecha_nac.split("-", 2);
    var anio_nac = parte_fecha[0];
    var mes_nac = parte_fecha[1];

    var hoy = new Date();
    var anio_actual = hoy.getFullYear();
    var mes_actual = hoy.getMonth() + 1;

    var edad = anio_actual - anio_nac;
    if (mes_actual > mes_nac) {
      $("#edad").val(edad);
    } else {
      $("#edad").val(edad - 1);
    }
  });

  $(".btnLimpiarCajasMedida").click(function (e) {
    e.preventDefault();
    $("#idPaciente_fk").val(0);
    $("#esf_der_lejos").val(null);
    $("#esf_izq_lejos").val(0);
    $("#esf_der_cerca").val(null);
    $("#esf_izq_cerca").val(null);
    $("#cilindro_der_lejos").val(null);

    $("#cilindro_izq_lejos").val(null);
    $("#cilindro_der_cerca").val(null);
    $("#cilindro_izq_cerca").val(null);
    $("#eje_der_lejos").val(null);
    $("#eje_izq_lejos").val(null);
    $("#eje_der_cerca").val(null);
    $("#eje_izq_cerca").val(null);
    $("#av_der_lejos").val(null);
    $("#av_izq_lejos").val(null);
    $("#av_der_cerca").val(null);

    $("#av_izq_cerca").val(null);
    $("#dis_pupilar_lejos").val(null);
    $("#dis_pupilar_cerca").val(null);
    $("#observaciones").val(null);
  });

  $("#btnGuardarMedida").click(function (e) {
    var selectPac = $("#idPaciente_fk").val();
    if (selectPac == 0) {
      //alert('Seleccionar paciente');
      //Marcar de rojo select
      $("#idPaciente_fk").css({ border: "3px solid red" });
      $(".input-error-select-pac").text(
        "Es necesario seleccionar un cliente!"
      );
      $(".input-error-select-pac").css({ color: "red" });
    }
  });
});
