<?php
include "../config.php"
?>
<?php
header('Content-Type: application/json');
/*---- Thông tin Quận/Huyện ----*/
$querry_districts = 'SELECT ma_dvhc, "tenDVHC" 
                        FROM "District" WHERE ma_dvhc_cha LIKE ' . "'" . '/87/%' . "'";
$result_districts = pg_query($tiengiang_db, $querry_districts);
if (!$result_districts) {
    echo "Không có dữ liệu.\n";
    exit;
}

/*** Chuyển định dạng từ Array sang Json ***/
$data_districts = array();
while ($row = pg_fetch_assoc($result_districts)) {
    $data_districts[] = $row;
}
$jsonData_districts = json_encode($data_districts);
$original_data_district = json_decode($jsonData_districts, true);

$querry_feat = 'SELECT * FROM sample_feature_pois';

$result = pg_query($tiengiang_db, $querry_feat);
if (!$result) {
    echo "Không có dữ liệu.\n";
    exit;
}

/*** Chuyển định dạng từ Array sang Json ***/
$data = array();
while ($row = pg_fetch_assoc($result)) {
    $data[] = $row;
}

/*** Generating Huyện ***/
function gen_Huyen($tenDVHC, $original_data)
{
    foreach ($original_data as $key => $value) {
        if ($tenDVHC == $value["ma_dvhc"]) {
            return $value["tenDVHC"];
        }
    }
}

$jsonData = json_encode($data);
$original_data = json_decode($jsonData, true);
$features = array();
foreach ($original_data as $key => $value) {
    $features[] = array(
        'type' => 'Feature',
        'properties' => array(
            'idgieng' => $value['kyhieu_mau'],
            'huyen' => gen_Huyen($value["ma_dvhc"], $original_data_district),
            'toadoX' => $value['toado_Y'],
            'toadoY' => $value['toado_X'],

            'vitri_mau' => $value['vitri_mau'],
            'ngaylay_mau' => $value['ngaylay_mau'],
            'khoiluong' => $value['khoiluong'],
            'ma_loaiquantrac' => $value['ma_loaiquantrac'],
            'LoaiQuanTrac' => $value['LoaiQuanTrac']
        ),
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => array(
                /*** Cắt chuỗi POINT để lấy tọa độ ***/
                floatval(explode("POINT(", explode(" ", $value['latlng'])[0])[1]),
                floatval(explode(" ", $value['latlng'])[1])
            ),
        ),
    );
}
$new_data = array(
    'type' => 'FeatureCollection',
    'features' => $features,
);
ob_start('ob_gzhandler');
$final_data = json_encode($new_data);
echo $final_data;
?>
