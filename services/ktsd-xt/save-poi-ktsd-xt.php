<?php
include "../config.php"
?>
<?php
if (isset($_POST['id_diem'])) {
    /*---- Update DiemXT ----*/
    $query = 'UPDATE "DiemXT" ';
    $query .= 'SET "soHieuDiem"=' . "'" . $_POST["sohieudiem"] . "'" . ', ';
    $query .= '"ma_luuvucsong"=' . $_POST["luuvucsong"] . ', ';
    $query .= '"toaDoX"=' . $_POST["toadoX"] . ', ';
    $query .= '"toaDoY"=' . $_POST["toadoY"] . ', ';
    $query .= '"luuLuongXT"=' . "'" . $_POST["llxt"] . "'" . ', ';
    $query .= '"nguonTiepNhanNT"=' . "'" . $_POST["tiepnhan_nt"] . "'" . ', ';
    $query .= '"cheDoXT"=' . "'" . $_POST["chedo_xt"] . "'" . ', ';
    $query .= '"mucDichXT"=' . "'" . $_POST["mucdich_xt"] . "'" . ', ';
    $query .= '"phuongThucXT"=' . "'" . $_POST["phuongthuc_xt"] . "'" . ', ';
    $query .= '"chatLuongNT"=' . "'" . $_POST["cl_nuocthai"] . "'" . ', ';
    $query .= '"loaiNT"=' . "'" . $_POST["loai_nt"] . "'" . ', ';
    $query .= '"tanSuatQuanTrac"=' . "'" . $_POST["tansuat_quantrac"] . "'" . ', ';
    $query .= '"tinhtrangxathai"=' . "'" . $_POST["tinhtrang_xathai"] . "'";
    $query .= ' WHERE id=' . $_POST["id_diem"];
    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert DiemXT ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "DiemXT" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["macongtrinh"] . "'" .
        ',' . "'" . $_POST["luuvucsong"] . "'" .
        ',' . "'" . $_POST["toadoX"] . "'" . ',' . "'" . $_POST["toadoY"] . "'" .
        ',' . "'" . $_POST["sohieudiem"] . "'" . ',' . "'" . $_POST["llxt"] . "'" .
        ',' . "'" . $_POST["chedo_xt"] . "'" . ',' . "'" . $_POST["tiepnhan_nt"] . "'" .
        ',' . "'" . $_POST["mucdich_xt"] . "'" . ',' . "'" . $_POST["phuongthuc_xt"] . "'" .
        ',' . "'" . $_POST["cl_nuocthai"] . "'" . ',' . "'" . $_POST["loai_nt"] . "'" .
        ',' . "'" . $_POST["tansuat_quantrac"] . "'" . ',' . "'" . $_POST["tinhtrang_xathai"] . "'" . ')';

    $querry_insert_code = 'INSERT INTO "DiemXT"(
                                "id", "ma_congtrinhktsd", "ma_luuvucsong", "toaDoX", "toaDoY", 
                                "soHieuDiem", "luuLuongXT", "cheDoXT", "nguonTiepNhanNT", "mucDichXT", 
                                "phuongThucXT", "chatLuongNT", "loaiNT", "tanSuatQuanTrac", tinhtrangxathai) VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
