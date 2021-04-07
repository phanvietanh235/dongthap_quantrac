<?php
include "../config.php"
?>
<?php
if (isset($_POST['ma'])) {
    /*---- Update Loại công trình ----*/
    $query = 'UPDATE "LoaiCongTrinh" ';
    $query .= 'SET "name" =' . "'" . $_POST["ten_loaict"] . "'" . ', ';
    $query .= '"type_ct" =' . "'" . $_POST["code_loaict"] . "'";
    $query .= ' WHERE id =' . $_POST["ma"];

    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert Loại công trình ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "LoaiCongTrinh" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["ten_loaict"] . "'" .
        ',' . "'" . $_POST["code_loaict"] . "'" . ')';

    $querry_insert_code = 'INSERT INTO "LoaiCongTrinh"(
                                     "id", "name", "type_ct") VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>

