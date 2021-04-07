<?php
include "../config.php"
?>
<?php
error_reporting(0);
if (isset($_POST['id_gp'])) {
    /*---- Update CT_KTSD ----*/
    $query_csktsd = 'UPDATE "CT_KTSD" ';
    $query_csktsd .= 'SET "coSoKTSD"=' . "'" . $_POST["coso_sanxuat"] . "'";
    $query_csktsd .= ' WHERE id=' . $_POST["macongtrinh"];

    /*---- Update ThongTinCP_NM ----*/
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
    if (is_null($_POST["ngaybanhanh"])) {
        $ngaybanhanh_new = 0;
    } else {
        $ngaybanhanh = explode("/", $_POST["ngaybanhanh"]);
        $ngaybanhanh_new = $ngaybanhanh[2] . "-" . $ngaybanhanh[1] . "-" . $ngaybanhanh[0];
    }

    $query = 'UPDATE "ThongTinCP_NM" ';
    $query .= 'SET "soGiayPhepNM"=' . "'" . $_POST["sogiayphep"] . "'" . ', ';
    $query .= '"ma_loaigiayphep"=' . $_POST["loaigiayphep"] . ', ';
    $query .= '"ma_doanhnghiep"=' . $_POST["doanhnghiep"] . ', ';
    $query .= '"ma_donvicapphep"=' . $_POST["donvi_cp"] . ', ';
    $query .= '"ma_donviquanly"=' . $_POST["donvi_ql"] . ', ';
    $query .= '"thoiHanGiayPhep"=' . "'" . $_POST["thoihan_cp"] . "'" . ', ';
    $query .= '"phamViCapNuoc"=' . "'" . $_POST["phamvi_capnuoc"] . "'" . ', ';
    $query .= '"quyetDinhVungBHVS"=' . "'" . $_POST["soqd_bhvs"] . "'" . ', ';
    if ($ngaybanhanh_new == 0) {
        $query .= '"ngayBanHanhQDVungBHVS"=' . 'NULL' . ', ';
    } else {
        $query .= '"ngayBanHanhQDVungBHVS"=' . "'" . $ngaybanhanh_new . "'" . ', ';
    }
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
    $query .= '"tongLLKTLonNhatTungThoiKy"=' . "'" . $_POST["luongnuoc_kt"] . "'" . ', ';
    $query .= '"tongLNSDTrongNam"=' . "'" . $_POST["luongnuoc_sd"] . "'" . ', ';
    $query .= '"taiLieuDinhKem"=' . "'" . $_POST["tailieudinhkem"] . "'" . ', ';
    $query .= '"tinhTrangGiayPhep"=' . "'" . $_POST["tinhtrang_gp"] . "'";
    $query .= ' WHERE id=' . $_POST["id_gp"];

    $result_csktsd = pg_query($tiengiang_db, $query_csktsd);
    $result = pg_query($tiengiang_db, $query);
    if (!$result && !$result_csktsd) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert DiemKTSD_NM ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "ThongTinCP_NM" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    $ngaycapphep = explode("/", $_POST["ngaycapphep"]);
    $ngaycapphep_new = "'" . $ngaycapphep[2] . "-" . $ngaycapphep[1] . "-" . $ngaycapphep[0] . "'";
    $ngayhethan = explode("/", $_POST["ngayhethan"]);
    $ngayhethan_new = "'" . $ngayhethan[2] . "-" . $ngayhethan[1] . "-" . $ngayhethan[0] . "'";
    $ngaybanhanh = explode("/", $_POST["ngaybanhanh"]);
    $ngaybanhanh_new = "'" . $ngaybanhanh[2] . "-" . $ngaybanhanh[1] . "-" . $ngaybanhanh[0] . "'";

    /*--- Nếu giá trị không có ==> Chuyển đổi giá trị thành NULL ---*/
    if ($ngaycapphep_new === "'--'") {
        $ngaycapphep_new = "NULL";
    }
    if ($ngayhethan_new === "'--'") {
        $ngayhethan_new = "NULL";
    }
    if ($ngaybanhanh_new === "'--'") {
        $ngaybanhanh_new = "NULL";
    }

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["loaigiayphep"] . "'" .
        ',' . "'" . $_POST["macongtrinh"] . "'" . ',' . "'" . $_POST["doanhnghiep"] . "'" .
        ',' . "'" . $_POST["donvi_cp"] . "'" .  ',' . "'" . $_POST["donvi_ql"] . "'" .
        ',' . "'" . $_POST["sogiayphep"] . "'" . ',' . "'" . $_POST["luongnuoc_kt"] . "'" .
        ',' . "'" . $_POST["luongnuoc_sd"] . "'" .
        ',' . "'" . $_POST["phamvi_capnuoc"] . "'" . ',' . "'" . $_POST["soqd_bhvs"] . "'" .
        ',' . $ngaybanhanh_new . ',' . $ngaycapphep_new .
        ',' . $ngayhethan_new . ',' . "'" . $_POST["thoihan_cp"] . "'" .
        ',' . "'" . $_POST["tinhtrang_gp"] . "'" .
        ',' . "'" . $_POST["tailieudinhkem"] . "'" . ')';

    $querry_insert_code = 'INSERT INTO "ThongTinCP_NM"(
                                "id", "ma_loaigiayphep", 
                                "ma_congtrinhktsd", "ma_doanhnghiep", 
                                "ma_donvicapphep", "ma_donviquanly", 
                                "soGiayPhepNM", "tongLLKTLonNhatTungThoiKy",
                                "tongLNSDTrongNam",
                                "phamViCapNuoc", 
                                "quyetDinhVungBHVS", 
                                "ngayBanHanhQDVungBHVS", 
                                "ngayCapPhep", "ngayHetHan", 
                                "thoiHanGiayPhep", "tinhTrangGiayPhep", "taiLieuDinhKem") VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
