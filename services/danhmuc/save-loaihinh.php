<?php
include "../config.php"
?>
<?php
if (isset($_POST['ma'])) {
    /*---- Update Loại hình ----*/
    if ($_POST["type_loaihinh"] == null) {
        $parentid = "NULL";
    } else {
        $parentid = $_POST["type_loaihinh"];
    }

    $query = 'UPDATE "ObservationType" ';
    $query .= 'SET "name" =' . "'" . $_POST["ten_loaihinh"] . "'" . ', ';
    $query .= '"parentid" =' . $parentid . ', ';
    $query .= '"code" =' . "'" . $_POST["code"] . "'";
    $query .= ' WHERE id =' . $_POST["ma"];

    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert Loại hình ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "ObservationType" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    if ($_POST["type_loaihinh"] == null) {
        $parentid = "NULL";
    } else {
        $parentid = $_POST["type_loaihinh"];
    }

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["ten_loaihinh"] . "'" .
        ',' . $parentid . ',' . "'" . $_POST["code"] . "'" . ')';

    $querry_insert_code = 'INSERT INTO "ObservationType"(
                                     "id", "name", "parentid", "code") VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
