<?php
include "../config.php";
?>
<?php
$macongtrinh = $_GET["macongtrinh"];
/*---- Thông tin công trình ----*/
$querry_info_ctkt = 'SELECT ctktsd.*, doituong_ktsd."tenDoiTuongKTSD",
                        loaicongtrinh.name, donviquanly.name, 
                        mucdichKTSD."mucDich", mucdichKTSD."type_mucdich",
                        district."tenDVHC", district."ma_dvhc_cha",
                        thongtincpnm."tongLNSDTrongNam", thongtincpnm."tongLLKTLonNhatTungThoiKy",
                        thongtincpnm."phamViCapNuoc", thongtincpnm."tinhTrangGiayPhep" FROM "CT_KTSD" ctktsd
                        LEFT JOIN "DoiTuongKTSD" doituong_ktsd ON ctktsd.ma_doituongktsd = doituong_ktsd.id
                        LEFT JOIN "LoaiCongTrinh" loaicongtrinh ON ctktsd.ma_loaicongtrinh = loaicongtrinh.id
                        LEFT JOIN "DonViQuanLy" donviquanly ON ctktsd.ma_donviquanly = donviquanly.id
                        LEFT JOIN "MucDichKTSD" mucdichKTSD ON ctktsd.ma_mucdichktsd = mucdichKTSD.id
                        LEFT JOIN "District" district ON ctktsd.ma_dvhc = district.ma_dvhc
                        LEFT JOIN "ThongTinCP_NM" thongtincpnm ON ctktsd.id = thongtincpnm.ma_congtrinhktsd
                        WHERE ctktsd.id = ' . "'" . $macongtrinh . "'";
$result_info_ctkt = pg_query($tiengiang_db, $querry_info_ctkt);
if (!$result_info_ctkt) {
    echo "Không có dữ liệu.\n";
    exit;
}
$data_info_ctkt = array();
while ($row = pg_fetch_assoc($result_info_ctkt)) {
    $data_info_ctkt[] = $row;
}
/*** Lấy duy nhất thông tin công trình theo giấy phép mới nhất ***/
$i_check = 0;
for ($i = 0; $i < count($data_info_ctkt); $i++) {
    if ($data_info_ctkt[$i]["tinhTrangGiayPhep"] == 't') {
        $i_check = $i;
    }
}

/*---- Thông tin điểm KTSD NM ----*/
$querry_poi_ktsd_nm = 'SELECT "DiemKTSD_NM".*, luuvucsong.name "LuuVucSong" FROM "DiemKTSD_NM" 
                                LEFT JOIN "CT_KTSD" ctktsd on "DiemKTSD_NM".ma_congtrinhktsd = ctktsd.id
                                LEFT JOIN "Basin" luuvucsong on "DiemKTSD_NM".ma_luuvucsong = luuvucsong.id
                                WHERE ma_congtrinhktsd =' . "'" . $macongtrinh . "'";
$result_poi_ktsd_nm = pg_query($tiengiang_db, $querry_poi_ktsd_nm);
if (!$result_poi_ktsd_nm) {
    echo "Không có dữ liệu.\n";
    exit;
}
$data_poi_ktsd_nm = array();
while ($row = pg_fetch_assoc($result_poi_ktsd_nm)) {
    $data_poi_ktsd_nm[] = $row;
}
$jsonData_poi_ktsd_nm = json_encode($data_poi_ktsd_nm);
$original_poi_ktsd_nm = json_decode($jsonData_poi_ktsd_nm, true);
$option_poi_ktsd_nm = array();
foreach ($original_poi_ktsd_nm as $key => $value_poi_ktsd_nm) {
    $option_poi_ktsd_nm[] = array(
        'STT' => $key + 1,
        "id_diem" => $value_poi_ktsd_nm['id'],
        "sohieudiem" => $value_poi_ktsd_nm['soHieuDiem'],
        "luuvucsong" => $value_poi_ktsd_nm['LuuVucSong'],
        "toadoX" => (float)$value_poi_ktsd_nm['toaDoX'],
        "toadoY" => (float)$value_poi_ktsd_nm['toaDoY'],
        "luuLuongKTLNMuaKho" => $value_poi_ktsd_nm['luuLuongKTLNMuaKho'],
        "luuLuongKTLN" => $value_poi_ktsd_nm['luuLuongKTLN'],
        "chedoKT" => $value_poi_ktsd_nm['cheDoKT'],
        "nguonKhaiThac" => $value_poi_ktsd_nm['nguonKhaiThac'],
        "phuongThucKT" => $value_poi_ktsd_nm['phuongThucKT'],
        "tinhtrangkhaithac" => $value_poi_ktsd_nm['tinhtrangkhaithac'] == 'f' ? 'Còn hoạt động' : 'Đang hoạt động',
        "vungbaoho" => (float)$value_poi_ktsd_nm['vungBHVS'],
        "motaVungbaoho" => $value_poi_ktsd_nm["moTaVungBHVS"]
    );
}
$final_poi_ktsd_nm = json_encode($option_poi_ktsd_nm);

/*---- Thông tin giấy phép khai thác ----*/
$querry_gp_nm = 'SELECT thongtincp_nm.*, enterprise.name "TenDoanhNghiep", donvicapphep.name "DonViCapPhep", 
                        ctktsd."coSoKTSD", loaigiayphep.name "LoaiGiayPhep" FROM "ThongTinCP_NM" thongtincp_nm
                        LEFT JOIN "CT_KTSD" ctktsd ON thongtincp_nm.ma_congtrinhktsd = ctktsd.id
                        LEFT JOIN "Enterprise" enterprise on thongtincp_nm.ma_doanhnghiep = enterprise.id
                        LEFT JOIN "DonViCapPhep" donvicapphep on thongtincp_nm.ma_donvicapphep = donvicapphep.id
                        LEFT JOIN "LoaiGiayPhep" loaigiayphep on thongtincp_nm.ma_loaigiayphep = loaigiayphep.id
                        WHERE ma_congtrinhktsd =' . "'" . $macongtrinh . "'";

$result_gp_nm = pg_query($tiengiang_db, $querry_gp_nm);
if (!$result_gp_nm) {
    echo "Không có dữ liệu.\n";
    exit;
}
$data_gp_nm = array();
while ($row = pg_fetch_assoc($result_gp_nm)) {
    $data_gp_nm[] = $row;
}
$jsonData_gp_nm = json_encode($data_gp_nm);
$original_gp_nm = json_decode($jsonData_gp_nm, true);
$option_gp_nm = array();
foreach ($original_gp_nm as $key => $value_gp_nm) {
    if ($value_gp_nm["ngayCapPhep"] != null) {
        $ngaycapphep = explode("-", $value_gp_nm["ngayCapPhep"]);
        $ngaycapphep_new = $ngaycapphep[2] . "/" . $ngaycapphep[1] . "/" . $ngaycapphep[0];
    } else {
        $ngaycapphep_new = '';
    }

    if ($value_gp_nm["ngayHetHan"] != null) {
        $ngayhethan = explode("-", $value_gp_nm["ngayHetHan"]);
        $ngayhethan_new = $ngayhethan[2] . "/" . $ngayhethan[1] . "/" . $ngayhethan[0];
    } else {
        $ngayhethan_new = '';
    }

    if ($value_gp_nm["ngayBanHanhQDVungBHVS"] != null) {
        $ngaybanhanh = explode("-", $value_gp_nm["ngayBanHanhQDVungBHVS"]);
        $ngaybanhanh_new = $ngaybanhanh[2] . "/" . $ngaybanhanh[1] . "/" . $ngaybanhanh[0];
    } else {
        $ngaybanhanh_new = '';
    }

    /*** Kiểm tra giấy phép ***/
    if (isset(explode("/", $value_gp_nm['taiLieuDinhKem'])[9])) {
        $filename = explode("/", $value_gp_nm['taiLieuDinhKem'])[9];
    } else {
        $filename = explode("/", $value_gp_nm['taiLieuDinhKem'])[6];
    }

    $option_gp_nm[] = array(
        'STT' => $key + 1,
        "id_gp" => $value_gp_nm['id'],
        "sogiayphep" => $value_gp_nm['soGiayPhepNM'],
        "loaigiayphep" => $value_gp_nm['LoaiGiayPhep'],
        "donvicapphep" => $value_gp_nm['DonViCapPhep'],
        "doanhnghiep" => $value_gp_nm['TenDoanhNghiep'],
        "coso_sanxuat" => $value_gp_nm['coSoKTSD'],
        "ngaycapphep" => $ngaycapphep_new,
        "ngayhethan" => $ngayhethan_new,
        "phamvi_capnuoc" => $value_gp_nm['phamViCapNuoc'],
        "qd_bhvs" => $value_gp_nm['quyetDinhVungBHVS'],
        "ngay_banhanh_bhvs" => $ngaybanhanh_new,
        "thoihan" => $value_gp_nm['thoiHanGiayPhep'],
        "hieuluc" => $value_gp_nm['tinhTrangGiayPhep'] == 't' ? "Còn hiệu lực" : "Hết hiệu lực",
        "banso_giayphep" =>  $filename,
        "link_giayphep" => $value_gp_nm['taiLieuDinhKem']
    );
}
$final_gp_nm = json_encode($option_gp_nm);

