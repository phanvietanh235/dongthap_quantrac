<?php
include "../config.php"
?>
<?php
header('Content-Type: application/json');
$tencongtrinh = $_GET["tencongtrinh"];
$giayphep = $_GET["giayphep"];
$doanhnghiep = $_GET["doanhnghiep"];
$loaicongtrinh = $_GET["loaicongtrinh"];
$district = $_GET["district"];

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

/*** Select All Feat Point ***/
/* if ($loaicongtrinh == 'none') { */

/*** DiemKTSD_NM ***/
/* } else */ if ($loaicongtrinh == 1) {
    $query_option = "SELECT diem.*, vung.geom
                    FROM feat_ktsd_nm AS diem
                    JOIN dph_4326 AS vung
                    ON ST_Contains(vung.geom, ST_GeomFromText(diem.latlng, 4326)) ";
    $query_option .= " WHERE ";
    $query_option .= '(diem."tenCongTrinh" IS NULL OR diem."tenCongTrinh" ILIKE ' . "'%" . $tencongtrinh . "%'" . ') AND ';

    if ($district == "none") {
        $query_option .= '1=1 AND ';
    } else {
        $query_option .= 'diem.ma_dvhc_cha LIKE ' . "'%" . $district . "%'" . ' AND ';
    }

    $query_option .= '(diem."TenDoanhNghiep" IS NULL OR diem."TenDoanhNghiep" ILIKE ' . "'%" . $doanhnghiep . "%'" . ') AND ';
    $query_option .= '(diem."soGiayPhepNM" IS NULL OR diem."soGiayPhepNM" ILIKE ' . "'%" . $giayphep . "%'" . ')';

    $result = pg_query($tiengiang_db, $query_option);
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
    $features = array();
    foreach ($original_data as $key => $value) {
        $features[] = array(
            'type' => 'Feature',
            'properties' => array(
                'type' => "ktsd_nm",
                'idgieng' => $value['idgieng'],
                'huyen' => gen_Huyen($value["ma_dvhc_cha"], $original_data_district),
                'xa' => $value['tenDVHC'],
                'toadoX' => $value['toaDoY'],
                'toadoY' => $value['toaDoX'],
                /*---- DiemKTSD_NM ----*/
                'sohieu_gieng' => $value['soHieuDiem'],
                'tendoanhnghiep' => $value['TenDoanhNghiep'],
                'chedo' => $value['cheDoKT'],
                'luuluong' => $value['luuLuongKTLN'],
                'tinhtrang_gieng' => $value['tinhtrangkhaithac'],
                'vung_baoho' => $value['vungBHVS']
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

    /*** DiemKTSD_NDD ***/
} else if ($loaicongtrinh == 2) {
    $query_option = "SELECT diem.*, vung.geom
                    FROM feat_ktsd_ndd AS diem
                    JOIN dph_4326 AS vung
                    ON ST_Contains(vung.geom, ST_GeomFromText(diem.latlng, 4326)) ";
    $query_option .= " WHERE ";
    $query_option .= '(diem."tenCongTrinh" IS NULL OR diem."tenCongTrinh" ILIKE ' . "'%" . $tencongtrinh . "%'" . ') AND ';

    if ($district == "none") {
        $query_option .= '1=1 AND ';
    } else {
        $query_option .= 'diem.ma_dvhc_cha LIKE ' . "'%" . $district . "%'" . ' AND ';
    }

    $query_option .= '(diem."TenDoanhNghiep" IS NULL OR diem."TenDoanhNghiep" ILIKE ' . "'%" . $doanhnghiep . "%'" . ') AND ';
    $query_option .= '(diem."soGiayPhepNDD" IS NULL OR diem."soGiayPhepNDD" ILIKE ' . "'%" . $giayphep . "%'" . ')';

    $result = pg_query($tiengiang_db, $query_option);
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
    $features = array();
    foreach ($original_data as $key => $value) {
        $features[] = array(
            'type' => 'Feature',
            'properties' => array(
                'type' => "ktsd_ndd",
                'idgieng' => $value['idgieng'],
                'huyen' => gen_Huyen($value["ma_dvhc_cha"], $original_data_district),
                'xa' => $value['tenDVHC'],
                'toadoX' => $value['toaDoY'],
                'toadoY' => $value['toaDoX'],
                /*---- DiemKTSD_NDD ----*/
                'sohieu_gieng' => $value['soHieuGieng'],
                'tendoanhnghiep' => $value['TenDoanhNghiep'],
                'chedo' => $value['cheDoKhaiThac'],
                'luuluong' => $value['luuLuongKTCP'],
                'tinhtrang_gieng' => $value['tinhTrangGieng'],
                'vung_baoho' => $value['vungBHVS']
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

    /*** DiemTD_NDD ***/
} else if ($loaicongtrinh == 3) {
    $query_option = "SELECT diem.*, vung.geom
                    FROM feat_ktsd_td AS diem
                    JOIN dph_4326 AS vung
                    ON ST_Contains(vung.geom, ST_GeomFromText(diem.latlng, 4326)) ";
    $query_option .= " WHERE ";
    $query_option .= '(diem."tenCongTrinh" IS NULL OR diem."tenCongTrinh" ILIKE ' . "'%" . $tencongtrinh . "%'" . ') AND ';

    if ($district == "none") {
        $query_option .= '1=1 AND ';
    } else {
        $query_option .= 'diem.ma_dvhc_cha LIKE ' . "'%" . $district . "%'" . ' AND ';
    }

    $query_option .= '(diem."TenDoanhNghiep" IS NULL OR diem."TenDoanhNghiep" ILIKE ' . "'%" . $doanhnghiep . "%'" . ') AND ';
    $query_option .= '(diem."soGiayPhepTD" IS NULL OR diem."soGiayPhepTD" ILIKE ' . "'%" . $giayphep . "%'" . ')';

    $result = pg_query($tiengiang_db, $query_option);
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
    $features = array();
    foreach ($original_data as $key => $value) {
        $features[] = array(
            'type' => 'Feature',
            'properties' => array(
                'type' => "td",
                'idgieng' => $value['idgieng'],
                'huyen' => gen_Huyen($value["ma_dvhc_cha"], $original_data_district),
                'xa' => $value['tenDVHC'],
                'toadoX' => $value['toaDoY'],
                'toadoY' => $value['toaDoX'],
                /*---- DiemTD_NDD ----*/
                'sohieu_gieng' => $value['soHieuGiengTD'] == null ? "" : $value['soHieuGiengTD'],
                'tendoanhnghiep' => $value['TenDoanhNghiep'],
                'chieusau' => $value['chieuSauDuKienTD'] == null ? "Chưa cập nhật dữ liệu" : $value['chieuSauDuKienTD'],
                'soluong' => $value['soLuongGiengTD'] == null ? "Chưa cập nhật dữ liệu" : $value['soLuongGiengTD'],
                'tinhtrang_gieng' => $value['tinhtrangthamdo'],
                'vung_baoho' => $value['vungBHVS']
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

    /*** DiemXT ***/
} else if ($loaicongtrinh == 4) {
    $query_option = "SELECT diem.*, vung.geom
                    FROM feat_ktsd_xt AS diem
                    JOIN dph_4326 AS vung
                    ON ST_Contains(vung.geom, ST_GeomFromText(diem.latlng, 4326)) ";
    $query_option .= " WHERE ";
    $query_option .= '(diem."tenCongTrinh" IS NULL OR diem."tenCongTrinh" ILIKE ' . "'%" . $tencongtrinh . "%'" . ') AND ';

    if ($district == "none") {
        $query_option .= '1=1 AND ';
    } else {
        $query_option .= 'diem.ma_dvhc_cha LIKE ' . "'%" . $district . "%'" . ' AND ';
    }

    $query_option .= '(diem."TenDoanhNghiep" IS NULL OR diem."TenDoanhNghiep" ILIKE ' . "'%" . $doanhnghiep . "%'" . ') AND ';
    $query_option .= '(diem."soGiayPhepXT" IS NULL OR diem."soGiayPhepXT" ILIKE ' . "'%" . $giayphep . "%'" . ')';

    $result = pg_query($tiengiang_db, $query_option);
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
?>
