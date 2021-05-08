<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : '';
$cu = (isset($_POST['cu'])) ? $_POST['cu'] : '';
$pv = (isset($_POST['pv'])) ? $_POST['pv'] : '';
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';

// $entradas = (isset($_POST['entradas'])) ? $_POST['entradas'] : '';
// $salidas = (isset($_POST['salidas'])) ? $_POST['salidas'] : '';
// $stock = (isset($_POST['stock'])) ? $_POST['stock'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idProducto = (isset($_POST['idProducto'])) ? $_POST['idProducto'] : '';

$new_categoria = (isset($_POST['new_categoria'])) ? $_POST['new_categoria'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO producto (descripcion, idCategoria_fk, cu, pv, marca) VALUES('$descripcion', '$categoria', '$cu', '$pv', '$marca')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM producto ORDER BY idProducto DESC LIMIT 1"; //enviar al final producto
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE producto SET descripcion='$descripcion', idCategoria_fk='$categoria', cu='$cu', pv='$pv', marca='$marca' WHERE idProducto='$idProducto' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();       
        
        $consulta = "SELECT * FROM producto WHERE idProducto='$idProducto' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM producto WHERE idProducto='$idProducto' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM producto";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC); //retorna una lista con la copia del registr. DB
        break;

    case 5:
        $consulta = "INSERT INTO categoria (nombre) VALUES('$new_categoria')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        echo 6;
        exit;
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final en formato json a AJAX - JS
$conexion=null;