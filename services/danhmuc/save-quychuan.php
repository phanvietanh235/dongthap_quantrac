<?php
include "../config.php"
?>
<?php
if (isset($_POST['ma'])) {
    if (is_null($_POST["ngaybanhanh"])) {
        $ngaybanhanh_new = 0;
    } else {
        $ngaybanhanh = explode("/", $_POST["ngaybanhanh"]);
        $ngaybanhanh_new = $ngaybanhanh[2] . "-" . $ngaybanhanh[1] . "-" . $ngaybanhanh[0];
    }

    /*---- Update Quy chuẩn ----*/
    $query = 'UPDATE "Standard" ';
    $query .= 'SET "name" =' . "'" . $_POST["ten_quychuan"] . "'" . ', ';
    $query .= '"symbol" =' . "'" . $_POST["symbol_quychuan"] . "'" . ', ';
    $query .= '"obstypeid" =' . "'" . $_POST["loaihinh"] . "'" . ', ';
    if ($ngaybanhanh_new == 0) {
        $query .= '"dateoflssue"=' . 'NULL' . ', ';
    } else {
        $query .= '"dateoflssue"=' . "'" . $ngaybanhanh_new . "'" . ', ';
    }
    $query .= '"organization" =' . "'" . $_POST["organization"] . "'";
    $query .= ' WHERE id =' . $_POST["ma"];

    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert Quy chuẩn ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "Standard" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    $ngaybanhanh = explode("/", $_POST["ngaybanhanh"]);
    $ngaybanhanh_new = "'" . $ngaybanhanh[2] . "-" . $ngaybanhanh[1] . "-" . $ngaybanhanh[0] . "'";
    if ($ngaybanhanh_new === "'--'") {
        $ngaybanhanh_new = "NULL";
    }

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["ten_quychuan"] . "'" .
        ',' . "'" . $_POST["symbol_quychuan"] . "'" . ',' . "'" . $_POST["loaihinh"] . "'".
        ',' . $ngaybanhanh_new . ',' . "'" . $_POST["organization"] . "'" . ')';

    $querry_insert_code = 'INSERT INTO "Standard"(
                                 "id", "name", "symbol", "obstypeid", "dateoflssue", "organization") VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
