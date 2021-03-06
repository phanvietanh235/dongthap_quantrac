<?php
include "../config.php"
?>
<?php
if (isset($_POST['id_gp'])) {
    /*---- Update CT_KTSD ----*/
    $query_csktsd = 'UPDATE "CT_KTSD" ';
    $query_csktsd .= 'SET "coSoKTSD"=' . "'" . $_POST["coso_sanxuat"] . "'";
    $query_csktsd .= ' WHERE id=' . $_POST["macongtrinh"];

    /*---- Update ThongTinCP_XT ----*/
    if (is_null($_POST["ngaycapphep"])) {
        $ngaycapphep_new = 0;
    } else {
        $ngaycapphep = explode("/", $_POST["ngaycapphep"]);
        $ngaycapphep_new = $ngaycapphep[2] . "-" . $ngaycapphep[1] . "-" . $ngaycapphep[0];
    }
    if (is_null($_POST["ngayhethan"])) {
        $ngayhethan_new = 0;
    } else {
        $ngayhethan = explode("/", $_POST["ngayhethan"]);
        $ngayhethan_new = $ngayhethan[2] . "-" . $ngayhethan[1] . "-" . $ngayhethan[0];
    }

    $query = 'UPDATE "ThongTinCP_XT" ';
    $query .= 'SET "soGiayPhepXT"=' . "'" . $_POST["sogiayphep"] . "'" . ', ';
    $query .= '"ma_loaigiayphep"=' . $_POST["loaigiayphep"] . ', ';
    $query .= '"ma_doanhnghiep"=' . $_POST["doanhnghiep"] . ', ';
    $query .= '"ma_donvicapphep"=' . $_POST["donvi_cp"] . ', ';
    $query .= '"ma_donviquanly"=' . $_POST["donvi_ql"] . ', ';
    $query .= '"tongLLXaLonNhatMuaKho"=' . "'" . $_POST["luuluong_muakho"] . "'" . ', ';
    $query .= '"tongLLXaLonNhat"=' . "'" . $_POST["luuluong_xa"] . "'" . ', ';
    $query .= '"tongSoDiemXa"=' . "'" . $_POST["tong_diemxa"] . "'" . ', ';
    $query .= '"thoiHanGiayPhep"=' . "'" . $_POST["thoihan_cp"] . "'" . ', ';
    if ($ngaycapphep_new == 0) {
        $query .= '"ngayCapPhep"=' . 'NULL' . ', ';
    } else {
        $query .= '"ngayCapPhep"=' . "'" . $ngaycapphep_new . "'" . ', ';
    }
    if ($ngayhethan_new == 0) {
        $query .= '"ngayHetHan"=' . 'NULL' . ', ';
    } else {
        $query .= '"ngayHetHan"=' . "'" . $ngayhethan_new . "'" . ', ';
    }
    $query .= '"ghiChu"=' . "'" . $_POST["ghichu"] . "'" . ', ';
    $query .= '"taiLieuDinhKem"=' . "'" . $_POST["tailieudinhkem"] . "'" . ', ';
    $query .= '"tinhTrangGiayPhep"=' . "'" . $_POST["tinhtrang_gp"] . "'";
    $query .= ' WHERE id=' . $_POST["id_gp"];

    $result_csktsd = pg_query($tiengiang_db, $query_csktsd);
    echo $query;
    $result = pg_query($tiengiang_db, $query);
    if (!$result && !$result_csktsd) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert DiemKTSD_NDD ----*/
    /*** Lu??n Restart ????? t??m ID m???i nh???t ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "ThongTinCP_XT" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** L???y gi?? tr??? max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    $ngaycapphep = explode("/", $_POST["ngaycapphep"]);
    $ngaycapphep_new = "'" . $ngaycapphep[2] . "-" . $ngaycapphep[1] . "-" . $ngaycapphep[0] . "'";
    $ngayhethan = explode("/", $_POST["ngayhethan"]);
    $ngayhethan_new = "'" . $ngayhethan[2] . "-" . $ngayhethan[1] . "-" . $ngayhethan[0] . "'";
    if ($ngaycapphep_new === "'--'") {
        $ngaycapphep_new = "NULL";
    }
    if ($ngayhethan_new === "'--'") {
        $ngayhethan_new = "NULL";
    }

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["loaigiayphep"] . "'" .
        ',' . "'" . $_POST["macongtrinh"] . "'" . ',' . "'" . $_POST["doanhnghiep"] . "'" .
        ',' . "'" . $_POST["donvi_cp"] . "'" . ',' . "'" . $_POST["donvi_ql"] . "'" .
        ',' . "'" . $_POST["sogiayphep"] . "'" . ',' . "'" . $_POST["luuluong_xa"] . "'" .
        ',' . "'" . $_POST["luuluong_muakho"] . "'" . ',' . "'" . $_POST["tong_diemxa"] . "'" .
        ',' . $ngaycapphep_new . ',' . $ngayhethan_new .
        ',' . "'" . $_POST["thoihan_cp"] . "'" . ',' . "'" . $_POST["tinhtrang_gp"] . "'" .
        ',' . "'" . $_POST["ghichu"] . "'" .
        ',' . "'" . $_POST["tailieudinhkem"] . "'" . ')';

    $querry_insert_code = 'INSERT INTO "ThongTinCP_XT"(
                                 "id", "ma_loaigiayphep", "ma_congtrinhktsd", "ma_doanhnghiep", 
                                 "ma_donvicapphep", "ma_donviquanly",
                                 "soGiayPhepXT", "tongLLXaLonNhat", "tongLLXaLonNhatMuaKho",
                                 "tongSoDiemXa", "ngayCapPhep", "ngayHetHan", 
                                 "thoiHanGiayPhep", "tinhTrangGiayPhep", "ghiChu", "taiLieuDinhKem") VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
