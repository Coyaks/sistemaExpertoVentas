function ocultarInputsCat() {
  var option_value = $("#categoria").val();
  if (option_value == "agregarCat") {
    //$("#modalCrudProducto").modal('hide');
    $("#modalCategoria").modal("show");

    $(".modal-header-cat").css("background-color", "#00b300");
    $(".modal-header-cat").css("color", "white");
    $(".modal-title-cat").text("Añadir Categoría");
  }
}

$(document).ready(function () {
  $("#cerrar-modal-cat").click(function (e) {
    $("#modalCategoria").modal("hide");
  });
});
