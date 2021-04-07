<?php
include "../config.php"
?>
<?php
header('Content-Type:application/json');
/*---- Thông tin  ----*/
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
$tencongtrinh = $_POST["tencongtrinh"];
$doanhnghiep = $_POST["doanhnghiep"];
$sogiayphep = $_POST["sogiayphep"];
$diachi_ct = $_POST["diachi_ct"];
$coso_sanxuat = $_POST["coso_sanxuat"];
$nam_xd = $_POST["nam_xd"];

/*---- Thông tin Danh sách công trình KTSD xt ----*/
$querry_data = 'SELECT * FROM list_ktsd_xt ';
$querry_data .= 'WHERE ';
$querry_data .= '("tenCongTrinh" IS NULL OR "tenCongTrinh" ILIKE ' . "'%" . $tencongtrinh . "%'" . ') AND ';

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

$querry_data .= '("tenDoanhNghiep" IS NULL OR "tenDoanhNghiep" ILIKE ' . "'%" . $doanhnghiep . "%'" . ') AND ';
$querry_data .= '("soGiayPhepXT" IS NULL OR "soGiayPhepXT" ILIKE ' . "'%" . $sogiayphep . "%'" . ') AND ';
$querry_data .= '("diaChiCongTrinh" IS NULL OR "diaChiCongTrinh" ILIKE ' . "'%" . $diachi_ct . "%'" . ') AND ';
$querry_data .= '("coSoKTSD" IS NULL OR "coSoKTSD" ILIKE ' . "'%" . $coso_sanxuat . "%'" . ') AND ';
$querry_data .= '("namXDVH" IS NULL OR "namXDVH" ILIKE ' . "'%" . $nam_xd . "%'" . ')';

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
        '#' => $key + 1,
        "macongtrinh" => $value['ma_ctkt'],
        "tencongtrinh" => $value['tenCongTrinh'],
        "diachi_ct" => $value['diaChiCongTrinh'],
        "quanhuyen" => gen_Huyen($value["ma_dvhc_cha"], $original_data_district),
        "doanhnghiep" => $value['tenDoanhNghiep'],
        "diachidoanhnghiep" => $value['diaChiDoanhNghiep'],
        "sogiayphep" => $value['soGiayPhepXT'],
        "phuongxa" => $value['tenDVHC'],
        "coso_sanxuat" => $value['coSoKTSD'],
        "nam_xd" => $value['namXDVH']
    );
}

$final_data = json_encode($option);
echo $final_data;
?>

