<?php
include "config.php"
?>
<?php
header('Content-Type: application/json');
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

/*** TienCapQuyen_NDD ***/
$querry_data_TienCapQuyen_NDD = 'SELECT count(tiencqndd.id) AS "soluong_TienCapQuyen_NDD",
                                            sum(tiencqndd."tongTienNop") AS "tongTienNop_NDD",
                                            district.ma_dvhc_cha, district.ma_dvhc, district."tenDVHC", donvicapphep.type_dvcp
                                            FROM "TienCapQuyen_NDD" tiencqndd
                                            LEFT JOIN "ThongTinCP_NDD" thongtincpndd ON tiencqndd.ma_giayphepndd = thongtincpndd.id
                                            FULL JOIN "DonViCapPhep" donvicapphep on thongtincpndd.ma_donvicapphep = donvicapphep.id
                                            LEFT JOIN "CT_KTSD" ct_ktsd ON thongtincpndd.ma_congtrinhktsd = ct_ktsd.id
                                            FULL JOIN "District" district ON ct_ktsd.ma_dvhc = district.ma_dvhc ';
$querry_data_TienCapQuyen_NDD .= 'WHERE ';
if ($quanhuyen == "none") {
    $querry_data_TienCapQuyen_NDD .= "district.ma_dvhc_cha NOT LIKE" . "'/87/%' AND district.ma_dvhc != 82";
} else {
    if ($phuongxa == "none") {
        $querry_data_TienCapQuyen_NDD .= "district.ma_dvhc_cha LIKE" . "'/" . (int)$quanhuyen . "/%'";
    } else {
        $querry_data_TienCapQuyen_NDD .= "district.ma_dvhc =" . "'" . (int)$phuongxa . "'";
    }
}

$querry_data_TienCapQuyen_NDD .= 'GROUP BY district."tenDVHC", district.ma_dvhc_cha, district.ma_dvhc, donvicapphep.type_dvcp
                                      ORDER BY district.ma_dvhc_cha';

$result_TienCapQuyen_NDD = pg_query($tiengiang_db, $querry_data_TienCapQuyen_NDD);
if (!$result_TienCapQuyen_NDD) {
    echo "Không có dữ liệu.\n";
    exit;
}

/*** Chuyển định dạng từ Array sang Json ***/
$data_TienCapQuyen_NDD = array();
while ($row = pg_fetch_assoc($result_TienCapQuyen_NDD)) {
    $data_TienCapQuyen_NDD[] = $row;
}

$jsonData_TienCapQuyen_NDD = json_encode($data_TienCapQuyen_NDD);
$original_data_TienCapQuyen_NDD = json_decode($jsonData_TienCapQuyen_NDD, true);

/*** TienCapQuyen_NM ***/
$querry_data_TienCapQuyen_NM = 'SELECT count(tiencqnn.id) AS "soluong_TienCapQuyen_NM",
                                            sum(tiencqnn."tongTienNop") AS "tongTienNop_NM",
                                            district.ma_dvhc_cha, district.ma_dvhc, district."tenDVHC", donvicapphep.type_dvcp
                                            FROM "TienCapQuyen_NM" tiencqnn
                                            LEFT JOIN "ThongTinCP_NM" thongtincpnm ON tiencqnn.ma_giayphepnm = thongtincpnm.id
                                            FULL JOIN "DonViCapPhep" donvicapphep on thongtincpnm.ma_donvicapphep = donvicapphep.id
                                            LEFT JOIN "CT_KTSD" ct_ktsd ON thongtincpnm.ma_congtrinhktsd = ct_ktsd.id
                                            FULL JOIN "District" district ON ct_ktsd.ma_dvhc = district.ma_dvhc ';
$querry_data_TienCapQuyen_NM .= 'WHERE ';
if ($quanhuyen == "none") {
    $querry_data_TienCapQuyen_NM .= "district.ma_dvhc_cha NOT LIKE" . "'/87/%' AND district.ma_dvhc != 82";
} else {
    if ($phuongxa == "none") {
        $querry_data_TienCapQuyen_NM .= "district.ma_dvhc_cha LIKE" . "'/" . (int)$quanhuyen . "/%'";
    } else {
        $querry_data_TienCapQuyen_NM .= "district.ma_dvhc =" . "'" . (int)$phuongxa . "'";
    }
}

