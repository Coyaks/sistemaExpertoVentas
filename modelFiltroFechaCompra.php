<?php

class Model
{
    //1. Función fetch ->almacena los registros de BD
    public function fetch2()
    {
        $data = [];

        //Model
        include 'modelo/conexion.php';

        //solo son 2 consultas | consulta 01
        $query = "SELECT m.idMov, m.fecha, m.producto, m.movimiento, concat(c.nombre) as proveedor, concat(u.nombre,' ', u.apellidos) 
        as usuario, m.cantidad, cu, pv, descuento, subtotal, observaciones, idProducto_fk, tipo_pago from movimiento 
        as m inner join proveedor as c on c.idProveedor=m.idProveedor_fk inner join usuario as u on u.idUsuario=m.idUsuario_fk 
        WHERE m.movimiento='compra'";
        
        if ($sql = mysqli_query($conexion, $query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // 2. FUNCION DATE_RANGE
    public function date_range($start_date, $end_date)
    {
        $data = [];
        include 'modelo/conexion.php';
        if (isset($start_date) && isset($end_date)) {
            //consulta 02
            // $query = "SELECT * FROM movimiento WHERE movimiento='compra' and fecha >= date('$start_date') AND fecha <= date_add('$end_date', INTERVAL 1 DAY)";

            $query = "SELECT m.idMov, m.fecha, m.producto, m.movimiento, concat(c.nombre) as proveedor, concat(u.nombre,' ', u.apellidos) 
            as usuario, m.cantidad, cu, pv, descuento, subtotal, observaciones, idProducto_fk, tipo_pago from movimiento 
            as m inner join proveedor as c on c.idProveedor=m.idProveedor_fk inner join usuario as u on u.idUsuario=m.idUsuario_fk 
            WHERE m.movimiento='compra' and fecha >= date('$start_date') AND fecha <= date_add('$end_date', INTERVAL 1 DAY)";
            
            if ($sql = mysqli_query($conexion, $query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
        }
        return $data;
    }
}