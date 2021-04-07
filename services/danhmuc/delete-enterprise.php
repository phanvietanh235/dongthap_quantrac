<?php
    error_reporting(0);
    include('../config.php');
    $madoanhnghiep = $_POST["madoanhnghiep"];
    $query = '';
    for ($i = 0; $i < count($madoanhnghiep); $i++) {
        $query.= 'DELETE FROM "Enterprise" WHERE id ='.$madoanhnghiep[$i]."; ";
    }
    echo $query;

    $result = pg_query($tiengiang_db, $query);
    if(!$result) {
        echo 'error';
    }
