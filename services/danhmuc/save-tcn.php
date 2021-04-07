<?php
include "../config.php"
?>
<?php
if (isset($_POST['ma'])) {
    /*---- Update Tầng chứa nước ----*/
    $query = 'UPDATE "TangChuaNuoc" ';
    $query .= 'SET "name"=' . "'" . $_POST["ten_tcn"] . "'" . ', ';
    $query .= '"chieuSauMai"=' . "'" . $_POST["chieusau_mai"] . "'" . ', ';
    $query .= '"chieuSauDay"=' . "'" . $_POST["chieusau_day"] . "'" . ', ';
    $query .= '"beDayTrungBinh"=' . "'" . $_POST["beday"] . "'" . ', ';
    $query .= '"dangChuaNuoc"=' . "'" . $_POST["dangchuannuoc"] . "'" . ', ';
    $query .= '"mucDoChuaNuoc"=' . "'" . $_POST["mucdo_tcn"] . "'" . ', ';
    $query .= '"thanhPhan"=' . "'" . $_POST["thanhphan"] . "'" . ', ';
    $query .= '"thachHoc"=' . "'" . $_POST["thachhoc"] . "'" . ', ';
    $query .= '"dongThaiMucNuoc"=' . "'" . $_POST["dongthai"] . "'" . ', ';
    $query .= '"chatLuongTangChuaNuoc"=' . "'" . $_POST["chatluong_tcn"] . "'";
    $query .= ' WHERE id=' . $_POST["ma"];

    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert Tầng chứa nước ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "TangChuaNuoc" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["ten_tcn"] . "'" .
        ',' . "'" . $_POST["chieusau_mai"] . "'" . ',' . "'" . $_POST["chieusau_day"] . "'" .
        ',' . "'" . $_POST["beday"] . "'" . ',' . "'" . $_POST["dangchuannuoc"] . "'" .
        ',' . "'" . $_POST["mucdo_tcn"] . "'" . ',' . "'" . $_POST["thanhphan"] . "'" .
        ',' . "'" . $_POST["thachhoc"] . "'" . ',' . "'" . $_POST["dongthai"] . "'" .
        ',' . "'" . $_POST["chatluong_tcn"] . "'" . ')';

    $querry_insert_code = 'INSERT INTO "TangChuaNuoc"(
                             "id", "name", "chieuSauMai", "chieuSauDay", 
                             "beDayTrungBinh", "dangChuaNuoc", "mucDoChuaNuoc", 
                             "thanhPhan", "thachHoc", "dongThaiMucNuoc", "chatLuongTangChuaNuoc") VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
