<?php
    error_reporting(0);
    include('../config.php');
    $id_tiencq = $_POST["id_tiencq"];
    $query = '';
    for ($i = 0; $i < count($id_tiencq); $i++) {
        $query.= 'DELETE FROM "TienCapQuyen_NDD" WHERE id ='.$id_tiencq[$i]."; ";
    }
    echo $query;

    $result = pg_query($tiengiang_db, $query);
    if(!$result) {
        echo 'error';
    }
