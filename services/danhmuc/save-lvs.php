<?php
include "../config.php"
?>
<?php
if (isset($_POST['ma'])) {
    echo $_POST["ten_lvs"]." ".$_POST["riverid"];
    /*---- Update Basin ----*/
    $query = 'UPDATE "Basin" ';
    $query .= 'SET "riverid"=' . "'" . $_POST["riverid"] . "'" . ', ';
    /* $query .= '"name"=' . "'" . $_POST["ten_lvs"] . "'" . ', '; */
    $query .= '"parentriverbasinid"=' . "'" . $_POST["parentriverbasinid"] . "'" . ', ';
    $query .= '"purpose"=' . "'" . $_POST["purpose"] . "'" . ', ';
    $query .= '"surfaceareanwt"=' . "'" . $_POST["surfaceareanwt"] . "'" . ', ';
    $query .= '"netcapacity"=' . "'" . $_POST["netcapacity"] . "'" . ', ';
    $query .= '"deadcapacity"=' . "'" . $_POST["deadcapacity"] . "'" . ', ';
    $query .= '"risingofnormalwaterlevel"=' . "'" . $_POST["risingofnormalwaterlevel"] . "'" . ', ';
    $query .= '"deadwaterlevel"=' . "'" . $_POST["deadwaterlevel"] . "'" . ', ';
    $query .= '"beginning"=' . "'" . $_POST["beginning"] . "'" . ', ';
    $query .= '"termini"=' . "'" . $_POST["termini"] . "'" . ', ';
    $query .= '"length"=' . "'" . $_POST["length"] . "'" . ', ';
    $query .= '"riverbasinarea"=' . "'" . $_POST["riverbasinarea"] . "'" . ', ';
    $query .= '"averageflowrate"=' . "'" . $_POST["averageflowrate"] . "'" . ', ';
    $query .= '"capacity"=' . "'" . $_POST["capacity"] . "'" . ', ';
    $query .= '"normalwaterlevel"=' . "'" . $_POST["normalwaterlevel"] . "'" . ', ';
    $query .= '"standard"=' . "'" . $_POST["standard"] . "'";
    $query .= ' WHERE id=' . $_POST["ma"];

    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert Basin ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "Basin" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["riverid"] . "'" .
        ',' . "'" . $_POST["ten_lvs"] . "'" . ',' . "'" . $_POST["parentriverbasinid"] . "'" .
        ',' . "'" . $_POST["master"] . "'" . ',' . "'" . $_POST["purpose"] . "'" .
        ',' . "'" . $_POST["surfaceareanwt"] . "'" . ',' . "'" . $_POST["netcapacity"] . "'" .
        ',' . "'" . $_POST["deadcapacity"] . "'" . ',' . "'" . $_POST["risingofnormalwaterlevel"] . "'" .
        ',' . "'" . $_POST["deadwaterlevel"] . "'" . ',' . "'" . $_POST["beginning"] . "'" .
        ',' . "'" . $_POST["termini"] . "'" . ',' . "'" . $_POST["length"] . "'" .
        ',' . "'" . $_POST["riverbasinarea"] . "'" . ',' . "'" . $_POST["averageflowrate"] . "'" .
        ',' . "'" . $_POST["capacity"] . "'" . ',' . "'" . $_POST["normalwaterlevel"] . "'" .
        ',' . "'" . $_POST["standard"] . "'" .')';

    $querry_insert_code = 'INSERT INTO "Basin" 
                        (id, riverid, name, parentriverbasinid, master, purpose, 
                         surfaceareanwt, netcapacity, deadcapacity, risingofnormalwaterlevel, 
                         deadwaterlevel, beginning, termini, length, riverbasinarea, 
                         averageflowrate, capacity, normalwaterlevel, standard)  VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
