<?php
include "../config.php"
?>
<?php
if (isset($_POST['idsoHieu'])) {
    /*---- Update GiengQT_NDD ----*/
    $query = 'UPDATE "GiengQT_NDD" ';
    $query .= 'SET "ma_giengqt_ndd"=' . "'" . $_POST["sohieugiengqt"] . "'" . ', ';
    $query .= '"sohieugiengqt"=' . "'" . $_POST["sohieugiengqt"] . "'" . ', ';
    $query .= '"ma_tangchuanuoc"=' . $_POST["tang_chuanuoc"] . ', ';
    $query .= '"ma_congtrinhktsd"=' . $_POST["congtrinh"] . ', ';
    $query .= '"ma_diadanhqt"=' . $_POST["diadanh"] . ', ';
    $query .= '"coordX"=' . $_POST["toadoX"] . ', ';
    $query .= '"coordY"=' . $_POST["toadoY"] . ', ';
    $query .= '"doSauGieng"=' . "'" . $_POST["doSauGieng"] . "'" . ', ';
    $query .= '"caoDoMiengGieng"=' . "'" . $_POST["caoDoMiengGieng"] . "'" . ', ';
    $query .= '"caoDoBeGieng"=' . "'" . $_POST["caoDoBeGieng"] . "'" . ', ';
    $query .= '"caoDoMatDat"=' . "'" . $_POST["caoDoMatDat"] . "'" . ', ';
    $query .= '"chieuSauChongOng"=' . "'" . $_POST["chieuSauChongOng"] . "'" . ', ';
    $query .= '"tinhTrangHoatDong"=' . "'" . $_POST["tinhTrangHoatDong"] . "'" . ', ';
    /*** Kiểu varchar ***/
    $query .= '"moTaTangChuaNuoc"=' . "'" . $_POST["moTaTangChuaNuoc"] . "'" . ', ';
    $query .= '"moTaMaiCachNuoc"=' . "'" . $_POST["moTaMaiCachNuoc"] . "'" . ', ';
    $query .= '"moTaOngLoc"=' . "'" . $_POST["moTaOngLoc"] . "'";
    $query .= ' WHERE id=' . $_POST["idsoHieu"];
    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert DiemKTSD_NDD ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "GiengQT_NDD" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;


    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["congtrinh"] . "'" .
        ',' . "'" . $_POST["sohieugiengqt"] . "'" .
        ',' . "'" . $_POST["tang_chuanuoc"] . "'" .
        ',' . "'" . $_POST["diadanh"] . "'" . ',' . "'" . $_POST["toadoX"] . "'" .
        ',' . "'" . $_POST["toadoY"] . "'" . ',' . "'" . $_POST["doSauGieng"] . "'" .
        ',' . "'" . $_POST["caoDoMiengGieng"] . "'" . ',' . "'" . $_POST["caoDoBeGieng"] . "'" .
        ',' . "'" . $_POST["caoDoMatDat"] . "'" . ',' . "'" . $_POST["chieuSauChongOng"] . "'" .
        ',' . "'" . $_POST["moTaMaiCachNuoc"] . "'" . ',' . "'" . $_POST["moTaTangChuaNuoc"] . "'" .
        ',' . "'" . $_POST["moTaOngLoc"] . "'" .
        ',' . "'" . $_POST["tinhTrangHoatDong"] . "'" . ',' . "'" . $_POST["sohieugiengqt"] . "'" . ')';

    $querry_insert_code = 'INSERT INTO "GiengQT_NDD" (id, ma_congtrinhktsd, ma_giengqt_ndd, ma_tangchuanuoc, ma_diadanhqt, 
                           "coordY", "coordX", "doSauGieng", "caoDoMiengGieng", "caoDoBeGieng", "caoDoMatDat", 
                           "chieuSauChongOng", "moTaMaiCachNuoc", "moTaTangChuaNuoc", "moTaOngLoc",
                           "tinhTrangHoatDong", sohieugiengqt)  VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
