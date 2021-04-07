<?php
include "../config.php"
?>
<?php
header('Content-Type:application/json');
/*---- Thông tin ----*/
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

/*---- POST Send Data ----*/
$sohieu = $_POST["sohieu"];
$quanhuyen = $_POST["quanhuyen"];
$phuongxa = $_POST["phuongxa"];
$ctkt = $_POST["ctkt"];
$tinhtrang_giengdiem = $_POST["tinhtrang_giengdiem"];
$ten_ct = $_POST["ten_ct"];
$diachi_ct = $_POST["diachi_ct"];

/*---- Thông tin Danh sách công trình KTSD NM ----*/
$querry_data = 'SELECT * FROM list_all_station ';
$querry_data .= 'WHERE llcp_num < 200 AND ';
$querry_data .= '"soHieu" ILIKE ' . "'%" . $sohieu . "%'" . ' AND ';
$querry_data .= '"ten_ct" ILIKE ' . "'%" . $ten_ct . "%'" . ' AND ';
$querry_data .= '"diachi_ct" ILIKE ' . "'%" . $diachi_ct . "%'" . ' AND ';

/*** Quận huyện, Phường xã ***/
$quanhuyen = $_POST["quanhuyen"];
if ($quanhuyen == "none") {
    $querry_data .= '1=1 AND ';
} else {
    $phuongxa = $_POST["phuongxa"];
    if ($phuongxa == "none") {
        $querry_data .= 'ma_dvhc_cha LIKE ' . "'%" . $quanhuyen . "%'" . ' AND ';
    } else {
        $querry_data .= 'ma_dvhc_cha = ' . "'/" . $quanhuyen . "/" . $phuongxa . "'" . ' AND ';
    }
}

/*** Tầng chứa nước ***/
if ($_POST["tangchuanuoc"] == 'all') {
    $querry_data .= '1=1 AND ';
} else {
    $tangchuanuoc = $_POST["tangchuanuoc"];
    $querry_data .= '"tangchuanuoc_id" = ' . "'" . (int)$tangchuanuoc . "' AND ";
}

/*** Lưu vực sông ***/
if ($_POST["basin_option"] == 'all') {
    $querry_data .= '1=1 AND ';
} else {
    $basin_option = $_POST["basin_option"];
    $querry_data .= '"luuvucsong_id" = ' . "'" . (int)$basin_option . "' AND ";
}

/*** Công trình khai thác sử dụng ***/
if ($ctkt == 'none') {
    $querry_data .= '1=1 AND ';
} else {
    $querry_data .= '"maLoaiCongTrinh" = ' . (int)$ctkt . ' AND ';
}

/*** Tình trạng giếng điểm ***/
if ($tinhtrang_giengdiem == 'none') {
    $querry_data .= '1=1';
} else if ($tinhtrang_giengdiem == 'true') {
    $querry_data .= '"TinhTrang" =' . "'true'";
} else {
    $querry_data .= '"TinhTrang" =' . "'false'";
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

/*** Push Option ***/
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
$option = array();
foreach ($original_data as $key => $value) {
    $option[] = array(
        'STT' => $key + 1,
        "id" => $value['id'],
        "sohieu" => $value['soHieu'],
        "quanhuyen" => gen_Huyen($value["ma_dvhc_cha"], $original_data_district),
        "phuongxa" => $value['tenDVHC'],
        "id_ct" => $value['id_ct'],
        "type_ct" => $value['type_ct'],
        "ten_ct" => $value['ten_ct'],
        "diachi_ct" => $value['diachi_ct'],
        "loai_ct" => $value['LoaiCongTrinh'],
        /* "doanhnghiep" => $value['doanhnghiep_name'], */
        "tinhtrang" => $value['TinhTrang'] == 't' ? "Còn hoạt động" : "Không hoạt động/Đã trám lấp"
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
