function ocultarInputsCat() {
  var option_value = $("#categoria").val();
  if (option_value == "1") { //montura
    //$(".modal-body-producto").show();
    $(".body-luna").hide();
  }else if(option_value == "2"){//luna
    $(".body-luna").show();
  }
}

$(document).ready(function () {

  var idProducto, opcion;
  opcion = 4;

  //capturar valor de input hidden
  var rol_input=$('#rol_input').val();
  if(rol_input==1){
    tablaProducto = $("#tablaProducto").DataTable({
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
        url: "crud_producto/crudProducto.php",
        method: "POST", //usamos el metodo POST
        data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
        dataSrc: "",
      },
      
      columns: [
        { data: "idProducto" },
        { data: "descripcion" },
        { data: "marca" },
        { data: "idCategoria_fk" },
        { data: "cu" },
        { data: "pv" },
        { data: "entradas" },
        { data: "salidas" },
        { data: "stock" },
        {
          defaultContent:
            "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarProducto'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrarProducto'><i class='material-icons'>delete</i></button></div></div>",
        },
      ],

      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });

  }else{

    tablaProducto = $("#tablaProducto").DataTable({
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
        url: "crud_producto/crudProducto.php",
        method: "POST", //usamos el metodo POST
        data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
        dataSrc: "",
      },
      
      columns: [
        { data: "idProducto" },
        { data: "descripcion" },
        { data: "marca" },
        { data: "idCategoria_fk" },
        { data: "cu" },
        { data: "pv" },
        { data: "entradas" },
        { data: "salidas" },
        { data: "stock" },
      ],
    });

  }
  

  var fila; //captura la fila, para editar o eliminar
  //submit para el AÑADIR NEW USER = Alta y Actualización
  $("#formProducto").submit(function (e) {
    e.preventDefault(); 
    descripcion = $.trim($("#descripcion").val());
    categoria = $.trim($("#categoria").val());
    cu = $.trim($("#cu").val());
    pv = $.trim($("#pv").val());

    marca = $.trim($("#marca").val());

    // entradas = $.trim($("#entradas").val());
    // salidas = $.trim($("#salidas").val());
    // stock = $.trim($("#stock").val());
    
   
    
    $.ajax({
      type: "POST",
      url: "crud_producto/crudProducto.php",
      datatype: "json",
      data: {
        idProducto: idProducto,
        descripcion: descripcion,
        categoria: categoria,
        cu: cu,
        pv: pv,
        marca:marca,
        opcion: opcion,
      },
      success: function (data) {  
        tablaProducto.ajax.reload(null, false);//POTENCIA: Con "null false" evitamos que se recargue toda la page, solo la fila
      },
    });
    $("#modalCrudProducto").modal("hide");
  });

    // ****************** CAPTURAR CATEGORIA Y ENVIAR POR AJAX *¨********************
    $("#formCategoria").submit(function (e) {
      opcion = 5;
      e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
      new_categoria = $.trim($("#new_categoria").val());
      
      $.ajax({
        type: "POST",
        url: "crud_producto/crudProducto.php",
        datatype: "json",
        data: {
          new_categoria: new_categoria,
          opcion: opcion,
        },
        success: function (data) {  
          if(data=6){
            Swal.fire({
              icon: 'success',
              title: 'Se insertó nueva categoría',
            })
          }
          location.reload();
        },
      });
    });
  //FIN CAPTURAR CATEGORIA Y ENVIAR POR AJAX

  //para limpiar los campos antes de dar de Alta una Persona
  $("#btnNuevoProducto").click(function () {
    opcion = 1; //añadir usuario
    idProducto = null;
    $("#formProducto").trigger("reset");
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Añadir nuevo Producto");
    $("#modalCrudProducto").modal("show");
  });

  //Editar
  $(document).on("click", ".btnEditarProducto", function () {
    opcion = 2; //editar
    fila = $(this).closest("tr");
    idProducto = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    descripcion = fila.find("td:eq(1)").text();
    categoria = fila.find("td:eq(3)").text();
    cu = fila.find("td:eq(4)").text();
    pv = fila.find("td:eq(5)").text();
    marca = fila.find("td:eq(2)").text();

    $("#descripcion").val(descripcion);
    $("#categoria").val(categoria);
    $("#cu").val(cu);
    $("#pv").val(pv);
  
    $("#marca").val(marca);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Producto");
    $("#modalCrudProducto").modal("show");
  });

  //Borrar
  $(document).on("click", ".btnBorrarProducto", function () {
    fila = $(this);
    idProducto = parseInt($(this).closest("tr").find("td:eq(0)").text());
    opcion = 3; //eliminar
    var respuesta = confirm(
      "¿Está seguro de borrar el registro " + idProducto + "?"
    );
    if (respuesta) {
      $.ajax({
        url: "crud_producto/crudProducto.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, idProducto: idProducto },
        success: function () {
          tablaProducto.row(fila.parents("tr")).remove().draw();
        },
      });
    }
  });
});
