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
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>Chất lượng môi trường Đồng Tháp</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/SoTNMT.ico">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="vendors/PACE/themes/blue/pace-theme-minimal.css"/>
    <link rel="stylesheet" href="vendors/perfect-scrollbar/css/perfect-scrollbar.min.css"/>

    <!-- Page Plugins CSS -->
    <link rel="stylesheet" href="vendors/selectize/dist/css/selectize.default.css"/>
    <link rel="stylesheet" href="vendors/bootstrap-daterangepicker/daterangepicker.css"/>
    <link rel="stylesheet" href="vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css"/>
    <link rel="stylesheet" href="vendors/summernote/dist/summernote.css"/>

    <link rel="stylesheet" href="vendors/bower-jvectormap/jquery-jvectormap-1.2.2.css"/>
    <link rel="stylesheet" href="vendors/nvd3/build/nv.d3.min.css"/>

    <!-- Core CSS -->
    <link href="assets/css/ei-icon.css" rel="stylesheet">
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/fonts/icomoon/styles.min.css" rel="stylesheet">
    <link href="assets/fonts/glyphicon/glyphicon.css" rel="stylesheet">
    <link href="assets/css/animate.min.css" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">

    <!-- Map CSS -->
    <link href="assets_map/css/leaflet.css" rel="stylesheet">
    <link href="assets_map/css/MarkerCluster.css" rel="stylesheet">
    <link href="assets_map/css/MarkerCluster.Default.css" rel="stylesheet">
    <link href="assets_map/css/leaflet.zoomhome.css" rel="stylesheet">
    <link href="assets_map/css/leaflet-gps.css" rel="stylesheet">
    <link href="assets_map/css/leaflet-sidebar.css" rel="stylesheet">
    <link href="assets_map/css/Control.FullScreen.css" rel="stylesheet">
    <link href="assets_map/css/L.Icon.Pulse.css" rel="stylesheet">
    <link href="assets_map/css/L.Control.Basemaps.css" rel="stylesheet">
    <link href="assets_map/css/Control.LatLng.css" rel="stylesheet">
    <link href="assets_map/css/leaflet-measure.css" rel="stylesheet"/>
    <link href="assets_map/css/Control.Geocoder.css" rel="stylesheet"/>
    <link href="assets_map/css/mapStyle.css" rel="stylesheet">