/*---- Thông tin tiền cấp quyền ----*/
$querry_tiencq_nm = 'SELECT tiencq_nm.*, 
                              thongtincp_nm."soGiayPhepNM", 
                              thongtincp_nm."tinhTrangGiayPhep" FROM "TienCapQuyen_NM" tiencq_nm
                              LEFT JOIN "ThongTinCP_NM" thongtincp_nm ON tiencq_nm.ma_giayphepnm = thongtincp_nm.id
                              LEFT JOIN "CT_KTSD" ctktsd ON thongtincp_nm.ma_congtrinhktsd = ctktsd.id
                              WHERE ma_congtrinhktsd =' . "'" . $macongtrinh . "'";
$result_tiencq_nm = pg_query($tiengiang_db, $querry_tiencq_nm);
if (!$result_tiencq_nm) {
    echo "Không có dữ liệu.\n";
    exit;
}
$data_tiencq_nm = array();
while ($row = pg_fetch_assoc($result_tiencq_nm)) {
    $data_tiencq_nm[] = $row;
}

$jsonData_tiencq_nm = json_encode($data_tiencq_nm);
$original_tiencq_nm = json_decode($jsonData_tiencq_nm, true);
$option_tiencq_nm = array();

if (count($data_tiencq_nm) != 0) {
    foreach ($original_tiencq_nm as $key => $value_tiencq_nm) {
        if ($value_tiencq_nm["ngayBanHanhQDPD"] != null) {
            $ngayBanHanhQDPD = explode("-", $value_tiencq_nm["ngayBanHanhQDPD"]);
            $ngayBanHanhQDPD_new = $ngayBanHanhQDPD[2] . "/" . $ngayBanHanhQDPD[1] . "/" . $ngayBanHanhQDPD[0];
        } else {
            $ngayBanHanhQDPD_new = '';
        }

        $option_tiencq_nm[] = array(
            'STT' => $key + 1,
            "id_tiencq" => $value_tiencq_nm['id'],
            "sogiayphep" => $value_tiencq_nm['soGiayPhepNM'],
            "hieuluc" => $value_tiencq_nm['tinhTrangGiayPhep'] == 't' ? "Còn hiệu lực" : "Hết hiệu lực",
            "so_quyetdinh_pheduyet" => $value_tiencq_nm['quyetDinhPheDuyetTCQ'],
            "ngay_banhanh_quyetdinh" => $ngayBanHanhQDPD_new,
            "tongtien_nop" => $value_tiencq_nm['tongTienNop'],
            "tien_hangnam" => nested_tienhangnam($value_tiencq_nm['soTienNopHangNam'], $value_tiencq_nm['tongTienNop']),
            "phuongan_nop" => $value_tiencq_nm['phuongAnNop'],
            "tailieu_dinhkem" => '',
        );
    }
    $final_tiencq_nm = json_encode($option_tiencq_nm);
} else {
    $final_tiencq_nm = json_encode([]);
}

function nested_tienhangnam($tien_hangnam, $tongtien)
{
    $tiennop_hangnam = explode(";", $tien_hangnam);
    $tien_hangnam_arr = array();
    $tongtien_ky = 0;
    foreach ($tiennop_hangnam as $key => $value) {
        $tongtien_ky += (int)$value;
        $tien_hangnam_arr[] = array(
            "id" => $key + 1,
            "sotien_hangnam" => $value
        );
    }

    $tien_hangnam_arr[] = array(
        "id" => "Còn lại",
        "sotien_hangnam" => (int)$tongtien - $tongtien_ky
    );
    return $tien_hangnam_arr;
}

/*** Thông tin tình hình vi phạm ***/
if (isset($data_gp_nm[0]["ma_doanhnghiep"])) {
    $querry_thvp_nm = 'SELECT thvp_nm.*, enterprise.name "TenDoanhNghiep" FROM "TinhHinhViPham_NM" thvp_nm
                        LEFT JOIN "Enterprise" enterprise on thvp_nm.ma_doanhnghiep = enterprise.id
                        WHERE ma_doanhnghiep =' . "'" . $data_gp_nm[0]["ma_doanhnghiep"] . "'";
    $result_thvp_nm = pg_query($tiengiang_db, $querry_thvp_nm);
    if (!$result_thvp_nm) {
        echo "Không có dữ liệu.\n";
        exit;
    }
    $data_thvp_nm = array();
    while ($row = pg_fetch_assoc($result_thvp_nm)) {
        $data_thvp_nm[] = $row;
    }

    $jsonData_thvp_nm = json_encode($data_thvp_nm);
    $original_thvp_nm = json_decode($jsonData_thvp_nm, true);
    $option_thvp_nm = array();

    if (count($data_thvp_nm) != 0) {
        foreach ($original_thvp_nm as $key => $value_thvp_nm) {
            if ($value_thvp_nm["ngayXP"] != null) {
                $ngayXP = explode("-", $value_thvp_nm["ngayXP"]);
                $ngayXP_new = $ngayXP[2] . "/" . $ngayXP[1] . "/" . $ngayXP[0];
            } else {
                $ngayXP_new = '';
            }

            $option_thvp_nm[] = array(
                'STT' => $key + 1,
                "id_thvp" => $value_thvp_nm['id'],
                "ten_doanhnghiep" => $value_thvp_nm['TenDoanhNghiep'],
                "so_quyetdinh_xp" => $value_thvp_nm['quyetDinhXP'],
                "ngay_xp" => $ngayXP_new,
                "donvi_xp" => $value_thvp_nm['donViXP'],
                "hinhthuc_xp" => $value_thvp_nm['hinhThucXP'],
                "noidung_xp" => $value_thvp_nm['noiDungXP'],
                "sotien_xp" => $value_thvp_nm['soTienXP'],
                "tailieu_dinhkem" => '',
            );
        }
        $final_thvp_nm = json_encode($option_thvp_nm);
    } else {
        $final_thvp_nm = json_encode([]);
    }
}
?>


<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>Chất lượng môi trường Đồng Tháp</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../assets/images/SoTNMT.ico">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="../../vendors/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="../../vendors/PACE/themes/blue/pace-theme-minimal.css" />
    <link rel="stylesheet" href="../../vendors/perfect-scrollbar/css/perfect-scrollbar.min.css" />

    <!-- Page Plugins CSS -->
    <link rel="stylesheet" href="../../vendors/select2/dist/css/select2.css" />
    <link rel="stylesheet" href="../../vendors/tabulator/dist/css/tabulator_bootstrap4.css" />
    <link rel="stylesheet" href="../../vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" />
    <link rel="stylesheet" href="../../vendors/summernote/dist/summernote.css" />

    <link rel="stylesheet" href="../../vendors/bower-jvectormap/jquery-jvectormap-1.2.2.css" />
    <link rel="stylesheet" href="../../vendors/nvd3/build/nv.d3.min.css" />

    <!-- Core CSS -->
    <link href="../../assets/css/ei-icon.css" rel="stylesheet">
    <link href="../../assets/css/themify-icons.css" rel="stylesheet">
    <link href="../../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../assets/fonts/icomoon/styles.min.css" rel="stylesheet">
    <link href="../../assets/fonts/glyphicon/glyphicon.css" rel="stylesheet">
    <link href="../../assets/css/animate.min.css" rel="stylesheet">
    <link href="../../assets/css/app.css" rel="stylesheet">
