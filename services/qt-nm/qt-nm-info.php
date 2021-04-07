<?php
include "../config.php";
?>
<?php
$macongtrinh = $_GET["macongtrinh"];
/*---- Thông tin công trình ----*/
$querry_info_ctkt = 'SELECT ctktsd.*, doituong_ktsd."tenDoiTuongKTSD",
                        loaicongtrinh.name, donviquanly.name, diemqt_nm."tinhTrangHoatDong",
                        /* mucdichKTSD."mucDich", mucdichKTSD."type_mucdich", */
                        district."tenDVHC", district."ma_dvhc_cha" FROM "CT_KTSD" ctktsd
                        LEFT JOIN "DoiTuongKTSD" doituong_ktsd ON ctktsd.ma_doituongktsd = doituong_ktsd.id
                        LEFT JOIN "LoaiCongTrinh" loaicongtrinh ON ctktsd.ma_loaicongtrinh = loaicongtrinh.id
                        LEFT JOIN "DonViQuanLy" donviquanly ON ctktsd.ma_donviquanly = donviquanly.id
                        /* LEFT JOIN "MucDichKTSD" mucdichKTSD ON ctktsd.ma_mucdichktsd = mucdichKTSD.id */
                        LEFT JOIN "District" district ON ctktsd.ma_dvhc = district.ma_dvhc
                        LEFT JOIN "DiemQT_NM" diemqt_nm ON diemqt_nm.ma_congtrinhktsd = ctktsd.id
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
    if ($data_info_ctkt[$i]["tinhTrangHoatDong"] == 't') {
        $i_check = $i;
    }
}

/*---- Thông tin điểm QT ----*/
$querry_poi_qt_nm = 'SELECT "DiemQT_NM".*, luuvucsong.name "LuuVucSong" FROM "DiemQT_NM" 
                                    LEFT JOIN "CT_KTSD" ctktsd on "DiemQT_NM".ma_congtrinhktsd = ctktsd.id
                                    LEFT JOIN "Basin" luuvucsong on "DiemQT_NM".ma_luuvucsong = luuvucsong.id
                                    WHERE ma_congtrinhktsd =' . "'" . $macongtrinh . "'";
$result_poi_qt_nm = pg_query($tiengiang_db, $querry_poi_qt_nm);
if (!$result_poi_qt_nm) {
    echo "Không có dữ liệu.\n";
    exit;
}
$data_poi_qt_nm = array();
while ($row = pg_fetch_assoc($result_poi_qt_nm)) {
    $data_poi_qt_nm[] = $row;
}
$jsonData_poi_qt_nm = json_encode($data_poi_qt_nm);
$original_poi_qt_nm = json_decode($jsonData_poi_qt_nm, true);
$option_poi_qt_nm = array();
foreach ($original_poi_qt_nm as $key => $value_poi_qt_nm) {
    $option_poi_qt_nm[] = array(
        'STT' => $key + 1,
        "id_diem" => $value_poi_qt_nm['id'],
        "sohieudiem" => $value_poi_qt_nm['soHieuDiemQT'],
        "luuvucsong" => $value_poi_qt_nm['LuuVucSong'],
        "toadoX" => (float)$value_poi_qt_nm['coordX'],
        "toadoY" => (float)$value_poi_qt_nm['coordY'],
        "tuanSuatBaoTri" => $value_poi_qt_nm['tuanSuatBaoTri'],
        "ma_tramcu" => $value_poi_qt_nm['ma_tramcu'],
        "tinhTrangHoatDong" => $value_poi_qt_nm['tinhTrangHoatDong'] == 'f' ? 'Còn hoạt động' : 'Đang hoạt động'
    );
}
$final_poi_qt_nm = json_encode($option_poi_qt_nm);

