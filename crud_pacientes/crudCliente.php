<?php
session_start();
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$fecha_atencion = (isset($_POST['fecha_atencion'])) ? $_POST['fecha_atencion'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$documento = (isset($_POST['documento'])) ? $_POST['documento'] : '';
$fecha_nac = (isset($_POST['fecha_nac'])) ? $_POST['fecha_nac'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$apellido_pat = (isset($_POST['apellido_pat'])) ? $_POST['apellido_pat'] : '';
$apellido_mat = (isset($_POST['apellido_mat'])) ? $_POST['apellido_mat'] : '';
$edad = (isset($_POST['edad'])) ? $_POST['edad'] : '';

$razon_social = (isset($_POST['razon_social'])) ? $_POST['razon_social'] : '';
$celular = (isset($_POST['celular'])) ? $_POST['celular'] : '';

$domicilio = (isset($_POST['domicilio'])) ? $_POST['domicilio'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$ocupacion = (isset($_POST['ocupacion'])) ? $_POST['ocupacion'] : '';
$deuda = (isset($_POST['deuda'])) ? $_POST['deuda'] : '';

// $placa = (isset($_POST['placa'])) ? $_POST['placa'] : '';
// $kilometraje = (isset($_POST['kilometraje'])) ? $_POST['kilometraje'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idPaciente = (isset($_POST['idPaciente'])) ? $_POST['idPaciente'] : '';
switch ($opcion) {
    case 1:
        if ($tipo == "Natural") {
            $consulta = "INSERT INTO cliente(fecha_atencion, tipo, documento, fecha_nac, nombre, apellido_pat, apellido_mat,edad, razon_social, celular,domicilio, deuda) VALUES('$fecha_atencion', '$tipo', '$documento', '$fecha_nac', '$nombre', '$apellido_pat', '$apellido_mat','$edad','$razon_social', '$celular', '$domicilio', '$deuda') ";
        }else{
            //Es Juridica
            $consulta = "INSERT INTO cliente(fecha_atencion, tipo, documento, nombre, apellido_pat, apellido_mat, razon_social, celular, domicilio, deuda) VALUES ('$fecha_atencion', '$tipo', '$documento','$nombre', '$apellido_pat', '$apellido_mat','$razon_social','$celular','$domicilio', '$deuda')";
        }

        $resultado = $conexion->prepare($consulta);

        if ($resultado->execute()) {
            echo 3;
        } else {
            echo 5;
        }

        $consulta = "SELECT * FROM cliente ORDER BY idPaciente DESC LIMIT 1"; //enviar al final usuario
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        exit;
    case 2:
        if($tipo == "Natural"){
            $consulta = "UPDATE cliente SET fecha_atencion='$fecha_atencion', tipo='$tipo', documento='$documento', fecha_nac='$fecha_nac', nombre='$nombre', apellido_pat='$apellido_pat', apellido_mat='$apellido_mat', edad='$edad', celular='$celular', domicilio='$domicilio', deuda='$deuda' WHERE idPaciente='$idPaciente' ";

        }else{
            //Es Juridica
            $consulta = "UPDATE cliente SET fecha_atencion='$fecha_atencion', tipo='$tipo', documento='$documento', nombre='$nombre', apellido_pat='$apellido_pat',apellido_mat='$apellido_mat',edad='$edad', razon_social='$razon_social', domicilio='$domicilio', deuda='$deuda' WHERE idPaciente='$idPaciente' ";
        }
        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM cliente WHERE idPaciente='$idPaciente' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        echo 4;
        exit;
    case 3:
        if ($_SESSION['idRol_fk'] == 1) {
            $consulta = "DELETE FROM cliente WHERE idPaciente='$idPaciente' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            echo 1;
            exit;
        } else {
            echo 2;
            exit;
        }

    case 4:

        $consulta = "SELECT * FROM cliente";
        // $consulta = "SELECT idPaciente,fecha_atencion,tipo,documento,fecha_nac,	nombre,apellido_pat,apellido_mat,placa,kilometraje,edad,razon_social,celular,domicilio,deuda FROM paciente";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC); //retorna una lista con la copia del registr. DB
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final en formato json a AJAX - JS
$conexion = null;
