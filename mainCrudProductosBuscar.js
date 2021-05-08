
$(document).ready(function () {
  var idProducto;
  var opcion = 4;

  var buscar_prod= $('#buscar-prod-admin').val();
  if(buscar_prod==1){
    tablaProductoBuscar = $("#tablaProductoBuscar").DataTable({
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
        url: "crud_producto/crudProductoBuscar.php",
        method: "POST", //usamos el metodo POST
        data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
        dataSrc: "",
      },
      columns: [
        { data: "idProducto" },
        { data: "descripcion" },
        { data: "cu" },
        { data: "pv" },
        { data: "stock" },
        {
          defaultContent:
            "<div class='text-center'><div class='btn-group'><button type='button' class='btnAgregar btn btn-warning'><i class='fas fa-plus icon-agregar'></i></button></div></div>",
        },
      ],
    });
  
  }else{


    tablaProductoBuscar = $("#tablaProductoBuscar").DataTable({
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
        url: "crud_producto/crudProductoBuscar.php",
        method: "POST", //usamos el metodo POST
        data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
        dataSrc: "",
      },
      columns: [
        { data: "idProducto" },
        { data: "descripcion" },
        { data: "pv" },
        { data: "stock" },
        {
          defaultContent:
            "<div class='text-center'><div class='btn-group'><button type='button' class='btnAgregar btn btn-warning'><i class='fas fa-plus icon-agregar'></i></button></div></div>",
        },
      ],
    });
  
  }

 
  //para limpiar los campos antes de dar de Alta una Persona
  // $("#btnNuevoProducto").click(function () {
  //   opcion = 1; //añadir usuario
  //   idProducto = null;
  //   $("#formProducto").trigger("reset");
  //   $(".modal-header").css("background-color", "#17a2b8");
  //   $(".modal-header").css("color", "white");
  //   $(".modal-title").text("Añadir nuevo Producto");
  //   $("#modalCrudProducto").modal("show");
  // });

    //  ************* PASAR DATOS DE TABLA MODAL A INPUTS *************
    $(".table tbody").on("click", ".btnAgregar", function () {
      var fila = $(this).closest("tr");
  
      var idProducto = parseInt(fila.find("td:eq(0)").text());
      var producto = fila.find("td:eq(1)").text();
      var cu = parseFloat(fila.find("td:eq(2)").text());
      var pv = parseFloat(fila.find("td:eq(3)").text());
  
      //asignación en los id de los inputs
      $("#idProducto_fk").val(idProducto);
      $("#producto").val(producto);
      $("#cu").val(cu);
      $("#pv").val(pv);

      $('#cantidad').val(null);
      $('#subtotal').val(null);

      $('#idProducto_fk,#producto,#cu,#pv').css({"background-color":"#c2f0c2"});

      $("#modalBuscarCodigo").modal("hide");
    });


});
