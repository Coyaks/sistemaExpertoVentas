$(document).ready(function () {
  var idUsuario, opcion;
  opcion = 4;

  tablaUsuarios = $("#tablaUsuario").DataTable({

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
      url: "crud_usuarios/crudUser.php",
      method: "POST", //usamos el metodo POST
      data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
      dataSrc: "",
    },
    columns: [
      { data: "idUsuario" },
      { data: "nombre" },
      { data: "apellidos" },
      { data: "celular" },
      { data: "email" },
      { data: "password" },
      { data: "idRol_fk" },
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar '><i class='material-icons icon-editarUser'>edit</i></button><button class='btn btn-danger btn-sm btnBorrarUser'><i class='material-icons icon-delete-user'>delete</i></button></div></div>",
      },
    ],
    //Botones para exportar
    dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
  });

  var fila; //captura la fila, para editar o eliminar
  //submit para el AÑADIR NEW USER = Alta y Actualización
  $("#formUsuarios").submit(function (e) {
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    nombre = $.trim($("#nombre").val());
    apellidos = $.trim($("#apellidos").val());
    celular = $.trim($("#celular").val());
    email = $.trim($("#email").val());
    password = $.trim($("#password").val());
    idRol_fk = $.trim($("#rol").val());
    
    $.ajax({
      type: "POST",
      url: "crud_usuarios/crudUser.php",
      datatype: "json",
      data: {
        idUsuario: idUsuario,
        nombre: nombre,
        apellidos: apellidos,
        celular: celular,
        email: email,
        password: password,
        idRol_fk: idRol_fk,
        opcion: opcion,
      },
      success: function (data) {
        tablaUsuarios.ajax.reload(null, false);//POTENCIA: Con "null false" evitamos que se recargue toda la page, solo la fila
      },
    });
    $("#modalCRUD").modal("hide");
  });

  //APARECER EL MODAL | Para limpiar los campos antes de dar de Alta una Persona
  $("#btnNuevo").click(function () {
    opcion = 1; //añadir usuario
    idUsuario = null;
    $("#formUsuarios").trigger("reset");
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Añadir nuevo usuario");
    $("#modalCRUD").modal("show");
  });

  //Editar
  $(document).on("click", ".btnEditar", function () {
    opcion = 2; //editar
    fila = $(this).closest("tr");
    idUsuario = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    nombre = fila.find("td:eq(1)").text();
    apellidos = fila.find("td:eq(2)").text();
    celular = fila.find("td:eq(3)").text();
    email = fila.find("td:eq(4)").text();
    password = fila.find("td:eq(5)").text();
    idRol_fk = fila.find("td:eq(6)").text();

    $("#nombre").val(nombre);
    $("#apellidos").val(apellidos);
    $("#celular").val(celular);
    $("#email").val(email);
    $("#password").val(password);
    $("#rol").val(idRol_fk);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Usuario");
    $("#modalCRUD").modal("show");
  });

  //Borrar
  $(document).on("click", ".btnBorrarUser", function () {
    fila = $(this);
    idUsuario = parseInt($(this).closest("tr").find("td:eq(0)").text());
    opcion = 3; //eliminar
    var respuesta = confirm(
      "¿Está seguro de borrar el registro " + idUsuario + "?"
    );
    if (respuesta) {
      $.ajax({
        url: "crud_usuarios/crudUser.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, idUsuario: idUsuario },
        success: function (dato) {
          if (dato==1) {
            Swal.fire({
              icon: "success",
              title: "Se eliminó el usuario correctamente!",
            });
            tablaUsuarios.row(fila.parents("tr")).remove().draw();
            
          } else if(dato==2) {
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
