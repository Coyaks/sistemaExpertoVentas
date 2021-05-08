<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 4:    
        $consulta = "SELECT *, subtotal-cantidad*cu as ganancia FROM movimiento where movimiento='venta'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC); //retorna una lista con la copia del registr. DB
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final en formato json a AJAX - JS
$conexion=null;