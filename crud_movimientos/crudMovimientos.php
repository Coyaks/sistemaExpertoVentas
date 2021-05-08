<?php

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion1 = $objeto->Conectar();

$fecha_hora = (isset($_POST['fecha_hora'])) ? $_POST['fecha_hora'] : '';
$idProducto_fk = (isset($_POST['idProducto_fk'])) ? $_POST['idProducto_fk'] : '';
$idProveedor_fk = (isset($_POST['idProveedor_fk'])) ? $_POST['idProveedor_fk'] : '';
$producto = (isset($_POST['producto'])) ? $_POST['producto'] : '';

$movimiento = (isset($_POST['movimiento'])) ? $_POST['movimiento'] : '';
$paciente = (isset($_POST['paciente'])) ? $_POST['paciente'] : '';
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';


$cu = (isset($_POST['cu'])) ? $_POST['cu'] : '';
$pv = (isset($_POST['pv'])) ? $_POST['pv'] : '';
$descuento = (isset($_POST['descuento'])) ? $_POST['descuento'] : '';

$subtotal = (isset($_POST['subtotal'])) ? $_POST['subtotal'] : '';
$observaciones = (isset($_POST['observaciones'])) ? $_POST['observaciones'] : '';

$tipo_pago = (isset($_POST['tipo_pago'])) ? $_POST['tipo_pago'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idMov = (isset($_POST['idMov'])) ? $_POST['idMov'] : '';


switch ($opcion) {
    case 1:

        //OPERACION INSERTAR
        if($movimiento=='compra'){
            $consulta = "INSERT INTO movimiento (fecha, producto, movimiento, idUsuario_fk, cantidad, cu, pv, descuento, subtotal, observaciones, idProducto_fk, idProveedor_fk,tipo_pago) VALUES ('$fecha_hora', '$producto', '$movimiento','$usuario','$cantidad', '$cu', '$pv','$descuento', '$subtotal', '$observaciones','$idProducto_fk','$idProveedor_fk','$tipo_pago') ";
        }else{//venta
            // if($_SESSION['idRol_fk']==1){
                $consulta = "INSERT INTO movimiento (fecha, producto, movimiento, idPaciente_fk, idUsuario_fk, cantidad, cu, pv, descuento, subtotal, observaciones, idProducto_fk,tipo_pago) VALUES ('$fecha_hora', '$producto', '$movimiento', '$paciente','$usuario','$cantidad', '$cu', '$pv','$descuento', '$subtotal', '$observaciones','$idProducto_fk','$tipo_pago') ";

            // }else{
            //     $consulta = "INSERT INTO movimiento (fecha, producto, movimiento, idPaciente_fk, idUsuario_fk, cantidad,pv, descuento, subtotal, observaciones, idProducto_fk,tipo_pago) VALUES ('$fecha_hora', '$producto', '$movimiento', '$paciente','$usuario','$cantidad','$pv','$descuento', '$subtotal', '$observaciones','$idProducto_fk','$tipo_pago') ";
            // }
        }
        
        $resultado = $conexion1->prepare($consulta);
        if($resultado->execute()){
            
            $consulta = "SELECT * FROM movimiento ORDER BY idMov DESC LIMIT 1"; //enviar al final movimiento
            $resultado = $conexion1->prepare($consulta);
            $resultado->execute();
    
            //CAPTURAR ENTRADA Y SALIDA ACTUAL
            $query = "SELECT * from producto where idProducto='$idProducto_fk'";
            $rta = mysqli_query($conexion, $query);
    
            $entradaSalidaActual = 0;
            if ($fila = mysqli_fetch_assoc($rta)) {
                if ($movimiento == "compra") {
                    $salidaEntrada = "entradas";
                    $entradaSalidaActual = $fila['entradas'];
                } else if ($movimiento == "venta") {
                    $salidaEntrada = "salidas";
                    $entradaSalidaActual = $fila['salidas'];
                }
            }
    
            $stockActual = $entradaSalidaActual + $cantidad;
            //Consulta para cargar movimiento a la tabla producto
            $consulta = "UPDATE producto set $salidaEntrada='$stockActual' where idProducto='$idProducto_fk' ";
            $resultado = $conexion1->prepare($consulta);
            $resultado->execute();
    
            //OPERACION PARA SACAR EL STOCK ACTUAL
            $consulta = "UPDATE producto set stock=entradas-salidas;";
            $resultado = $conexion1->prepare($consulta);
            $resultado->execute();
    
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            
        }else{
            echo 11;
            exit;
        }

        break;
    case 3:
        $consulta = "DELETE FROM movimiento WHERE idMov='$idMov' ";
        $resultado = $conexion1->prepare($consulta);
        $resultado->execute();
        break;
    case 4:
        $consulta = "SELECT * FROM movimiento";
        $resultado = $conexion1->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC); //retorna una lista con la copia del registr. DB
        break;

    case 5:
        $consulta = "DELETE FROM movimiento";
        $resultado = $conexion1->prepare($consulta);
        $resultado->execute();
        echo 5;
        exit;
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final en formato json a AJAX - JS
$conexion1 = null;
