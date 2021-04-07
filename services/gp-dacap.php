<?php
include "config.php"
?>
<?php
header('Content-Type: application/json');
/*---- Thông tin cấp phép NDD ----*/
$querry_ndd = 'SELECT count(thongtincp_ndd.id), DVCP.type_dvcp
                    FROM "ThongTinCP_NDD" thongtincp_ndd
                    FULL JOIN "DonViCapPhep" DVCP on thongtincp_ndd.ma_donvicapphep = DVCP.id
                    GROUP BY DVCP.type_dvcp';
$result_ndd = pg_query($tiengiang_db, $querry_ndd);
if (!$result_ndd) {
    echo "Không có dữ liệu.\n";
    exit;
}

/*** Chuyển định dạng từ Array sang Json ***/
$data_ndd = array();
while ($row = pg_fetch_assoc($result_ndd)) {
    $data_ndd[] = $row;
}

$jsonData_ndd = json_encode($data_ndd);
$original_data_ndd = json_decode($jsonData_ndd, true);
/*---- Thông tin cấp phép NM ----*/
$querry_nm = 'SELECT count(thongtincp_nm.id), DVCP.type_dvcp
                    FROM "ThongTinCP_NM" thongtincp_nm
                    FULL JOIN "DonViCapPhep" DVCP on thongtincp_nm.ma_donvicapphep = DVCP.id
                    GROUP BY DVCP.type_dvcp';
$result_nm = pg_query($tiengiang_db, $querry_nm);
if (!$result_nm) {
    echo "Không có dữ liệu.\n";
    exit;
}

/*** Chuyển định dạng từ Array sang Json ***/
$data_nm = array();
while ($row = pg_fetch_assoc($result_nm)) {
    $data_nm[] = $row;
}

$jsonData_nm = json_encode($data_nm);
$original_data_nm = json_decode($jsonData_nm, true);
/*---- Thông tin cấp phép XT ----*/
$querry_xt = 'SELECT count(thongtincp_xt.id), DVCP.type_dvcp
                    FROM "ThongTinCP_XT" thongtincp_xt
                    FULL JOIN "DonViCapPhep" DVCP on thongtincp_xt.ma_donvicapphep = DVCP.id
                    GROUP BY DVCP.type_dvcp';
$result_xt = pg_query($tiengiang_db, $querry_xt);
if (!$result_xt) {
    echo "Không có dữ liệu.\n";
    exit;
}

/*** Chuyển định dạng từ Array sang Json ***/
$data_xt = array();
while ($row = pg_fetch_assoc($result_xt)) {
    $data_xt[] = $row;
}

$jsonData_xt = json_encode($data_xt);
$original_data_xt = json_decode($jsonData_xt, true);
/*---- Thông tin cấp phép TD ----*/
$querry_td = 'SELECT count(thongtincp_td.id), DVCP.type_dvcp
                    FROM "ThongTinCP_TD" thongtincp_td
                    FULL JOIN "DonViCapPhep" DVCP on thongtincp_td.ma_donvicapphep = DVCP.id
                    GROUP BY DVCP.type_dvcp';
$result_td = pg_query($tiengiang_db, $querry_td);
if (!$result_td) {
    echo "Không có dữ liệu.\n";
    exit;
}

/*** Chuyển định dạng từ Array sang Json ***/
$data_td = array();
while ($row = pg_fetch_assoc($result_td)) {
    $data_td[] = $row;
}

$jsonData_td = json_encode($data_td);
$original_data_td = json_decode($jsonData_td, true);

/*** Push Array ***/
$option = array();
$option[] = array(
    'loaigiayphep' => 'Khai thác nước dưới đất',
    'count_tw' => $original_data_ndd[0]["type_dvcp"] == "Trung ương" ? $original_data_ndd[0]["count"] : 0,
    'count_dp' => $original_data_ndd[0]["type_dvcp"] == "Địa phương" ? $original_data_ndd[0]["count"] : 0,
    'count' => ($original_data_nm[0]["type_dvcp"] == "Trung ương" ? $original_data_nm[0]["count"] : 0) +
        ($original_data_ndd[0]["type_dvcp"] == "Địa phương" ? $original_data_ndd[0]["count"] : 0),
);
$option[] = array(
    'loaigiayphep' => 'Khai thác nước mặt',
    'count_tw' => $original_data_nm[0]["type_dvcp"] == "Trung ương" ? $original_data_nm[0]["count"] : 0,
    'count_dp' => $original_data_nm[0]["type_dvcp"] == "Địa phương" ? $original_data_nm[0]["count"] : 0,
    'count' => ($original_data_nm[0]["type_dvcp"] == "Trung ương" ? $original_data_nm[0]["count"] : 0) +
        ($original_data_nm[0]["type_dvcp"] == "Địa phương" ? $original_data_nm[0]["count"] : 0),
);
$option[] = array(
    'loaigiayphep' => 'Thăm dò nước dưới đất',
    'count_tw' => $original_data_td[0]["type_dvcp"] == "Trung ương" ? $original_data_td[0]["count"] : 0,
    'count_dp' => $original_data_td[0]["type_dvcp"] == "Địa phương" ? $original_data_td[0]["count"] : 0,
    'count' => ($original_data_td[0]["type_dvcp"] == "Trung ương" ? $original_data_td[0]["count"] : 0) +
        ($original_data_td[0]["type_dvcp"] == "Địa phương" ? $original_data_td[0]["count"] : 0),
);
$option[] = array(
    'loaigiayphep' => 'Xả nước thải vào nguồn nước',
    'count_tw' => $original_data_xt[0]["type_dvcp"] == "Trung ương" ? $original_data_xt[0]["count"] : 0,
    'count_dp' => $original_data_xt[0]["type_dvcp"] == "Địa phương" ? $original_data_xt[0]["count"] : 0,
    'count' => ($original_data_xt[0]["type_dvcp"] == "Trung ương" ? $original_data_xt[0]["count"] : 0) +
        ($original_data_xt[0]["type_dvcp"] == "Địa phương" ? $original_data_xt[0]["count"] : 0),
);

$final_data = json_encode($option);
echo $final_data;
?>
