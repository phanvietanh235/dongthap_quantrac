<?php
include "../config.php";
?>
<?php
header('Content-Type: application/json');
$status_gpxt = $_POST["status_gpxt"];
$rangeDate_gpxt_start = $_POST["rangeDate_gpxt_start"];
$rangeDate_gpxt_end = $_POST["rangeDate_gpxt_end"];
$checked = $_POST["checked"];

$querry_data = 'SELECT thongtincp_xt.*,
                E.name "tenDoanhNghiep", E.address "diachiDoanhNghiep",
                DVCP.name "DonViCapPhep", DVQL.name "DonViQuanLy", LGP.name "LoaiGiayPhep" 
                FROM "ThongTinCP_XT" thongtincp_xt 
                LEFT JOIN "DonViCapPhep" DVCP on thongtincp_xt.ma_donvicapphep = DVCP.id
                LEFT JOIN "DonViQuanLy" DVQL on thongtincp_xt.ma_donviquanly = DVQL.id
                LEFT JOIN "Enterprise" E on thongtincp_xt.ma_doanhnghiep = E.id
                LEFT JOIN "LoaiGiayPhep" LGP on thongtincp_xt.ma_loaigiayphep = LGP.id ';
$querry_data.= 'WHERE ';
if ($checked == 'ngaycap') {
    /*** Range Cấp phép ***/
    $querry_data.= 'thongtincp_xt."ngayCapPhep" between '."'".$rangeDate_gpxt_start."'".' AND '."'".$rangeDate_gpxt_end."'".' AND ';
    /*** Tình trạng cấp phép ***/
    if ($status_gpxt == 'all') {
        $querry_data.= '1=1 ';
    } else if ($status_gpxt == 'true') {
        $querry_data.= 'thongtincp_xt."tinhTrangGiayPhep" ='."'true' ";
    } else {
        $querry_data.= 'thongtincp_xt."tinhTrangGiayPhep" ='."'false' ";
    }
    /*** Lưu vực sông khai thác
    if (!isset($_POST["tiepnhan_option"])) {
        $querry_data.= '1=1';
    } else {
        $tiepnhan_option = $_POST["tiepnhan_option"];
        foreach ($tiepnhan_option as $i => $value) {
            if ($i > 0) {
                $querry_data.= ' OR ';
            }
            $querry_data.= '"id_lvs" = '."'".(int)$value."' ";
        }
    } ***/
} else {
    /*** Range Hết hạn ***/
    $querry_data.= 'thongtincp_xt.ngayHetHan" between '."'".$rangeDate_gpxt_start."'".' AND '."'".$rangeDate_gpxt_end."'".' AND ';
    /*** Tình trạng cấp phép ***/
    if ($status_gpxt == 'all') {
        $querry_data.= '1=1 ';
    } else if ($status_gpxt == 'true') {
        $querry_data.= 'thongtincp_xt."tinhTrangGiayPhep" ='."'true' ";
    } else {
        $querry_data.= 'thongtincp_xt."tinhTrangGiayPhep" ='."'false' ";
    }
    /*** Lưu vực sông khai thác
    if (!isset($_POST["tiepnhan_option"])) {
        $querry_data.= '1=1';
    } else {
        $tiepnhan_option = $_POST["tiepnhan_option"];
        foreach ($tiepnhan_option as $i => $value) {
            if ($i > 0) {
                $querry_data.= ' OR ';
            }
            $querry_data.= '"id_lvs" = '."'".(int)$value."' ";
        }
    } ***/
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

    $ngayhethan = explode("-", $value['ngayHetHan']);
    $ngayhethan_new = $ngayhethan[2]."/".$ngayhethan[1]."/".$ngayhethan[0];

    $option[] = array(
        'soGiayPhepXT' => $value['soGiayPhepXT'],
        'loaigiayphep' => $value['LoaiGiayPhep'],
        'ngayCapPhep' => $ngaycapphep_new,
        'ngayHetHan' => $ngayhethan_new,
        'tenDoanhNghiep' => $value['tenDoanhNghiep'],
        'diachiDoanhNghiep' => $value['diachiDoanhNghiep'],
        /* 'coSoKTSD' => $value['coSoKTSD'],
        'diachiCSSX' => $value['diachiCSSX'], */
        'tinhTrangGiayPhep' => $value['tinhTrangGiayPhep'] == 't' ? "Còn hiệu lực" : "Hết hiệu lực",
        'thoiHanGiayPhep' => $value['thoiHanGiayPhep'],
        'donvicapphep' => $value['DonViCapPhep'],
        'donviquanly' => $value['DonViQuanLy'],
        'tongLLXaLonNhat' => $value['tongLLXaLonNhat'],
        'tongLLXaLonNhatMuaKho' => $value['tongLLXaLonNhatMuaKho'],
        'tongSoDiemXa' => $value['tongSoDiemXa'],
        'ghiChu' => $value['ghiChu'],
        'tailieudinhkem' => $value['taiLieuDinhKem']
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
