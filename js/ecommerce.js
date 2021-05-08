$(document).ready(function () {
    //Abrir dropdown al agregar carritoooooooooo
    var ruta_img="admin/crud_producto/images/";
    $.ajax({
        type: "post",
        url: "ajax/leerCarrito.php",
        dataType: "json",
        success: function (response) {
            llenaCarrito(response);
        }
    });

    //llenar tbody de verCarrito
    $.ajax({
        type: "post",
        url: "ajax/leerCarrito.php",
        dataType: "json",
        success: function (response) {
            llenarTablaCarrito(response);  
        }
    });

    //EDICIÓN DE CARRITO DE COMPRA
    function llenarTablaCarrito(response){
        $("#tablaCarrito tbody").text(""); 
        var TOTAL=0; 
        response.forEach(element => {
            var precio=parseFloat (element['precio']); 
            //alert(precio);
            var totalProd=element['cantidad']*precio;
            TOTAL+=totalProd;
            $("#tablaCarrito tbody").append(
                `
                <tr>
                    <td><img src="${ruta_img+element['img']}" class="img-size-50"/></td>
                    <td>${element['nombre']}</td>
                    <td>
                        ${element['cantidad']}
                        <button type="button" class="btn-xs btn-primary mas"
                        data-id="${element['id']}"
                        data-tipo="mas">+</button>

                        <button type="button" class="btn-xs btn-danger menos"
                        data-id="${element['id']}"
                        data-tipo="menos">-</button>
                        
                    </td>
                    <td>S/ ${precio.toFixed(2)}</td>
                    <td>S/ ${totalProd.toFixed(2)}</td>
                    <td><i class="fa fa-trash text-danger borrarProducto"                         data-id="${element['id']}"
                    ></i></td>
                </tr>
                `
            );
        });

        $("#tablaCarrito tbody").append(
            `
            <tr>
                <td colspan="4" class="text-right"><strong>Total:</strong></td>
                <td>S/ ${TOTAL.toFixed(2)}</td>
                <td></td>
            </tr>
            `
        );
    }
    //snippets aumentar-disminuir cantidad
    $(document).on("click", ".mas, .menos", function(e){
        e.preventDefault();
        var id=$(this).data('id');
        var tipo=$(this).data('tipo');
        $.ajax({
            type: "post",
            url: "ajax/cambiaCantidadProductos.php",
            data: {"id":id, "tipo": tipo},
            dataType: "json",
            success: function (response) {
                llenarTablaCarrito(response);
                llenaCarrito(response);
            }
        });
    });

    $(document).on("click", ".borrarProducto", function(e){
        e.preventDefault();
        var id=$(this).data('id');
        $.ajax({
            type: "post",
            url: "ajax/borrarProductoCarrito.php",
            data: {"id":id},
            dataType: "json",
            success: function (response) {
                llenarTablaCarrito(response);
                llenaCarrito(response);
            }
        });
    });

    //1: //////////////////////// Agregar carrito //////////////////////// 
    $('#btnAgregarCarrito').click(function (e) { 
        e.preventDefault();
        //obtenemos datos del producto
        var id=$(this).data('id');
        var nombre=$(this).data('nombre');
        var img=$(this).data('img');
        var cantidad=$('#cantidadProducto').val();
        var precio=$(this).data('precio');  //Esta llegando el precio
        //alert(precio);
        //guardar los datos en una COOKIE
        $.ajax({
            type: "post",
            url: "ajax/agregarCarrito.php",
            data: {"id":id, "nombre": nombre, "img": img, "cantidad": cantidad, "precio": precio},
            dataType: "json",
            success: function (response) {//el response está devolviendo el precio correctamente
                // var a=[1,2,3,4,5];
                // console.log(a);
                // console.log(response);
                //alert();
                llenaCarrito(response);
                //EFECTO DE PARPADEO DE NUMERACION DE CARRITO
                $('#badgeProducto').hide(500).show(500).hide(500).show(500).hide(500).show(500);
                //Al hacer click a agregar carrito, abrir productos
                $('#iconoCarrito').click();
            }
        });
        
    });
    function llenaCarrito(response){
        var cantidad=Object.keys(response).length;
        if(cantidad>0){
            $('#badgeProducto').text(cantidad);
        }else{
            $('#badgeProducto').text("");
        }
        
        $('#listaCarrito').text("");
        response.forEach(element => {
            //var rutaImg="admin/crud_producto/images/";
            $("#listaCarrito").append(
                
                `
                <a href="index.php?modulo=detalleproducto&id=${element['id']}" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="${ruta_img+element['img']}" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                            ${element['nombre']}
                                <span class="float-right text-sm text-primary"><i class="fas fa-eye"></i></span>
                            </h3>
                            <p class="text-sm">Cantidad ${element['cantidad']}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                `
            );
        });
        $("#listaCarrito").append(
            `
            <a href="index.php?modulo=carrito" class="dropdown-item dropdown-footer text-primary">
            Ver carrito <i class="fa fa-cart-plus"></i>
            </a>

            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer text-danger" id="borrarCarrito">
            Borrar carrito <i class="fa fa-trash"></i>
            </a>

            `
        );
    }

    $(document).on("click","#borrarCarrito", function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "ajax/borrarCarrito.php",
            dataType: "json",
            success: function (response) {
                llenaCarrito(response);
            }
        });
        
    });
    // ======== Datos de recepción ================= 
    var nombreRec=$('#nombreRec').val();
    var emailRec=$('#emailRec').val();
    var direccionRec=$('#direccionRec').val();
      
    $('#jalar').click(function (e) { 
        var nombreCli=$('#nombreCli').val();
        var emailCli=$('#emailCli').val();
        var direccionCli=$('#direccionCli').val();
        if($(this).prop('checked')==true){
            $('#nombreRec').val(nombreCli);
            $('#emailRec').val(emailCli);
            $('#direccionRec').val(direccionCli);
        }else{
            $('#nombreRec').val(nombreRec);
            $('#emailRec').val(emailRec);
            $('#direccionRec').val(direccionRec);

        }
    
        
    });
});