</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Side Nav START -->
            <div class="side-nav">
                <div class="side-nav-inner">
                    <div class="side-nav-logo">
                        <a href="../../index.php">
                            <img src="../../assets/images/monre_logo.png" class="cus_logo"/>
                            <p class="text-white text-bold font-size-14 title_1" >
                                CHẤT LƯỢNG MÔI TRƯỜNG
                            </p>
                            <p class="text-white font-size-13 title_2">
                                Tỉnh: Đồng Tháp
                            </p>
                        </a>
                        <div class="mobile-toggle side-nav-toggle">
                            <a href="#">
                                <i class="ti-arrow-circle-left"></i>
                            </a>
                        </div>
                    </div>
                    <ul class="side-nav-menu scrollable">
                        <li class="nav-item" id="homepage">
                            <a href="../../index.php">
                                <span class="icon-holder">
                                    <i class="icon-home2 font-size-14"></i>
                                </span>
                                <span class="title">Trang chủ</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../map.php">
                                <span class="icon-holder">
                                    <i class="fa fa-map"></i>
                                </span>
                                <span class="title">Bản đồ</span>
                            </a>
                        </li>
                        <!-- Dữ liệu công trình -->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fa fa-wrench"></i>
                                </span>
                                <span class="title">Công cụ và thống kê</span>
                                <span class="arrow">
                                    <i class="ti-angle-right"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="../../congcu-thongke/import-excel.php">
                                        <i class="ti-export pdd-right-5"></i>
                                        <span>Chuyển File bán tự động</span>
                                    </a>

                                </li>
                                <li>
                                    <a href="../../congcu-thongke/threshold.php">
                                        <i class="ti-alert pdd-right-5"></i>
                                        <span>Danh sách vượt ngưỡng</span>
                                    </a>

                                </li>
                                <li>
                                    <a href="../../congcu-thongke/statistic.php">
                                        <i class="ti-bar-chart-alt pdd-right-5"></i>
                                        <span>Thống kê quan trắc</span>
                                    </a>

                                </li>
                                <li>
                                    <a href="../../congcu-thongke/aqi-wqi.php">
                                        <i class="fa fa-leaf pdd-right-5"></i>
                                        <span>Đánh giá AQI - WQI</span>
                                    </a>

                                </li>
                                <li>
                                    <!-- <a href="../../congcu-thongke/report.php">
                                        <i class="fa fa-clipboard pdd-right-5"></i>
                                        <span>Mẫu báo cáo</span>
                                    </a> -->

                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fa fa-building-o"></i>
                                </span>
                                <span class="title">Công trình Quan trắc</span>
                                <span class="arrow">
                                    <i class="ti-angle-right"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- <li>
                                    <a class="">Quan trắc Nước mặt</a>
                                </li> -->
                                <li>
                                    <a class="" href="../../congtrinh-quantrac/giengqt-ndd.php">Giếng QT Nước dưới đất</a>
                                </li>
<li>
                                    <a class="" href="../../congtrinh-quantrac/diemqt-nm.php">Điểm QT Nước mặt</a>
                                </li>
                                <li>
                                    <a class="" href="../../congtrinh-khaithac/giamsatnuoc.php">Giám sát tài nguyên nước</a>
                                </li>
                                <!-- <li>
                                    <a class="">Quan trắc Nước thải <i>(beta)</i></a>
                                </li>
                                <li>
                                    <a class="">Quan trắc Khí tượng <i>(beta)</i></a>
                                </li>
                                <li>
                                    <a class="">Quan trắc Thủy văn <i>(beta)</i></a>
                                </li> -->
                            </ul>
                        </li>
                        <li class="nav-item dropdown open">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="ei-antenna"></i>
                                </span>
                                <span class="title">Công trình Khai thác</span>
                                <span class="arrow">
                                    <i class="ti-angle-right"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- <li>
                                    <a href="../../congtrinh-khaithac/ktsd-nuocmat.php" class="">KTSD Nước mặt</a>
                                </li>
                                <li>
                                    <a href="../../congtrinh-khaithac/ktsd-nuocduoidat.php" class="">KTSD Nước dưới đất</a>
                                </li> -->
                                <li>
                                    <a href="../../congtrinh-khaithac/nguonxathai.php" class="">Nguồn xả thải</a>
                                </li>
                                <!-- <li>
                                    <a href="../../congtrinh-khaithac/thamdo.php" class="">CT Thăm dò Nước dưới đất</a>
                                </li> -->
                                <!--<li>
                                    <a href="../../congtrinh-khaithac/giamsatnuoc.php" class="">Giám sát tài nguyên nước</a>
                                </li>-->
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="icon-pagebreak"></i>
                                </span>
                                <span class="title">Giấy phép</span>
                                <span class="arrow">
                                    <i class="ti-angle-right"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!--<li>
                                    <a href="../../baocao-thongke/giayphep-nuocmat.php" class="">Giấy phép Nước mặt</a>
                                </li>
                                <li>
                                    <a href="../../baocao-thongke/giayphep-nuocduoidat.php" class="">Giấy phép Nước dưới đất</a>
                                </li> -->
                                <li>
                                    <a href="../../baocao-thongke/giayphep-xathai.php" class="">Giấy phép Xả thải</a>
                                </li>
                                <!--<li>
                                    <a href="../../baocao-thongke/giayphep-thamdo.php" class="">Giấy phép Thăm dò</a>
                                </li>-->
                                <!-- <li>
                                    <a href="../../baocao-thongke/giayphep-hanhnghe.php" class="">Giấy phép Hành nghề</a>
                                </li> -->
                                <li>
                                    <a href="../../baocao-thongke/thongke-tramquantrac.php" class="">Thống kê Trạm quan trắc</a>
                                </li>
                                <li>
                                    <a href="../../baocao-thongke/hochua-lvs.php" class="">Tổng hợp hồ chứa, LVS</a>
                                </li>
                                <li>
                                    <a href="../../baocao-thongke/ctkt-nguonnuoc.php" class="">Số CTKT theo Nguồn nước</a>
                                </li>
                                <li>
                                    <a href="../../baocao-thongke/ctkt-mucdichsudung.php" class="">Số CTKT theo MĐSD</a>
                                </li>
                                <!-- <li>
                                    <a href="../../baocao-thongke/ctkt-loaihinh.php" class="">Số CTKT theo Loại hình</a>
                                </li>
                                <li>
                                    <a href="../../baocao-thongke/water-ktsd-cp.php" class="">Lượng nước KTSD được CP</a>
                                </li> -->
                                <li>
                                    <a href="../../baocao-thongke/gp-dacap.php" class="">Số lượng GP đã cấp</a>
                                </li>
                                <li>
                                    <a href="../../baocao-thongke/tien-cqkt.php" class="">Tiền cấp quyền KT</a>
                                </li>
                                <!--<li>
                                    <a href="../../baocao-thongke/danhmuc-ctktsd.php" class="">Danh mục CTKTSD</a>
                                </li>-->
                            </ul>
                        </li>
                        <li class="nav-item dropdown" id="dm_soft">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="ti-view-list-alt"></i>
                                </span>
                                <span class="title">Danh mục</span>
                                <span class="arrow">
                                    <i class="ti-angle-right"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item dropdown">
                                    <a href="javascript:void(0);">
                                        <span>Doanh nghiệp</span>
                                        <span class="arrow" style="line-height: unset; margin-top: 2px">
                                            <i class="ti-angle-right"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/doanhnghiep.php">Doanh nghiệp</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/loaihinhdoanhnghiep.php">Loại hình doanh nghiệp</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="javascript:void(0);">
                                        <span>Đơn vị</span>
                                        <span class="arrow" style="line-height: unset; margin-top: 2px">
                                            <i class="ti-angle-right"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/donvicapphep.php">Đơn vị cấp phép</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/donviquanly.php">Đơn vị quản lý</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="javascript:void(0);">
                                        <span>Khai thác sử dụng</span>
                                        <span class="arrow" style="line-height: unset; margin-top: 2px">
                                            <i class="ti-angle-right"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/doituongktsd.php">Đối tượng khai thác</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/mucdichktsd.php">Mục đích khai thác</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="javascript:void(0);">
                                        <span>Địa danh</span>
                                        <span class="arrow" style="line-height: unset; margin-top: 2px">
                                            <i class="ti-angle-right"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/diadanh.php">Địa danh</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/loaidiadanh.php">Loại địa danh</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="javascript:void(0);">
                                        <span>Tiêu chuẩn</span>
                                        <span class="arrow" style="line-height: unset; margin-top: 2px">
                                            <i class="ti-angle-right"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/loaitram.php">Loại trạm</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/loaihinh.php">Loại hình</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/loaicongtrinh.php">Loại công trình</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/loaigiayphep.php">Loại giấy phép</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/quychuan.php">Quy chuẩn</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/thongso.php">Thông số</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/donvi.php">Đơn vị</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/chatluongmt.php">Chất lượng môi trường</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/donvi.php">Mục đích sử dụng</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../../danhmuc/chitieu.php">Chỉ tiêu</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="../../danhmuc/tangchuanuoc.php" class="">Tầng chứa nước</a>
                                </li>
                                <li>
                                    <a href="../../danhmuc/luuvucsong.php" class="">Lưu vực sông</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">
                <!-- Header START -->
                <div class="header navbar">
                    <div class="header-container">
                        <ul class="nav-left navbar-dark">
                            <li>
                                <a class="side-nav-toggle" href="javascript:void(0);">
                                    <i class="ti-view-grid font-size-14"></i>
                                </a>
                            </li>
                            <li style="cursor: pointer" data-target="#aboutUs" data-toggle="modal">
                                <a class="aboutUs-toogle">
                                    <i class="fa fa-users font-size-14"></i>
                                </a>
                            </li>
                            <!-- <li class="search-box">
                                <a class="search-toggle no-pdd-right" href="javascript:void(0);">
                                    <i class="search-icon ti-search pdd-right-10 font-size-14"></i>
                                    <i class="search-icon-close ti-close pdd-right-10 font-size-14"></i>
                                </a>
                            </li>
                            <li class="search-input">
                                <input class="form-control" type="text" placeholder="Tìm kiếm dữ liệu ...">
                            </li> -->
                        </ul>
                        <ul class="nav-right">
                            <li class="user-profile dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img class="profile-img img-fluid" src="../../assets/images/logo/user.png" alt="">
                                    <div class="user-info">
   <span class="name pdd-right-5">
   <?php
      require_once("../../services/config.php");
      if (isset($_SESSION['username'])) {
          $sql = 'select fullname from users where username ='."'".$_SESSION['username']."'";
          $result = pg_query($tiengiang_db, $sql);
          if (!$result) {
              echo "Không có dữ liệu.\n";
              exit;
          }
          $data = array();
          while ($row = pg_fetch_assoc($result)) {
              $data[] = $row;
          }
          echo $data[0]['fullname'];
      }
      ?>
   </span>
   <i class="ti-angle-down font-size-10"></i>
