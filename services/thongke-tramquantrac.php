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

    /*** GiengQT_NDD ***/
    $querry_data_GiengQT_NDD = 'SELECT count(giengqtndd.id) AS "soluongGiengQT_NDD", 
                                    district.ma_dvhc_cha, district.ma_dvhc, district."tenDVHC"
                                    FROM "GiengQT_NDD" giengqtndd
                                    LEFT JOIN "CT_KTSD" ct_ktsd ON giengqtndd.ma_congtrinhktsd = ct_ktsd.id
                                    FULL JOIN "District" district ON ct_ktsd.ma_dvhc = district.ma_dvhc ';
    $querry_data_GiengQT_NDD .= 'WHERE ';
    if ($quanhuyen == "none") {
        $querry_data_GiengQT_NDD .= "district.ma_dvhc_cha NOT LIKE" . "'/87/%' AND district.ma_dvhc != 82";
    } else {
        if ($phuongxa == "none") {
            $querry_data_GiengQT_NDD .= "district.ma_dvhc_cha LIKE" . "'/" . (int)$quanhuyen . "/%'";
        } else {
            $querry_data_GiengQT_NDD .= "district.ma_dvhc =" . "'" . (int)$phuongxa . "'";
        }
    }

    $querry_data_GiengQT_NDD .= 'GROUP BY district."tenDVHC", district.ma_dvhc_cha, district.ma_dvhc
                                    ORDER BY district.ma_dvhc_cha';

    $result_GiengQT_NDD = pg_query($tiengiang_db, $querry_data_GiengQT_NDD);
    if (!$result_GiengQT_NDD) {
        echo "Không có dữ liệu.\n";
        exit;
    }

    /*** Chuyển định dạng từ Array sang Json ***/
    $data_GiengQT_NDD = array();
    while ($row = pg_fetch_assoc($result_GiengQT_NDD)) {
        $data_GiengQT_NDD[] = $row;
    }

    $jsonData_GiengQT_NDD = json_encode($data_GiengQT_NDD);
    $original_data_GiengQT_NDD = json_decode($jsonData_GiengQT_NDD, true);

    /*** Push Sum Collumn ***/
    $result_giengQT_NDD_quanhuyen = array();
    $tongTram = 0;
    $tongGiengQT_NDD = 0;
    $tongDiemQT_NM = 0;
    foreach ($original_data_GiengQT_NDD as $key => $value) {
        $tongGiengQT_NDD += (int)$value['soluongGiengQT_NDD'];
        $tongTram += (int)$value['soluongGiengQT_NDD'];
    }
    $result_giengQT_NDD_quanhuyen[] = array(
        'id' => "#",
        'soluongGiengQT_NDD' => $tongGiengQT_NDD,
        /* 'soluongDiemQT_NM' => 0, */
        'tongsotram' => $tongTram,
        'filter' => "Tổng",
    );

    /*** Sum theo từng Quận/Huyện ***/
    foreach ($original_data as $key => $value) {
        $tong = 0;
        foreach ($original_data_GiengQT_NDD as $key_NDD => $value_NDD) {
            if ($value["ma_dvhc"] == explode("/", $value_NDD["ma_dvhc_cha"])[1]) {
                $tong += (int)$value_NDD["soluongGiengQT_NDD"];
            }
        }
        $result_giengQT_NDD_quanhuyen[] = array(
            'quanhuyen' => true,
            'soluongGiengQT_NDD' => $tong,
            /* 'soluongDiemQT_NM' => 0, */
            'tongsotram' => $tong,
            'filter' => $value['tenDVHC'],
        );
        /*** Push Phường/Xã ***/
        foreach ($original_data_GiengQT_NDD as $key_NDD => $value_NDD) {
            if ($value["ma_dvhc"] == explode("/", $value_NDD["ma_dvhc_cha"])[1]) {
                $result_giengQT_NDD_quanhuyen[] = array(
                    'quanhuyen' => false,
                    'soluongGiengQT_NDD' => (int)$value_NDD['soluongGiengQT_NDD'],
                    /* 'soluongDiemQT_NM' => 0, */
                    'tongsotram' => (int)$value_NDD['soluongGiengQT_NDD'],
                    'filter' => $value_NDD['tenDVHC'],
                );
            }
        }
    }

    $final_data = json_encode($result_giengQT_NDD_quanhuyen);
    echo $final_data;

    /*---- Theo Tầng chứa nước ----*/
} else {
    /*** GiengQT_NDD ***/
    $querry_data_GiengQT_NDD = 'SELECT count(giengqtndd.id) AS "soluongGiengQT_NDD", 
                                    tangchuanuoc.name AS "TangChuaNuoc", tangchuanuoc.id
                                    FROM "GiengQT_NDD" giengqtndd
                                    FULL JOIN "TangChuaNuoc" tangchuanuoc ON 
                                        giengqtndd.ma_tangchuanuoc = tangchuanuoc.id ';
    $querry_data_GiengQT_NDD .= 'WHERE ';
    if ($_POST["tangchuanuoc"] == "all") {
        $querry_data_GiengQT_NDD .= '1=1 ';
    } else {
        $tangchuanuoc = $_POST["tangchuanuoc"];
        foreach ($tangchuanuoc as $i => $value) {
            if ($i > 0) {
                $querry_data_GiengQT_NDD .= ' OR ';
            }
            $querry_data_GiengQT_NDD .= "tangchuanuoc.id = '" . (int)$value . "' ";
        }
    }
    $querry_data_GiengQT_NDD .= 'GROUP BY tangchuanuoc.name, tangchuanuoc.id
                                    ORDER BY tangchuanuoc.name';

    $result_GiengQT_NDD = pg_query($tiengiang_db, $querry_data_GiengQT_NDD);
    if (!$result_GiengQT_NDD) {
        echo "Không có dữ liệu.\n";
        exit;
    }

    /*** Chuyển định dạng từ Array sang Json ***/
    $data_GiengQT_NDD = array();
    while ($row = pg_fetch_assoc($result_GiengQT_NDD)) {
        $data_GiengQT_NDD[] = $row;
    }

    $jsonData_GiengQT_NDD = json_encode($data_GiengQT_NDD);
    $original_data_GiengQT_NDD = json_decode($jsonData_GiengQT_NDD, true);
    $option_GiengQT_NDD = array();
    /*** Push Sum Collumn ***/
    $tongTram = 0;
    $tongGiengQT_NDD = 0;
    $tongDiemQT_NM = 0;
    foreach ($original_data_GiengQT_NDD as $key => $value) {
        $tongGiengQT_NDD += (int)$value['soluongGiengQT_NDD'];
        $tongTram += (int)$value['soluongGiengQT_NDD'];
    }
    $option_GiengQT_NDD[] = array(
        'soluongGiengQT_NDD' => $tongGiengQT_NDD,
        'tongsotram' => $tongTram,
        'filter' => "Tổng",
    );

    foreach ($original_data_GiengQT_NDD as $key => $value) {
        $option_GiengQT_NDD[] = array(
            'soluongGiengQT_NDD' => (int)$value['soluongGiengQT_NDD'],
            'tongsotram' => (int)$value['soluongGiengQT_NDD'],
            'filter' => $value['TangChuaNuoc'],
        );
    }

    $final_data = json_encode($option_GiengQT_NDD);
    echo $final_data;
}
?>
