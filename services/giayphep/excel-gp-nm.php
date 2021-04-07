<?php
include "../config.php";
?>
<?php
header('Content-Type: application/json');
$status_gpnm = $_POST["status_gpnm"];
$rangeDate_gpnm_start = $_POST["rangeDate_gpnm_start"];
$rangeDate_gpnm_end = $_POST["rangeDate_gpnm_end"];
$checked = $_POST["checked"];

$querry_data = 'SELECT thongtincp_nm.*,
                E.name "tenDoanhNghiep", E.address "diachiDoanhNghiep",
                DVCP.name "DonViCapPhep", DVQL.name "DonViQuanLy", LGP.name "LoaiGiayPhep" 
                FROM "ThongTinCP_NM" thongtincp_nm 
                LEFT JOIN "DonViCapPhep" DVCP on thongtincp_nm.ma_donvicapphep = DVCP.id
                LEFT JOIN "DonViQuanLy" DVQL on thongtincp_nm.ma_donviquanly = DVQL.id
                LEFT JOIN "Enterprise" E on thongtincp_nm.ma_doanhnghiep = E.id
                LEFT JOIN "LoaiGiayPhep" LGP on thongtincp_nm.ma_loaigiayphep = LGP.id ';
$querry_data.= 'WHERE ';
if ($checked == 'ngaycap') {
    /*** Range Cấp phép ***/
    $querry_data.= 'thongtincp_nm."ngayCapPhep" between '."'".$rangeDate_gpnm_start."'".' AND '."'".$rangeDate_gpnm_end."'".' AND ';
    /*** Tình trạng cấp phép ***/
    if ($status_gpnm == 'all') {
        $querry_data.= '1=1 ';
    } else if ($status_gpnm == 'true') {
        $querry_data.= 'thongtincp_nm."tinhTrangGiayPhep" ='."'true'";
    } else {
        $querry_data.= 'thongtincp_nm."tinhTrangGiayPhep" ='."'false'";
    }
    /*** Lưu vực sông khai thác
    if (!isset($_POST["basin_option"])) {
        $querry_data.= '1=1';
    } else {
        $basin_option = $_POST["basin_option"];
        foreach ($basin_option as $i => $value) {
            if ($i > 0) {
                $querry_data.= ' OR ';
            }
            $querry_data.= 'B.id = '."'".(int)$value."' ";
        }
    } ***/
} else {
    /*** Range Hết hạn ***/
    $querry_data.= 'thongtincp_nm."ngayHetHan" between '."'".$rangeDate_gpnm_start."'".' AND '."'".$rangeDate_gpnm_end."'".' AND ';
    /*** Tình trạng cấp phép ***/
    if ($status_gpnm == 'all') {
        $querry_data.= '1=1 ';
    } else if ($status_gpnm == 'true') {
        $querry_data.= 'thongtincp_nm."tinhTrangGiayPhep" ='."'true'";
    } else {
        $querry_data.= 'thongtincp_nm."tinhTrangGiayPhep" ='."'false'";
    }
    /*** Lưu vực sông khai thác
    if (!isset($_POST["basin_option"])) {
        $querry_data.= '1=1';
    } else {
        $basin_option = $_POST["basin_option"];
        foreach ($basin_option as $i => $value) {
            if ($i > 0) {
                $querry_data.= ' OR ';
            }
            $querry_data.= 'B.id = '."'".(int)$value."' ";
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

    if ($value['ngayBanHanhQDVungBHVS'] != null) {
        $ngaybanhanh = explode("-", $value['ngayBanHanhQDVungBHVS']);
        $ngaybanhanh_new = $ngaybanhanh[2]."/".$ngaybanhanh[1]."/".$ngaybanhanh[0];
    } else {
        $ngaybanhanh_new = "Chưa cập nhật";
    }

    $option[] = array(
        'soGiayPhepNM' => $value['soGiayPhepNM'],
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
        'tongLLKTLonNhatTungThoiKy' => $value['tongLLKTLonNhatTungThoiKy'],
        'tongLNSDTrongNam' => $value['tongLNSDTrongNam'],
        'phamvicapnuoc' => $value['phamViCapNuoc'],
        'QD_vungBHVS' => $value['quyetDinhVungBHVS'],
        'ngaybanhanh_QD_vungBHVS' => $ngaybanhanh_new,
        'ghiChu' => $value['ghiChu'],
        'tailieudinhkem' => $value['taiLieuDinhKem']
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
