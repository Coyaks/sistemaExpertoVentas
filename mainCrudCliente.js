//ONCHANGE TIPO PERSONA
function tipoPersona() {
  var tipo_per = $("#tipo_persona").val();
  if (tipo_per == "Natural") {
    $("#labelTipoPer").text("DNI");
    $(".hide-razon-social").hide();
    $(".hide-datos-personales").show();
  } else if (tipo_per == "Juridica") {
    $("#labelTipoPer").text("RUC");
    $(".hide-razon-social").show();
    $(".hide-datos-personales").hide();

    //$('#razon-social').removeClass('.col-lg-8');
    $('#razon-social').addClass('.col-lg-12');
  }
}

$(document).ready(function () {

  $(".btnBuscarDoc2").click(function (e) {
    e.preventDefault();
    //CAPTURAR DATOS DEL WEBSERVICES = ENDPOINT

    var doc=$('#documento').val();
    if(doc!=""){
      var tipo_per = $("#tipo_persona").val();
      if (tipo_per == "Natural") {
        //Capturamos el dni
        var dni=$('#documento').val();
        $.ajax({
          type: "GET",
          url: "https://dniruc.apisperu.com/api/v1/dni/"+dni+"?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNveWFrczE5QGdtYWlsLmNvbSJ9.1NdRT9-w-xvSN0NONmckZLfMLcVixw_7sC30dAW9ALI",
          dataType: "json",
        }).done((data)=>{
          $('#nombre_cli').val(data.nombres);
          $('#apellido_pat').val(data.apellidoPaterno);
          $('#apellido_mat').val(data.apellidoMaterno);
        });
  
      } else if (tipo_per == "Juridica") {
          //Capturamos el RUC
        var ruc=$('#documento').val();
        $.ajax({
          type: "GET",
          url: "https://dniruc.apisperu.com/api/v1/ruc/"+ruc+"?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNveWFrczE5QGdtYWlsLmNvbSJ9.1NdRT9-w-xvSN0NONmckZLfMLcVixw_7sC30dAW9ALI",
          dataType: "json",
        }).done((data) => {
          $('#razon_social').val(data.razonSocial);
          $('#domicilio').val(data.direccion);
         
        });
  
      }else{
        alert("Selecciona el tipo de persona");
      }

    }else{
      alert("Es necesario ingresar el campo documento!");
    }
   
  });

  var idPaciente, opcion;
  opcion = 4;

  tablaCliente = $("#tablaCliente").DataTable({
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
      url: "crud_pacientes/crudCliente.php",
      method: "POST", //usamos el metodo POST
      data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
      dataSrc: "",
    },
    columns: [
      { data: "idPaciente" },
      { data: "fecha_atencion" },
      { data: "tipo" },
      { data: "documento" },
      { data: "fecha_nac" },
      { data: "nombre" },
      { data: "apellido_pat" },
      { data: "apellido_mat" },
      { data: "edad" },
      { data: "razon_social" },
      { data: "celular" },
      { data: "domicilio" },
      { data: "deuda" },
     
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarPaciente'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrarPaciente'><i class='material-icons'>delete</i></button></div></div>",
      },
    ],
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],

     //PERSONALIZAR ANCHO  DE COLUMNAS Y FILAS DE DATATABLES
    ///// ADICIANAR SCROLL VERTICAL Y HORIZONTAL
    scrollY: "450px",
    scrollX: true,
    scrollCollapse: true,
    paging: false,
    columnDefs: [{ width: 200, targets: 0 }],
    fixedColumns: true,
  });

  var fila; //captura la fila, para editar o eliminar
  //submit para el AÑADIR NEW USER = Alta y Actualización
  $("#formPacientes").submit(function (e) {
    e.preventDefault();

    fecha_atencion = $.trim($("#fecha_atencion").val());
    tipo = $.trim($("#tipo_persona").val());
    documento = $.trim($("#documento").val());
    fecha_nac = $.trim($("#fecha_nac").val());
    nombre = $.trim($("#nombre_cli").val());
    apellido_pat = $.trim($("#apellido_pat").val());

    apellido_mat = $.trim($("#apellido_mat").val());

    placa = $.trim($("#placa").val());
    kilometraje = $.trim($("#kilometraje").val());

    edad = $.trim($("#edad").val());
    razon_social = $.trim($("#razon_social").val());
    celular = $.trim($("#celular").val());
    domicilio = $.trim($("#domicilio").val());
    email = $.trim($("#email").val());
    ocupacion = $.trim($("#ocupacion").val());
    deuda = $.trim($("#deuda").val());

    $.ajax({
      type: "POST",
      url: "crud_pacientes/crudCliente.php",
      datatype: "json",
      data: {
        idPaciente: idPaciente,
        fecha_atencion: fecha_atencion,
        tipo: tipo,
        documento: documento,
        fecha_nac: fecha_nac,
        nombre: nombre,
        apellido_pat: apellido_pat,
        apellido_mat: apellido_mat,

        placa: placa,
        kilometraje: kilometraje,
        edad: edad,
        razon_social: razon_social,
        celular: celular,
        domicilio: domicilio,
        email: email,
        ocupacion: ocupacion,
        deuda: deuda,
        opcion: opcion,
      },
      success: function (data) {
        if (data == 3) {
          Swal.fire({
            icon: "success",
            title: "Cliente registrado correctamente!",
          });
        } else if (data == 4) {
          Swal.fire({
            icon: "success",
            title: "Cliente actualizado correctamente!",
          });
        } else if (data == 5) {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Error al registrar",
          });
        }
        tablaCliente.ajax.reload(null, false);
      },
    });
    $("#modalPaciente").modal("hide");
  });

  //para limpiar los campos antes de dar de Alta una Persona
  $("#btnNuevoPaciente").click(function () {
    opcion = 1; //añadir usuario
    idPaciente = null;
    $("#formPacientes").trigger("reset");
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Añadir nuevo Cliente");
    $("#modalPaciente").modal("show");
  });

  //Editar
  $(document).on("click", ".btnEditarPaciente", function () {
    opcion = 2; //editar
    fila = $(this).closest("tr");

    idPaciente = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    fecha_atencion = fila.find("td:eq(1)").text();
    tipo = fila.find("td:eq(2)").text();
    documento = fila.find("td:eq(3)").text();
    fecha_nac = fila.find("td:eq(4)").text();
    nombre = fila.find("td:eq(5)").text();
    apellido_pat = fila.find("td:eq(6)").text();

    apellido_mat = fila.find("td:eq(7)").text();

    edad = fila.find("td:eq(8)").text();
    razon_social = fila.find("td:eq(9)").text();
    celular = fila.find("td:eq(10)").text();
    domicilio = fila.find("td:eq(11)").text();
    deuda = fila.find("td:eq(12)").text();

    $("#fecha_atencion").val(fecha_atencion);
    $("#tipo_persona").val(tipo);
    $("#documento").val(documento);
    $("#fecha_nac").val(fecha_nac);
    $("#nombre_cli").val(nombre);
    $("#apellido_pat").val(apellido_pat);
    $("#apellido_mat").val(apellido_mat);
    $("#edad").val(edad);
    $("#razon_social").val(razon_social);
    $("#celular").val(celular);
    $("#domicilio").val(domicilio);
    $("#deuda").val(deuda);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Cliente");
    $("#modalPaciente").modal("show");
  });

  //Borrar
  $(document).on("click", ".btnBorrarPaciente", function () {
    fila = $(this);
    idPaciente = parseInt($(this).closest("tr").find("td:eq(0)").text());
    opcion = 3; //eliminar
    var respuesta = confirm(
      "¿Está seguro de borrar el registro " + idPaciente + "?"
    );
    if (respuesta) {
      $.ajax({
        url: "crud_pacientes/crudCliente.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, idPaciente: idPaciente },
        success: function (dato) {
          if (dato == 1) {
            Swal.fire({
              icon: "success",
              title: "Se eliminó el cliente correctamente!",
            });
            tablaCliente.row(fila.parents("tr")).remove().draw();
          } else if (dato == 2) {
            Swal.fire({
              icon: "error",
              title: "Ud. no es administrador para eliminar",
            });
          }
        },
      });
    }
  });
});
