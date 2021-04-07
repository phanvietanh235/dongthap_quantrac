<?php
    error_reporting(0);
    include('../config.php');
    $id_diem = $_POST["id_diem"];
    $query = '';
    for ($i = 0; $i < count($id_diem); $i++) {
        $query.= 'DELETE FROM "StdStation_DiemXT" WHERE stationid ='.$id_diem[$i]."; ";
        $query.= 'DELETE FROM "Observation_DiemXT" WHERE stationid ='.$id_diem[$i]."; ";
        $query.= 'DELETE FROM "DiemXT" WHERE ma_congtrinhktsd ='.$_POST["macongtrinh"].' AND id ='.$id_diem[$i]."; ";
    }
    echo $query;

    $result = pg_query($tiengiang_db, $query);
    if(!$result) {
        echo 'error';
    }