</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Side Nav START -->
            <div class="side-nav">
                <div class="side-nav-inner">
                    <div class="side-nav-logo" style="height: 150px">
                        <a href="index.php">
                            <img src="assets/images/monre_logo.png" class="cus_logo"/>
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
                            <a href="index.php">
                                <span class="icon-holder">
                                    <i class="icon-home2 font-size-14"></i>
                                </span>
                                <span class="title">Trang chủ</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="map.php">
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
                                    <a href="congcu-thongke/import-excel.php">
                                        <i class="ti-export pdd-right-5"></i>
                                        <span>Chuyển File bán tự động</span>
                                    </a>

                                </li>
                                <li>
                                    <a href="congcu-thongke/threshold.php">
                                        <i class="ti-alert pdd-right-5"></i>
                                        <span>Danh sách vượt ngưỡng</span>
                                    </a>

                                </li>
                                <li>
                                    <a href="congcu-thongke/statistic.php">
                                        <i class="ti-bar-chart-alt pdd-right-5"></i>
                                        <span>Thống kê quan trắc</span>
                                    </a>

                                </li>
                                <li>
                                    <a href="congcu-thongke/aqi-wqi.php">
                                        <i class="fa fa-leaf pdd-right-5"></i>
                                        <span>Đánh giá AQI - WQI</span>
                                    </a>

                                </li>
                                <li>
                                    <!-- <a href="congcu-thongke/report.php">
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
                                    <a class="" href="congtrinh-quantrac/giengqt-ndd.php">Giếng QT Nước dưới đất</a>
                                </li>
                                <li>
                                    <a class="" href="congtrinh-quantrac/diemqt-nm.php">Điểm QT Nước mặt</a>
                                </li>
                                <li>
                                    <a class="" href="congtrinh-khaithac/giamsatnuoc.php">Giám sát tài nguyên nước</a>
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
                                    <a href="congtrinh-khaithac/ktsd-nuocmat.php" class="">KTSD Nước mặt</a>
                                </li>
                                <li>
                                    <a href="congtrinh-khaithac/ktsd-nuocduoidat.php" class="">KTSD Nước dưới đất</a>
                                </li> -->
                                <li>
                                    <a href="congtrinh-khaithac/nguonxathai.php" class="">Nguồn xả thải</a>
                                </li>
                                <!-- <li>
                                    <a href="congtrinh-khaithac/thamdo.php" class="">CT Thăm dò Nước dưới đất</a>
                                </li> -->
                                <!-- <li>
                                    <a href="congtrinh-khaithac/giamsatnuoc.php" class="">Giám sát tài nguyên nước</a>
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
                                    <a href="baocao-thongke/giayphep-nuocmat.php" class="">Giấy phép Nước mặt</a>
                                </li>
                                <li>
                                    <a href="baocao-thongke/giayphep-nuocduoidat.php" class="">Giấy phép Nước dưới đất</a>
                                </li> -->
                                <li>
                                    <a href="baocao-thongke/giayphep-xathai.php" class="">Giấy phép Xả thải</a>
                                </li>
                                <!--<li>
                                    <a href="baocao-thongke/giayphep-thamdo.php" class="">Giấy phép Thăm dò</a>
                                </li>-->
                                <!-- <li>
                                    <a href="baocao-thongke/giayphep-hanhnghe.php" class="">Giấy phép Hành nghề</a>
                                </li> -->
                                <li>
                                    <a href="baocao-thongke/thongke-tramquantrac.php" class="">Thống kê Trạm quan trắc</a>
                                </li>
                                <li>
                                    <a href="baocao-thongke/hochua-lvs.php" class="">Tổng hợp hồ chứa, LVS</a>
                                </li>
                                <li>
                                    <a href="baocao-thongke/ctkt-nguonnuoc.php" class="">Số CTKT theo Nguồn nước</a>
                                </li>
                                <li>
                                    <a href="baocao-thongke/ctkt-mucdichsudung.php" class="">Số CTKT theo MĐSD</a>
                                </li>
                                <!-- <li>
                                    <a href="baocao-thongke/ctkt-loaihinh.php" class="">Số CTKT theo Loại hình</a>
                                </li>
                                <li>
                                    <a href="baocao-thongke/water-ktsd-cp.php" class="">Lượng nước KTSD được CP</a>
                                </li> -->
                                <li>
                                    <a href="baocao-thongke/gp-dacap.php" class="">Số lượng GP đã cấp</a>
                                </li>
                                <li>
                                    <a href="baocao-thongke/tien-cqkt.php" class="">Tiền cấp quyền KT</a>
                                </li>
                                <!--<li>
                                    <a href=baocao-thongke/danhmuc-ctktsd.php" class="">Danh mục CTKTSD</a>
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
                                            <a class="mrg-left-10" href="danhmuc/doanhnghiep.php">Doanh nghiệp</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="danhmuc/loaihinhdoanhnghiep.php">Loại hình doanh
                                                nghiệp</a>
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
                                            <a class="mrg-left-10" href="danhmuc/donvicapphep.php">Đơn vị cấp phép</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="danhmuc/donviquanly.php">Đơn vị quản lý</a>
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
                                            <a class="mrg-left-10" href="danhmuc/doituongktsd.php">Đối tượng khai thác</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="danhmuc/mucdichktsd.php">Mục đích khai thác</a>
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
                                            <a class="mrg-left-10" href="danhmuc/diadanh.php">Địa danh</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="danhmuc/loaidiadanh.php">Loại địa danh</a>
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
                                            <a class="mrg-left-10" href="danhmuc/loaitram.php">Loại trạm</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="danhmuc/loaihinh.php">Loại hình</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="danhmuc/loaicongtrinh.php">Loại công trình</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="danhmuc/loaigiayphep.php">Loại giấy phép</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="danhmuc/quychuan.php">Quy chuẩn</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="danhmuc/thongso.php">Thông số</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="danhmuc/donvi.php">Đơn vị</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="danhmuc/chatluongmt.php">Chất lượng môi trường</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="danhmuc/mucdichsudung.php">Mục đích sử dụng</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="danhmuc/chitieu.php">Chỉ tiêu</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="danhmuc/tangchuanuoc.php" class="">Tầng chứa nước</a>
                                </li>
                                <li>
                                    <a href="danhmuc/luuvucsong.php" class="">Lưu vực sông</a>
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
                                    <img class="profile-img img-fluid" src="assets/images/logo/user.png" alt="">
                                    <div class="user-info">
                                        <span class="name pdd-right-5">
                                            <?php
                                                require_once("services/config.php");
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
                                        <a href="logout.php">
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
                                            <a href="#about"
                                               class="nav-link active" role="tab" data-toggle="tab">
                                                <i class="icon-profile pdd-right-10"></i>
                                                Giới thiệu dự án
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#contact"
                                               class="nav-link" role="tab" data-toggle="tab">
                                                <i class="fa fa-envelope pdd-right-10"></i>
                                                Liên hệ chúng tôi
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#developers"
                                               class="nav-link" role="tab" data-toggle="tab">
                                                <i class="fa fa-exclamation-circle pdd-right-10"></i>
                                                Đơn vị phát triển phần mềm
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="aboutTabsContent">
                                        <div role="tabpanel" class="tab-pane fade in active" id="about">
                                            <div class="pdd-horizon-15 pdd-vertical-20">
                                                <p>Hệ thống truyền, nhận, quản lý và công bố dữ liệu các hệ thống quản trị tài nguyên nước của tỉnh Đồng Tháp
                                                    tích hợp số liệu quan trắc các nguồn thải từ các khu công nghiệp, khu chế xuất và khu công nghệ cao nói riêng và quan trắc
                                                    nguồn điểm nói chung nhằm mục đích bảo vệ nguồn tiếp nhận (sông, hồ), đảm bảo chất lượng nước thải của các khu công nghiệp,
                                                    khu chế xuất, khu công nghệ cao trước khi thải vào nguồn tiếp nhận;</p>
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading" style="text-align: center">
                                                        <b>CÁC NGUỒN TIẾP NHẬN</b>
                                                    </div>
                                                    <ul class="list-group">
                                                        <li class="list-group-item">Các trạm quan trắc tự động</li>
                                                        <li class="list-group-item">Các trạm quan trắc bán tự động</li>
                                                        <li class="list-group-item">Các doanh nghiệp xả thải trên 1000 m³</li>
                                                    </ul>
                                                    <a href="HDSD_QuanTracDongThap.docx">Hướng dẫn sử dụng</a>
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
                                                                    <input class="form-control" style="border: 1px solid #888da8"
                                                                           id="first-name" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="last-name">Địa chỉ Email</label>
                                                                    <input class="form-control" style="border: 1px solid #888da8"
                                                                           id="last-name" type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="message">Tin nhắn:</label>
                                                                    <textarea class="form-control" style="border: 1px solid #888da8"
                                                                              id="message" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 align-self-center">
                                                                <div class="form-group">
                                                                    <button class="btn btn-info pull-right"
                                                                            data-dismiss="modal" type="submit">Gửi đến chúng tôi
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
                                <button class="btn btn-info" data-dismiss="modal"
                                        type="button">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal END -->

                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="full-container">
                        <div id="map"></div>
                    </div>
                </div>
                <!-- Content Wrapper END -->

                <!-- Side Panel For Map -->
                <div id="sidebar" class="leaflet-sidebar collapsed">

                    <!-- nav tabs -->
                    <div class="leaflet-sidebar-tabs">
                        <!-- top aligned tabs -->
                        <ul role="tablist">
                            <li>
                                <a href="#search" role="tab">
                                    <i class="ti-map-alt active" style="margin-left: -3px"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#autopan" role="tab">
                                    <i class="ti-layers-alt" style="margin-left: -3px"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- panel content -->
                    <div class="leaflet-sidebar-content">
                        <div class="leaflet-sidebar-pane" id="search">
                            <h3 class="leaflet-sidebar-header">
                                <b class="font-size-14">Tìm kiếm dữ liệu trên bản đồ</b>
                                <!-- <span class="leaflet-sidebar-close">
                                    <i class="fa fa-caret-left"></i>
                                </span> -->
                            </h3>
                            <div class="row mrg-top-5" style="width: 77.5%">
                                <div class="col-md-12 no-pdd">
                                    <div class="card">
                                        <div class="card-block pdd-horizon-10 pdd-vertical-10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form class="form-horizontal">
                                                        <div class="form-group row list-ctkt">
                                                            <label style="margin-top: 7px" class="col-md-12 control-label">
                                                                <b>Loại công trình</b>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <select class="form-control" id="loaicongtrinh">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row list-ctkt">
                                                            <label style="margin-top: 7px" class="col-md-12 control-label">
                                                                <b>Tên công trình</b>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <input class="form-control input-sm" placeholder="Tên công trình"
                                                                       type="text" name="tencongtrinh" id="tencongtrinh" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group row list-ctkt">
                                                            <label style="margin-top: 7px" class="col-md-12 control-label">
                                                                <b>Giấy phép</b>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <input class="form-control input-sm" placeholder="Giấy phép"
                                                                       type="text" name="giayphep" id="giayphep" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group row list-ctkt">
                                                            <label style="margin-top: 7px" class="col-md-12 control-label">
                                                                <b>Doanh nghiệp</b>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <input class="form-control input-sm" placeholder="Doanh nghiệp"
                                                                       type="text" name="doanhnghiep" id="doanhnghiep" />
                                                            </div>
                                                        </div>

                                                        <div class="ctqt form-group row list-ctkt" style="display: none">
                                                            <label style="margin-top: 7px" class="col-md-12 control-label">
                                                                <b>Loại hình</b>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <select class="form-control" name="loaihinh" id="loaihinh">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="ctqt form-group row list-ctkt" style="display: none">
                                                            <label style="margin-top: 7px" class="col-md-12 control-label">
                                                                <b>Loại trạm</b>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <select class="form-control" name="loaitram" id="loaitram">
                                                                    <option>Tự động</option>
                                                                    <option>Bán tự động</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row list-ctkt">
                                                            <label style="margin-top: 7px" class="col-md-12 control-label">
                                                                <b>Thị xã/Huyện/Thành phố</b>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <select class="form-control" name="district" id="district">
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 text-right no-pdd">
                                                            <a class="btn-xs btn btn-info no-mrg" id="poi_search">
                                                                <span class="text-white font-size-12">Tìm kiếm</span>
                                                            </a>
                                                            <a class="btn-xs btn btn-danger no-mrg" id="reset_search">
                                                                <span class="text-white font-size-12">Reset</span>
                                                            </a>
                                                        </div>

                                                        <!-- Kết quả tìm kiếm -->
                                                        <div class="form-group row list-ctkt no-mrg-btm">
                                                            <div class="col-md-12 search-error mrg-top-10 mrg-left-55" style="display: none">
                                                                <i class="icon-alert font-size-12" style="margin-top: -1px"></i>
                                                                <span>Không tìm thấy trạm quan trắc</span>
                                                            </div>
                                                            <div class="col-md-12 search-success mrg-top-10 mrg-left-55" style="display: none">
                                                                <i class="icon-check font-size-14" style="margin-top: -1px"></i>
                                                                <span id="success_alert"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row list-ctkt">
                                                            <label style="margin-top: 7px" class="col-md-12 control-label">
                                                                <b>Điểm/Giếng</b>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <select class="form-control" name="poi_res" id="poi_res" onchange="search_poi()">
                                                                    <option value="none">--Lựa chọn điểm/giếng--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="leaflet-sidebar-pane" id="autopan">
                            <h3 class="leaflet-sidebar-header">
                                <b class="font-size-14">Chú thích bản đồ</b>
                                <div class="row mrg-top-5" style="width: 77.5%">
                                    <div class="col-md-12 no-pdd">
                                        <div class="card">
                                            <div class="card-header pdd-vertical-5">
                                                <span class="font-size-14 text-center text-info text-bold">Chú thích các công trình Điểm/Giếng</span>
                                            </div>
                                            <div class="card-block pdd-horizon-5 pdd-vertical-5">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <form class="form-horizontal">
                                                            <div class="form-group row list-ctkt">
                                                                <label style="" class="col-md-12 control-label">
                                                                    <div class="point_legend_div">
                                                                        <i class="fa fa-dot-circle-o legend_icon"></i>
                                                                    </div>
                                                                    <b class="text-dark font-size-13 legend_name"> - Giếng KTSD Nước dưới đất</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <div class="point_legend_div">
                                                                        <i class="icon-air legend_icon" style="margin-top: 5px"></i>
                                                                    </div>
                                                                    <b class="text-dark font-size-13 legend_name"> - Điểm KTSD Nước mặt</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <div class="point_legend_div">
                                                                        <i class="fa fa-recycle legend_icon" style="margin-left: 3px"></i>
                                                                    </div>
                                                                    <b class="text-dark font-size-13 legend_name"> - Nguồn Xả thải</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <div class="point_legend_div">
                                                                        <i class="icon-server legend_icon" style="margin-top: 5px"></i>
                                                                    </div>
                                                                    <b class="text-dark font-size-13 legend_name"> - Giếng Thăm dò Nước dưới đất</b>
                                                                </label>

                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <div class="point_legend_div">
                                                                        <i class="fa fa-dot-circle-o legend_icon"></i>
                                                                    </div>
                                                                    <i class="text-bold text-dark font-size-13 legend_name"> - Còn hoạt động</i>
                                                                </label>

                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <div class="point_legend_div" style="border-radius: 25%">
                                                                        <i class="fa fa-dot-circle-o legend_icon" style="color: red"></i>
                                                                    </div>
                                                                    <i class="text-bold text-dark font-size-13 legend_name"> - Đã trám lấp/Ngừng hoạt động</i>
                                                                </label>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 no-pdd">
                                        <div class="card">
                                            <div class="card-header pdd-vertical-5" style="text-align: center">
                                                <span class="font-size-14 text-info text-bold">Chú thích Địa chất - Thủy văn</span>
                                            </div>
                                            <div class="card-block pdd-horizon-5 pdd-vertical-5">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <form class="form-horizontal">
                                                            <div class="form-group row list-ctkt">
                                                                <label style="" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranhdutgay.png" />
                                                                    <b class="text-dark font-size-13"> - Ranh đứt gãy</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranh2.png" />
                                                                    <b class="text-dark font-size-13"> - Ranh giới phân bố tầng chứa nước Miocen trên</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranh3.png" />
                                                                    <b class="text-dark font-size-13"> - Ranh giới phân bố tầng chứa nước Holocen</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranh4.png" />
                                                                    <b class="text-dark font-size-13"> - Ranh giới vùng có giá trị Modun khác nhau (Tầng chứa nước bị che phủ)</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranh5.png" />
                                                                    <b class="text-dark font-size-13"> - Ranh giới vùng có giá trị Modun khác nhau (Tầng chứa nước lộ trên mặt)</b>
                                                                </label>
                                                                <label style="" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranh6.png" />
                                                                    <b class="text-dark font-size-13"> - Ranh tầng chứa nước Holocen</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranh7.png" />
                                                                    <b class="text-dark font-size-13"> - Ranh tầng chứa nước Pilestocen trên</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranh8.png" />
                                                                    <b class="text-dark font-size-13"> - Ranh tầng chứa nước Pilestocen giữa - trên</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranh9.png" />
                                                                    <b class="text-dark font-size-13"> - Ranh tầng chứa nước Pilestocen dưới</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranh10.png" />
                                                                    <b class="text-dark font-size-13"> - Ranh tầng chứa nước Pliocen giữa</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranh11.png" />
                                                                    <b class="text-dark font-size-13"> - Ranh tầng chứa nước Pliocen dưới</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranh12.png" />
                                                                    <b class="text-dark font-size-13"> - Ranh tầng chứa nước Miocen trên</b>
                                                                </label>

                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranh13.png" />
                                                                    <b class="text-dark font-size-13"> - Tầng chứa nước lỗ hổng lộ bề mặt (Nghèo Md &#60; 200)</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranh14.png" />
                                                                    <b class="text-dark font-size-13"> - Tầng chứa nước lỗ hổng lộ bề mặt (Trung bình 200 &#60; Md &#8804; 500)</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranh15.png" />
                                                                    <b class="text-dark font-size-13"> - Tầng chứa nước bị phủ (Nghèo Md &#60; 200)</b>
                                                                </label>
                                                                <label style="margin-top: -10px" class="col-md-12 control-label">
                                                                    <img src="assets/images/ranh16.png" />
                                                                    <b class="text-dark font-size-13"> - Tầng chứa nước bị phủ (Trung bình 200 &#60; Md &#8804; 500)</b>
                                                                </label>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Side Panel START -->
                <div class="side-panel" id="side-feature">
                    <div class="side-panel-wrapper bg-white" style="height: 100vh">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-left-0 border-right-0 border-top-0 no-mrg-btm"
                                     style="border-radius: 0">
                                    <div class="card-block pdd-vertical-10">
                                        <h5 class="card-title panel-close"
                                            style="margin-top: 7px; margin-bottom: 7px">
                                            <a class="side-panel-toggle" href="javascript:void(0);">
                                                <b class="pdd-right-15">THÔNG TIN CHI TIẾT</b>
                                                <i class="ti-close pdd-left-40"></i>
                                            </a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="accor-feat" class="accordion panel-group" role="tablist" aria-multiselectable="true">
                                            <div class="panel panel-default no-mrg-btm">
                                                <div class="panel-heading" role="tab" id="info-poi">
                                                    <h4 class="panel-title bg-info">
                                                        <a data-toggle="collapse" data-parent="#accor-feat"
                                                           href="#poi" class="pdd-horizon-10 pdd-vertical-10">
                                                            <span class="font-size-12 text-bold text-white">
                                                                <i class="icon-info22 pdd-right-10"></i>
                                                                Thông tin điểm khai thác
                                                            </span>
                                                            <i class="icon ti-angle-down font-size-10 text-white"
                                                               style="margin-top: 9px"></i>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="poi" class="collapse panel-collapse show">
                                                    <!-- DOM Form Disable -->
                                                </div>
                                            </div>
                                            <div class="panel panel-default no-mrg-btm">
                                                <div class="panel-heading" role="tab" id="info-ctkt">
                                                    <h4 class="panel-title bg-info">
                                                        <a data-toggle="collapse" data-parent="#accor-feat"
                                                           href="#ctkt" class="pdd-horizon-10 pdd-vertical-10">
                                                            <span class="font-size-12 text-bold text-white">
                                                                <i class="ei-antenna pdd-right-10"></i>
                                                                Thông tin công trình khai thác
                                                            </span>
                                                            <i class="icon ti-angle-down font-size-10 text-white"
                                                               style="margin-top: 9px"></i>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="ctkt" class="collapse panel-collapse show">
                                                    <!-- DOM Form Disable -->
                                                </div>
                                            </div>
                                            <!-- <div class="panel panel-default no-mrg-btm">
                                                <div class="panel-heading" role="tab" id="info-ctkt">
                                                    <h4 class="panel-title bg-info">
                                                        <a data-toggle="collapse" data-parent="#accor-feat"
                                                           href="#gp" class="pdd-horizon-10 pdd-vertical-10">
                                                            <span class="font-size-12 text-bold text-white">
                                                                <i class="icon-pagebreak pdd-right-10"></i>
                                                                Danh sách giấy phép
                                                            </span>
                                                            <i class="icon ti-angle-down font-size-10 text-white"
                                                               style="margin-top: 9px"></i>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="gp" class="collapse panel-collapse show">
                                                    <!-- DOM Form Disable -->
                                              <!--  </div>
                                                </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Side Panel END -->
            </div>
            <!-- Page Container END -->
        </div>
    </div>

    <script src="assets/js/vendor.js"></script>
    <script src="assets_map/js/map_function/config.js"></script>

    <!-- Page Plugins JS -->
    <script src="vendors/d3/d3.min.js"></script>
    <script src="vendors/nvd3/build/nv.d3.min.js"></script>
    <script src="vendors/jquery.sparkline/index.js"></script>


    <script src="vendors/select2/dist/js/select2.js"></script>
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="vendors/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="vendors/summernote/dist/summernote.min.js"></script>

    <!-- Map JS -->
    <script src="assets_map/js/leaflet_plugin/leaflet.js"></script>
    <script src="assets_map/js/leaflet_plugin/leaflet.ajax.js"></script>
    <script src="assets_map/js/leaflet_plugin/leaflet.markercluster.js"></script>
    <script src="assets_map/js/leaflet_plugin/leaflet.zoomhome.js"></script>
    <script src="assets_map/js/leaflet_plugin/leaflet-gps.js"></script>
    <script src="assets_map/js/leaflet_plugin/leaflet-sidebar.js"></script>
    <script src="assets_map/js/leaflet_plugin/Control.FullScreen.js"></script>
    <script src="assets_map/js/leaflet_plugin/L.Icon.Pulse.js"></script>
    <script src="assets_map/js/leaflet_plugin/L.Control.Basemaps.js"></script>
    <script src="assets_map/js/leaflet_plugin/Leaflet.Control.Custom.js"></script>
    <script src="assets_map/js/leaflet_plugin/Control.LatLng.js"></script>
    <script src="assets_map/js/leaflet_plugin/rbush.js"></script>
    <script src="assets_map/js/leaflet_plugin/labelgun.js"></script>
    <script src="assets_map/js/leaflet_plugin/geojson-bbox.js"></script>
    <script src="assets_map/js/leaflet_plugin/leaflet-measure.js"></script>
    <script src="assets_map/js/leaflet_plugin/Control.Geocoder.js"></script>

    <!-- Map JS Custom -->
    <script src="assets_map/js/map_function/mapScript.js"></script>
    <script src="assets_map/js/map_function/mapSide.js"></script>
    <script src="assets_map/js/map_function/mapSearch.js"></script>
    <script src="assets_map/js/map_function/mapInfo.js"></script>
    <script src="assets_map/js/map_function/mapRanhThua.js"></script>
    <script src="assets_map/js/map_function/mapInfo_RanhThua.js"></script>

    <!-- Main JS Custom -->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/forms/form-elements.js"></script>

    <script>
        if ($("*").width() <= 1440 && $("*").width() >= 767) {
            $(".app").toggleClass("is-collapsed");
        }

        $('.dropdown-menu').on('click', function (e) {
            e.stopPropagation();
        });

        /*** Custom formate date-cus ***/
        $('.date-cus').datepicker({
            language: "vi",
            format: "dd/mm/yyyy"
        });
    </script>
</body>
</html>
