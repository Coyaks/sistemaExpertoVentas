<?php
session_start();
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$contacto = (isset($_POST['contacto'])) ? $_POST['contacto'] : '';
$celular = (isset($_POST['celular'])) ? $_POST['celular'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idUsuario = (isset($_POST['idUsuario'])) ? $_POST['idUsuario'] : '';


switch ($opcion) {
    case 1:
        $consulta = "INSERT INTO proveedor (nombre, contacto, celular, direccion) VALUES('$nombre', '$contacto', '$celular', '$direccion') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM proveedor ORDER BY idProveedor DESC LIMIT 1"; //enviar al final usuario
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $consulta = "UPDATE proveedor SET nombre='$nombre', contacto='$contacto', celular='$celular', direccion='$direccion' WHERE idProveedor='$idUsuario' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM proveedor WHERE idProveedor='$idUsuario' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        if ($_SESSION['idRol_fk'] == 1) {
            $consulta = "DELETE FROM proveedor WHERE idProveedor='$idUsuario' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            echo 1;
            exit;
        } else {
            echo 2;
            exit;
        }

    case 4:

        $consulta = "SELECT * FROM proveedor";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC); //retorna una lista con la copia del registr. DB
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final en formato json a AJAX - JS
$conexion = null;
