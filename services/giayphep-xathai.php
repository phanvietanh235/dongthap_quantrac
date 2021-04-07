<?php
    include "config.php";
?>
<?php
    header('Content-Type: application/json');
    $status_gpxt = $_POST["status_gpxt"];
    $rangeDate_gpxt_start = $_POST["rangeDate_gpxt_start"];
    $rangeDate_gpxt_end = $_POST["rangeDate_gpxt_end"];
    $checked = $_POST["checked"];

    $querry_data = 'SELECT * FROM giayphepxathai ';
    $querry_data.= 'WHERE ';
    if ($checked == 'ngaycap') {
        /*** Range Cấp phép ***/
        $querry_data.= '"ngayCapPhep" between '."'".$rangeDate_gpxt_start."'".' AND '."'".$rangeDate_gpxt_end."'".' AND ';
        /*** Tình trạng cấp phép ***/
        if ($status_gpxt == 'all') {
            $querry_data.= '1=1 AND ';
        } else if ($status_gpxt == 'true') {
            $querry_data.= '"tinhTrangGiayPhep" ='."'true' AND ";
        } else {
            $querry_data.= '"tinhTrangGiayPhep" ='."'false' AND ";
        }
        /*** Lưu vực sông khai thác ***/
        if (!isset($_POST["tiepnhan_option"])) {
            $querry_data.= '1=1';
        } else {
            $tiepnhan_option = $_POST["tiepnhan_option"];
            foreach ($tiepnhan_option as $i => $value) {
                if ($i > 0) {
                    $querry_data.= ' OR ';
                }
                $querry_data.= '"id_lvs" = '."'".(int)$value."' ";
            }
        }
    } else {
        /*** Range Hết hạn ***/
        $querry_data.= '"ngayHetHan" between '."'".$rangeDate_gpxt_start."'".' AND '."'".$rangeDate_gpxt_end."'".' AND ';
        /*** Tình trạng cấp phép ***/
        if ($status_gpxt == 'all') {
            $querry_data.= '1=1 AND ';
        } else if ($status_gpxt == 'true') {
            $querry_data.= '"tinhTrangGiayPhep" ='."'true' AND ";
        } else {
            $querry_data.= '"tinhTrangGiayPhep" ='."'false' AND ";
        }
        /*** Lưu vực sông khai thác ***/
        if (!isset($_POST["tiepnhan_option"])) {
            $querry_data.= '1=1';
        } else {
            $tiepnhan_option = $_POST["tiepnhan_option"];
            foreach ($tiepnhan_option as $i => $value) {
                if ($i > 0) {
                    $querry_data.= ' OR ';
                }
                $querry_data.= '"id_lvs" = '."'".(int)$value."' ";
            }
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
            'soGiayPhepXT' => $value['soGiayPhepXT'],
            'ngayCapPhep' => $ngaycapphep_new,
            'thoiHanGiayPhep' => $value['thoiHanGiayPhep'],
            'tenCongTrinh' => $value['tenCongTrinh'],
            'diaChiCongTrinh' => $value['diaChiCongTrinh'],
            'LoaihinhXT' => $value['LoaihinhXT'],
            'tongLLXaLonNhatMuaKho' => $value['tongLLXaLonNhatMuaKho'],
            /* 'quychuan' => '', */
            'toaDoX' => $value['toaDoX'],
            'toaDoY' => $value['toaDoY'],
            'nguonTiepNhanNT' => $value['nguonTiepNhanNT'],

            /*** Thêm các Field để xuất Excel ***/
            'tensong' => $value['TenSong'],
            'ngayHetHan' => $value['ngayHetHan'],
            'tinhTrangGiayPhep' => $value['tinhTrangGiayPhep'] == 't' ? "Còn hiệu lực" : "Hết hiệu lực"
        );
    }

    $final_data = json_encode($option);
    echo $final_data;
?>
