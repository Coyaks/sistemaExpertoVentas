<?php

class Model
{
    //1. Función fetch ->almacena los registros de BD
    public function fetch1()
    {
        $data = [];

        //Model
        include 'modelo/conexion.php';

        //solo son 2 consultas | consulta 01
        $query = "SELECT m.idMov, m.fecha, m.producto, m.movimiento, concat(c.nombre, ' ',c.apellido_pat, ' ', c.apellido_mat) as cliente, concat(u.nombre,' ', u.apellidos) as usuario, m.cantidad, cu, pv, descuento, subtotal, 
        observaciones, idProducto_fk, tipo_pago from movimiento as m
        inner join cliente as c on c.idPaciente=m.idPaciente_fk inner join usuario as u on u.idUsuario=m.idUsuario_fk 
        WHERE m.movimiento='venta'";
        if ($sql = mysqli_query($conexion, $query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // 2. FUNCION DATE_RANGE
    public function date_range1($start_date1, $end_date1)
    {
        $data = [];
        include 'modelo/conexion.php';
        if (isset($start_date1) && isset($end_date1)) {
            //consulta 02
            // $query = "SELECT * FROM movimiento WHERE movimiento='venta' and fecha >= date('$start_date1') AND fecha <= date_add('$end_date1', INTERVAL 1 DAY)";

            $query = "SELECT m.idMov, m.fecha, m.producto, m.movimiento, concat(c.nombre, ' ',c.apellido_pat, ' ', c.apellido_mat) as cliente, concat(u.nombre,' ', u.apellidos) as usuario, m.cantidad, cu, pv, descuento, subtotal, 
            observaciones, idProducto_fk, tipo_pago from movimiento as m
            inner join cliente as c on c.idPaciente=m.idPaciente_fk inner join usuario as u on u.idUsuario=m.idUsuario_fk 
            WHERE m.movimiento='venta' and fecha >= date('$start_date1') AND fecha <= date_add('$end_date1', INTERVAL 1 DAY)";
            
            if ($sql = mysqli_query($conexion, $query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
        }
        return $data;
    }
}