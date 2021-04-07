<?php
include "../config.php"
?>
<?php
header('Content-Type:application/json');
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

/*---- POST Send Data ----*/
$tencongtrinh = $_POST["tencongtrinh"];
/* $mucdich_khaithac = $_POST["mucdich_khaithac"];
    $tongsogieng =  $_POST["tongsogieng"];
    $thoihan_ktsd = $_POST["thoihan_ktsd"]; */

/* $quanhuyen = $_POST["quanhuyen"]; */
$doanhnghiep = $_POST["doanhnghiep"];
$sogiayphep = $_POST["sogiayphep"];
/* $status_gieng_ndd = $_POST["status_gieng_ndd"]; */

$diachi_ct = $_POST["diachi_ct"];
/*$chedo_kt = $_POST["chedo_kt"];
    $tong_llkt = $_POST["tong_llkt"]; */

/* $tangchuanuoc = $_POST["tangchuanuoc"];
    $phuongxa =  $_POST["phuongxa"]; */
$coso_sanxuat = $_POST["coso_sanxuat"];
$nam_xd = $_POST["nam_xd"];
/* $phamvi_capnuoc = $_POST["phamvi_capnuoc"];
    $status_list_ctkt_ndd = $_POST["status_list_ctkt_ndd"]; */

/*---- Thông tin Danh sách công trình KTSD NDD ----*/
$querry_data = 'SELECT * FROM list_ktsd_ndd ';
$querry_data .= 'WHERE ';
$querry_data .= '("tenCongTrinh" IS NULL OR "tenCongTrinh" ILIKE ' . "'%" . $tencongtrinh . "%'" . ') AND ';
/* $querry_data.= '"mucDich" ILIKE '."'%".$mucdich_khaithac."%'".' AND ';
    if ($tongsogieng == 0) {
        $querry_data.= "1=1 AND ";
    } else {
        $querry_data.= '"tongSoGiengKT" = '."'".$tongsogieng."'".' AND ';
    }
    if ($thoihan_ktsd == 0) {
        $querry_data.= "1=1 AND ";
    } else {
        $querry_data.= '"thoiHanKTSD" = '."'".$thoihan_ktsd."'".' AND ';
    } */

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
/*** Tầng chứa nước
    if (!isset($_POST["tangchuanuoc"])) {
        $querry_data.= '1=1 AND ';
    } else {
        $basin_option = $_POST["tangchuanuoc"];
        foreach ($basin_option as $i => $value) {
            if ($i > 0) {
                $querry_data.= ' OR ';
            }
            $querry_data.= '"TangChuaNuoc" = '."'".(int)$value."' ";
        }
    } ***/

$querry_data .= '("tenDoanhNghiep" IS NULL OR "tenDoanhNghiep" ILIKE ' . "'%" . $doanhnghiep . "%'" . ') AND ';
$querry_data .= '("soGiayPhepNDD" IS NULL OR "soGiayPhepNDD" ILIKE ' . "'%" . $sogiayphep . "%'" . ') AND ';
/*** Tình trạng giếng khai thác
    $status_gieng_ndd = $_POST["status_gieng_ndd"];
    if ($status_gieng_ndd == 'all') {
        $querry_data.= '1=1 AND ';
    } else if ($status_gieng_ndd == 'true') {
        $querry_data.= '"tinhTrangGieng" ='."'true' AND ";
    } else {
        $querry_data.= '"tinhTrangGieng" ='."'false' AND ";
    } ***/

$querry_data .= '("diaChiCongTrinh" IS NULL OR "diaChiCongTrinh" ILIKE ' . "'%" . $diachi_ct . "%'" . ') AND ';
/* $querry_data.= '"cheDoKhaiThac" ILIKE '."'%".$chedo_kt."%'".' AND ';
    if ($tong_llkt == 0) {
        $querry_data.= "1=1 AND ";
    } else {
        $querry_data.= '"tongLuuLuongKT" = '."'".$tong_llkt."'".' AND ';
    } */
$querry_data .= '("coSoKTSD" IS NULL OR  "coSoKTSD" ILIKE ' . "'%" . $coso_sanxuat . "%'" . ') AND ';
$querry_data .= '("namXDVH" IS NULL OR  "namXDVH" ILIKE ' . "'%" . $nam_xd . "%'" . ')';
/* $querry_data.= '"phamViCapNuoc" ILIKE '."'%".$phamvi_capnuoc."%'".' AND '; */
/*** Tình trạng giấy phép (have Condition)
    $status_list_ctkt_ndd = $_POST["status_list_ctkt_ndd"];
    if ($status_list_ctkt_ndd == 'all') {
        $querry_data.= '1=1 ';
    } else if ($status_list_ctkt_ndd == 'true') {
        $querry_data.= '"tinhTrangGiayPhep" ='."'true' ";
    } else {
        $querry_data.= '"tinhTrangGiayPhep" ='."'false' ";
    } ***/
/* $querry_data.= 'GROUP BY ma_ctkt, "tenCongTrinh", "mucDich", "tongSoGiengKT", "thoiHanKTSD",
                "ma_dvhc_cha", "tenDVHC", "tenDoanhNghiep", "soGiayPhepNDD",
                "tinhTrangGieng", "diaChiCongTrinh", "cheDoKhaiThac",
                "tongLuuLuongKT", "coSoKTSD", "tinhTrangGiayPhep"
                ORDER BY ma_ctkt'; */

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
        /* '#' => $key + 1, */
        "macongtrinh" => $value['ma_ctkt'],
        "tencongtrinh" => $value['tenCongTrinh'],
        "diachi_ct" => $value['diaChiCongTrinh'],
        /* "tongsogieng" => $value['tongSoGiengKT'],
            "thoihan_ktsd" => $value['thoiHanKTSD'], */
        "quanhuyen" => gen_Huyen($value["ma_dvhc_cha"], $original_data_district),
        "doanhnghiep" => $value['tenDoanhNghiep'],
        "sogiayphep" => $value['soGiayPhepNDD'],
        /* "status_gieng_ndd" => $value['tinhTrangGieng'],
            "vitri_kt" => $value['diaChiCongTrinh'],
            "chedo_kt" => $value['cheDoKhaiThac']
            "tong_llkt" => $value['tongLuuLuongKT'],
            "tangchuanuoc" => $value[''],*/
        "phuongxa" => $value['tenDVHC'],
        "coso_sanxuat" => $value['coSoKTSD'],
        "nam_xd" => $value['namXDVH'],
        /* "phamvi_capnuoc" => $value['phamViCapNuoc'],
            "status_list_ctkt_ndd" => $value['tinhTrangGiayPhep'] */
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
