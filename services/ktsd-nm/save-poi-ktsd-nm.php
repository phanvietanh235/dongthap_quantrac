<?php
include "../config.php"
?>
<?php
if (isset($_POST['id_diem'])) {
    /*---- Update DiemKTSD_NM ----*/
    $query = 'UPDATE "DiemKTSD_NM" ';
    $query .= 'SET "soHieuDiem"=' . "'" . $_POST["sohieudiem"] . "'" . ', ';
    $query .= '"ma_luuvucsong"=' . $_POST["luuvucsong"] . ', ';
    $query .= '"toaDoX"=' . $_POST["toadoX"] . ', ';
    $query .= '"toaDoY"=' . $_POST["toadoY"] . ', ';
    $query .= '"luuLuongKTLNMuaKho"=' . "'" . $_POST["llkt_muakho"] . "'" . ', ';
    $query .= '"luuLuongKTLN"=' . "'" . $_POST["llkt"] . "'" . ', ';
    $query .= '"cheDoKT"=' . "'" . $_POST["chedo_kt"] . "'" . ', ';
    $query .= '"nguonKhaiThac"=' . "'" . $_POST["nguon_kt"] . "'" . ', ';
    $query .= '"phuongThucKT"=' . "'" . $_POST["phuongthuc_kt"] . "'" . ', ';
    $query .= '"vungBHVS"=' . "'" . $_POST["vung_baoho"] . "'" . ', ';
    $query .= '"moTaVungBHVS"=' . "'" . $_POST["mota_vungbaoho"] . "'" . ', ';
    $query .= '"tinhtrangkhaithac"=' . "'" . $_POST["tinhtrang_khaithac"] . "'";
    $query .= ' WHERE id=' . $_POST["id_diem"];
    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert DiemKTSD_NM ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "DiemKTSD_NM" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["macongtrinh"] . "'" .
        ',' . "'" . $_POST["toadoX"] . "'" . ',' . "'" . $_POST["toadoY"] . "'" . ',' . "'" . $_POST["luuvucsong"] . "'" .
        ',' . "'" . $_POST["sohieudiem"] . "'" . ',' . "'" . $_POST["llkt_muakho"] . "'" .
        ',' . "'" . $_POST["llkt"] . "'" . ',' . "'" . $_POST["chedo_kt"] . "'" .
        ',' . "'" . $_POST["nguon_kt"] . "'" . ',' . "'" . $_POST["phuongthuc_kt"] . "'" .
        ',' . "'" . $_POST["vung_baoho"] . "'" . ',' . "'" . $_POST["mota_vungbaoho"] . "'" .
        ',' . "'" . $_POST["tinhtrang_khaithac"] . "'" . ')';

    $querry_insert_code = 'INSERT INTO "DiemKTSD_NM"(
                                    "id", "ma_congtrinhktsd",
                                    "toaDoX", "toaDoY", "ma_luuvucsong", 
                                    "soHieuDiem", "luuLuongKTLNMuaKho", "luuLuongKTLN", 
                                    "cheDoKT", "nguonKhaiThac", "phuongThucKT", 
                                    "vungBHVS", "moTaVungBHVS", "tinhtrangkhaithac") VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
