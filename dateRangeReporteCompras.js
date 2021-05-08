$(function () {
  //Formato de date ventana en español
  $("#start_date").datepicker({
    closeText: "Cerrar",
    prevText: "<Ant",
    nextText: "Sig>",
    currentText: "Hoy",
    monthNames: [
      "Enero",
      "Febrero",
      "Marzo",
      "Abril",
      "Mayo",
      "Junio",
      "Julio",
      "Agosto",
      "Septiembre",
      "Octubre",
      "Noviembre",
      "Diciembre",
    ],
    monthNamesShort: [
      "Ene",
      "Feb",
      "Mar",
      "Abr",
      "May",
      "Jun",
      "Jul",
      "Ago",
      "Sep",
      "Oct",
      "Nov",
      "Dic",
    ],
    dayNames: [
      "Domingo",
      "Lunes",
      "Martes",
      "Miércoles",
      "Jueves",
      "Viernes",
      "Sábado",
    ],
    dayNamesShort: ["Dom", "Lun", "Mar", "Mié", "Juv", "Vie", "Sáb"],
    dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá"],
    weekHeader: "Sm",
    dateFormat: "dd/mm/yy",
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: "",
    dateFormat: "yy-mm-dd",
  });

  $("#end_date").datepicker({
    closeText: "Cerrar",
    prevText: "<Ant",
    nextText: "Sig>",
    currentText: "Hoy",
    monthNames: [
      "Enero",
      "Febrero",
      "Marzo",
      "Abril",
      "Mayo",
      "Junio",
      "Julio",
      "Agosto",
      "Septiembre",
      "Octubre",
      "Noviembre",
      "Diciembre",
    ],
    monthNamesShort: [
      "Ene",
      "Feb",
      "Mar",
      "Abr",
      "May",
      "Jun",
      "Jul",
      "Ago",
      "Sep",
      "Oct",
      "Nov",
      "Dic",
    ],
    dayNames: [
      "Domingo",
      "Lunes",
      "Martes",
      "Miércoles",
      "Jueves",
      "Viernes",
      "Sábado",
    ],
    dayNamesShort: ["Dom", "Lun", "Mar", "Mié", "Juv", "Vie", "Sáb"],
    dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá"],
    weekHeader: "Sm",
    dateFormat: "dd/mm/yy",
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: "",
    dateFormat: "yy-mm-dd",
  });
});

///////////////////////////  EL MÁS EXTENSO  /////////////////////////// -->

// Fetch tablaCompra
function fetch2(start_date, end_date) {
  $.ajax({
    url: "filtroFechasCompra.php",
    type: "POST",
    data: {
      start_date: start_date,
      end_date: end_date,
    },
    dataType: "json",
    success: function (data) {
      // Datatables
      var i = "1";
      /////////////RTA JSON//////////////
      $("#tablaCompra").DataTable({
        language: {
          lengthMenu: "Mostrar _MENU_ registros",
          zeroRecords: "No se encontraron resultados",
          info:
            "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          infoEmpty:
            "Mostrando registros del 0 al 0 de un total de 0 registros",
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
        data: data,
        // buttons CSV, EXCEL, PDF
        dom:
          "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        // Fin buttons CSV, EXCEL, PDF
        buttons: ["copy", "csv", "excel", "pdf", "print"],
        // responsive
        responsive: true,
        
        //////////////  IMPORTANTE: LAS COLUMNAS
        columns: [
          {
            data: "idMov",
          },
          {
            data: "fecha",
          },
          {
            data: "producto",
          },
          {
            data: "movimiento",
          },
          {
            data: "proveedor",
          },
          {
            data: "usuario",
          },
          {
            data: "cantidad",
          },
          {
            data: "cu",
          },
          {
            data: "pv",
          },
          {
            data: "descuento",
          },
          {
            data: "subtotal",
          },
          {
            data: "observaciones",
          },
          {
            data: "idProducto_fk",
          },
          {
            data: "tipo_pago",
          },
        ],
    
        ///// ADICIANAR SCROLL VERTICAL Y HORIZONTAL
        scrollY: "350px",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        columnDefs: [{ width: 200, targets: 0 }],
        fixedColumns: true,
      }); 

      /////////////FIN RTA JSON//////////////
    },
  });

}
fetch2();

// """" BOTON Filter """"""""

$(document).on("click", "#filterCompra", function (e) {
  e.preventDefault();

  var start_date = $("#start_date").val();
  var end_date = $("#end_date").val();

  if (start_date == "" || end_date == "") {
    alert("Ambas fechas requeridas 2");
  } else {
    $("#tablaCompra").DataTable().destroy();
    fetch2(start_date, end_date);
  }
});

// """" BOTON Reset """"

$(document).on("click", "#resetCompra", function (e) {
  e.preventDefault();

  $("#start_date").val(""); // empty value
  $("#end_date").val("");

  $("#tablaCompra").DataTable().destroy();
  fetch2();
});
