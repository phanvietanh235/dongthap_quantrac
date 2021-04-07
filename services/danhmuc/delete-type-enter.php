<?php
    error_reporting(0);
    include('../config.php');
    $ma = $_POST["ma"];
    $query = '';
    for ($i = 0; $i < count($ma); $i++) {
        $query.= 'DELETE FROM "LoaiHinhDoanhNghiep" WHERE id ='.$ma[$i]."; ";
    }
    echo $query;

    $result = pg_query($tiengiang_db, $query);
    if(!$result) {
        echo 'error';
    }
