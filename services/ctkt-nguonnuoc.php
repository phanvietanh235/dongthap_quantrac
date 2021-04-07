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
                                    district.ma_dvhc_cha, district.ma_dvhc, district."tenDVHC"
                                    FROM "DiemKTSD_NDD" diemktsdndd
                                    LEFT JOIN "CT_KTSD" ct_ktsd ON diemktsdndd.ma_congtrinhktsd = ct_ktsd.id
                                    FULL JOIN "District" district ON ct_ktsd.ma_dvhc = district.ma_dvhc ';
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

    $querry_data_DiemKTSD_NDD .= 'GROUP BY district."tenDVHC", district.ma_dvhc_cha, district.ma_dvhc
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
                                    district.ma_dvhc_cha, district.ma_dvhc, district."tenDVHC"
                                    FROM "DiemKTSD_NM" diemktsdnm
                                    LEFT JOIN "CT_KTSD" ct_ktsd ON diemktsdnm.ma_congtrinhktsd = ct_ktsd.id
                                    FULL JOIN "District" district ON ct_ktsd.ma_dvhc = district.ma_dvhc ';
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

    $querry_data_DiemKTSD_NM .= 'GROUP BY district."tenDVHC", district.ma_dvhc_cha, district.ma_dvhc
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
    $tongDiemKTSD_NDD = 0;
    $tongDiemKTSD_NM = 0;
    foreach ($original_data_DiemKTSD_NDD as $key => $value) {
        $tongDiemKTSD_NDD += (int)$value['soluongDiemKTSD_NDD'];
        $tongTram += (int)$value['soluongDiemKTSD_NDD'];
    }
    foreach ($original_data_DiemKTSD_NM as $key => $value) {
        $tongDiemKTSD_NM += (int)$value['soluongDiemKTSD_NM'];
        $tongTram += (int)$value['soluongDiemKTSD_NM'];
    }

    $result_quanhuyen[] = array(
        'id' => "#",
        'soluongDiemKTSD_NDD' => $tongDiemKTSD_NDD,
        'soluongDiemKTSD_NM' => $tongDiemKTSD_NM,
        'tongsotram' => $tongTram,
        'filter' => "Tổng",
    );

    /*** Sum theo từng Quận/Huyện ***/
    foreach ($original_data as $key => $value) {
        $tong_ndd = 0;
        $tong_nm = 0;
        foreach ($original_data_DiemKTSD_NDD as $key_NDD => $value_NDD) {
            if ($value["ma_dvhc"] == explode("/", $value_NDD["ma_dvhc_cha"])[1]) {
                $tong_ndd += (int)$value_NDD["soluongDiemKTSD_NDD"];
            }
        }
        foreach ($original_data_DiemKTSD_NM as $key_NM => $value_NM) {
            if ($value["ma_dvhc"] == explode("/", $value_NM["ma_dvhc_cha"])[1]) {
                $tong_nm += (int)$value_NM["soluongDiemKTSD_NM"];
            }
        }

        $result_quanhuyen[] = array(
            'quanhuyen' => true,
            'soluongDiemKTSD_NDD' => $tong_ndd,
            'soluongDiemKTSD_NM' => $tong_nm,
            'tongsotram' => $tong_ndd + $tong_nm,
            'filter' => $value['tenDVHC'],
        );

        /*** Push Phường/Xã ***/
        for ($i = 0; $i < count($data_DiemKTSD_NDD); $i++) {
            if ($value["ma_dvhc"] == explode("/", $data_DiemKTSD_NDD[$i]["ma_dvhc_cha"])[1]) {
                $result_quanhuyen[] = array(
                    'quanhuyen' => false,
                    'soluongDiemKTSD_NDD' => (int)$data_DiemKTSD_NDD[$i]["soluongDiemKTSD_NDD"],
                    'soluongDiemKTSD_NM' => (int)$data_DiemKTSD_NM[$i]["soluongDiemKTSD_NM"],
                    'tongsotram' => (int)$data_DiemKTSD_NDD[$i]["soluongDiemKTSD_NDD"] + (int)$data_DiemKTSD_NM[$i]["soluongDiemKTSD_NM"],
                    'filter' => $data_DiemKTSD_NDD[$i]["tenDVHC"],
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
                                    tangchuanuoc.name AS "TangChuaNuoc", tangchuanuoc.id
                                    FROM "DiemKTSD_NDD" diemktsdndd
                                    FULL JOIN "TangChuaNuoc" tangchuanuoc ON 
                                        diemktsdndd.ma_tangchuanuoc = tangchuanuoc.id ';
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
    $querry_data_DiemKTSD_NDD .= 'GROUP BY tangchuanuoc.name, tangchuanuoc.id
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
    $tongDiemKTSD_NDD = 0;
    foreach ($original_data_DiemKTSD_NDD as $key => $value) {
        $tongDiemKTSD_NDD += (int)$value['soluongDiemKTSD_NDD'];
        $tongTram += (int)$value['soluongDiemKTSD_NDD'];
    }
    $option_DiemKTSD_NDD[] = array(
        'soluongDiemKTSD_NDD' => $tongDiemKTSD_NDD,
        'soluongDiemKTSD_NM' => 0,
        'tongsotram' => $tongTram,
        'filter' => "Tổng",
    );

    foreach ($original_data_DiemKTSD_NDD as $key => $value) {
        $option_DiemKTSD_NDD[] = array(
            'soluongDiemKTSD_NDD' => (int)$value['soluongDiemKTSD_NDD'],
            'soluongDiemKTSD_NM' => 0,
            'tongsotram' => (int)$value['soluongDiemKTSD_NDD'],
            'filter' => $value['TangChuaNuoc'],
        );
    }

    $final_data = json_encode($option_DiemKTSD_NDD);
    echo $final_data;

    /*---- Theo Lưu vực sông ----*/
} else {
    /*** DiemKTSD_NM ***/
    $querry_data_DiemKTSD_NM = 'SELECT count(diemktsdnm.id) AS "soluongDiemKTSD_NM", 
                                    basin.name AS "TenLVS", basin.id
                                    FROM "DiemKTSD_NM" diemktsdnm
                                    FULL JOIN "Basin" basin ON 
                                        diemktsdnm.ma_luuvucsong = basin.id ';
    $querry_data_DiemKTSD_NM .= 'WHERE ';
    if ($_POST["tangchuanuoc"] == "all") {
        $querry_data_DiemKTSD_NM .= '1=1 ';
    } else {
        $luuvucsong = $_POST["luuvucsong"];
        foreach ($luuvucsong as $i => $value) {
            if ($i > 0) {
                $querry_data_DiemKTSD_NM .= ' OR ';
            }
            $querry_data_DiemKTSD_NM .= "basin.id = '" . (int)$value . "' ";
        }
    }
    $querry_data_DiemKTSD_NM .= 'GROUP BY basin.name, basin.id
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
    $tongDiemKTSD_NM = 0;
    foreach ($original_data_DiemKTSD_NM as $key => $value) {
        $tongDiemKTSD_NM += (int)$value['soluongDiemKTSD_NM'];
        $tongTram += (int)$value['soluongDiemKTSD_NM'];
    }
    $option_DiemKTSD_NM[] = array(
        'soluongDiemKTSD_NDD' => 0,
        'soluongDiemKTSD_NM' => $tongDiemKTSD_NM,
        'tongsotram' => $tongTram,
        'filter' => "Tổng",
    );

    foreach ($original_data_DiemKTSD_NM as $key => $value) {
        $option_DiemKTSD_NM[] = array(
            'soluongDiemKTSD_NDD' => 0,
            'soluongDiemKTSD_NM' => (int)$value['soluongDiemKTSD_NM'],
            'tongsotram' => (int)$value['soluongDiemKTSD_NM'],
            'filter' => $value['TenLVS'],
        );
    }

    $final_data = json_encode($option_DiemKTSD_NM);
    echo $final_data;
}
?>
