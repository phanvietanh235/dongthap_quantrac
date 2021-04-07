<?php
include "../config.php"
?>
<?php
error_reporting(0);
if (isset($_POST['id_tiencq'])) {
    /*---- Update TienCapQuyen_NDD ----*/
    if (is_null($_POST["ngay_banhanh"])) {
        $ngaybanhanh_new = 0;
    } else {
        $ngaybanhanh = explode("/", $_POST["ngay_banhanh"]);
        $ngaybanhanh_new = $ngaybanhanh[2] . "-" . $ngaybanhanh[1] . "-" . $ngaybanhanh[0];
    }

    $query = 'UPDATE "TienCapQuyen_NM" ';
    $query .= 'SET "quyetDinhPheDuyetTCQ"=' . "'" . $_POST["so_qdpd"] . "'" . ', ';
    $query .= '"ma_giayphepnm"=' . $_POST["ma_sogiayphep"] . ', ';
    $query .= '"tongTienNop"=' . "'" . $_POST["tongtiennop"] . "'" . ', ';
    $query .= '"thoiGianNop"=' . "'" . $_POST["thoigian_nop"] . "'" . ', ';
    if ($ngaybanhanh_new == 0) {
        $query .= '"ngayBanHanhQDPD"=' . 'NULL' . ', ';
    } else {
        $query .= '"ngayBanHanhQDPD"=' . "'" . $ngaybanhanh_new . "'" . ', ';
    }
    $query .= '"soTienNopHangNam"=' . "'" . $_POST["tien_hangnam"] . "'" . ', ';
    $query .= '"thongBaoPheDuyet"=' . "'" . $_POST["thongbao"] . "'" . ', ';
    $query .= '"phuongAnNop"=' . "'" . $_POST["pa_nop"] . "'";
    $query .= ' WHERE id=' . $_POST["id_tiencq"];
    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "TienCapQuyen_NM" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    $ngaybanhanh = explode("/", $_POST["ngay_banhanh"]);
    $ngaybanhanh_new = "'" . $ngaybanhanh[2] . "-" . $ngaybanhanh[1] . "-" . $ngaybanhanh[0] . "'";
    if ($ngaybanhanh_new === "'--'") {
        $ngaybanhanh_new = "NULL";
    }

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["ma_sogiayphep"] . "'" .
        ',' . "'" . $_POST["so_qdpd"] . "'" . ',' . $ngaybanhanh_new .
        ',' . "'" . $_POST["tongtiennop"] . "'" . ',' . "'" . $_POST["pa_nop"] . "'" .
        ',' . "'" . $_POST["thoigian_nop"] . "'" . ',' . "'" . $_POST["tien_hangnam"] . "'" .
        ',' . "'" . $_POST["thongbao"] . "'" . ')';

    $querry_insert_code = 'INSERT INTO "TienCapQuyen_NM"(
                            "id", "ma_giayphepnm", "quyetDinhPheDuyetTCQ", "ngayBanHanhQDPD", 
                            "tongTienNop", "phuongAnNop", "thoiGianNop", "soTienNopHangNam", "thongBaoPheDuyet") 
                            VALUES' . $querry_values_code;

    // echo $querry_insert_code;
    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
