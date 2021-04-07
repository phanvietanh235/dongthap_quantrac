<?php
include "../config.php"
?>
<?php
if (isset($_POST['ma'])) {
    /*---- Update Chất lượng môi trường ----*/
    $query = 'UPDATE "Qualityindex" ';
    $query .= 'SET "name" =' . "'" . $_POST["ten_clmt"] . "'" . ', ';
    $query .= '"belowvalue" =' . "'" . $_POST["min_clmt"] . "'" . ', ';
    $query .= '"abovevalue" =' . "'" . $_POST["max_clmt"] . "'" . ', ';
    $query .= '"colorcode" =' . "'" . $_POST["color_clmt"] . "'" . ', ';
    $query .= '"purpose" =' . "'" . $_POST["mucdich"] . "'";
    $query .= ' WHERE id =' . $_POST["ma"];

    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert Chất lượng môi trường ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "Qualityindex" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["ten_clmt"] . "'" .
        ',' . "'" . $_POST["min_clmt"] . "'" . ',' . "'" . $_POST["max_clmt"] . "'" .
        ',' . "'" . $_POST["color_clmt"] . "'" . ',' . "'" . $_POST["mucdich"] . "'" . ')';

    $querry_insert_code = 'INSERT INTO "Qualityindex"(
                                 "id", "name", "belowvalue", "abovevalue", "colorcode", "purpose") VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
