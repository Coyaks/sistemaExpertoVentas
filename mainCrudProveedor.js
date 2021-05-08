$(document).ready(function () {
  var idUsuario, opcion;
  opcion = 4;

  input_hidden_prov=$('#input_hidden_prov').val();
  if(input_hidden_prov==1){
    tablaProveedor = $("#tablaProveedor").DataTable({

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
        url: "crud_usuarios/crudProveedor.php",
        method: "POST", //usamos el metodo POST
        data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
        dataSrc: "",
      },
      columns: [
        { data: "idProveedor" },
        { data: "nombre" },
        { data: "contacto" },
        { data: "celular" },
        { data: "direccion" },
        {
          defaultContent:
            "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarProveedor'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>",
        },
      ],
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });  
  }else{
    tablaProveedor = $("#tablaProveedor").DataTable({

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
        url: "crud_usuarios/crudProveedor.php",
        method: "POST", //usamos el metodo POST
        data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
        dataSrc: "",
      },
      columns: [
        { data: "idProveedor" },
        { data: "nombre" },
        { data: "contacto" },
        { data: "celular" },
        { data: "direccion" },
      ],
    });
  }

  

  var fila; //captura la fila, para editar o eliminar
  //submit para el AÑADIR NEW USER = Alta y Actualización
  $("#formProveedor").submit(function (e) {
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    nombre = $.trim($("#nombre").val());
    contacto = $.trim($("#contacto").val());
    celular = $.trim($("#celular").val());
    direccion = $.trim($("#direccion").val());
    
    $.ajax({
      type: "POST",
      url: "crud_usuarios/crudProveedor.php",
      datatype: "json",
      data: {
        idUsuario: idUsuario,
        nombre: nombre,
        contacto: contacto,
        celular: celular,
        direccion: direccion,
        opcion: opcion,
      },
      success: function (data) {
        tablaProveedor.ajax.reload(null, false);//POTENCIA: Con "null false" evitamos que se recargue toda la page, solo la fila
      },
    });
    $("#modalProveedor").modal("hide");
  });

  //APARECER EL MODAL | Para limpiar los campos antes de dar de Alta una Persona
  $("#btnNuevoProveedor").click(function () {
    opcion = 1; //añadir usuario
    idUsuario = null;
    $("#formProveedor").trigger("reset");
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Añadir nuevo Proveedor");
    $("#modalProveedor").modal("show");
  });

  //Editar
  $(document).on("click", ".btnEditarProveedor", function () {
    opcion = 2; //editar
    fila = $(this).closest("tr");
    idUsuario = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    nombre = fila.find("td:eq(1)").text();
    contacto = fila.find("td:eq(2)").text();
    celular = fila.find("td:eq(3)").text();
    direccion = fila.find("td:eq(4)").text();
    

    $("#nombre").val(nombre);
    $("#contacto").val(contacto);
    $("#celular").val(celular);
    $("#direccion").val(direccion);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Proveedor");
    $("#modalProveedor").modal("show");
  });

  //Borrar
  $(document).on("click", ".btnBorrar", function () {
    fila = $(this);
    idUsuario = parseInt($(this).closest("tr").find("td:eq(0)").text());
    opcion = 3; //eliminar
    var respuesta = confirm(
      "¿Está seguro de borrar el registro " + idUsuario + "?"
    );
    if (respuesta) {
      $.ajax({
        url: "crud_usuarios/crudProveedor.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, idUsuario: idUsuario },
        success: function (dato) {
          if (dato==1) {
            Swal.fire({
              icon: "success",
              title: "Se eliminó el proveedor correctamente!",
            });
            tablaProveedor.row(fila.parents("tr")).remove().draw();
            
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