$querry_data_TienCapQuyen_NM .= 'GROUP BY district."tenDVHC", district.ma_dvhc_cha, district.ma_dvhc, donvicapphep.type_dvcp
                                          ORDER BY district.ma_dvhc_cha';

$result_TienCapQuyen_NM = pg_query($tiengiang_db, $querry_data_TienCapQuyen_NM);
if (!$result_TienCapQuyen_NM) {
    echo "Không có dữ liệu.\n";
    exit;
}

/*** Chuyển định dạng từ Array sang Json ***/
$data_TienCapQuyen_NM = array();
while ($row = pg_fetch_assoc($result_TienCapQuyen_NM)) {
    $data_TienCapQuyen_NM[] = $row;
}

$jsonData_TienCapQuyen_NM = json_encode($data_TienCapQuyen_NM);
$original_data_TienCapQuyen_NM = json_decode($jsonData_TienCapQuyen_NM, true);

/*** Push Sum Collumn ***/
$result_quanhuyen = array();
$tongTram_tw = 0;
$tongTram_dp = 0;
$tongTram = 0;
$tongTien = 0;

$tongTram_NDD_tw = 0;
$tongTram_NDD_dp = 0;
$tongTram_NM_tw = 0;
$tongTram_NM_dp = 0;

$tongSoTien_NDD_tw = 0;
$tongSoTien_NDD_dp = 0;
$tongSoTien_NM_tw = 0;
$tongSoTien_NM_dp = 0;

foreach ($original_data_TienCapQuyen_NDD as $key => $value) {
    if ($value['type_dvcp'] == "Địa phương") {
        $tongTram_NDD_dp += (int)$value['soluong_TienCapQuyen_NDD'];
        $tongSoTien_NDD_dp += (int)$value['tongTienNop_NDD'];
    } else {
        $tongTram_NDD_tw += (int)$value['soluong_TienCapQuyen_NDD'];
        $tongSoTien_NDD_tw += (int)$value['tongTienNop_NDD'];
    }
}

foreach ($original_data_TienCapQuyen_NM as $key => $value) {
    if ($value['type_dvcp'] == "Địa phương") {
        $tongTram_NM_dp += (int)$value['soluong_TienCapQuyen_NM'];
        $tongSoTien_NM_dp += (int)$value['tongTienNop_NM'];
    } else {
        $tongTram_NM_tw += (int)$value['soluong_TienCapQuyen_NM'];
        $tongSoTien_NM_tw += (int)$value['tongTienNop_NM'];
    }
}

$tongTram_tw = $tongTram_NDD_tw + $tongTram_NM_tw;
$tongTram_dp = $tongTram_NDD_dp + $tongTram_NM_dp;
$tongTram = $tongTram_NDD_tw + $tongTram_NM_tw + $tongTram_NDD_dp + $tongTram_NM_dp;
$tongTien = $tongSoTien_NDD_tw + $tongSoTien_NDD_dp + $tongSoTien_NM_tw + $tongSoTien_NM_dp;

$result_quanhuyen[] = array(
    'id' => "#",
    'tongTram_tw' => $tongTram_tw,
    'tongTram_dp' => $tongTram_dp,
    'tongTram' => $tongTram,
    'tongTien' => $tongTien,
    'filter' => "Tổng"
);

