<?php
include "../config.php"
?>
<?php
if (isset($_GET["idsoHieu"])) {
    $idsoHieu = $_GET["idsoHieu"];
    $querry_poi_giengqt_ndd = 'SELECT giengqt_ndd.*, tangchuanuoc.name "TangChuaNuoc", diadanh.name "DiaDanh" FROM "GiengQT_NDD" giengqt_ndd
                                LEFT JOIN "CT_KTSD" CK ON giengqt_ndd.ma_congtrinhktsd = CK.id
                                LEFT JOIN "TangChuaNuoc" tangchuanuoc ON giengqt_ndd.ma_tangchuanuoc = tangchuanuoc.id
                                LEFT JOIN "Location" diadanh ON giengqt_ndd.ma_diadanhqt = diadanh.id
                                WHERE giengqt_ndd.id ='."'".$idsoHieu."'";
    $result_poi_giengqt_ndd = pg_query($tiengiang_db, $querry_poi_giengqt_ndd);
    if (!$result_poi_giengqt_ndd) {
        echo "Không có dữ liệu.\n";
        exit;
    }
    $data_poi_giengqt_ndd = array();
    while ($row = pg_fetch_assoc($result_poi_giengqt_ndd)) {
        $data_poi_giengqt_ndd[] = $row;
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
                        <li class="nav-item dropdown open">
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
                        <li class="nav-item dropdown">
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

                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block pdd-vertical-15 pdd-horizon-15">
                                        <h4 class="card-title text-bold">
                                            THÔNG TIN GIẾNG QUAN TRẮC NƯỚC DƯỚI ĐẤT
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form class="form-horizontal">
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Số hiệu giếng quan trắc</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <?php
                                                            if (isset($_GET['idsoHieu'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="sohieugiengqt" 
                                                                            value=' . '"' . $data_poi_giengqt_ndd[0]["sohieugiengqt"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="sohieugiengqt"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Tầng chứa nước</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <select class="form-control input-sm" id="tang_chuanuoc">
                                                                <!-- DOM to Database -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Tên công trình</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <select class="form-control input-sm" id="congtrinh">
                                                                <!-- DOM to Database -->
                                                            </select>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Địa danh</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <select class="form-control input-sm" id="diadanh">
                                                                <!-- DOM to Database -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Tọa độ Y</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <?php
                                                            if (isset($_GET['idsoHieu'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="toadoX" 
                                                                            value=' . '"' . $data_poi_giengqt_ndd[0]["coordX"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="toadoX"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Tọa độ X</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <?php
                                                            if (isset($_GET['idsoHieu'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="toadoY" 
                                                                            value=' . '"' . $data_poi_giengqt_ndd[0]["coordY"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="toadoY"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Độ sâu giếng</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <?php
                                                            if (isset($_GET['idsoHieu'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="doSauGieng" 
                                                                            value=' . '"' . $data_poi_giengqt_ndd[0]["doSauGieng"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="doSauGieng"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Cao độ miệng giếng</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <?php
                                                            if (isset($_GET['idsoHieu'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="caoDoMiengGieng" 
                                                                            value=' . '"' . $data_poi_giengqt_ndd[0]["caoDoMiengGieng"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="caoDoMiengGieng"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Cao độ bể giếng</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <?php
                                                            if (isset($_GET['idsoHieu'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="caoDoBeGieng" 
                                                                            value=' . '"' . $data_poi_giengqt_ndd[0]["caoDoBeGieng"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="caoDoBeGieng"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Cao độ mặt đất</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <?php
                                                            if (isset($_GET['idsoHieu'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="caoDoMatDat" 
                                                                            value=' . '"' . $data_poi_giengqt_ndd[0]["caoDoMatDat"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="caoDoMatDat"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Chiều sâu chống ống</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <?php
                                                            if (isset($_GET['idsoHieu'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="chieuSauChongOng" 
                                                                            value=' . '"' . $data_poi_giengqt_ndd[0]["chieuSauChongOng"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="chieuSauChongOng"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Tình trạng hoạt động</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <select class="form-control input-sm" id="tinhTrangHoatDong">
                                                                <?php
                                                                if ($data_poi_giengqt_ndd[0]["tinhTrangHoatDong"] == 't') {
                                                                    echo '<option value="f">Đã trám lấp</option>
                                                                                <option value="t" selected>Còn hoạt động</option>';
                                                                } else {
                                                                    echo '<option value="f" selected>Đã trám lấp</option>
                                                                                <option value="t">Còn hoạt động</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Mô tả tầng chứa nước</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            if (isset($_GET['idsoHieu'])) {
                                                                echo '<textarea class="form-control" id="moTaTangChuaNuoc">' .
                                                                    $data_poi_giengqt_ndd[0]["moTaTangChuaNuoc"] . '</textarea>';
                                                            } else {
                                                                echo '<textarea class="form-control" id="moTaTangChuaNuoc"></textarea>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Mô tả mái cách nước</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            if (isset($_GET['idsoHieu'])) {
                                                                echo '<textarea class="form-control" id="moTaMaiCachNuoc">' .
                                                                    $data_poi_giengqt_ndd[0]["moTaMaiCachNuoc"] . '</textarea>';
                                                            } else {
                                                                echo '<textarea class="form-control" id="moTaMaiCachNuoc"></textarea>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Mô tả ống lọc</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            if (isset($_GET['idsoHieu'])) {
                                                                echo '<textarea class="form-control" id="moTaOngLoc">' .
                                                                    $data_poi_giengqt_ndd[0]["moTaOngLoc"] . '</textarea>';
                                                            } else {
                                                                echo '<textarea class="form-control" id="moTaOngLoc"></textarea>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="list-ctkt text-right">
                                                    <a href="#" class="btn btn-success btn-sm" id="save_poi_giengqt_ndd">
                                                        <i class="ti-save-alt pdd-right-5"></i>
                                                        <span>Lưu thông tin</span>
                                                    </a>
                                                    <a href='../../congtrinh-quantrac/giengqt-ndd.php' class="btn btn-info btn-sm">
                                                        <i class="ti-save-alt pdd-right-5"></i>
                                                        <span>Quay lại</span>
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

    <script>
        /*** DOM option Công trình quan trắc ***/
        $("#congtrinh").select2({
            ajax: {
                url: "../../services/congtrinhkhaithac.php",
                data: function(params) {
                    return {
                        searchTerm: params.term,
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            },
            tags: "true",
            placeholder: "--Lựa chọn công trình khai thác--",
            allowClear: true,
            width: "resolve",
            language: {
                searching: function() {
                    return "Đang tìm ...";
                }
            },
        });
        /*** Tìm Công trình để gắn selected ***/
        <?php
        if (isset($_GET['idsoHieu'])) {
            $querry_option = 'SELECT * FROM "CT_KTSD"'
                . ' WHERE id=' . $data_poi_giengqt_ndd[0]["ma_congtrinhktsd"];
            $result = pg_query($tiengiang_db, $querry_option);
            if (!$result) {
                echo "Không có dữ liệu";
            }

            $selected = [];
            while ($row = pg_fetch_assoc($result)) {
                $selected[] = array(
                    "id" => $row['id'],
                    "text" => $row['tenCongTrinh']
                );
            }

            echo '$("#congtrinh").select2("trigger", "select", {
                            data: ' .
                '{ id:' . $selected[0]["id"] . ',' .
                'text:' . "'" . $selected[0]["text"] . "'" .
                ',}' . '});';
        }
        ?>

        /*** DOM option Tầng chứa nước ***/
        $.getJSON("../tangchuanuoc-option.php", function(tang_chuanuoc) {
            $('#tang_chuanuoc')
                .append($("<option></option>")
                    .attr('value', 'none').text("--Lựa chọn tầng chứa nước--"));
            $.each(tang_chuanuoc, function(key, value) {
                /*** Đánh dấu Option Tầng chứa nước được chọn ***/
                <?php
                if (isset($_GET['idsoHieu'])) {
                    echo 'if (value.id == ' . $data_poi_giengqt_ndd[0]["ma_tangchuanuoc"] . ') {
                        $("#tang_chuanuoc")
                            .append($("<option></option>")
                                .attr("value", value.id).attr("selected", "selected").text(value.name));
                        } else {
                            $("#tang_chuanuoc")
                                .append($("<option></option>")
                                    .attr("value", value.id).text(value.name));
                        }';
                } else {
                    echo '$("#tang_chuanuoc")
                        .append($("<option></option>")
                        .attr("value", value.id).text(value.name));';
                }
                ?>
            });
        })

        /*** DOM option Địa danh ***/
        $.getJSON("../diadanh-option.php", function(diadanh) {
            $('#diadanh')
                .append($("<option></option>")
                    .attr('value', 'none').text("--Lựa chọn địa danh--"));
            $.each(diadanh, function(key, value) {
                /*** Đánh dấu Option Địa danh được chọn ***/
                <?php
                if (isset($_GET['idsoHieu'])) {
                    echo 'if (value.id == ' . $data_poi_giengqt_ndd[0]["ma_diadanhqt"] . ') {
                        $("#diadanh")
                            .append($("<option></option>")
                                .attr("value", value.id).attr("selected", "selected").text(value.name));
                        } else {
                            $("#diadanh")
                                .append($("<option></option>")
                                    .attr("value", value.id).text(value.name));
                        }';
                } else {
                    echo '$("#diadanh")
                        .append($("<option></option>")
                        .attr("value", value.id).text(value.name));';
                }
                ?>
            });
        })
    </script>
    <script>
        $("#save_poi_giengqt_ndd").click(function() {
            var sohieugiengqt = $("#sohieugiengqt").val();
            var tang_chuanuoc = $("#tang_chuanuoc").val();
            var congtrinh = $("#congtrinh").val();
            var diadanh = $("#diadanh").val();
            var toadoX = $("#toadoX").val();
            var toadoY = $("#toadoY").val();
            var doSauGieng = $("#doSauGieng").val();
            var caoDoMiengGieng = $("#caoDoMiengGieng").val();
            var caoDoBeGieng = $("#caoDoBeGieng").val();
            var caoDoMatDat = $("#caoDoMatDat").val();
            var chieuSauChongOng = $("#chieuSauChongOng").val();
            var tinhTrangHoatDong = $("#tinhTrangHoatDong").val();
            var moTaTangChuaNuoc = $("#moTaTangChuaNuoc").val();
            var moTaMaiCachNuoc = $("#moTaMaiCachNuoc").val();
            var moTaOngLoc = $("#moTaOngLoc").val();

            if (toadoX == "" || toadoY == "") {
                alert("Vui lòng nhập tọa độ!")
            } else {
                var response_post = $.post("save-giengqt-ndd.php", {
                    <?php
                    if (isset($_GET['idsoHieu'])) {
                        /*** Update Thông tin Diemgiengqt_ndd ***/
                        echo 'idsoHieu:' . $_GET['idsoHieu'] . ', ' ;
                    }
                    ?> "sohieugiengqt": sohieugiengqt,
                    "tang_chuanuoc": tang_chuanuoc,
                    "congtrinh": congtrinh,
                    "diadanh": diadanh,
                    "toadoX": toadoX,
                    "toadoY": toadoY,
                    "doSauGieng": doSauGieng,
                    "caoDoMiengGieng": caoDoMiengGieng,
                    "caoDoBeGieng": caoDoBeGieng,
                    "caoDoMatDat": caoDoMatDat,
                    "chieuSauChongOng": chieuSauChongOng,
                    "tinhTrangHoatDong": tinhTrangHoatDong,
                    "moTaTangChuaNuoc": moTaTangChuaNuoc,
                    "moTaMaiCachNuoc": moTaMaiCachNuoc,
                    "moTaOngLoc": moTaOngLoc
                }).done(function(data) {
                    if (data == "error") {
                        alert("Lỗi cập nhật dữ liệu")
                    } else {
                        alert("Cập nhật thành công!")
                        location.reload();
                    }
                })
            }
        })
    </script>
</body>

</html>
