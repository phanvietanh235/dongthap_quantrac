<?php
include "config.php"
?>
<?php
header('Content-Type: application/json');
/*---- Thông tin Quận/Huyện ----*/
$querry_districts = 'SELECT ma_dvhc, "tenDVHC" 
                                    FROM "District" WHERE ma_dvhc_cha LIKE ' . "'" . '/87/%' . "'";
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

/*---- Thông tin DiemKTSD_NDD ----*/
$querry_ndd = 'SELECT ctktsd."tenCongTrinh", tangchuanuoc.name "TangChuaNuoc", 
                        district."tenDVHC", district.ma_dvhc, district.ma_dvhc_cha
                        FROM "DiemKTSD_NDD" diemktsdndd
                        LEFT JOIN "CT_KTSD" ctktsd ON diemktsdndd.ma_congtrinhktsd = ctktsd.id
                        LEFT JOIN "District" district on ctktsd.ma_dvhc = district.ma_dvhc
                        LEFT JOIN "TangChuaNuoc" tangchuanuoc on diemktsdndd.ma_tangchuanuoc = tangchuanuoc.id';

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

/*---- Thông tin DiemKTSD_NM ----*/
$querry_nm = 'SELECT ctktsd."tenCongTrinh",
                            district."tenDVHC", district.ma_dvhc, 
                            district.ma_dvhc_cha, basin.name "TenLVS"
                            FROM "DiemKTSD_NM" diemktsdnm
                            LEFT JOIN "CT_KTSD" ctktsd ON diemktsdnm.ma_congtrinhktsd = ctktsd.id
                            LEFT JOIN "District" district on ctktsd.ma_dvhc = district.ma_dvhc
                            LEFT JOIN "Basin" basin ON diemktsdnm.ma_luuvucsong = basin.id';

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

$option = array();
/*** DiemKTSD_NDD ***/
foreach ($original_data_ndd as $key_ndd => $value_ndd) {
    $option[] = array(
        'tencongtrinh' => $value_ndd["tenCongTrinh"],
        'type_congtrinh' => 'Công trình KTSD Nước dưới đất',
        'basin_waterfloor' => $value_ndd["TangChuaNuoc"],
        'xa' => $value_ndd["tenDVHC"],
        'huyen' => gen_Huyen($value_ndd["ma_dvhc_cha"], $original_data),
        'tinh' => 'Tỉnh Đồng Tháp'
    );
}

/*** DiemKTSD_NM ***/
foreach ($original_data_nm as $key_nm => $value_nm) {
    $option[] = array(
        'tencongtrinh' => $value_nm["tenCongTrinh"],
        'type_congtrinh' => 'Công trình KTSD Nước mặt',
        'basin_waterfloor' => $value_nm["TenLVS"],
        'xa' => $value_nm["tenDVHC"],
        'huyen' => gen_Huyen($value_nm["ma_dvhc_cha"], $original_data),
        'tinh' => 'Tỉnh Đồng Tháp'
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
