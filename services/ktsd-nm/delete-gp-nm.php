<?php
    error_reporting(0);
    include('../config.php');
    $id_gp = $_POST["id_gp"];
    $query = '';
    for ($i = 0; $i < count($id_gp); $i++) {
        $query.= 'DELETE FROM "ThongTinCP_NM" WHERE ma_congtrinhktsd ='.$_POST["macongtrinh"].' AND id ='.$id_gp[$i]."; ";
    }
    echo $query;

    $result = pg_query($tiengiang_db, $query);
    if(!$result) {
        echo 'error';
    }
