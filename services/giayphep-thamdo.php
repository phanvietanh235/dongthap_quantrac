<?php
    include "config.php";
?>
<?php
    header('Content-Type: application/json');
    $status_gptd = $_POST["status_gptd"];
    $rangeDate_gptd_start = $_POST["rangeDate_gptd_start"];
    $rangeDate_gptd_end = $_POST["rangeDate_gptd_end"];
    $checked = $_POST["checked"];

    $querry_data = 'SELECT * FROM giayphepthamdo ';
    $querry_data.= 'WHERE ';
    if ($checked == 'ngaycap') {
        /*** Range Cấp phép ***/
        $querry_data.= '"ngayCapPhep" between '."'".$rangeDate_gptd_start."'".' AND '."'".$rangeDate_gptd_end."'".' AND ';
        /*** Tình trạng cấp phép ***/
        if ($status_gptd == 'all') {
            $querry_data.= '1=1';
        } else if ($status_gptd == 'true') {
            $querry_data.= '"tinhTrangGiayPhep" ='."'true'";
        } else {
            $querry_data.= '"tinhTrangGiayPhep" ='."'false'";
        }
    } else {
        /*** Range Hết hạn ***/
        $querry_data.= '"ngayHetHan" between '."'".$rangeDate_gptd_start."'".' AND '."'".$rangeDate_gptd_end."'".' AND ';
        /*** Tình trạng cấp phép ***/
        if ($status_gptd == 'all') {
            $querry_data.= '1=1';
        } else if ($status_gptd == 'true') {
            $querry_data.= '"tinhTrangGiayPhep" ='."'true'";
        } else {
            $querry_data.= '"tinhTrangGiayPhep" ='."'false'";
        }
    }

    $result = pg_query($tiengiang_db, $querry_data);
    if (!$result) {
        echo "Không có dữ liệu.\n";
        exit;
    }

    /*** Chuyển định dạng từ Array sang Json ***/
    $data = array();
    while ($row = pg_fetch_assoc($result)) {
        $data[] = $row;
    }

    $jsonData = json_encode($data);
    $original_data = json_decode($jsonData, true);
    $option = array();
    foreach ($original_data as $key => $value) {
        /*---- Xử lý Date ----*/
        $ngaycapphep = explode("-", $value['ngayCapPhep']);
        $ngaycapphep_new = $ngaycapphep[2]."/".$ngaycapphep[1]."/".$ngaycapphep[0];

        $option[] = array(
            'id' => $value['id'],
            'idgp' => $value['idgp'],
            'macongtrinh' => $value['macongtrinh'],
            'tenDoanhNghiep' => $value['tenDoanhNghiep'],
            'diachiDoanhNghiep' => $value['diachiDoanhNghiep'],
            'coSoKTSD' => $value['coSoKTSD'],
            'diachiCSSX' => $value['diachiCSSX'],
            'soGiayPhepTD' => $value['soGiayPhepTD'],
            'ngayCapPhep' => $ngaycapphep_new,
            'thoiHanGiayPhep' => $value['thoiHanGiayPhep'],
            'diaChiCongTrinh' => $value['diaChiCongTrinh'],
            'soLuongGiengTD' => $value['soLuongGiengTD'],
            /* 'luuluong' => '', */
            'tangChuaNuoc' => $value['tangChuaNuoc']
        );
    }

    $final_data = json_encode($option);
    echo $final_data;
?>
