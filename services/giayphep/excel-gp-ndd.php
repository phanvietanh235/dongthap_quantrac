<?php
include "../config.php";
?>
<?php
header('Content-Type: application/json');
$status_gpndd = $_POST["status_gpndd"];
$rangeDate_gpndd_start = $_POST["rangeDate_gpndd_start"];
$rangeDate_gpndd_end = $_POST["rangeDate_gpndd_end"];
$checked = $_POST["checked"];

$querry_data = 'SELECT thongtincp_ndd.*, 
                E.name "tenDoanhNghiep", E.address "diachiDoanhNghiep",
                DVCP.name "DonViCapPhep", DVQL.name "DonViQuanLy", LGP.name "LoaiGiayPhep"
                FROM "ThongTinCP_NDD" thongtincp_ndd
                LEFT JOIN "Enterprise" E on thongtincp_ndd.ma_doanhnghiep = E.id
                LEFT JOIN "DonViCapPhep" DVCP on thongtincp_ndd.ma_donvicapphep = DVCP.id
                LEFT JOIN "DonViQuanLy" DVQL on thongtincp_ndd.ma_donviquanly = DVQL.id
                LEFT JOIN "LoaiGiayPhep" LGP on thongtincp_ndd.ma_loaigiayphep = LGP.id ';
$querry_data .= 'WHERE ';
if ($checked == 'ngaycap') {
    /*** Range Cấp phép ***/
    $querry_data .= 'thongtincp_ndd."ngayCapPhep" between ' . "'" . $rangeDate_gpndd_start . "'" . ' AND ' . "'" . $rangeDate_gpndd_end . "'" . ' AND ';
    /*** Tình trạng cấp phép ***/
    if ($status_gpndd == 'all') {
        $querry_data .= '1=1';
    } else if ($status_gpndd == 'true') {
        $querry_data .= 'thongtincp_ndd."tinhTrangGiayPhep" =' . "'true'";
    } else {
        $querry_data .= 'thongtincp_ndd."tinhTrangGiayPhep" =' . "'false'";
    }
} else {
    /*** Range Hết hạn ***/
    $querry_data .= 'thongtincp_ndd."ngayHetHan" between ' . "'" . $rangeDate_gpndd_start . "'" . ' AND ' . "'" . $rangeDate_gpndd_end . "'" . ' AND ';
    /*** Tình trạng cấp phép ***/
    if ($status_gpndd == 'all') {
        $querry_data .= '1=1';
    } else if ($status_gpndd == 'true') {
        $querry_data .= 'thongtincp_ndd."tinhTrangGiayPhep" =' . "'true'";
    } else {
        $querry_data .= 'thongtincp_ndd."tinhTrangGiayPhep" =' . "'false'";
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

    $ngayhethan = explode("-", $value['ngayHetHan']);
    $ngayhethan_new = $ngayhethan[2]."/".$ngayhethan[1]."/".$ngayhethan[0];

    if ($value['ngayBanHanhQDVungBHVS'] != null) {
        $ngaybanhanh = explode("-", $value['ngayBanHanhQDVungBHVS']);
        $ngaybanhanh_new = $ngaybanhanh[2]."/".$ngaybanhanh[1]."/".$ngaybanhanh[0];
    } else {
        $ngaybanhanh_new = "Chưa cập nhật";
    }

    $option[] = array(
        'soGiayPhepNDD' => $value['soGiayPhepNDD'],
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
        'tongluuluongkt' => $value['tongLuuLuongKT'],
        'phuongthuckt' => $value['phuongThucKT'],
        'tongsogiengkt' => $value['tongSoGiengKT'],
        'phamvicapnuoc' => $value['phamViCapNuoc'],
        'soluong_dautu' => $value['soLuongGKDuocPhepDauTu'],
        'QD_vungBHVS' => $value['quyetDinhVungBHVS'],
        'ngaybanhanh_QD_vungBHVS' => $ngaybanhanh_new,
        'tailieudinhkem' => $value['taiLieuDinhKem']
        /* 'mucDich' => $value['moTa'],
        'tangChuaNuoc' => $value['tangChuaNuoc'],
        'soHieuGieng' => $value['soHieuGieng'],
        'tongLuuLuongKT' => $value['tongLuuLuongKT'],
        'toaDoX' => $value['toaDoX'],
        'toaDoY' => $value['toaDoY'],
        'mucNuocTinh' => $value['mucNuocTinh'],
        'mucNuocDong' => $value['mucNuocDong'], */
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