/*** Sum theo từng Quận/Huyện ***/
foreach ($original_data as $key => $value) {
    $tongtram_ndd_tw = 0;
    $tongtram_ndd_dp = 0;
    $tongtram_nm_tw = 0;
    $tongtram_nm_dp = 0;

    $tongsotien_ndd_tw = 0;
    $tongsotien_ndd_dp = 0;
    $tongsotien_nm_tw = 0;
    $tongsotien_nm_dp = 0;

    foreach ($original_data_TienCapQuyen_NDD as $key_NDD => $value_NDD) {
        if ($value["ma_dvhc"] == explode("/", $value_NDD["ma_dvhc_cha"])[1]) {
            if ($value_NDD['type_dvcp'] == "Địa phương") {
                $tongtram_ndd_dp += (int)$value_NDD["soluong_TienCapQuyen_NDD"];
                $tongsotien_ndd_dp += (int)$value_NDD['tongTienNop_NDD'];
            } else {
                $tongtram_ndd_tw += (int)$value_NDD["soluong_TienCapQuyen_NDD"];
                $tongsotien_ndd_tw += (int)$value_NDD['tongTienNop_NDD'];
            }
        }
    }
    foreach ($original_data_TienCapQuyen_NM as $key_NM => $value_NM) {
        if ($value["ma_dvhc"] == explode("/", $value_NM["ma_dvhc_cha"])[1]) {
            if ($value_NM['type_dvcp'] == "Địa phương") {
                $tongtram_nm_dp += (int)$value_NM["soluong_TienCapQuyen_NM"];
                $tongsotien_nm_dp += (int)$value_NM['tongTienNop_NM'];
            } else {
                $tongtram_nm_tw += (int)$value_NM["soluong_TienCapQuyen_NM"];
                $tongsotien_nm_tw += (int)$value_NM['tongTienNop_NM'];
            }
        }
    }

    $result_quanhuyen[] = array(
        'quanhuyen' => true,
        'tongTram_tw' => $tongtram_nm_tw + $tongtram_ndd_tw,
        'tongTram_dp' => $tongtram_nm_dp + $tongtram_ndd_dp,
        'tongTram' => $tongtram_nm_tw + $tongtram_ndd_tw + $tongtram_nm_dp + $tongtram_ndd_dp,
        'tongTien' => $tongsotien_nm_tw + $tongsotien_nm_dp + $tongsotien_ndd_tw + $tongsotien_ndd_dp,
        'filter' => $value['tenDVHC'],
    );

    /*** Push Phường/Xã ***/
    for ($i = 0; $i < count($data_TienCapQuyen_NDD); $i++) {
        if ($value["ma_dvhc"] == explode("/", $data_TienCapQuyen_NDD[$i]["ma_dvhc_cha"])[1]) {
            $result_quanhuyen[] = array(
                'quanhuyen' => false,
                'tongTram_tw' => ($data_TienCapQuyen_NDD[$i]['type_dvcp'] == 'Địa phương' ? (int)$data_TienCapQuyen_NDD[$i]['soluong_TienCapQuyen_NDD'] : 0) +
                    ($data_TienCapQuyen_NM[$i]['type_dvcp'] == 'Địa phương' ? (int)$data_TienCapQuyen_NM[$i]['soluong_TienCapQuyen_NM'] : 0),

                'tongTram_dp' => ($data_TienCapQuyen_NDD[$i]['type_dvcp'] == 'Trung ương' ? (int)$data_TienCapQuyen_NDD[$i]['soluong_TienCapQuyen_NDD'] : 0) +
                    ($data_TienCapQuyen_NM[$i]['type_dvcp'] == 'Trung ương' ? (int)$data_TienCapQuyen_NM[$i]['soluong_TienCapQuyen_NM'] : 0),

                'tongTram' => ($data_TienCapQuyen_NDD[$i]['type_dvcp'] == 'Địa phương' ? (int)$data_TienCapQuyen_NDD[$i]['soluong_TienCapQuyen_NDD'] : 0) +
                    ($data_TienCapQuyen_NM[$i]['type_dvcp'] == 'Địa phương' ? (int)$data_TienCapQuyen_NM[$i]['soluong_TienCapQuyen_NM'] : 0) +
                    ($data_TienCapQuyen_NDD[$i]['type_dvcp'] == 'Trung ương' ? (int)$data_TienCapQuyen_NDD[$i]['soluong_TienCapQuyen_NDD'] : 0) +
                    ($data_TienCapQuyen_NM[$i]['type_dvcp'] == 'Trung ương' ? (int)$data_TienCapQuyen_NM[$i]['soluong_TienCapQuyen_NM'] : 0),

                'tongTien' => ($data_TienCapQuyen_NDD[$i]['type_dvcp'] == 'Địa phương' ? (int)$data_TienCapQuyen_NDD[$i]['tongTienNop_NDD'] : 0) +
                    ($data_TienCapQuyen_NM[$i]['type_dvcp'] == 'Địa phương' ? (int)$data_TienCapQuyen_NM[$i]['tongTienNop_NM'] : 0) +
                    ($data_TienCapQuyen_NDD[$i]['type_dvcp'] == 'Trung ương' ? (int)$data_TienCapQuyen_NDD[$i]['tongTienNop_NDD'] : 0) +
                    ($data_TienCapQuyen_NM[$i]['type_dvcp'] == 'Trung ương' ? (int)$data_TienCapQuyen_NM[$i]['tongTienNop_NM'] : 0),

                'filter' => @$data_TienCapQuyen_NDD[$i]["tenDVHC"],
            );
        }
    }
}
$final_data = json_encode($result_quanhuyen);
echo $final_data;
?>
