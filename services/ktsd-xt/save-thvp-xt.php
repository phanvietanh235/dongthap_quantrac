<?php
include "../config.php"
?>
<?php
if (isset($_POST['id_thvp'])) {
    /*---- Update TinhHinhViPham_xt ----*/
    if (is_null($_POST["ngayxuphat"])) {
        $ngayxuphat_new = 0;
    } else {
        $ngayxuphat = explode("/", $_POST["ngayxuphat"]);
        $ngayxuphat_new = $ngayxuphat[2] . "-" . $ngayxuphat[1] . "-" . $ngayxuphat[0];
    }

    if (is_null($_POST["tien_xp"])) {
        $tien_xp = 0;
    } else {
        $tien_xp = $_POST["tien_xp"];
    }

    $query = 'UPDATE "TinhHinhViPham_XT" ';
    $query .= 'SET "ma_doanhnghiep"=' . "'" . $_POST["doanhnghiep"] . "'" . ', ';
    $query .= '"quyetDinhXP"=' . "'" . $_POST["so_qdxp"] . "'" . ', ';
    if ($ngayxuphat_new == 0) {
        $query .= '"ngayXP"=' . 'NULL' . ', ';
    } else {
        $query .= '"ngayXP"=' . "'" . $ngayxuphat_new . "'" . ', ';
    }
    $query .= '"donViXP"=' . "'" . $_POST["donvi_xp"] . "'" . ', ';
    $query .= '"hinhThucXP"=' . "'" . $_POST["hinhthuc_xp"] . "'" . ', ';
    $query .= '"noiDungXP"=' . "'" . $_POST["noidung_xuphat"] . "'" . ', ';
    if ($tien_xp == 0) {
        $query .= '"soTienXP"=' . 'NULL';
    } else {
        $query .= '"soTienXP"=' . $tien_xp;
    }
    $query .= ' WHERE id=' . $_POST["id_thvp"];

    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert TinhHinhViPham_xt ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT count(id) id FROM "TinhHinhViPham_XT"');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    $ngayxuphat = explode("/", $_POST["ngayxuphat"]);
    $ngayxuphat_new = "'" . $ngayxuphat[2] . "-" . $ngayxuphat[1] . "-" . $ngayxuphat[0] . "'";
    if ($ngayxuphat_new === "'--'") {
        $ngayxuphat_new = "NULL";
    }

    if (is_null($_POST["tien_xp"])) {
        $tien_xp = "NULL";
    } else {
        $tien_xp = "'" . $_POST["tien_xp"] . "'";
    }

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["doanhnghiep"] . "'" .
        ',' . "'" . $_POST["so_qdxp"] . "'" . ',' . $ngayxuphat_new .
        ',' . "'" . $_POST["donvi_xp"] . "'" . ',' . "'" . $_POST["hinhthuc_xp"] . "'" .
        ',' . "'" . $_POST["noidung_xuphat"] . "'" . ',' . $_POST["tien_xp"] . ')';

    $querry_insert_code = 'INSERT INTO "TinhHinhViPham_XT"(
                                         "id", "ma_doanhnghiep", "quyetDinhXP", "ngayXP", 
                                         "donViXP", "hinhThucXP", "noiDungXP", "soTienXP") VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