</div>
                                </a>
                                <ul class="dropdown-menu" style="margin-top: -5px; margin-right: 15px;">
                                    <!-- <li>
                                        <a href="#">
                                            <i class="ti-settings pdd-right-10"></i>
                                            <span>Cài đặt</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="icon-table2 pdd-right-10"></i>
                                            <span>Quản trị</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-user pdd-right-10"></i>
                                            <span>Tài khoản</span>
                                        </a>
                                    </li> -->
                                    <!-- <li role="separator" class="divider"></li> -->
                                    <li>
                                        <a href="../../logout.php">
                                            <i class="ti-power-off pdd-right-10"></i>
                                            <span>Đăng xuất</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Header END -->

                <!-- Modal START -->
                <!-- Modal About Us -->
                <div class="modal fade" id="aboutUs">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 style="text-transform: uppercase; color: #0f9aee">
                                    <i class="icon-profile" style="font-size: 16px; margin-top: -2px"></i>
                                    <b>Giới thiệu về hệ thống quản trị Chất lượng môi trường Đồng Tháp</b>
                                </h4>
                            </div>
                            <div class="modal-body">
                                <div class="tab-info">
                                    <ul class="nav nav-tabs" role="tablist" id="aboutTabs">
                                        <li class="nav-item">
                                            <a href="#about" class="nav-link active" role="tab" data-toggle="tab">
                                                <i class="icon-profile pdd-right-10"></i> Giới thiệu dự án
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#contact" class="nav-link" role="tab" data-toggle="tab">
                                                <i class="fa fa-envelope pdd-right-10"></i> Liên hệ chúng tôi
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#developers" class="nav-link" role="tab" data-toggle="tab">
                                                <i class="fa fa-exclamation-circle pdd-right-10"></i> Đơn vị phát triển phần mềm
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="aboutTabsContent">
                                        <div role="tabpanel" class="tab-pane fade in active" id="about">
                                            <div class="pdd-horizon-15 pdd-vertical-20">
                                                <p>Hệ thống truyền, nhận, quản lý và công bố dữ liệu các hệ thống quản trị tài nguyên nước của tỉnh Đồng Tháp tích hợp số liệu quan trắc các nguồn thải từ các khu công nghiệp, khu chế xuất và khu công nghệ
                                                    cao nói riêng và quan trắc nguồn điểm nói chung nhằm mục đích bảo vệ nguồn tiếp nhận (sông, hồ), đảm bảo chất lượng nước thải của các khu công nghiệp, khu chế xuất, khu công nghệ cao trước khi thải vào
                                                    nguồn tiếp nhận;</p>
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading" style="text-hozAlign: center">
                                                        <b>CÁC NGUỒN TIẾP NHẬN</b>
                                                    </div>
                                                    <ul class="list-group">
                                                    <li class="list-group-item">Các trạm quan trắc tự động</li>
                                                    <li class="list-group-item">Các trạm quan trắc bán tự động</li>
                                                    <li class="list-group-item">Các doanh nghiệp xả thải trên 1000 m³
                                                    </li>
                                                </ul>
