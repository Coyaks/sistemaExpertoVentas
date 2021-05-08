$(document).ready(function () {
  $('#movimiento1').change(function (e) { 
    e.preventDefault();
    var movimiento=$('#movimiento1').val();
    if(movimiento==0){
      Swal.fire({
        icon: 'error',
        title: 'Seleccione una opción',
      })
    }else if(movimiento==1){//ventas
      $('.select_compras').css("display", "none");
      $('.select_ventas').css("display", "block");

    }else if(movimiento==2){//compras

      $('.select_ventas').css("display", "none");
      $('.select_compras').css("display", "block");
    }else if(movimiento==3){//cliente
      $('.select_compras').css("display", "none");
      $('.select_ventas').css("display", "none");
      Swal.fire({
        icon: 'error',
        title: 'En proceso :D',
      })
    }
  });

  
  $('#btnRealizarConsultas').click(function (e) { 
    e.preventDefault();
    opcion_seleccionada = $('input[name="consultaVenta"]:checked').val();
    if(opcion_seleccionada=="option1"){
      alert("Opcion seleccionada 1");

    }else if(opcion_seleccionada=="option2"){
      alert("En proceso");
    }else if(opcion_seleccionada=="option3"){
      $('.producto_estrella').css("display", "block");
    }else if(opcion_seleccionada=="option4"){
      $('.costos_actuales').css("display", "block");
    }else if(opcion_seleccionada=="option5"){
      $('.ingresos_actuales').css("display", "block");
    }else if(opcion_seleccionada=="option6"){
      $('.utilidad_actual').css("display", "block");
    }else if(opcion_seleccionada=="option7"){
      alert("En proceso");
    }else if(opcion_seleccionada=="option8"){
      alert("En proceso");
    }
    
  });
  
});