/*---- Thông tin giấy phép khai thác ----*/
$querry_gp_xt = 'SELECT thongtincp_xt.*, enterprise.name "TenDoanhNghiep", donvicapphep.name "DonViCapPhep", 
                            ctktsd."coSoKTSD", loaigiayphep.name "LoaiGiayPhep" FROM "ThongTinCP_XT" thongtincp_xt
                            LEFT JOIN "CT_KTSD" ctktsd ON thongtincp_xt.ma_congtrinhktsd = ctktsd.id
                            LEFT JOIN "Enterprise" enterprise on thongtincp_xt.ma_doanhnghiep = enterprise.id
                            LEFT JOIN "DonViCapPhep" donvicapphep on thongtincp_xt.ma_donvicapphep = donvicapphep.id
                            LEFT JOIN "LoaiGiayPhep" loaigiayphep on thongtincp_xt.ma_loaigiayphep = loaigiayphep.id
                            WHERE ma_congtrinhktsd =' . "'" . $macongtrinh . "'";

$result_gp_xt = pg_query($tiengiang_db, $querry_gp_xt);
if (!$result_gp_xt) {
    echo "Không có dữ liệu.\n";
    exit;
}
$data_gp_xt = array();
while ($row = pg_fetch_assoc($result_gp_xt)) {
    $data_gp_xt[] = $row;
}
$jsonData_gp_xt = json_encode($data_gp_xt);
$original_gp_xt = json_decode($jsonData_gp_xt, true);
$option_gp_xt = array();
foreach ($original_gp_xt as $key => $value_gp_xt) {
    if ($value_gp_xt["ngayCapPhep"] != null) {
        $ngaycapphep = explode("-", $value_gp_xt["ngayCapPhep"]);
        $ngaycapphep_new = $ngaycapphep[2] . "/" . $ngaycapphep[1] . "/" . $ngaycapphep[0];
    } else {
        $ngaycapphep_new = '';
    }

    if ($value_gp_xt["ngayHetHan"] != null) {
        $ngayhethan = explode("-", $value_gp_xt["ngayHetHan"]);
        $ngayhethan_new = $ngayhethan[2] . "/" . $ngayhethan[1] . "/" . $ngayhethan[0];
    } else {
        $ngayhethan_new = '';
    }

    /*** Kiểm tra giấy phép ***/
    if (isset(explode("/", $value_gp_xt['taiLieuDinhKem'])[9])) {
        $filename = explode("/", $value_gp_xt['taiLieuDinhKem'])[9];
    } else {
        $filename = explode("/", $value_gp_xt['taiLieuDinhKem'])[6];
    }

    $option_gp_xt[] = array(
        'STT' => $key + 1,
        "id_gp" => $value_gp_xt['id'],
        "sogiayphep" => $value_gp_xt['soGiayPhepXT'],
        "loaigiayphep" => $value_gp_xt['LoaiGiayPhep'],
        "donvicapphep" => $value_gp_xt['DonViCapPhep'],
        "doanhnghiep" => $value_gp_xt['TenDoanhNghiep'],
        "coso_sanxuat" => $value_gp_xt['coSoKTSD'],
        "ngaycapphep" => $ngaycapphep_new,
        "ngayhethan" => $ngayhethan_new,
        "thoihan" => $value_gp_xt['thoiHanGiayPhep'],
        "hieuluc" => $value_gp_xt['tinhTrangGiayPhep'] == 't' ? "Còn hiệu lực" : "Hết hiệu lực",
        "banso_giayphep" =>  $filename,
        "link_giayphep" => $value_gp_xt['taiLieuDinhKem']
    );
}
$final_gp_xt = json_encode($option_gp_xt);

