<?php
include "../config.php"
?>
<?php
if (isset($_POST['ma'])) {
    if ($_POST["min_ct"] == null) {
        $min = 'NULL';
    } else {
        $min = "'".$_POST["min_ct"]."'";
    }

    if ($_POST["max_ct"] == null) {
        $max = 'NULL';
    } else {
        $max = "'".$_POST["max_ct"]."'";
    }

    if ($_POST["purpose"] == "none") {
        $purpose = 'NULL';
    } else {
        $purpose = "'".$_POST["purpose"]."'";
    }

    /*---- Update Chỉ tiêu ----*/
    $query = 'UPDATE "StandardParameter" ';
    $query .= 'SET "standardid" =' . "'" . $_POST["standard"] . "'" . ', ';
    $query .= '"parameterid" =' . "'" . $_POST["para"] . "'" . ', ';
    $query .= '"unitid" =' . "'" . $_POST["unit"] . "'" . ', ';
    $query .= '"minvalue" =' .$min. ', ';
    $query .= '"maxvalue" =' . $max . ', ';
    $query .= '"purposeid" =' . $purpose . ', ';
    $query .= '"analysismethod" =' . "'" . $_POST["method"] . "'";
    $query .= ' WHERE id =' . $_POST["ma"];

    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert Chỉ tiêu ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "StandardParameter" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    if ($_POST["min_ct"] == null) {
        $min = 'NULL';
    } else {
        $min = "'".$_POST["min_ct"]."'";
    }

    if ($_POST["max_ct"] == null) {
        $max = 'NULL';
    } else {
        $max = "'".$_POST["max_ct"]."'";
    }

    if ($_POST["purpose"] == "none") {
        $purpose = 'NULL';
    } else {
        $purpose = "'".$_POST["purpose"]."'";
    }

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["standard"] . "'" .
        ',' . "'" . $_POST["para"] . "'" . ',' . "'" . $_POST["unit"] . "'" .
        ',' . $min . ',' . $max .
        ',' . $purpose . ',' . "'" . $_POST["method"] . "'". ')';

    $querry_insert_code = 'INSERT INTO "StandardParameter"(
                                "id", "standardid", "parameterid", 
                                "unitid", "minvalue", "maxvalue",
                                "purposeid", "analysismethod") VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
