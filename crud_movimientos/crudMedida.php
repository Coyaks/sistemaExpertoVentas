<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion1 = $objeto->Conectar();

$idPaciente_fk = (isset($_POST['idPaciente_fk'])) ? $_POST['idPaciente_fk'] : '';
$esf_der_lejos = (isset($_POST['esf_der_lejos'])) ? $_POST['esf_der_lejos'] : '';
$esf_izq_lejos = (isset($_POST['esf_izq_lejos'])) ? $_POST['esf_izq_lejos'] : '';
$esf_der_cerca = (isset($_POST['esf_der_cerca'])) ? $_POST['esf_der_cerca'] : '';
$esf_izq_cerca = (isset($_POST['esf_izq_cerca'])) ? $_POST['esf_izq_cerca'] : '';

$cilindro_der_lejos = (isset($_POST['cilindro_der_lejos'])) ? $_POST['cilindro_der_lejos'] : '';
$cilindro_izq_lejos = (isset($_POST['cilindro_izq_lejos'])) ? $_POST['cilindro_izq_lejos'] : '';
$cilindro_der_cerca = (isset($_POST['cilindro_der_cerca'])) ? $_POST['cilindro_der_cerca'] : '';
$cilindro_izq_cerca = (isset($_POST['cilindro_izq_cerca'])) ? $_POST['cilindro_izq_cerca'] : '';

$eje_der_lejos = (isset($_POST['eje_der_lejos'])) ? $_POST['eje_der_lejos'] : '';
$eje_izq_lejos = (isset($_POST['eje_izq_lejos'])) ? $_POST['eje_izq_lejos'] : '';
$eje_der_cerca = (isset($_POST['eje_der_cerca'])) ? $_POST['eje_izq_lejos'] : '';
$eje_izq_cerca = (isset($_POST['eje_izq_cerca'])) ? $_POST['eje_izq_cerca'] : '';

$av_der_lejos = (isset($_POST['av_der_lejos'])) ? $_POST['av_der_lejos'] : '';
$av_izq_lejos = (isset($_POST['av_izq_lejos'])) ? $_POST['av_izq_lejos'] : '';
$av_der_cerca = (isset($_POST['av_der_cerca'])) ? $_POST['av_der_cerca'] : '';
$av_izq_cerca = (isset($_POST['av_izq_cerca'])) ? $_POST['av_izq_cerca'] : '';

$dis_pupilar_lejos = (isset($_POST['dis_pupilar_lejos'])) ? $_POST['dis_pupilar_lejos'] : '';
$dis_pupilar_cerca = (isset($_POST['dis_pupilar_cerca'])) ? $_POST['dis_pupilar_cerca'] : '';

$observaciones = (isset($_POST['observaciones'])) ? $_POST['observaciones'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idMedida = (isset($_POST['idMedida'])) ? $_POST['idMedida'] : '';


switch ($opcion) {
    case 1:
        //OPERACION INSERTAR
        $consulta = "INSERT INTO medidas VALUES (NULL, '$idPaciente_fk', '$esf_der_lejos','$esf_izq_lejos', '$esf_der_cerca', '$esf_izq_cerca','$cilindro_der_lejos','$cilindro_izq_lejos', '$cilindro_der_cerca', '$cilindro_izq_cerca','$eje_der_lejos', '$eje_izq_lejos','$eje_der_cerca','$eje_izq_cerca', 
        '$av_der_lejos', '$av_izq_lejos','$av_der_cerca','$av_izq_cerca','$dis_pupilar_lejos','$dis_pupilar_cerca',
        '$observaciones')";
        $resultado = $conexion1->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM medidas ORDER BY idMedida DESC LIMIT 1"; //enviar al final esf_der_cerca
        $resultado = $conexion1->prepare($consulta);
        $resultado->execute();

        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta = "DELETE FROM medidas WHERE idMedida='$idMedida' ";
        $resultado = $conexion1->prepare($consulta);
        $resultado->execute();
        break;
    case 4:
        $consulta = "SELECT * FROM medidas";
        $resultado = $conexion1->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC); 
        break;

    case 5:
        $consulta = "DELETE FROM medidas";
        $resultado = $conexion1->prepare($consulta);
        $resultado->execute();
        echo 5;
        exit;
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); 
$conexion1 = null;
