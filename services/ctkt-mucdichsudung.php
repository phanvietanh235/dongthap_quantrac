<?php
    include "config.php";
?>
<?php
    header('Content-Type: application/json');
    $checked = $_POST["checked"];

    /*---- Theo Đơn vị hành chính ----*/
    if ($checked == "district") {
        $quanhuyen = $_POST["quanhuyen"];
        $phuongxa = $_POST["phuongxa"];

        /*** Danh sách Huyện ***/
        if ($quanhuyen != "none") {
            $querry_districts = 'SELECT ma_dvhc, "tenDVHC" 
                                    FROM "District" WHERE ma_dvhc_cha LIKE ' . "'" . '/87/' . $quanhuyen . "'";
        } else {
            $querry_districts = 'SELECT ma_dvhc, "tenDVHC" 
                                    FROM "District" WHERE ma_dvhc_cha LIKE ' . "'" . '/87/%' . "'";
        }

        $result = pg_query($tiengiang_db, $querry_districts);
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

        /*** DiemKTSD_NDD ***/
        $querry_data_DiemKTSD_NDD = 'SELECT count(diemktsdndd.id) AS "soluongDiemKTSD_NDD", 
                                        district.ma_dvhc_cha, district.ma_dvhc, district."tenDVHC", mucdichktsd.type_mucdich
                                        FROM "DiemKTSD_NDD" diemktsdndd
                                        LEFT JOIN "CT_KTSD" ct_ktsd ON diemktsdndd.ma_congtrinhktsd = ct_ktsd.id
                                        FULL JOIN "District" district ON ct_ktsd.ma_dvhc = district.ma_dvhc
                                        LEFT JOIN "MucDichKTSD" mucdichktsd ON ct_ktsd.ma_mucdichktsd = mucdichktsd.id ';
        $querry_data_DiemKTSD_NDD .= 'WHERE ';
        if ($quanhuyen == "none") {
            $querry_data_DiemKTSD_NDD .= "district.ma_dvhc_cha NOT LIKE" . "'/87/%' AND district.ma_dvhc != 82";
        } else {
            if ($phuongxa == "none") {
                $querry_data_DiemKTSD_NDD .= "district.ma_dvhc_cha LIKE" . "'/" . (int)$quanhuyen . "/%'";
            } else {
                $querry_data_DiemKTSD_NDD .= "district.ma_dvhc =" . "'" . (int)$phuongxa . "'";
            }
        }

        $querry_data_DiemKTSD_NDD .= 'GROUP BY district."tenDVHC", district.ma_dvhc_cha, district.ma_dvhc, mucdichktsd.type_mucdich
                                        ORDER BY district.ma_dvhc_cha';

        $result_DiemKTSD_NDD = pg_query($tiengiang_db, $querry_data_DiemKTSD_NDD);
        if (!$result_DiemKTSD_NDD) {
            echo "Không có dữ liệu.\n";
            exit;
        }

        /*** Chuyển định dạng từ Array sang Json ***/
        $data_DiemKTSD_NDD = array();
        while ($row = pg_fetch_assoc($result_DiemKTSD_NDD)) {
            $data_DiemKTSD_NDD[] = $row;
        }

        $jsonData_DiemKTSD_NDD = json_encode($data_DiemKTSD_NDD);
        $original_data_DiemKTSD_NDD = json_decode($jsonData_DiemKTSD_NDD, true);

        /*** DiemKTSD_NM ***/
        $querry_data_DiemKTSD_NM = 'SELECT count(diemktsdnm.id) AS "soluongDiemKTSD_NM", 
                                        district.ma_dvhc_cha, district.ma_dvhc, district."tenDVHC", mucdichktsd.type_mucdich
                                        FROM "DiemKTSD_NM" diemktsdnm
                                        LEFT JOIN "CT_KTSD" ct_ktsd ON diemktsdnm.ma_congtrinhktsd = ct_ktsd.id
                                        FULL JOIN "District" district ON ct_ktsd.ma_dvhc = district.ma_dvhc
                                        LEFT JOIN "MucDichKTSD" mucdichktsd ON ct_ktsd.ma_mucdichktsd = mucdichktsd.id ';
        $querry_data_DiemKTSD_NM .= 'WHERE ';
        if ($quanhuyen == "none") {
            $querry_data_DiemKTSD_NM .= "district.ma_dvhc_cha NOT LIKE" . "'/87/%' AND district.ma_dvhc != 82";
        } else {
            if ($phuongxa == "none") {
                $querry_data_DiemKTSD_NM .= "district.ma_dvhc_cha LIKE" . "'/" . (int)$quanhuyen . "/%'";
            } else {
                $querry_data_DiemKTSD_NM .= "district.ma_dvhc =" . "'" . (int)$phuongxa . "'";
            }
        }

        $querry_data_DiemKTSD_NM .= 'GROUP BY district."tenDVHC", district.ma_dvhc_cha, district.ma_dvhc, mucdichktsd.type_mucdich
                                        ORDER BY district.ma_dvhc_cha';

        $result_DiemKTSD_NM = pg_query($tiengiang_db, $querry_data_DiemKTSD_NM);
        if (!$result_DiemKTSD_NM) {
            echo "Không có dữ liệu.\n";
            exit;
        }

        /*** Chuyển định dạng từ Array sang Json ***/
        $data_DiemKTSD_NM = array();
        while ($row = pg_fetch_assoc($result_DiemKTSD_NM)) {
            $data_DiemKTSD_NM[] = $row;
        }

        $jsonData_DiemKTSD_NM = json_encode($data_DiemKTSD_NM);
        $original_data_DiemKTSD_NM = json_decode($jsonData_DiemKTSD_NM, true);

        /*** Push Sum Collumn ***/
        $result_quanhuyen = array();
        $tongTram = 0;
        $tongDiemKTSD_NM_tuoi = 0;
        $tongDiemKTSD_NM_thuydien = 0;
        $tongDiemKTSD_NM_sinhhoat = 0;
        $tongDiemKTSD_NM_khac = 0;
        $tongDiemKTSD_NDD_tuoi = 0;
        $tongDiemKTSD_NDD_thuydien = 0;
        $tongDiemKTSD_NDD_sinhhoat = 0;
        $tongDiemKTSD_NDD_khac = 0;
        foreach ($original_data_DiemKTSD_NDD as $key => $value) {
            if ($value['type_mucdich'] == "Tưới") {
                $tongDiemKTSD_NDD_tuoi += (int)$value['soluongDiemKTSD_NDD'];
            } else if ($value['type_mucdich'] == "Thủy điện") {
                $tongDiemKTSD_NDD_thuydien += (int)$value['soluongDiemKTSD_NDD'];
            } else if ($value['type_mucdich'] == "Sinh hoạt") {
                $tongDiemKTSD_NDD_sinhhoat += (int)$value['soluongDiemKTSD_NDD'];
            } else {
                $tongDiemKTSD_NDD_khac += (int)$value['soluongDiemKTSD_NDD'];
            }
        }
        foreach ($original_data_DiemKTSD_NM as $key => $value) {
            if ($value['type_mucdich'] == "Tưới") {
                $tongDiemKTSD_NM_tuoi += (int)$value['soluongDiemKTSD_NM'];
            } else if ($value['type_mucdich'] == "Thủy điện") {
                $tongDiemKTSD_NM_thuydien += (int)$value['soluongDiemKTSD_NM'];
            } else if ($value['type_mucdich'] == "Sinh hoạt") {
                $tongDiemKTSD_NM_sinhhoat += (int)$value['soluongDiemKTSD_NM'];
            } else {
                $tongDiemKTSD_NM_khac += (int)$value['soluongDiemKTSD_NM'];
            }
        }

        $tongTram = $tongDiemKTSD_NM_tuoi + $tongDiemKTSD_NM_thuydien + $tongDiemKTSD_NM_sinhhoat + $tongDiemKTSD_NM_khac +
            $tongDiemKTSD_NDD_tuoi + $tongDiemKTSD_NDD_thuydien + $tongDiemKTSD_NDD_sinhhoat + $tongDiemKTSD_NDD_khac;

        $result_quanhuyen[] = array(
            'id' => "#",
            'soluongDiemKTSD_NDD_tuoi' => $tongDiemKTSD_NDD_tuoi,
            'thuydien' => $tongDiemKTSD_NDD_thuydien + $tongDiemKTSD_NM_thuydien,
            'soluongDiemKTSD_NDD_sinhhoat' => $tongDiemKTSD_NDD_sinhhoat,
            'soluongDiemKTSD_NDD_khac' => $tongDiemKTSD_NDD_khac,
            'soluongDiemKTSD_NM_tuoi' => $tongDiemKTSD_NM_tuoi,
            'soluongDiemKTSD_NM_sinhhoat' => $tongDiemKTSD_NM_sinhhoat,
            'soluongDiemKTSD_NM_khac' => $tongDiemKTSD_NM_khac,
            'tongsotram' => $tongTram,
            'filter' => "Tổng",
        );

        /*** Sum theo từng Quận/Huyện ***/
        foreach ($original_data as $key => $value) {
            $tong_ndd_tuoi = 0;
            $tong_ndd_thuydien = 0;
            $tong_ndd_sinhhoat = 0;
            $tong_ndd_khac = 0;
            $tong_nm_tuoi = 0;
            $tong_nm_thuydien = 0;
            $tong_nm_sinhhoat = 0;
            $tong_nm_khac = 0;
            foreach ($original_data_DiemKTSD_NDD as $key_NDD => $value_NDD) {
                if ($value["ma_dvhc"] == explode("/", $value_NDD["ma_dvhc_cha"])[1]) {
                    if ($value_NDD['type_mucdich'] == "Tưới") {
                        $tong_ndd_tuoi += (int)$value_NDD["soluongDiemKTSD_NDD"];
                    } else if ($value_NDD['type_mucdich'] == "Thủy điện") {
                        $tong_ndd_thuydien += (int)$value_NDD["soluongDiemKTSD_NDD"];
                    } else if ($value_NDD['type_mucdich'] == "Sinh hoạt") {
                        $tong_ndd_sinhhoat += (int)$value_NDD["soluongDiemKTSD_NDD"];
                    } else {
                        $tong_ndd_khac += (int)$value_NDD["soluongDiemKTSD_NDD"];
                    }
                }
            }
            foreach ($original_data_DiemKTSD_NM as $key_NM => $value_NM) {
                if ($value["ma_dvhc"] == explode("/", $value_NM["ma_dvhc_cha"])[1]) {
                    if ($value_NM['type_mucdich'] == "Tưới") {
                        $tong_nm_tuoi += (int)$value_NM["soluongDiemKTSD_NM"];
                    } else if ($value_NM['type_mucdich'] == "Thủy điện") {
                        $tong_nm_thuydien += (int)$value_NM["soluongDiemKTSD_NM"];
                    } else if ($value_NM['type_mucdich'] == "Sinh hoạt") {
                        $tong_nm_sinhhoat += (int)$value_NM["soluongDiemKTSD_NM"];
                    } else {
                        $tong_nm_khac += (int)$value_NM["soluongDiemKTSD_NM"];
                    }
                }
            }

            $result_quanhuyen[] = array(
                'quanhuyen' => true,
                'soluongDiemKTSD_NDD_tuoi' => $tong_ndd_tuoi,
                'thuydien' => $tong_ndd_thuydien + $tong_nm_thuydien,
                'soluongDiemKTSD_NDD_sinhhoat' => $tong_ndd_sinhhoat,
                'soluongDiemKTSD_NDD_khac' => $tong_ndd_khac,
                'soluongDiemKTSD_NM_tuoi' => $tong_nm_tuoi,
                'soluongDiemKTSD_NM_sinhhoat' => $tong_nm_sinhhoat,
                'soluongDiemKTSD_NM_khac' => $tong_nm_khac,
                'tongsotram' => $tong_ndd_tuoi + $tong_ndd_thuydien + $tong_ndd_sinhhoat + $tong_ndd_khac +
                    $tong_nm_tuoi + $tong_nm_thuydien + $tong_nm_sinhhoat + $tong_nm_khac,
                'filter' => $value['tenDVHC'],
            );

            /*** Push Phường/Xã ***/
            $length = 0;
            if (count($data_DiemKTSD_NDD) > count($data_DiemKTSD_NM)) {
                $length = count($data_DiemKTSD_NDD);
            } else {
                $length = count($data_DiemKTSD_NM);
            }
            for ($i = 0; $i < $length; $i++) {
                if ($value["ma_dvhc"] == explode("/", $data_DiemKTSD_NDD[$i]["ma_dvhc_cha"])[1]) {
                    $result_quanhuyen[] = array(
                        'quanhuyen' => false,
                        'soluongDiemKTSD_NDD_tuoi' => @$data_DiemKTSD_NDD[$i]['type_mucdich'] == 'Tưới' ? @(int)$data_DiemKTSD_NDD[$i]['soluongDiemKTSD_NDD'] : 0,
                        'thuydien' => (@$data_DiemKTSD_NDD[$i]['type_mucdich'] == 'Thủy điện' ? @(int)$data_DiemKTSD_NDD[$i]['soluongDiemKTSD_NDD'] : 0) +
                            (@$data_DiemKTSD_NM[$i]['type_mucdich'] == 'Thủy điện' ? @(int)$data_DiemKTSD_NM[$i]['soluongDiemKTSD_NM'] : 0),

                        'soluongDiemKTSD_NDD_sinhhoat' => @$data_DiemKTSD_NDD[$i]['type_mucdich'] == 'Sinh hoạt' ? @(int)$data_DiemKTSD_NDD[$i]['soluongDiemKTSD_NDD'] : 0,
                        'soluongDiemKTSD_NDD_khac' => @$data_DiemKTSD_NDD[$i]['type_mucdich'] == 'Mục đích khác' ? @(int)$data_DiemKTSD_NDD[$i]['soluongDiemKTSD_NDD'] : 0,

                        'soluongDiemKTSD_NM_tuoi' => @$data_DiemKTSD_NM[$i]['type_mucdich'] == 'Tưới' ? @(int)$data_DiemKTSD_NM[$i]['soluongDiemKTSD_NM'] : 0,
                        'soluongDiemKTSD_NM_sinhhoat' => @$data_DiemKTSD_NM[$i]['type_mucdich'] == 'Sinh hoạt' ? @(int)$data_DiemKTSD_NM[$i]['soluongDiemKTSD_NM'] : 0,
                        'soluongDiemKTSD_NM_khac' => @$data_DiemKTSD_NM[$i]['type_mucdich'] == 'Mục đích khác' ? @(int)$data_DiemKTSD_NM[$i]['soluongDiemKTSD_NM'] : 0,

                        'tongsotram' => (@$data_DiemKTSD_NDD[$i]['type_mucdich'] == 'Tưới' ? @(int)$data_DiemKTSD_NDD[$i]['soluongDiemKTSD_NDD'] : 0) +
                            (@$data_DiemKTSD_NDD[$i]['type_mucdich'] == 'Thủy điện' ? @(int)$data_DiemKTSD_NDD[$i]['soluongDiemKTSD_NDD'] : 0) +
                            (@$data_DiemKTSD_NDD[$i]['type_mucdich'] == 'Sinh hoạt' ? @(int)$data_DiemKTSD_NDD[$i]['soluongDiemKTSD_NDD'] : 0) +
                            (@$data_DiemKTSD_NDD[$i]['type_mucdich'] == 'Mục đích khác' ? @(int)$data_DiemKTSD_NDD[$i]['soluongDiemKTSD_NDD'] : 0) +
                            (@$data_DiemKTSD_NM[$i]['type_mucdich'] == 'Tưới' ? @(int)$data_DiemKTSD_NM[$i]['soluongDiemKTSD_NM'] : 0) +
                            (@$data_DiemKTSD_NM[$i]['type_mucdich'] == 'Thủy điện' ? @(int)$data_DiemKTSD_NM[$i]['soluongDiemKTSD_NM'] : 0) +
                            (@$data_DiemKTSD_NM[$i]['type_mucdich'] == 'Sinh hoạt' ? @(int)$data_DiemKTSD_NM[$i]['soluongDiemKTSD_NM'] : 0) +
                            (@$data_DiemKTSD_NM[$i]['type_mucdich'] == 'Mục đích khác' ? @(int)$data_DiemKTSD_NM[$i]['soluongDiemKTSD_NM'] : 0),

                        'filter' => @$data_DiemKTSD_NDD[$i]["tenDVHC"],
                    );
                }
            }
        }

        $final_data = json_encode($result_quanhuyen);
        echo $final_data;

    /*---- Theo Tầng chứa nước ----*/
    } else if ($checked == "waterfloor") {
        /*** DiemKTSD_NDD ***/
        $querry_data_DiemKTSD_NDD = 'SELECT count(diemktsdndd.id) AS "soluongDiemKTSD_NDD", 
                                        tangchuanuoc.name AS "TangChuaNuoc", tangchuanuoc.id, mucdichktsd.type_mucdich
                                        FROM "DiemKTSD_NDD" diemktsdndd
                                        FULL JOIN "TangChuaNuoc" tangchuanuoc ON 
                                            diemktsdndd.ma_tangchuanuoc = tangchuanuoc.id
                                        LEFT JOIN "CT_KTSD" ct_ktsd ON diemktsdndd.ma_congtrinhktsd = ct_ktsd.id
                                        LEFT JOIN "MucDichKTSD" mucdichktsd ON ct_ktsd.ma_mucdichktsd = mucdichktsd.id ';
        $querry_data_DiemKTSD_NDD .= 'WHERE ';
        if ($_POST["tangchuanuoc"] == "all") {
            $querry_data_DiemKTSD_NDD .= '1=1 ';
        } else {
            $tangchuanuoc = $_POST["tangchuanuoc"];
            foreach ($tangchuanuoc as $i => $value) {
                if ($i > 0) {
                    $querry_data_DiemKTSD_NDD .= ' OR ';
                }
                $querry_data_DiemKTSD_NDD .= "tangchuanuoc.id = '" . (int)$value . "' ";
            }
        }
        $querry_data_DiemKTSD_NDD .= 'GROUP BY tangchuanuoc.name, tangchuanuoc.id, mucdichktsd.type_mucdich
                                        ORDER BY tangchuanuoc.name';

        $result_DiemKTSD_NDD = pg_query($tiengiang_db, $querry_data_DiemKTSD_NDD);
        if (!$result_DiemKTSD_NDD) {
            echo "Không có dữ liệu.\n";
            exit;
        }

        /*** Chuyển định dạng từ Array sang Json ***/
        $data_DiemKTSD_NDD = array();
        while ($row = pg_fetch_assoc($result_DiemKTSD_NDD)) {
            $data_DiemKTSD_NDD[] = $row;
        }

        $jsonData_DiemKTSD_NDD = json_encode($data_DiemKTSD_NDD);
        $original_data_DiemKTSD_NDD = json_decode($jsonData_DiemKTSD_NDD, true);
        $option_DiemKTSD_NDD = array();
        /*** Push Sum Collumn ***/
        $tongTram = 0;
        $tongDiemKTSD_NDD_tuoi = 0;
        $tongDiemKTSD_NDD_thuydien = 0;
        $tongDiemKTSD_NDD_sinhhoat = 0;
        $tongDiemKTSD_NDD_khac = 0;
        foreach ($original_data_DiemKTSD_NDD as $key => $value) {
            if ($value['type_mucdich'] == "Tưới") {
                $tongDiemKTSD_NDD_tuoi += (int)$value['soluongDiemKTSD_NDD'];
            } else if ($value['type_mucdich'] == "Thủy điện") {
                $tongDiemKTSD_NDD_thuydien += (int)$value['soluongDiemKTSD_NDD'];
            } else if ($value['type_mucdich'] == "Sinh hoạt") {
                $tongDiemKTSD_NDD_sinhhoat += (int)$value['soluongDiemKTSD_NDD'];
            } else {
                $tongDiemKTSD_NDD_khac += (int)$value['soluongDiemKTSD_NDD'];
            }
        }

        $tongTram = $tongDiemKTSD_NDD_tuoi + $tongDiemKTSD_NDD_thuydien + $tongDiemKTSD_NDD_sinhhoat + $tongDiemKTSD_NDD_khac;
        $option_DiemKTSD_NDD[] = array(
            'soluongDiemKTSD_NDD_tuoi' => $tongDiemKTSD_NDD_tuoi,
            'thuydien' => $tongDiemKTSD_NDD_thuydien,
            'soluongDiemKTSD_NDD_sinhhoat' => $tongDiemKTSD_NDD_sinhhoat,
            'soluongDiemKTSD_NDD_khac' => $tongDiemKTSD_NDD_khac,
            'tongsotram' => $tongTram,
            'filter' => "Tổng",
            'soluongDiemKTSD_NM_tuoi' => 0,
            'soluongDiemKTSD_NM_sinhhoat' => 0,
            'soluongDiemKTSD_NM_khac' => 0
        );

        foreach ($original_data_DiemKTSD_NDD as $key => $value) {
            $option_DiemKTSD_NDD[] = array(
                'soluongDiemKTSD_NDD_tuoi' => $value['type_mucdich'] == 'Tưới' ? (int)$value['soluongDiemKTSD_NDD'] : 0,
                'thuydien' => $value['type_mucdich'] == 'Thủy điện' ? (int)$value['soluongDiemKTSD_NDD'] : 0,
                'soluongDiemKTSD_NDD_sinhhoat' => $value['type_mucdich'] == 'Sinh hoạt' ? (int)$value['soluongDiemKTSD_NDD'] : 0,
                'soluongDiemKTSD_NDD_khac' => $value['type_mucdich'] == 'Mục đích khác' ? (int)$value['soluongDiemKTSD_NDD'] : 0,
                'tongsotram' => ($value['type_mucdich'] == 'Tưới' ? (int)$value['soluongDiemKTSD_NDD'] : 0) +
                    ($value['type_mucdich'] == 'Thủy điện' ? (int)$value['soluongDiemKTSD_NDD'] : 0) +
                    ($value['type_mucdich'] == 'Sinh hoạt' ? (int)$value['soluongDiemKTSD_NDD'] : 0) +
                    ($value['type_mucdich'] == 'Mục đích khác' ? (int)$value['soluongDiemKTSD_NDD'] : 0),
                'filter' => $value['TangChuaNuoc'],
                'soluongDiemKTSD_NM_tuoi' => 0,
                'soluongDiemKTSD_NM_sinhhoat' => 0,
                'soluongDiemKTSD_NM_khac' => 0
            );
        }

        $final_data = json_encode($option_DiemKTSD_NDD);
        echo $final_data;

    /*---- Theo Lưu vực sông ----*/
    } else {
        /*** DiemKTSD_NM ***/
        $querry_data_DiemKTSD_NM = 'SELECT count(diemktsdnm.id) AS "soluongDiemKTSD_NM", 
                                        basin.name AS "basin", basin.id, mucdichktsd.type_mucdich
                                        FROM "DiemKTSD_NM" diemktsdnm
                                        FULL JOIN "Basin" basin ON diemktsdnm.ma_luuvucsong = basin.id
                                        LEFT JOIN "CT_KTSD" ct_ktsd ON diemktsdnm.ma_congtrinhktsd = ct_ktsd.id
                                        LEFT JOIN "MucDichKTSD" mucdichktsd ON ct_ktsd.ma_mucdichktsd = mucdichktsd.id ';
        $querry_data_DiemKTSD_NM .= 'WHERE ';
        if ($_POST["luuvucsong"] == "all") {
            $querry_data_DiemKTSD_NM .= '1=1 ';
        } else {
            $basin = $_POST["luuvucsong"];
            foreach ($basin as $i => $value) {
                if ($i > 0) {
                    $querry_data_DiemKTSD_NM .= ' OR ';
                }
                $querry_data_DiemKTSD_NM .= "basin.id = '" . (int)$value . "' ";
            }
        }
        $querry_data_DiemKTSD_NM .= 'GROUP BY basin.name, basin.id, mucdichktsd.type_mucdich
                                        ORDER BY basin.name';

        $result_DiemKTSD_NM = pg_query($tiengiang_db, $querry_data_DiemKTSD_NM);
        if (!$result_DiemKTSD_NM) {
            echo "Không có dữ liệu.\n";
            exit;
        }

        /*** Chuyển định dạng từ Array sang Json ***/
        $data_DiemKTSD_NM = array();
        while ($row = pg_fetch_assoc($result_DiemKTSD_NM)) {
            $data_DiemKTSD_NM[] = $row;
        }

        $jsonData_DiemKTSD_NM = json_encode($data_DiemKTSD_NM);
        $original_data_DiemKTSD_NM = json_decode($jsonData_DiemKTSD_NM, true);
        $option_DiemKTSD_NM = array();
        /*** Push Sum Collumn ***/
        $tongTram = 0;
        $tongDiemKTSD_NM_tuoi = 0;
        $tongDiemKTSD_NM_thuydien = 0;
        $tongDiemKTSD_NM_sinhhoat = 0;
        $tongDiemKTSD_NM_khac = 0;
        foreach ($original_data_DiemKTSD_NM as $key => $value) {
            if ($value['type_mucdich'] == "Tưới") {
                $tongDiemKTSD_NM_tuoi += (int)$value['soluongDiemKTSD_NM'];
            } else if ($value['type_mucdich'] == "Thủy điện") {
                $tongDiemKTSD_NM_thuydien += (int)$value['soluongDiemKTSD_NM'];
            } else if ($value['type_mucdich'] == "Sinh hoạt") {
                $tongDiemKTSD_NM_sinhhoat += (int)$value['soluongDiemKTSD_NM'];
            } else {
                $tongDiemKTSD_NM_khac += (int)$value['soluongDiemKTSD_NM'];
            }
        }

        $tongTram = $tongDiemKTSD_NM_tuoi + $tongDiemKTSD_NM_thuydien + $tongDiemKTSD_NM_sinhhoat + $tongDiemKTSD_NM_khac;
        $option_DiemKTSD_NM[] = array(
            'soluongDiemKTSD_NM_tuoi' => $tongDiemKTSD_NM_tuoi,
            'thuydien' => $tongDiemKTSD_NM_thuydien,
            'soluongDiemKTSD_NM_sinhhoat' => $tongDiemKTSD_NM_sinhhoat,
            'soluongDiemKTSD_NM_khac' => $tongDiemKTSD_NM_khac,
            'tongsotram' => $tongTram,
            'filter' => "Tổng",
            'soluongDiemKTSD_NDD_tuoi' => 0,
            'soluongDiemKTSD_NDD_sinhhoat' => 0,
            'soluongDiemKTSD_NDD_khac' => 0
        );

        foreach ($original_data_DiemKTSD_NM as $key => $value) {
            $option_DiemKTSD_NM[] = array(
                'soluongDiemKTSD_NM_tuoi' => $value['type_mucdich'] == 'Tưới' ? (int)$value['soluongDiemKTSD_NM'] : 0,
                'thuydien' => $value['type_mucdich'] == 'Thủy điện' ? (int)$value['soluongDiemKTSD_NM'] : 0,
                'soluongDiemKTSD_NM_sinhhoat' => $value['type_mucdich'] == 'Sinh hoạt' ? (int)$value['soluongDiemKTSD_NM'] : 0,
                'soluongDiemKTSD_NM_khac' => $value['type_mucdich'] == 'Mục đích khác' ? (int)$value['soluongDiemKTSD_NM'] : 0,
                'tongsotram' => ($value['type_mucdich'] == 'Tưới' ? (int)$value['soluongDiemKTSD_NM'] : 0) +
                    ($value['type_mucdich'] == 'Thủy điện' ? (int)$value['soluongDiemKTSD_NM'] : 0) +
                    ($value['type_mucdich'] == 'Sinh hoạt' ? (int)$value['soluongDiemKTSD_NM'] : 0) +
                    ($value['type_mucdich'] == 'Mục đích khác' ? (int)$value['soluongDiemKTSD_NM'] : 0),
                'filter' => $value['basin'],
                'soluongDiemKTSD_NDD_tuoi' => 0,
                'soluongDiemKTSD_NDD_sinhhoat' => 0,
                'soluongDiemKTSD_NDD_khac' => 0
            );
        }

        $final_data = json_encode($option_DiemKTSD_NM);
        echo $final_data;
    }
?>
