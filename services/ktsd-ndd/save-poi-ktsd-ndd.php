<?php
include "../config.php"
?>
<?php
if (isset($_POST['id_gieng'])) {
    /*---- Update DiemKTSD_NDD ----*/
    $query = 'UPDATE "DiemKTSD_NDD" ';
    $query .= 'SET "soHieuGieng"=' . "'" . $_POST["sohieugieng"] . "'" . ', ';
    $query .= '"ma_tangchuanuoc"=' . $_POST["tang_chuanuoc"] . ', ';
    $query .= '"toaDoX"=' . $_POST["toadoX"] . ', ';
    $query .= '"toaDoY"=' . $_POST["toadoY"] . ', ';
    $query .= '"chieuSauGiengTu"=' . "'" . $_POST["chieuSau_tu"] . "'" . ', ';
    $query .= '"chieuSauGiengDen"=' . "'" . $_POST["chieuSau_den"] . "'" . ', ';
    $query .= '"chieuSauMNTinh"=' . "'" . $_POST["mn_tinh"] . "'" . ', ';
    $query .= '"chieuSauMNDongLonNhat"=' . "'" . $_POST["mn_dong"] . "'" . ', ';
    $query .= '"cheDoKhaiThac"=' . "'" . $_POST["chedo_kt"] . "'" . ', ';
    $query .= '"tinhTrangGieng"=' . "'" . $_POST["tinhtrang_gieng"] . "'" . ', ';
    /*** Kiểu varchar ***/
    $query .= '"vungBHVS"=' . "'" . $_POST["vung_baoho"] . "'" . ', ';
    $query .= '"ketCauGiengKhoan"=' . "'" . $_POST["ketcau_giengkhoan"] . "'" . ', ';
    $query .= '"moTaVungBHVS"=' . "'" . $_POST["mota_vungbaoho"] . "'";
    $query .= ' WHERE id=' . $_POST["id_gieng"];
    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert DiemKTSD_NDD ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "DiemKTSD_NDD" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["macongtrinh"] . "'" .
        ',' . "'" . $_POST["tang_chuanuoc"] . "'" . ',' . "'" . $_POST["toadoX"] . "'" .
        ',' . "'" . $_POST["toadoY"] . "'" . ',' . "'" . $_POST["sohieugieng"] . "'" .
        ',' . "'" . $_POST["chieuSau_tu"] . "'" . ',' . "'" . $_POST["chieuSau_den"] . "'" .
        ',' . "'" . $_POST["mn_dong"] . "'" . ',' . "'" . $_POST["mn_tinh"] . "'" .
        ',' . "'" . $_POST["chedo_kt"] . "'" . ',' . "'" . $_POST["ketcau_giengkhoan"] . "'" .
        ',' . "'" . $_POST["tinhtrang_gieng"] . "'" .
        ',' . "'" . $_POST["vung_baoho"] . "'" . ',' . "'" . $_POST["mota_vungbaoho"] . "'" . ')';

    $querry_insert_code = 'INSERT INTO "DiemKTSD_NDD"(
                                "id", "ma_congtrinhktsd", "ma_tangchuanuoc", 
                                "toaDoX", "toaDoY", 
                                "soHieuGieng", "chieuSauGiengTu", "chieuSauGiengDen", 
                                "chieuSauMNDongLonNhat", "chieuSauMNTinh", "cheDoKhaiThac",
                                "ketCauGiengKhoan", "tinhTrangGieng", 
                                "vungBHVS", "moTaVungBHVS") VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