<a href="../../HDSD_QuanTracDongThap.docx">Hướng dẫn sử dụng</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="contact">
                                            <div class="pdd-top-5">
                                                <form class="contact-form">
                                                    <div class="well well-sm">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="first-name">Họ và tên</label>
                                                                    <input class="form-control" style="border: 1px solid #888da8" id="first-name" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="last-name">Địa chỉ Email</label>
                                                                    <input class="form-control" style="border: 1px solid #888da8" id="last-name" type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="message">Tin nhắn:</label>
                                                                    <textarea class="form-control" style="border: 1px solid #888da8" id="message" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 hozAlign-self-center">
                                                                <div class="form-group">
                                                                    <button class="btn btn-info pull-right" data-dismiss="modal" type="submit">Gửi đến chúng
                                                                        tôi
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="developers">
                                            <div class="pdd-horizon-15 pdd-vertical-20">
                                                <p style="text-transform: uppercase">Trung tâm ứng dụng công nghệ thông tin phía Nam</p>
                                                <p>
                                                    <i class="icon-location4 blue" style="font-size: 16px; margin-top: -2px"></i>
                                                    <a href="https://www.google.com/maps/place/Số 36, Lý Văn Phức, Tân Định, Quận 1, Thành phố Hồ Chí Minh" target="_blank">
                                                        Số 36, Lý Văn Phức, P.Tân Định, Q.1, TP.HCM
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-info" data-dismiss="modal" type="button">Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Update - Thông tin công trình
                <div class="modal fade" id="info-ctkt"> -->
                <div class="modal fade" id="info-ctkt" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-lg" style="max-width: 70%">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 style="text-transform: uppercase; color: #0f9aee">
                                    <i class="ti-pencil-alt" style="font-size: 16px; margin-top: -2px"></i>
                                    <b>Thông tin công trình - Cập nhật</b>
                                </h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post" id="info_ctkt_form" enctype="multipart/form-data">
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-2 control-label">
                                                    <b>Tên công trình</b>
                                                </label>
                                                <div class="col-md-10">
                                                    <?php
                                                    echo '<input class="form-control input-sm"
                                                        type="text" name="tencongtrinh" id="tencongtrinh"' .
                                                        'value=' . '"' . $data_info_ctkt[$i_check]["tenCongTrinh"] . '"' . '>'
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-2 control-label">
                                                    <b>Địa chỉ công trình</b>
                                                </label>
                                                <div class="col-md-10">
                                                    <?php
                                                    echo '<input class="form-control input-sm"
                                                        type="text" name="diachi_ct" id="diachi_ct"' .
                                                        'value=' . '"' . $data_info_ctkt[$i_check]["diaChiCongTrinh"] . '"' . '>'
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-2 control-label">
                                                    <b>Phạm vi cấp nước</b>
                                                </label>
                                                <div class="col-md-10">
                                                    <?php
                                                    echo '<input class="form-control input-sm" 
                                                        type="text" name="phamvi_capnuoc" id="phamvi_capnuoc"' .
                                                        'value=' . '"' . $data_info_ctkt[$i_check]["phamViCapNuoc"] . '"' . '>'
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-2 control-label">
                                                    <b>Mục đích khai thác</b>
                                                </label>
                                                <div class="col-md-5">
                                                    <select class="form-control input-sm" type="text" name="mucdich" id="mucdich">
                                                        <!-- DOM from DB -->
                                                    </select>
                                                </div>
                                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                                    <b>Tổng lượng nước sử dụng trong năm</b>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo '<input class="form-control input-sm" 
                                                        type="text" name="tongLNSD" id="tongLNSD"' .
                                                        'value=' . '"' . $data_info_ctkt[$i_check]["tongLNSDTrongNam"] . '"' . '>'
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                                    <b>Tổng lưu lượng khai thác</b>
                                                </label>
                                                <div class="col-md-9">
                                                    <?php
                                                    echo '<input class="form-control input-sm" 
                                                        type="text" name="tongLuuLuongKT" id="tongLuuLuongKT"' .
                                                        'value=' . '"' . $data_info_ctkt[$i_check]["tongLLKTLonNhatTungThoiKy"] . '"' . '>'
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-2 control-label">
                                                    <b>Quận/Huyện</b>
                                                </label>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="quanhuyen"></select>
                                                </div>
                                                <label style="margin-top: 7px" class="col-md-2 control-label">
                                                    <b>Phường/Xã</b>
                                                </label>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="phuongxa">
                                                        <option value="none" selected>--Lựa chọn Phường/Xã--
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row list-ctkt">
                                                <label style="margin-top: 7px" class="col-md-3 control-label">
                                                    <b>Thời hạn khai thác sử dụng</b>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo '<input class="form-control input-sm" 
                                                        type="text" name="thoihan_ktsd" id="thoihan_ktsd"' .
                                                        'value=' . '"' . $data_info_ctkt[$i_check]["thoiHanKTSD"] . '"' . '>'
                                                    ?>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="update_info_ctkt" id="update_info_ctkt" class="btn btn-success" value="Chỉnh sửa" />
                                <button class="btn btn-info" data-dismiss="modal" type="button">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Preview Giấy phép -->
                <div class="modal fade" id="modal-gp" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-lg" style="max-width: 70%">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 style="text-transform: uppercase; color: #0f9aee">
                                    <b>Xem giấy phép</b>
                                </h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="pdf_preview"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-info" data-dismiss="modal" type="button">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal END -->

                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="container-fluid">
                        <div class="page-title" style="text-align: center">
                            <h3>
                                <b>CÔNG TRÌNH KHAI THÁC SỬ DỤNG NƯỚC MẶT</b>
                            </h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Thông tin công trình -->
                                <div class="card">
                                    <div class="card-block pdd-vertical-15 pdd-horizon-15">
                                        <h4 class="card-title text-bold text-info">
                                            Thông tin công trình
                                            <i class="ti-pencil text-bold text-info" style="cursor: pointer" data-target="#info-ctkt" data-toggle="modal"></i>
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form class="form-horizontal">
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Tên công trình</b>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <?php
                                                            echo '<input class="form-control input-sm" id="ten-congtrinh"
                                                                type="text"' . 'value=' . '"' . $data_info_ctkt[$i_check]["tenCongTrinh"] . '"' . '>'
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Địa chỉ công trình</b>
                                                        </label>
                                                        <div class="col-md-5">
                                                            <?php
                                                            echo '<input class="form-control input-sm" id="diachi-congtrinh"
                                                                type="text"' . 'value=' . '"' . $data_info_ctkt[$i_check]["diaChiCongTrinh"] . '"' . '>'
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Loại mục đích khai thác</b>
                                                        </label>
                                                        <div class="col-md-3">
                                                            <?php
                                                            echo '<input class="form-control input-sm" id="type-mucdich"
                                                                type="text"' . 'value=' . '"' . $data_info_ctkt[$i_check]["type_mucdich"] . '"' . '>'
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Phạm vi cấp nước</b>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <?php
                                                            echo '<input class="form-control input-sm" id="pv-capnuoc"
                                                                type="text"' . 'value=' . '"' . $data_info_ctkt[$i_check]["phamViCapNuoc"] . '"' . '>'
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Mục đích khai thác</b>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <?php
                                                            echo '<input class="form-control input-sm" id="mucdich-text"
                                                                type="text"' . 'value=' . '"' . $data_info_ctkt[$i_check]["mucDich"] . '"' . '>'
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-3 control-label">
                                                            <b>Tổng lượng nước sử dụng trong năm</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            echo '<input class="form-control input-sm" id="tong-lnsd"
                                                                type="text"' . 'value=' . '"' . $data_info_ctkt[$i_check]["tongLNSDTrongNam"] . '"' . '>'
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-3 control-label">
                                                            <b>Tổng lưu lượng khai thác lớn nhất</b>
                                                        </label>
                                                        <div class="col-md-1">
                                                            <?php
                                                            echo '<input class="form-control input-sm" id="tong-llkt"
                                                                type="text"' . 'value=' . '"' . $data_info_ctkt[$i_check]["tongLLKTLonNhatTungThoiKy"] . '"' . '>'
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-1 control-label">
                                                            <b>Đơn vị</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            echo '<input class="form-control input-sm" 
                                                                type="text"' . 'value=' . '"' . 'm³/ngày' . '"' . '>'
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Thời hạn khai thác sử dụng</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            echo '<input class="form-control input-sm" id="thoihan-ktsd"
                                                                type="text"' . 'value=' . '"' . $data_info_ctkt[$i_check]["thoiHanKTSD"] . '"' . '>'
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Quận/Huyện</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
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


                                                            $i_check = 0;
                                                            for ($i = 0; $i < count($data_info_ctkt); $i++) {
                                                                if ($data_info_ctkt[$i]["tinhTrangGiayPhep"] == 't') {
                                                                    $i_check = $i;
                                                                }
                                                            }
                                                            $id_huyen = explode("/", $data_info_ctkt[$i_check]["ma_dvhc_cha"])[1];
                                                            foreach ($original_data as $key => $value) {
                                                                if ($id_huyen == $value["ma_dvhc"]) {
                                                                    echo '<input class="form-control input-sm" id="quan-huyen"
                                                                                type="text"' . 'value=' . '"' . $value["tenDVHC"] . '"' . '>';
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Phường/Xã</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            echo '<input class="form-control input-sm" id="phuong-xa"
                                                                type="text"' . 'value=' . '"' . $data_info_ctkt[$i_check]["tenDVHC"] . '"' . '>'
                                                            ?>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Thông tin điểm KTSD nm -->
                                <div class="card">
                                    <div class="card-block pdd-vertical-15 pdd-horizon-15">
                                        <h4 class="card-title text-bold text-info">
                                            Thông tin điểm Khai thác sử dụng Nước mặt
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="poi_ktsd_nm" class="table table-sm table-hover table-bordered">
                                                    <!-- DOM after Process Data -->
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="list-ctkt text-right">
                                                    <a href="#" class="btn btn-info btn-sm" id="create_poi_ktsd_nm">
                                                        <i class="ti-plus pdd-right-5"></i>
                                                        <span>Thêm mới</span>
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm" id="delete_poi_ktsd_nm">
                                                        <i class="ti-eraser pdd-right-5"></i>
                                                        <span>Xóa</span>
                                                    </a>
                                                    <!-- <a href="#" class="btn btn-success btn-sm" id="export_poi_ktsd_nm">
                                                        <i class="ti-export pdd-right-5"></i>
                                                        <span>Xuất dữ liệu</span>
                                                    </a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Thông tin giấy phép khai thác -->
                                <div class="card">
                                    <div class="card-block pdd-vertical-15 pdd-horizon-15">
                                        <h4 class="card-title text-bold text-info">
                                            Giấy phép khai thác
                                        </h4>
                                        <h5 class="text-bold" style="text-align: center">
                                            Thông tin giấy phép
                                        </h5>
                                        <!-- Thông tin giấy phép -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="gp_nm" class="table table-sm table-hover table-bordered">
                                                    <!-- DOM after Process Data -->
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="list-ctkt text-right">
                                                    <a href="#" class="btn btn-info btn-sm" id="create_gp_nm">
                                                        <i class="ti-plus pdd-right-5"></i>
                                                        <span>Thêm mới</span>
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm" id="delete_gp_nm">
                                                        <i class="ti-eraser pdd-right-5"></i>
                                                        <span>Xóa</span>
                                                    </a>
                                                    <!-- <a href="#" class="btn btn-success btn-sm" id="export_gp_nm">
                                                        <i class="ti-export pdd-right-5"></i>
                                                        <span>Xuất dữ liệu</span>
                                                    </a> -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Tiền cấp quyền khai thác -->
                                        <h5 class="text-bold" style="text-align: center">
                                            Tiền cấp quyền khai thác
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="tiencq_nm" class="table table-sm table-hover table-bordered">
                                                    <!-- DOM after Process Data -->
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="list-ctkt text-right">
                                                    <a href="#" class="btn btn-info btn-sm" id="create_tiencq_nm">
                                                        <i class="ti-plus pdd-right-5"></i>
                                                        <span>Thêm mới</span>
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm" id="delete_tiencq_nm">
                                                        <i class="ti-eraser pdd-right-5"></i>
                                                        <span>Xóa</span>
                                                    </a>
                                                    <!-- <a href="#" class="btn btn-success btn-sm" id="export_tiencq_nm">
                                                        <i class="ti-export pdd-right-5"></i>
                                                        <span>Xuất dữ liệu</span>
                                                    </a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Thông tin tình hình vi phạm -->
                                <div class="card">
                                    <div class="card-block pdd-vertical-15 pdd-horizon-15">
                                        <h4 class="card-title text-bold text-info">
                                            Tình hình vi phạm khai thác sử dụng Nước mặt của Chủ công trình
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="thvp_nm" class="table table-sm table-hover table-bordered">
                                                    <!-- DOM after Process Data -->
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="list-ctkt text-right">
                                                    <a href="#" class="btn btn-info btn-sm" id="create_thvp_nm">
                                                        <i class="ti-plus pdd-right-5"></i>
                                                        <span>Thêm mới</span>
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm" id="delete_thvp_nm">
                                                        <i class="ti-eraser pdd-right-5"></i>
                                                        <span>Xóa</span>
                                                    </a>
                                                    <!-- <a href="#" class="btn btn-success btn-sm" id="export_thvp_nm">
                                                        <i class="ti-export pdd-right-5"></i>
                                                        <span>Xuất dữ liệu</span>
                                                    </a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content Wrapper END -->
        </div>
        <!-- Page Container END -->
    </div>

    <script src="../../assets/js/vendor.js"></script>

    <!-- Page Plugins JS -->
    <script src="../../vendors/d3/d3.min.js"></script>
    <script src="../../vendors/nvd3/build/nv.d3.min.js"></script>
    <script src="../../vendors/jquery.sparkline/index.js"></script>
    <script src="../../vendors/pdfobject/dist/pdfobject.js"></script>

    <script src="../../vendors/select2/dist/js/select2.js"></script>
    <script src="../../vendors/tabulator/dist/js/tabulator.js"></script>
    <script src="../../vendors/moment/min/moment.min.js"></script>
    <script src="../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../../vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="../../vendors/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="../../vendors/summernote/dist/summernote.min.js"></script>

    <!-- Main JS Custom -->
    <script src="../../assets/js/app.js"></script>
    <script src="../../assets/js/forms/form-elements.js"></script>

    <script>
        if ($("*").width() <= 1440 && $("*").width() >= 767) {
            $(".app").toggleClass("is-collapsed");
        }

        $('.dropdown-menu').on('click', function(e) {
            e.stopPropagation();
        });
    </script>

    <!-- Thông tin điểm KTSD NM -->
    <script>
        var showMap = function(cell, formatterParams, onRendered) {
            var cell_stt = cell._cell.row.data.STT
            return '<button class="map_click_' + cell_stt + ' btn-xs btn-outline-info">' +
                '<i class="fa fa-map-marker font-size-12"></i>' +
                '</button>';
        };

        var columns_title = [{
                formatter: "rowSelection",
                titleFormatter: "rowSelection",
                frozen: true,
                hozAlign: "center",
                headerSort: false,
                cellClick: function(e, cell) {
                    cell.getRow().toggleSelect();
                }
            },
            {
                formatter: showMap,
                align: "center",
                title: "",
                frozen: true,
                headerSort: false,
                cellClick: function(e, row, formatterParams) {
                    const iddiem = row.getData().id_diem;
                    window.open("../../map.php?idpoi=" + iddiem + "&type=ktsd_nm")
                }
            },
            {
                title: "#",
                field: "STT",
                frozen: true,
                hozAlign: "center"
            },
            {
                title: "Điểm khai thác",
                field: "id_diem",
                frozen: true,
                hozAlign: "center",
                formatter: "link",
                formatterParams: {
                    labelField: "sohieudiem",
                    <?php
                    echo 'urlPrefix: "form-poi-ktsd-nm.php?macongtrinh=' . $macongtrinh . '&iddiem=",'
                    ?>
                    target: "_blank",
                }
            },
            {
                title: "Lưu vực sông",
                field: "luuvucsong",
                hozAlign: "center"
            },
            {
                title: "Tọa độ Y",
                field: "toadoX",
                hozAlign: "center"
            },
            {
                title: "Tọa độ X",
                field: "toadoY",
                hozAlign: "center"
            },
            {
                title: "Lưu lượng khai thác lớn nhất mùa khô",
                field: "luuLuongKTLNMuaKho",
                hozAlign: "center"
            },
            {
                title: "Lưu lượng khai thác lớn nhất",
                field: "luuLuongKTLN",
                hozAlign: "center"
            },
            {
                title: "Chế độ khai thác",
                field: "cheDoKT",
                hozAlign: "center"
            },
            {
                title: "Nguồn khai thác",
                field: "nguonKhaiThac",
                hozAlign: "center"
            },
            {
                title: "Phương thức khai thác",
                field: "phuongThucKT",
                formatter: "textarea",
                width: 350
            },
            {
                title: "Tình trạng khai thác",
                field: "tinhtrangkhaithac",
                hozAlign: "center"
            },
            {
                title: "Vùng bảo hộ",
                field: "vungbaoho",
                hozAlign: "center"
            },
            {
                title: "Mô tả vùng bảo hộ",
                field: "motaVungbaoho",
                formatter: "textarea",
                width: 350
            }
        ];
        /*---- Lấy JSON bằng Php ----*/
        <?php
        $script = 'var tabledata = ' . $final_poi_ktsd_nm . ";";
        echo $script;
        ?>

        $("#poi_ktsd_nm").css("border-top", "1px solid #dee2e6");
        var selected_id;
        var table = new Tabulator("#poi_ktsd_nm", {
            columns: columns_title,
            rowSelectionChanged: function(data, rows) {
                selected_id = data;
            }
        })
        table.setData(tabledata)

        /*** Delete DiemKTSD_NM ***/
        $("#delete_poi_ktsd_nm").click(function(e) {
            e.preventDefault();
            if (selected_id.length == 0) {
                alert("Vui lòng chọn điểm khai thác cần xóa")
            } else {
                if (confirm("Bạn chắc chắn muốn xóa các điểm khai thác đã chọn này ?")) {
                    var id_diem = [];
                    selected_id.forEach(function(item, index) {
                        /*** Get id_diem ***/
                        id_diem.push(item.id_diem);
                    })
                    var response_post = $.post("delete-poi-ktsd-nm.php", {
                        <?php
                        echo '"macongtrinh":' . $macongtrinh . ",";
                        ?> "id_diem": id_diem
                    }).done(function(data) {
                        if (data != "error") {
                            location.reload();
                        }
                    })
                } else {
                    console.log("No rows deleted")
                }
            }
        })

        /*** Create new DiemKTSD_NM (Button) ***/
        $("#create_poi_ktsd_nm").click(function(e) {
            e.preventDefault();
            <?php
            echo 'location.href = "form-poi-ktsd-nm.php?macongtrinh=' . $macongtrinh . '"';
            ?>
        })
    </script>

    <!-- Thông tin Giấy phép -->
    <script>
        var view_downPDF = function(cell, formatterParams, onRendered) {
            var cell_stt = cell._cell.row.data.STT
            return '<button class="PDF_show_' + cell_stt + ' btn-xs btn-outline-info" ' +
                'style="cursor: pointer" data-target="#modal-gp" data-toggle="modal">' +
                '<i class="PDF_show fa fa-eye pdd-right-5 font-size-12"></i>' +
                '<span class="PDF_show text-bold font-size-10">Xem file</span>' +
                '</button>' +
                '<button class="PDF_down_' + cell_stt + ' mrg-left-5 btn-xs btn-outline-success">' +
                '<i class="PDF_down ti-import pdd-right-5 font-size-12"></i>' +
                '<span class="PDF_down text-bold font-size-10">Tải về</span>' +
                '</button>';
        };

        var columns_title = [{
                formatter: "rowSelection",
                titleFormatter: "rowSelection",
                frozen: true,
                hozAlign: "center",
                headerSort: false,
                cellClick: function(e, cell) {
                    cell.getRow().toggleSelect();
                }
            },
            {
                title: "#",
                field: "STT",
                frozen: true,
                hozAlign: "center"
            },
            {
                title: "Số giấy phép",
                field: "id_gp",
                frozen: true,
                hozAlign: "center",
                formatter: "link",
                formatterParams: {
                    labelField: "sogiayphep",
                    <?php
                    echo 'urlPrefix: "form-gp-nm.php?macongtrinh=' . $macongtrinh . '&idgp=",'
                    ?>
                    target: "_blank",
                }
            },
            {
                title: "Ngày cấp phép",
                field: "ngaycapphep",
                hozAlign: "center"
            },
            {
                title: "Ngày hết hạn",
                field: "ngayhethan",
                hozAlign: "center"
            },
            {
                title: "Loại giấy phép",
                field: "loaigiayphep",
                hozAlign: "center"
            },
            {
                title: "Đơn vị cấp phép",
                field: "donvicapphep",
                hozAlign: "center"
            },
            {
                title: "Doanh nghiệp",
                field: "doanhnghiep",
                hozAlign: "center"
            },
            {
                title: "Cơ sở sản xuất",
                field: "coso_sanxuat",
                hozAlign: "center"
            },
            {
                title: "Thời hạn cấp phép",
                field: "thoihan",
                hozAlign: "center"
            },
            {
                title: "Tình trạng giấy phép",
                field: "hieuluc",
                hozAlign: "center"
            },
            {
                title: "Phạm vi cấp nước",
                field: "phamViCapNuoc",
                hozAlign: "center"
            },
            {
                title: "Số quyết định vùng BHVS",
                field: "qd_bhvs",
                hozAlign: "center"
            },
            {
                title: "Ngày ban hành quyết định vùng BHVS",
                field: "ngay_banhanh_bhvs",
                hozAlign: "center"
            },
            {
                formatter: view_downPDF,
                title: "Bản số giấy phép",
                field: "banso_giayphep",
                hozAlign: "center",
                width: 200,
                headerSort: false,
                cellClick: function(e, row, formatterParams) {
                    var target_class = e.target.classList[0];
                    const link_gp = row.getData().link_giayphep;
                    if (target_class.includes("PDF_show")) {
                        PDFObject.embed(link_gp, "#pdf_preview", {
                            height: "45rem"
                        });
                        $("#modal-gp").show();
                    } else {
                        var a = $("<a>")
                            .attr("style", "display:none")
                            .attr("href", link_gp)
                            .attr("target", "_blank")
                            .appendTo("body");
                        a[0].click();
                        a.remove();
                    }
                }
            }
        ];
        /*---- Lấy JSON bằng Php ----*/
        <?php
        $script = 'var tabledata = ' . $final_gp_nm . ";";
        echo $script;
        ?>
        $("#gp_nm").css("border-top", "1px solid #dee2e6");
        var selected_id;
        var table = new Tabulator("#gp_nm", {
            columns: columns_title,
            rowSelectionChanged: function(data, rows) {
                selected_id = data;
            }
        })
        table.setData(tabledata);

        /*** Delete ThongtinCP_NM ***/
        $("#delete_gp_nm").click(function(e) {
            e.preventDefault();
            if (selected_id.length == 0) {
                alert("Vui lòng chọn giấy phép cần xóa")
            } else {
                if (confirm("Bạn chắc chắn muốn xóa các giấy phép đã chọn này ?")) {
                    var id_gp = [];
                    selected_id.forEach(function(item, index) {
                        /*** Get id_gp ***/
                        id_gp.push(item.id_gp);
                    })
                    var response_post = $.post("delete-gp-nm.php", {
                        <?php
                        echo '"macongtrinh":' . $macongtrinh . ",";
                        ?> "id_gp": id_gp
                    }).done(function(data) {
                        if (data != "error") {
                            location.reload();
                        }
                    })
                } else {
                    console.log("No rows deleted")
                }
            }
        })

        /*** Create new ThongtinCP_NM (Button) ***/
        $("#create_gp_nm").click(function(e) {
            e.preventDefault();
            <?php
            echo 'location.href = "form-gp-nm.php?macongtrinh=' . $macongtrinh . '"';
            ?>
        })
    </script>

    <!-- Thông tin Tiền cấp quyền khai thác -->
    <script>
        var hideIcon = function(cell, formatterParams, onRendered) {
            var cell_stt = cell._cell.row.data.STT
            return '<button class="eye_click_' + cell_stt + ' btn-xs btn-outline-success">' +
                '<i class="fa fa-eye pdd-right-5 font-size-10"></i>' +
                '<span class="text-bold font-size-10">Xem</span>' +
                '</button>';
        };

        var columns_title = [{
                formatter: "rowSelection",
                titleFormatter: "rowSelection",
                hozAlign: "center",
                headerSort: false,
                cellClick: function(e, cell) {
                    cell.getRow().toggleSelect();
                }
            },
            {
                formatter: hideIcon,
                align: "center",
                title: "",
                headerSort: false,
                cellClick: function(e, row, formatterParams) {
                    const id = row.getData().STT;
                    $(".subTable" + id).toggle();
                    var icon = $(".eye_click_" + id).find('i');
                    var text = $(".eye_click_" + id).find('span');
                    if (icon.hasClass('fa-eye')) {
                        icon.removeClass('fa-eye');
                        icon.addClass('fa-eye-slash');
                        text.html("Ẩn")
                    } else {
                        icon.removeClass('fa-eye-slash');
                        icon.addClass('fa-eye');
                        text.html("Xem")
                    }
                }
            },
            {
                title: "#",
                field: "STT",
                hozAlign: "center",
                vertAlign: "middle"
            },
            {
                title: "Số giấy phép",
                field: "sogiayphep",
                hozAlign: "center",
                vertAlign: "middle"
            },
            {
                title: "Tình trạng giấy phép",
                field: "hieuluc",
                hozAlign: "center",
                vertAlign: "middle"
            },
            {
                title: "Số Quyết định Phê duyệt",
                field: "id_tiencq",
                hozAlign: "center",
                vertAlign: "middle",
                formatter: "link",
                formatterParams: {
                    labelField: "so_quyetdinh_pheduyet",
                    <?php
                    echo 'urlPrefix: "form-tiencq-nm.php?macongtrinh=' . $macongtrinh . '&idtiencq=",'
                    ?>
                    target: "_blank",
                }
            },
            {
                title: "Ngày Ban hành Quyết định",
                field: "ngay_banhanh_quyetdinh",
                hozAlign: "center",
                vertAlign: "middle"
            },
            {
                title: "Tổng tiền nộp",
                field: "tongtien_nop",
                hozAlign: "center",
                formatter: "money",
                vertAlign: "middle",
                width: 150,
                formatterParams: {
                    decimal: ".",
                    thousand: ",",
                    symbol: " VNĐ",
                    symbolAfter: "p",
                    precision: false,
                }
            },
            {
                title: "Phương án nộp",
                field: "phuongan_nop",
                hozAlign: "center",
                vertAlign: "middle"
            },
            {
                title: "Tài liệu đính kèm",
                field: "tailieu_dinhkem",
                hozAlign: "center",
                width: 150
            },
        ];
        /*---- Lấy JSON bằng Php ----*/
        <?php
        $script = 'var tabledata = ' . $final_tiencq_nm . ";";
        echo $script;
        ?>
        <?php
        if (count($data_tiencq_nm) != 0) {
            echo '$("#tiencq_nm").css("border-top", "1px solid #dee2e6");';
        } else {
            echo '$("#tiencq_nm").css("border-top", "none");';
        }
        ?>
        var selected_id;
        var table = new Tabulator("#tiencq_nm", {
            <?php
            if (count($data_tiencq_nm) != 0) {
                echo 'columns: columns_title,
                        height: "calc(100% - 15px)", ';
            } else {
                echo 'height: "70px",';
            }
            ?>
            layout: "fitDataFill",
            rowSelectionChanged: function(data, rows) {
                selected_id = data;
            },
            rowFormatter: function(row) {
                var holderEl = document.createElement("div");
                var tableEl = document.createElement("div");
                const id = row.getData().STT;

                holderEl.style.boxSizing = "border-box";
                holderEl.style.padding = "15px";
                holderEl.style.width = "50%";
                holderEl.style.margin = "auto";
                holderEl.style.display = "none";
                holderEl.setAttribute('class', "subTable" + id);

                tableEl.style.border = "1px solid #333";
                tableEl.style.display = "none";
                tableEl.setAttribute('class', "subTable" + id);

                holderEl.appendChild(tableEl);
                row.getElement().appendChild(holderEl);

                var subTable = new Tabulator(tableEl, {
                    layout: "fitColumns",
                    data: row.getData().tien_hangnam,
                    columns: [{
                            title: "Kỳ nộp",
                            field: "id",
                            hozAlign: "center"
                        },
                        {
                            title: "Số tiền nộp",
                            field: "sotien_hangnam",
                            hozAlign: "center",
                            formatter: "money",
                            formatterParams: {
                                decimal: ".",
                                thousand: ",",
                                symbol: " VNĐ",
                                symbolAfter: "p",
                                precision: false,
                            }
                        },
                    ]
                })
            },
            placeholder: "<p class='text-danger text-bold font-size-14'>" +
                "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
        })
        <?php
        $script = 'table.setData(tabledata);';
        echo $script;
        ?>

        /*** Delete TienCapQuyen_NM ***/
        $("#delete_tiencq_nm").click(function(e) {
            e.preventDefault();
            if (selected_id.length == 0) {
                alert("Vui lòng chọn mục tiền cấp quyền cần xóa")
            } else {
                if (confirm("Bạn chắc chắn muốn xóa các mục tiền cấp quyền đã chọn này ?")) {
                    var id_tiencq = [];
                    selected_id.forEach(function(item, index) {
                        /*** Get id_gp ***/
                        id_tiencq.push(item.id_tiencq);
                    })
                    var response_post = $.post("delete-tiencq-nm.php", {
                        "id_tiencq": id_tiencq
                    }).done(function(data) {
                        if (data != "error") {
                            location.reload();
                        }
                    })
                } else {
                    console.log("No rows deleted")
                }
            }
        })

        /*** Create new TienCapQuyen_nm (Button) ***/
        $("#create_tiencq_nm").click(function(e) {
            e.preventDefault();
            <?php
            echo 'location.href = "form-tiencq-nm.php?macongtrinh=' . $macongtrinh . '"';
            ?>
        })
    </script>

    <!-- Thông tin Tình hình vi phạm -->
    <script>
        var columns_title = [{
                formatter: "rowSelection",
                titleFormatter: "rowSelection",
                frozen: true,
                hozAlign: "center",
                headerSort: false,
                cellClick: function(e, cell) {
                    cell.getRow().toggleSelect();
                }
            },
            {
                title: "#",
                field: "STT",
                frozen: true,
                hozAlign: "center"
            },
            {
                title: "Số Quyết định Xử phạt",
                field: "id_thvp",
                frozen: true,
                hozAlign: "center",
                formatter: "link",
                formatterParams: {
                    labelField: "so_quyetdinh_xp",
                    <?php
                    echo 'urlPrefix: "form-thvp-nm.php?macongtrinh=' . $macongtrinh . '&idthvp=",'
                    ?>
                    target: "_blank",
                }
            },
            {
                title: "Doanh nghiệp",
                field: "ten_doanhnghiep",
                hozAlign: "center"
            },
            {
                title: "Ngày xử phạt",
                field: "ngay_xp",
                hozAlign: "center"
            },
            {
                title: "Đơn vị xử phạt",
                field: "donvi_xp",
                hozAlign: "center"
            },
            {
                title: "Hình thức xử phạt",
                field: "hinhthuc_xp",
                hozAlign: "center"
            },
            {
                title: "Nội dung xử phạt",
                field: "noidung_xp",
                formatter: "textarea",
                width: 350
            },
            {
                title: "Tiền xử phạt",
                field: "sotien_xp",
                formatter: "money",
                hozAlign: "center",
                width: 150,
                formatterParams: {
                    decimal: ".",
                    thousand: ",",
                    symbol: " VNĐ",
                    symbolAfter: "p",
                    precision: false,
                }
            },
            {
                title: "Bản số giấy phép",
                field: "tailieu_dinhkem",
                hozAlign: "center"
            }
        ];
        /*---- Lấy JSON bằng Php ----*/
        <?php
        $script = 'var tabledata = ' . $final_thvp_nm . ";";
        echo $script;
        ?>
        <?php
        if (count($data_thvp_nm) != 0) {
            echo '$("#thvp_nm").css("border-top", "1px solid #dee2e6");';
        } else {
            echo '$("#thvp_nm").css("border-top", "none");';
        }
        ?>
        var selected_id;
        var table = new Tabulator("#thvp_nm", {
            <?php
            if (count($data_thvp_nm) != 0) {
                echo 'columns: columns_title,
                    height: "calc(100% - 15px)", ';
            } else {
                echo 'height: "70px",';
            }
            ?>
            rowSelectionChanged: function(data, rows) {
                selected_id = data;
            },
            placeholder: "<p class='text-danger text-bold font-size-14'>" +
                "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
        })
        <?php
        $script = 'table.setData(tabledata);';
        echo $script;
        ?>

        /*** Delete TinhHinhViPham_NM ***/
        $("#delete_thvp_nm").click(function(e) {
            e.preventDefault();
            if (selected_id.length == 0) {
                alert("Vui lòng chọn giấy phép cần xóa")
            } else {
                if (confirm("Bạn chắc chắn muốn xóa các giấy phép đã chọn này ?")) {
                    var id_thvp = [];
                    selected_id.forEach(function(item, index) {
                        /*** Get id_thvp ***/
                        id_thvp.push(item.id_thvp);
                    })
                    var response_post = $.post("delete-thvp-nm.php", {
                        <?php
                        echo '"macongtrinh":' . $macongtrinh . ",";
                        ?> "id_thvp": id_thvp
                    }).done(function(data) {
                        if (data != "error") {
                            location.reload();
                        }
                    })
                } else {
                    console.log("No rows deleted")
                }
            }
        })

        /*** Create new TinhHinhViPham_NM (Button) ***/
        $("#create_thvp_nm").click(function(e) {
            e.preventDefault();
            <?php
            echo 'location.href = "form-thvp-nm.php?macongtrinh=' . $macongtrinh . '"';
            ?>
        })
    </script>

    <!-- Update Thông tin công trình -->
    <script>
        /*---- DOM Option Quận/huyện và Phường/xã ----*/
        $.getJSON("../quanhuyen.php", function(quanhuyen) {
            $('#quanhuyen')
                .append($("<option></option>")
                    .attr('value', 'none').text("--Lựa chọn Quận/Huyện--"));
            $.each(quanhuyen, function(key, value) {
                /* $('#quanhuyen')
                    .append($("<option></option>")
                        .attr('value', value.id).text(value.name)); */
                <?php
                echo 'if (value.id == ' . explode("/", $data_info_ctkt[$i_check]["ma_dvhc_cha"])[1] . ') {
                    $("#quanhuyen")
                        .append($("<option></option>")
                            .attr("value", value.id).attr("selected", "selected").text(value.name));
                    } else {
                        $("#quanhuyen")
                            .append($("<option></option>")
                            .attr("value", value.id).text(value.name));
                    };';
                ?>
                $.post("../phuongxa.php", {
                    "maHuyen": $("#quanhuyen").val()
                }).done(function(data) {
                    if (data.length != 0) {
                        /*** Remove Option trước đó ***/
                        $('#phuongxa').find('option').remove();
                        $('#phuongxa')
                            .append($("<option></option>")
                                .attr('value', 'none').text("--Lựa chọn Phường/Xã--"));
                        $.each(data, function(key, value) {
                            <?php
                            echo 'if (value.id == ' . $data_info_ctkt[$i_check]["ma_dvhc"] . ') {
                                $("#phuongxa")
                                    .append($("<option></option>")
                                        .attr("value", value.id).attr("selected", "selected").text(value.name));
                                } else {
                                    $("#phuongxa")
                                        .append($("<option></option>")
                                            .attr("value", value.id).text(value.name));
                                };';
                            ?>
                        });
                    }
                })
            });
        })

        /*** DOM Option depended Phường/Xã ***/
        $('#quanhuyen').change(function() {
            $.post("../phuongxa.php", {
                "maHuyen": $(this).val()
            }).done(function(data) {
                if (data.length != 0) {
                    /*** Remove Option trước đó ***/
                    $('#phuongxa').find('option').remove();
                    $('#phuongxa')
                        .append($("<option></option>")
                            .attr('value', 'none').text("--Lựa chọn Phường/Xã--"));
                    $.each(data, function(key, value) {
                        <?php
                        echo 'if (value.id == ' . $data_info_ctkt[$i_check]["ma_dvhc"] . ') {
                                $("#phuongxa")
                                    .append($("<option></option>")
                                        .attr("value", value.id).attr("selected", "selected").text(value.name));
                            } else {
                                $("#phuongxa")
                                    .append($("<option></option>")
                                        .attr("value", value.id).text(value.name));
                            };';
                        ?>
                    });
                } else {
                    $('#phuongxa').find('option').remove();
                    $('#phuongxa')
                        .append($("<option></option>")
                            .attr('value', 'none').text("--Lựa chọn Phường/Xã--"));
                }
            })
        })

        /*** DOM option Mục đích khai thác ***/
        $.getJSON("../mucdich-ktsd.php", function(mucdichKTSD) {
            $('#mucdich')
                .append($("<option></option>")
                    .attr('value', 'none').text("--Lựa chọn Mục đích khai thác/Sử dụng--"));
            $.each(mucdichKTSD, function(key, value) {
                /*** Đánh dấu Option Mục đích được chọn ***/
                <?php
                echo 'if (value.id == ' . $data_info_ctkt[$i_check]["ma_mucdichktsd"] . ') {
                    $("#mucdich")
                        .append($("<option></option>")
                            .attr("value", value.id).attr("selected", "selected").text(value.mucDich));
                    } else {
                        $("#mucdich")
                            .append($("<option></option>")
                                .attr("value", value.id).text(value.mucDich));
                    }';
                ?>
            });
        })

        /*---- Update Thông tin công trình ----*/
        $("#update_info_ctkt").click(function() {
            var tencongtrinh = $("#tencongtrinh").val();
            /*** CT_KTSD ***/
            var diachi_congtrinh = $("#diachi_ct").val();
            /*** Option lấy mã của option được Chọn và Text ***/
            var ma_mucdichktsd = $("#mucdich").val()
            var mucdich_text = $("#mucdich option:selected").text()
            var thoihan_ktsd = $("#thoihan_ktsd").val();
            var ma_dvhc = $("#phuongxa").val();
            var quanhuyen_text = $("#quanhuyen option:selected").text()
            var phuongxa_text = $("#phuongxa option:selected").text()
            /*** ThongtinCP_NM ***/
            var phamvi_capnuoc = $("#phamvi_capnuoc").val();
            var tonglnsd = $("#tongLNSD").val();
            var tongllkt = $("#tongLuuLuongKT").val();

            var response_post = $.post("update-nm-info.php", {
                <?php
                echo '"macongtrinh":' . $macongtrinh . ",";
                ?>
                /*** CT_KTSD ***/
                "tencongtrinh": tencongtrinh,
                "diachi_congtrinh": diachi_congtrinh,
                "ma_mucdichktsd": ma_mucdichktsd,
                "thoihan_ktsd": thoihan_ktsd,
                "ma_dvhc": ma_dvhc,
                /*** ThongtinCP_NM ***/
                <?php
                echo '"i_check":' . $i_check . ",";
                ?> "phamvi_capnuoc": phamvi_capnuoc,
                "tonglnsd": tonglnsd == "" ? 'NULL' : tonglnsd,
                "tongllkt": tongllkt == "" ? 'NULL' : tongllkt,
            }).done(function(data) {
                /*** Reset Input ***/
                if (data != "error") {
                    $("#info-ctkt").modal("hide");
                    /*** Update Thông tin công trình ***/
                    $("#ten-congtrinh").val(tencongtrinh);
                    $("#diachi-congtrinh").val(diachi_congtrinh);
                    $("#type-mucdich").val(data);
                    $("#mucdich-text").val(mucdich_text);
                    $("#thoihan-ktsd").val(thoihan_ktsd);
                    $("#quan-huyen").val(quanhuyen_text);
                    $("#phuong-xa").val(phuongxa_text);
                    $("#pv-capnuoc").val(phamvi_capnuoc);
                    $("#tong-lnsd").val(tonglnsd);
                    $("#tong-llkt").val(tongllkt);
                } else {
                    alert("Lỗi cập nhật dữ liệu");
                }
            })
        })
    </script>
</body>

</html>
