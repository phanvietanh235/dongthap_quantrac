<?php
include "../config.php"
?>
<?php

if (isset($_POST['idsoHieu'])) {
    /*---- Update GiengQT_NDD ----*/
    $query = 'UPDATE "DiemQT_NM" ';
    $query .= 'SET "soHieuDiemQT"=' . "'" . $_POST["soHieuDiemQT"] . "'" . ', ';
    $query .= '"ma_tramcu"=' . "'" . $_POST["ma_tramcu"] . "'" . ', ';
    $query .= '"ma_congtrinhktsd"=' . $_POST["congtrinh"] . ', ';
    $query .= '"ma_diadanhqt"=' . $_POST["diadanh"] . ', ';
    $query .= '"ma_diemqt_nm"=' . "'" . $_POST["ma_diemqt_nm"] . "'" . ', ';
    $query .= '"coordX"=' . $_POST["toadoX"] . ', ';
    $query .= '"coordY"=' . $_POST["toadoY"] . ', ';
    $query .= '"tuanSuatBaoTri"=' . "'" . $_POST["tuanSuatBaoTri"] . "'" . ', ';
    $query .= '"tinhTrangHoatDong"=' . "'" . $_POST["tinhTrangHoatDong"] . "'" . ' ';
    $query .= ' WHERE id=' . $_POST["idsoHieu"];
    //echo $query;
    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} 
else {
    /*---- Insert DiemKTSD_NDD ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "DiemQT_NM" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;


    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["soHieuDiemQT"] . "'" .
        ',' . "'" . $_POST["ma_tramcu"] . "'" . ',' . "'" . $_POST["toadoX"] . "'" .
        ',' . "'" . $_POST["toadoY"] . "'" . ',' . "'" . $_POST["tuanSuatBaoTri"] . "'" .
        ',' . "'" . $_POST["tinhTrangHoatDong"] . "'" . ')';

    $querry_insert_code = 'INSERT INTO "DiemQT_NM" (id, "soHieuDiemQT", "ma_tramcu", 
                           "coordY", "coordX", "tuanSuatBaoTri",
                           "tinhTrangHoatDong")  VALUES' . $querry_values_code;
    // echo $querry_insert_code;
    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
