<?php
    error_reporting(0);
    include('../config.php');
    $id_gieng = $_POST["id_gieng"];
    $query = '';
    for ($i = 0; $i < count($id_gieng); $i++) {
        $query.= 'DELETE FROM "DiemTD_NDD" WHERE ma_congtrinhktsd ='.$_POST["macongtrinh"].' AND id ='.$id_gieng[$i]."; ";
    }
    echo $query;

    $result = pg_query($tiengiang_db, $query);
    if(!$result) {
        echo 'error';
    }
