
$(document).ready(function () {
  var idMov, opcion;
  opcion = 4;

  tablaMovimiento = $("#tablaCompras").DataTable({

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
      url: "crud_movimientos/crudCompras.php",
      method: "POST", //usamos el metodo POST
      data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
      dataSrc: "",
    },
    columns: [
      { data: "idMov" },
      { data: "fecha" },
      { data: "producto" },
      { data: "idProducto_fk" },
      { data: "movimiento" },
      { data: "idPaciente_fk" },
      { data: "idUsuario_fk" },
      { data: "cantidad" },
      { data: "cu" },
      { data: "pv" },
      { data: "descuento" },
      { data: "subtotal" },
      { data: "observaciones" },
    ],

     //para usar los botones   
     responsive: "true",
     dom: 'Bfrtilp',       
     buttons:[ 
   {
     extend:    'excelHtml5',
     text:      '<i class="fas fa-file-excel"></i> ',
     titleAttr: 'Exportar a Excel',
     className: 'btn btn-success'
   },
   {
     extend:    'pdfHtml5',
     text:      '<i class="fas fa-file-pdf"></i> ',
     titleAttr: 'Exportar a PDF',
     className: 'btn btn-danger'
   },
   {
     extend:    'print',
     text:      '<i class="fa fa-print"></i> ',
     titleAttr: 'Imprimir',
     className: 'btn btn-info'
   },
 ]	        


  });
});
