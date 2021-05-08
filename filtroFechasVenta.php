<?php

include 'modelFiltroFechaVenta.php';

$model = new Model();

if (isset($_POST['start_date1']) && isset($_POST['end_date1'])) {
    $start_date1 = $_POST['start_date1'];
    $end_date1 = $_POST['end_date1'];

    $rows = $model->date_range1($start_date1, $end_date1);
} else {
    $rows = $model->fetch1();
}

echo json_encode($rows);