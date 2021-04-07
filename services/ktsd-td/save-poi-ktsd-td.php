<?php
include "../config.php"
?>
<?php
if (isset($_POST['id_gieng'])) {
    /*---- Update DiemTD_NDD ----*/
    $query = 'UPDATE "DiemTD_NDD" ';
    $query .= 'SET "soHieuGiengTD"=' . "'" . $_POST["sohieugieng"] . "'" . ', ';
    $query .= '"ma_tangchuanuoc"=' . $_POST["tang_chuanuoc"] . ', ';
    $query .= '"toaDoX"=' . $_POST["toadoX"] . ', ';
    $query .= '"toaDoY"=' . $_POST["toadoY"] . ', ';
    $query .= '"chieuSauDuKienTD"=' . "'" . $_POST["chieusau_dukien"] . "'" . ', ';
    $query .= '"soLuongGiengTD"=' . "'" . $_POST["soluong_giengtd"] . "'" . ', ';
    $query .= '"vungBHVS"=' . "'" . $_POST["vung_baoho"] . "'" . ', ';
    $query .= '"moTaVungBHVS"=' . "'" . $_POST["mota_vungbaoho"] . "'" . ', ';
    $query .= '"tinhtrangthamdo"=' . "'" . $_POST["tinhtrang_thamdo"] . "'";
    $query .= ' WHERE id=' . $_POST["id_gieng"];
    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert DiemTD_NDD ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "DiemTD_NDD" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["macongtrinh"] . "'" .
        ',' . "'" . $_POST["tang_chuanuoc"] . "'" . ',' . "'" . $_POST["toadoX"] . "'" .
        ',' . "'" . $_POST["toadoY"] . "'" . ',' . "'" . $_POST["sohieugieng"] . "'" .
        ',' . "'" . $_POST["chieusau_dukien"] . "'" . ',' . "'" . $_POST["soluong_giengtd"] . "'" .
        ',' . "'" . $_POST["vung_baoho"] . "'" . ',' . "'" . $_POST["mota_vungbaoho"] . "'" .
        ',' . "'" . $_POST["tinhtrang_thamdo"] . ')';

    $querry_insert_code = 'INSERT INTO "DiemTD_NDD"(
                                    "id", "ma_congtrinhktsd", "ma_tangchuanuoc", 
                                    "toaDoX", "toaDoY", 
                                    "soHieuGiengTD", "chieuSauDuKienTD", "soLuongGiengTD", 
                                    "vungBHVS", "moTaVungBHVS", "tinhtrangthamdo") VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
