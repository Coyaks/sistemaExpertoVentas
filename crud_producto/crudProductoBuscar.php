<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 4:    
        $consulta = "SELECT idProducto,descripcion, cu, pv, stock from producto"; 

        // if($_SESSION['idRol_fk']==1){       
        //     $consulta = "SELECT idProducto,descripcion, cu, pv, stock from producto"; 
        // }else{
        //     $consulta = "SELECT idProducto,descripcion, pv, stock from producto";
        // }
        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC); //retorna una lista con la copia del registr. DB
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final en formato json a AJAX - JS
$conexion=null;