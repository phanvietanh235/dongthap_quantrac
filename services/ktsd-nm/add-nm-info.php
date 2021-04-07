<?php
    include('../config.php');
?>

<?php
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "CT_KTSD" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;
    $thoihan_ktsd = $_POST["thoihan_ktsd"] != '' ? $_POST["thoihan_ktsd"] : 'NULL';
    $ma_mucdichktsd = $_POST["ma_mucdichktsd"] != 'none' ? $_POST["ma_mucdichktsd"] : 'NULL';

    $querry_values_code = '(' . "'" . $max_count . "'" . ','
        . "'1'" . ','
        . $ma_mucdichktsd . ','
        . $_POST["ma_dvhc"] . ','
        . "'" . $_POST["tencongtrinh"] . "'" . ','
        . "'" . $_POST["diachi_congtrinh"] . "'" . ','
        . "'" . $thoihan_ktsd . "'" .')';

    $querry_insert_code = 'INSERT INTO "CT_KTSD"(id, ma_loaicongtrinh, ma_mucdichktsd, ma_dvhc, 
                          "tenCongTrinh", "diaChiCongTrinh", "thoiHanKTSD") VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
    echo $max_count;
?>
