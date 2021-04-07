<?php
    include "config.php";
?>
<?php
    header('Content-Type: application/json');
    $status_gpnm = $_POST["status_gpnm"];
    $rangeDate_gpnm_start = $_POST["rangeDate_gpnm_start"];
    $rangeDate_gpnm_end = $_POST["rangeDate_gpnm_end"];
    $checked = $_POST["checked"];

    $querry_data = 'SELECT * FROM giayphepnuocmat ';
    $querry_data.= 'WHERE ';
    if ($checked == 'ngaycap') {
        /*** Range Cấp phép ***/
        $querry_data.= '"ngayCapPhep" between '."'".$rangeDate_gpnm_start."'".' AND '."'".$rangeDate_gpnm_end."'".' AND ';
        /*** Tình trạng cấp phép ***/
        if ($status_gpnm == 'all') {
            $querry_data.= '1=1 AND ';
        } else if ($status_gpnm == 'true') {
            $querry_data.= '"tinhTrangGiayPhep" ='."'true' AND ";
        } else {
            $querry_data.= '"tinhTrangGiayPhep" ='."'false' AND ";
        }
        /*** Lưu vực sông khai thác ***/
        if (!isset($_POST["basin_option"])) {
            $querry_data.= '1=1';
        } else {
            $basin_option = $_POST["basin_option"];
            foreach ($basin_option as $i => $value) {
                if ($i > 0) {
                    $querry_data.= ' OR ';
                }
                $querry_data.= '"id_lvs" = '."'".(int)$value."' ";
            }
        }
    } else {
        /*** Range Hết hạn ***/
        $querry_data.= '"ngayHetHan" between '."'".$rangeDate_gpnm_start."'".' AND '."'".$rangeDate_gpnm_end."'".' AND ';
        /*** Tình trạng cấp phép ***/
        if ($status_gpnm == 'all') {
            $querry_data.= '1=1 AND ';
        } else if ($status_gpnm == 'true') {
            $querry_data.= '"tinhTrangGiayPhep" ='."'true' AND ";
        } else {
            $querry_data.= '"tinhTrangGiayPhep" ='."'false' AND ";
        }
        /*** Lưu vực sông khai thác ***/
        if (!isset($_POST["basin_option"])) {
            $querry_data.= '1=1';
        } else {
            $basin_option = $_POST["basin_option"];
            foreach ($basin_option as $i => $value) {
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
            'soGiayPhepNM' => $value['soGiayPhepNM'],
            'ngayCapPhep' => $ngaycapphep_new,
            'thoiHanGiayPhep' => $value['thoiHanGiayPhep'],
            'tenCongTrinh' => $value['tenCongTrinh'],
            'diaChiCongTrinh' => $value['diaChiCongTrinh'],
            /* 'Loaicongtrinh' => $value['Loaicongtrinh'], */
            'mucDich' => $value['moTa'],
            'tongLLKTLonNhatTungThoiKy' => $value['tongLLKTLonNhatTungThoiKy'],
            'toaDoX' => $value['toaDoX'],
            'toaDoY' => $value['toaDoY'],
            'nguonKhaiThac' => $value['nguonKhaiThac'],

            /*--- Thêm các trường để xuất Excel ---*/
            'tensong' => $value['TenSong'],
            'ngayHetHan' => $value['ngayHetHan'],
            'tinhTrangGiayPhep' => $value['tinhTrangGiayPhep'] == 't' ? "Còn hiệu lực" : "Hết hiệu lực"
        );
    }

    $final_data = json_encode($option);
    echo $final_data;
?>
