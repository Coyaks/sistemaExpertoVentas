<?php
session_start();
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '';
$celular = (isset($_POST['celular'])) ? $_POST['celular'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
$idRol_fk = (isset($_POST['idRol_fk'])) ? $_POST['idRol_fk'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idUsuario = (isset($_POST['idUsuario'])) ? $_POST['idUsuario'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO usuario (nombre, apellidos, celular, email, password, idRol_fk) VALUES('$nombre', '$apellidos', '$celular', '$email', '$password', '$idRol_fk') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM usuario ORDER BY idUsuario DESC LIMIT 1"; //enviar al final usuario
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE usuario SET nombre='$nombre', apellidos='$apellidos', celular='$celular', email='$email', password='$password', idRol_fk='$idRol_fk' WHERE idUsuario='$idUsuario' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM usuario WHERE idUsuario='$idUsuario' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        if($_SESSION['idRol_fk']==1){
            $consulta = "DELETE FROM usuario WHERE idUsuario='$idUsuario' ";	
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            echo 1;
            exit;
        }else{
            echo 2;
            exit;
        }     
       	
    case 4:    
        
        if($_SESSION['idRol_fk']==1){
            $consulta = "SELECT * FROM usuario";
        }else{
            $usuarioActual=$_SESSION['idUsuario'];
            $consulta = "SELECT * FROM usuario where idUsuario='$usuarioActual'";
        }
        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC); //retorna una lista con la copia del registr. DB
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final en formato json a AJAX - JS
$conexion=null;