<?php
    error_reporting(0);
    include('../config.php');
    /*---- Update CT_KTSD ----*/
    $query = 'UPDATE "CT_KTSD" ';
    $query.= 'SET "tenCongTrinh"='."'".$_POST["tencongtrinh"]."'".', ';
    $query.= '"diaChiCongTrinh"='."'".$_POST["diachi_congtrinh"]."'".', ';
    /* $query.= '"ma_mucdichktsd"='.$_POST["ma_mucdichktsd"].', '; */
    $query.= '"ma_dvhc"='.$_POST["ma_dvhc"].', ';
    $query.= '"thoiHanKTSD"='."'".$_POST["thoihan_ktsd"]."'";
    $query.= ' WHERE id='.$_POST["macongtrinh"];
    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }

    /*---- Update ThongTinCP_XT----*/
    $query = 'UPDATE "ThongTinCP_XT" ';
    $query.= 'SET "tongLLXaLonNhatMuaKho"='."'".$_POST["tongllxt_muakho"]."'".', ';
    $query.= '"tongSoDiemXa"='.$_POST["tong_diemxa"].', ';
    $query.= '"tongLLXaLonNhat"='."'".$_POST["tongllxt"]."'";

    if ($_POST["i_check"] != 0) {
        $query.= ' WHERE ma_congtrinhktsd='.$_POST["macongtrinh"].'AND "tinhTrangGiayPhep"='."'t'";
    } else {
        $query.= ' WHERE ma_congtrinhktsd='.$_POST["macongtrinh"];
    }
    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }

    /*---- Send Data
    $querry_option = 'SELECT * FROM "MucDichKTSD"
                                            WHERE id ='."'".$_POST["ma_mucdichktsd"]."'";
    $result = pg_query($tiengiang_db, $querry_option);
    $data = array();
    while ($row = pg_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo $data[0]["type_mucdich"]; ----*/
