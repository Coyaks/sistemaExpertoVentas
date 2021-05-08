<?php 

$host="localhost";
$user_bd="root";
$pass_bd="";
$bd="bd_ventas_general";
//conexión básica
try {
    $conexion=mysqli_connect($host, $user_bd, $pass_bd, $bd);
    $conexion->set_charset("utf8");
    //echo "Conexion exitosa";
} catch (Exception $ex) {
    echo "Error al conectar: ".$ex->getMessage();
}

class Conexion{	  
    public static function Conectar() {      
        //definición de constantes  
        define('host', 'localhost');
        define('user_bd', 'root');
        define('pass_bd', '');		
        define('bd', 'bd_ventas_general');			        
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
        try{
            $conexion2 = new PDO("mysql:host=".host."; dbname=".bd, user_bd, pass_bd, $opciones);		
            return $conexion2;
            //echo '<script>alert("Conexion exitosa")</script>';
        }catch (Exception $e){
            die("El error de Conexión es: ". $e->getMessage());
        }
    }
}

?>