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

/*** Querry Feature DiemXT, CT_KTSD và ThongTinCP_XT ***/
$querry_feat = 'SELECT * FROM feat_ktsd_xt';
/* $querry_feat = 'SELECT diem.*, vung.geom
                FROM feat_ktsd_xt AS diem
                JOIN dph_4326 AS vung
                ON ST_Contains(vung.geom, ST_GeomFromText(diem.latlng, 4326))'; */
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
    /*** Xử lý ma_dvhc_cha ***/
    $id_huyen = explode("/", $tenDVHC)[1];
    foreach ($original_data as $key => $value) {
        if ($id_huyen == $value["ma_dvhc"]) {
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
            'type' => "xt",
            'idgieng' => $value['idgieng'],
            'huyen' => gen_Huyen($value["ma_dvhc_cha"], $original_data_district),
            'xa' => $value['tenDVHC'],
            'toadoX' => $value['toaDoY'],
            'toadoY' => $value['toaDoX'],
            /*---- DiemXT ----*/
            'sohieu_gieng' => $value['soHieuDiem'],
            'tendoanhnghiep' => $value['TenDoanhNghiep'],
            'chedo' => $value['cheDoXT'],
            'luuluong' => $value['luuLuongXT'],
            'tinhtrang_gieng' => $value['tinhtrangxathai'],
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
