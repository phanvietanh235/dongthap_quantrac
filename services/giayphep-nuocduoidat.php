<?php
include "config.php";
?>
<?php
header('Content-Type: application/json');
$status_gpndd = $_POST["status_gpndd"];
$rangeDate_gpndd_start = $_POST["rangeDate_gpndd_start"];
$rangeDate_gpndd_end = $_POST["rangeDate_gpndd_end"];
$checked = $_POST["checked"];

$querry_data = 'SELECT * FROM giayphepnuocduoidat ';
$querry_data .= 'WHERE ';
if ($checked == 'ngaycap') {
    /*** Range Cấp phép ***/
    $querry_data .= '"ngayCapPhep" between ' . "'" . $rangeDate_gpndd_start . "'" . ' AND ' . "'" . $rangeDate_gpndd_end . "'" . ' AND ';
    /*** Tình trạng cấp phép ***/
    if ($status_gpndd == 'all') {
        $querry_data .= '1=1';
    } else if ($status_gpndd == 'true') {
        $querry_data .= '"tinhTrangGiayPhep" =' . "'true'";
    } else {
        $querry_data .= '"tinhTrangGiayPhep" =' . "'false'";
    }
} else {
    /*** Range Hết hạn ***/
    $querry_data .= '"ngayHetHan" between ' . "'" . $rangeDate_gpndd_start . "'" . ' AND ' . "'" . $rangeDate_gpndd_end . "'" . ' AND ';
    /*** Tình trạng cấp phép ***/
    if ($status_gpndd == 'all') {
        $querry_data .= '1=1';
    } else if ($status_gpndd == 'true') {
        $querry_data .= '"tinhTrangGiayPhep" =' . "'true'";
    } else {
        $querry_data .= '"tinhTrangGiayPhep" =' . "'false'";
    }
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

$jsonData = json_encode($data);
$original_data = json_decode($jsonData, true);
$option = array();
foreach ($original_data as $key => $value) {
    /*---- Xử lý Date ----*/
    $ngaycapphep = explode("-", $value['ngayCapPhep']);
    $ngaycapphep_new = $ngaycapphep[2]."/".$ngaycapphep[1]."/".$ngaycapphep[0];

    $option[] = array(
        'id' => $value['id'],
        'idgp' => $value['idgp'],
        'macongtrinh' => $value['macongtrinh'],
        'tenDoanhNghiep' => $value['tenDoanhNghiep'],
        'diachiDoanhNghiep' => $value['diachiDoanhNghiep'],
        'coSoKTSD' => $value['coSoKTSD'],
        'diachiCSSX' => $value['diachiCSSX'],
        'soGiayPhepNDD' => $value['soGiayPhepNDD'],
        'ngayCapPhep' => $ngaycapphep_new,
        'thoiHanGiayPhep' => $value['thoiHanGiayPhep'],
        'tenCongTrinh' => $value['tenCongTrinh'],
        'diaChiCongTrinh' => $value['diaChiCongTrinh'],
        'mucDich' => $value['moTa'],
        'tangChuaNuoc' => $value['tangChuaNuoc'],
        'soHieuGieng' => $value['soHieuGieng'],
        'tongLuuLuongKT' => $value['tongLuuLuongKT'],
        'toaDoX' => $value['toaDoX'],
        'toaDoY' => $value['toaDoY'],
        'mucNuocTinh' => $value['mucNuocTinh'],
        'mucNuocDong' => $value['mucNuocDong'],

        /*--- Thêm các trường để xuất Excel ---*/
        'ngayHetHan' => $value['ngayHetHan'],
        'tinhTrangGiayPhep' => $value['tinhTrangGiayPhep'] == 't' ? "Còn hiệu lực" : "Hết hiệu lực"
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
