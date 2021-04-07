<?php
    error_reporting(0);
    include('../config.php');
    $id_thvp = $_POST["id_thvp"];
    $query = '';
    for ($i = 0; $i < count($id_thvp); $i++) {
        $query.= 'DELETE FROM "TinhHinhViPham_NM" WHERE id ='.$id_thvp[$i]."; ";
    }
    echo $query;

    $result = pg_query($tiengiang_db, $query);
    if(!$result) {
        echo 'error';
    }