/*** Thông tin tình hình vi phạm ***/
if (isset($data_gp_xt[0]["ma_doanhnghiep"])) {
    $querry_thvp_xt = 'SELECT thvp_xt.*, enterprise.name "TenDoanhNghiep" FROM "TinhHinhViPham_XT" thvp_xt
                        LEFT JOIN "Enterprise" enterprise on thvp_xt.ma_doanhnghiep = enterprise.id
                        WHERE ma_doanhnghiep =' . "'" . $data_gp_xt[0]["ma_doanhnghiep"] . "'";
    $result_thvp_xt = pg_query($tiengiang_db, $querry_thvp_xt);
    if (!$result_thvp_xt) {
        echo "Không có dữ liệu.\n";
        exit;
    }
    $data_thvp_xt = array();
    while ($row = pg_fetch_assoc($result_thvp_xt)) {
        $data_thvp_xt[] = $row;
    }

    $jsonData_thvp_xt = json_encode($data_thvp_xt);
    $original_thvp_xt = json_decode($jsonData_thvp_xt, true);
    $option_thvp_xt = array();

    if (count($data_thvp_xt) != 0) {
        foreach ($original_thvp_xt as $key => $value_thvp_xt) {
            if ($value_thvp_xt["ngayXP"] != null) {
                $ngayXP = explode("-", $value_thvp_xt["ngayXP"]);
                $ngayXP_new = $ngayXP[2] . "/" . $ngayXP[1] . "/" . $ngayXP[0];
            } else {
                $ngayXP_new = '';
            }

            $option_thvp_xt[] = array(
                'STT' => $key + 1,
                "id_thvp" => $value_thvp_xt['id'],
                "ten_doanhnghiep" => $value_thvp_xt['TenDoanhNghiep'],
                "so_quyetdinh_xp" => $value_thvp_xt['quyetDinhXP'],
                "ngay_xp" => $ngayXP_new,
                "donvi_xp" => $value_thvp_xt['donViXP'],
                "hinhthuc_xp" => $value_thvp_xt['hinhThucXP'],
                "noidung_xp" => $value_thvp_xt['noiDungXP'],
                "sotien_xp" => $value_thvp_xt['soTienXP'],
                "tailieu_dinhkem" => '',
            );
        }
        $final_thvp_xt = json_encode($option_thvp_xt);
    } else {
        $final_thvp_xt = json_encode([]);
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
                                                    <b>Tổng số điểm xả</b>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo '<input class="form-control input-sm" 
                                                        type="text" name="tong_diemxa" id="tong_diemxa"' .
                                                        'value=' . '"' . $data_info_ctkt[$i_check]["tongSoDiemXa"] . '"' . '>'
                                                    ?>
                                                </div>
                                                <label style="margin-top: 7px" class="col-md-2 control-label">
                                                    <b>Tổng lưu lượng xả</b>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo '<input class="form-control input-sm" 
                                                        type="text" name="tongLLX" id="tongLLX"' .
                                                        'value=' . '"' . $data_info_ctkt[$i_check]["tongLLXaLonNhat"] . '"' . '>'
                                                    ?>
                                                </div>
                                                <label style="margin-top: 7px" class="col-md-2 control-label">
                                                    <b>Tổng lượng xả MK</b>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo '<input class="form-control input-sm" 
                                                        type="text" name="tongLLX_muakho" id="tongLLX_muakho"' .
                                                        'value=' . '"' . $data_info_ctkt[$i_check]["tongLLXaLonNhatMuaKho"] . '"' . '>'
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
                                <b>CÔNG TRÌNH QUAN TRẮC</b>
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
                                                            <b>Đối tượng khai thác sử dụng</b>
                                                        </label>
                                                        <div class="col-md-3">
                                                            <?php
                                                            echo '<input class="form-control input-sm" id="thoihan-ktsd"
                                                                type="text"' . 'value=' . '"' . $data_info_ctkt[$i_check]["tenDoiTuongKTSD"] . '"' . '>'
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Đơn vị</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            echo '<input class="form-control input-sm" 
                                                                type="text"' . 'value=' . '"' . 'm³/ngày' . '"' . '>'
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
                                                                if ($data_info_ctkt[$i]["tinhTrangHoatDong"] == 't') {
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
                                <!-- Thông tin điểm KTSD xt -->
                                <div class="card">
                                    <div class="card-block pdd-vertical-15 pdd-horizon-15">
                                        <h4 class="card-title text-bold text-info">
                                            Thông tin điểm Quan Trắc
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="poi_qt_nm" class="table table-sm table-hover table-bordered">
                                                    <!-- DOM after Process Data -->
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="list-ctkt text-right">
                                                    <a href="#" class="btn btn-info btn-sm" id="create_poi_qt_nm">
                                                        <i class="ti-plus pdd-right-5"></i>
                                                        <span>Thêm mới</span>
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm" id="delete_poi_qt_nm">
                                                        <i class="ti-eraser pdd-right-5"></i>
                                                        <span>Xóa</span>
                                                    </a>
                                                    <a href="#" class="btn btn-success btn-sm" id="export_poi_qt_nm">
                                                        <i class="ti-export pdd-right-5"></i>
                                                        <span>Xuất dữ liệu</span>
                                                    </a>
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

    <!-- Thông tin điểm QT_NM -->
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
                    window.open("../../map.php?idpoi=" + iddiem + "&type=qt_nm")
                }
            },
            {
                title: "#",
                field: "STT",
                frozen: true,
                hozAlign: "center"
            },
            {
                title: "Điểm Quan Trắc",
                field: "id_diem",
                frozen: true,
                hozAlign: "center",
                formatter: "link",
                formatterParams: {
                    labelField: "sohieudiem",
                    <?php
                    echo 'urlPrefix: "form-poi-qt-nm.php?macongtrinh=' . $macongtrinh . '&iddiem=",'
                    ?>
                    target: "_blank",
                }
            },
            {
                title: "Lưu vực sông",
                field: "luuvucsong",
                hozAlign: "center",
                width: 320
            },
            {
                title: "Tọa độ Y",
                field: "toadoX",
                hozAlign: "center",
            },
            {
                title: "Tọa độ X",
                field: "toadoY",
                hozAlign: "center"
            },
            {
                title: "Tuần suất bảo trì",
                field: "tuanSuatBaoTri",
                hozAlign: "center",
                width: 250
            },
            {
                title: "Mã trạm cũ",
                field: "ma_tramcu",
                hozAlign: "center"
            },
            {
                title: "Tình trạng hoạt động",
                field: "tinhTrangHoatDong",
                hozAlign: "center"
            }
        ];
        /*---- Lấy JSON bằng Php ----*/
        <?php
        $script = 'var tabledata = ' . $final_poi_qt_nm . ";";
        echo $script;
        ?>

        $("#poi_qt_nm").css("border-top", "1px solid #dee2e6");
        var selected_id;
        var table = new Tabulator("#poi_qt_nm", {
            columns: columns_title,
            rowSelectionChanged: function(data, rows) {
                selected_id = data;
            }
        })
        table.setData(tabledata)

        /*** Delete DiemKTSD_xt ***/
        $("#delete_poi_qt_nm").click(function(e) {
            e.preventDefault();
            if (selected_id.length == 0) {
                alert("Vui lòng chọn điểm quan trắc cần xóa")
            } else {
                if (confirm("Bạn chắc chắn muốn xóa các điểm quan trắc đã chọn này ?")) {
                    var id_diem = [];
                    selected_id.forEach(function(item, index) {
                        /*** Get id_diem ***/
                        id_diem.push(item.id_diem);
                    })
                    var response_post = $.post("delete-poi-qt-nm.php", {
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

        /*** Create new DiemKTSD_xt (Button) ***/
        $("#create_poi_qt_nm").click(function(e) {
            e.preventDefault();
            <?php
            echo 'location.href = "form-poi-qt-nm.php?macongtrinh=' . $macongtrinh . '"';
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
                    echo 'urlPrefix: "form-gp-xt.php?macongtrinh=' . $macongtrinh . '&idgp=",'
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
                            height: "25rem"
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
        $script = 'var tabledata = ' . $final_gp_xt . ";";
        echo $script;
        ?>
        $("#gp_xt").css("border-top", "1px solid #dee2e6");
        var selected_id;
        var table = new Tabulator("#gp_xt", {
            columns: columns_title,
            rowSelectionChanged: function(data, rows) {
                selected_id = data;
            }
        })
        table.setData(tabledata);

        /*** Delete ThongtinCP_XT ***/
        $("#delete_gp_xt").click(function(e) {
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
                    var response_post = $.post("delete-gp-xt.php", {
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

        /*** Create new ThongtinCP_xt (Button) ***/
        $("#create_gp_xt").click(function(e) {
            e.preventDefault();
            <?php
            echo 'location.href = "form-gp-xt.php?macongtrinh=' . $macongtrinh . '"';
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
                    echo 'urlPrefix: "form-thvp-xt.php?macongtrinh=' . $macongtrinh . '&idthvp=",'
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
        $script = 'var tabledata = ' . $final_thvp_xt . ";";
        echo $script;
        ?>
        <?php
        if (count($data_thvp_xt) != 0) {
            echo '$("#thvp_xt").css("border-top", "1px solid #dee2e6");';
        } else {
            echo '$("#thvp_xt").css("border-top", "none");';
        }
        ?>
        var selected_id;
        var table = new Tabulator("#thvp_xt", {
            <?php
            if (count($data_thvp_xt) != 0) {
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

        /*** Delete TinhHinhViPham_XT ***/
        $("#delete_thvp_xt").click(function(e) {
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
                    var response_post = $.post("delete-thvp-xt.php", {
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

        /*** Create new TinhHinhViPham_XT (Button) ***/
        $("#create_thvp_xt").click(function(e) {
            e.preventDefault();
            <?php
            echo 'location.href = "form-thvp-xt.php?macongtrinh=' . $macongtrinh . '"';
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

        /*---- Update Thông tin công trình ----*/
        $("#update_info_ctkt").click(function() {
            var tencongtrinh = $("#tencongtrinh").val();
            /*** CT_KTSD ***/
            var diachi_congtrinh = $("#diachi_ct").val();
            /*** Option lấy mã của option được Chọn và Text
            var ma_mucdichktsd = $("#mucdich").val()
            var mucdich_text = $("#mucdich option:selected").text() ***/
            var thoihan_ktsd = $("#thoihan_ktsd").val();
            var ma_dvhc = $("#phuongxa").val();
            var quanhuyen_text = $("#quanhuyen option:selected").text()
            var phuongxa_text = $("#phuongxa option:selected").text()
            /*** ThongtinCP_xt ***/
            var tong_diemxa = $("#tong_diemxa").val();
            var tongLLX = $("#tongLLX").val();
            var tongLLX_muakho = $("#tongLLX_muakho").val();

            var response_post = $.post("update-xt-info.php", {
                <?php
                echo '"macongtrinh":' . $macongtrinh . ",";
                ?>
                /*** CT_KTSD ***/
                "tencongtrinh": tencongtrinh,
                "diachi_congtrinh": diachi_congtrinh,
                /* "ma_mucdichktsd": ma_mucdichktsd, */
                "thoihan_ktsd": thoihan_ktsd,
                "ma_dvhc": ma_dvhc,
                /*** ThongtinCP_xt ***/
                <?php
                echo '"i_check":' . $i_check . ",";
                ?> "tong_diemxa": tong_diemxa == "" ? 'NULL' : tong_diemxa,
                "tongllxt": tongLLX,
                "tongllxt_muakho": tongLLX_muakho,
            }).done(function(data) {
                /*** Reset Input ***/
                if (data != "error") {
                    $("#info-ctkt").modal("hide");
                    /*** Update Thông tin công trình ***/
                    $("#ten-congtrinh").val(tencongtrinh);
                    $("#diachi-congtrinh").val(diachi_congtrinh);
                    /* $("#type-mucdich").val(data);
                    $("#mucdich-text").val(mucdich_text); */
                    $("#thoihan-ktsd").val(thoihan_ktsd);
                    $("#quan-huyen").val(quanhuyen_text);
                    $("#phuong-xa").val(phuongxa_text);
                    $("#tongdiemxa").val(tong_diemxa);
                    $("#tong-llxt").val(tongLLX);
                    $("#tong-llxt-muakho").val(tongLLX_muakho);
                } else {
                    alert("Lỗi cập nhật dữ liệu");
                }
            })
        })
    </script>
</body>

</html>
