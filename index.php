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

    <!-- Datatables CSS -->
    <link href="vendors/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="vendors/datatables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="vendors/datatables/media/css/select.dataTables.min.css" rel="stylesheet">
    <link href="vendors/datatables/media/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="vendors/datatables/media/css/buttons.bootstrap4.min.css" rel="stylesheet">

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
                                </li> -->
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
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-block no-pdd">
                                        <div class="card-header bg-info-inverse">
                                            <h5 class="text-bold text-center">GIẤY PHÉP KHAI THÁC SỬ DỤNG <br> NƯỚC DƯỚI ĐẤT</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <span class="col-md-7 text-bold font-size-14 mrg-top-20">Tổng số giấy phép: </span>
                                                <span class="col-md-5 text-bold text-success font-size-40">
                                                    <?php
                                                        require_once("services/config.php");
                                                        $query_ndd = 'select count("ThongTinCP_NDD".id) as "SoLuong"
                                                                      from "ThongTinCP_NDD"';
                                                        $result_ndd = pg_query($tiengiang_db, $query_ndd);
                                                        if (!$result_ndd) {
                                                            echo "Không có dữ liệu.\n";
                                                            exit;
                                                        }

                                                        $data_ndd = array();
                                                        while ($row = pg_fetch_assoc($result_ndd)) {
                                                            $data_ndd[] = $row;
                                                        }
                                                        echo $data_ndd[0]["SoLuong"]
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="row">
                                                <span class="col-md-7 text-bold font-size-14 mrg-top-20">Số giấy phép hết hiệu lực: </span>
                                                <span class="col-md-5 text-bold font-size-40" style="color: #ff0000">
                                                    <?php
                                                        require_once("services/config.php");
                                                        $query_ndd = 'select count("ThongTinCP_NDD".id) as "SoLuong"
                                                                      from "ThongTinCP_NDD" where "tinhTrangGiayPhep" ='."'"."f"."'";
                                                        $result_ndd = pg_query($tiengiang_db, $query_ndd);
                                                        if (!$result_ndd) {
                                                            echo "Không có dữ liệu.\n";
                                                            exit;
                                                        }

                                                        $data_ndd = array();
                                                        while ($row = pg_fetch_assoc($result_ndd)) {
                                                            $data_ndd[] = $row;
                                                        }
                                                        echo $data_ndd[0]["SoLuong"]
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="row">
                                                <span class="col-md-7 text-bold font-size-14 mrg-top-20">Số giấy phép sắp hết hạn: </span>
                                                <span class="col-md-5 text-bold text-warning font-size-40">
                                                    <?php
                                                        require_once("services/config.php");
                                                        $query = 'select count("ThongTinCP_NDD".id) as "SoLuong"
                                                                  from "ThongTinCP_NDD" where "ngayHetHan" <='."CURRENT_DATE + 7".' AND "tinhTrangGiayPhep" ='."'t'";
                                                        $result = pg_query($tiengiang_db, $query);
                                                        if (!$result) {
                                                            echo "Không có dữ liệu.\n";
                                                            exit;
                                                        }

                                                        $data = array();
                                                        while ($row = pg_fetch_assoc($result)) {
                                                            $data[] = $row;
                                                        }
                                                        echo $data[0]["SoLuong"]
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-block no-pdd">
                                        <div class="card-header bg-success-inverse">
                                            <h5 class="text-bold text-center">GIẤY PHÉP KHAI THÁC SỬ DỤNG <br> NƯỚC MẶT</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <span class="col-md-7 text-bold font-size-14 mrg-top-20">Tổng số giấy phép: </span>
                                                <span class="col-md-5 text-bold text-success font-size-40">
                                                    <?php
                                                        require_once("services/config.php");
                                                        $query_nm = 'select count("ThongTinCP_NM".id) as "SoLuong"
                                                                     from "ThongTinCP_NM"';
                                                        $result_nm = pg_query($tiengiang_db, $query_nm);
                                                        if (!$result_nm) {
                                                            echo "Không có dữ liệu.\n";
                                                            exit;
                                                        }

                                                        $data_nm = array();
                                                        while ($row = pg_fetch_assoc($result_nm)) {
                                                            $data_nm[] = $row;
                                                        }
                                                        echo $data_nm[0]["SoLuong"]
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="row">
                                                <span class="col-md-7 text-bold font-size-14 mrg-top-20">Số giấy phép hết hiệu lực: </span>
                                                <span class="col-md-5 text-bold font-size-40" style="color: #ff0000">
                                                    <?php
                                                        require_once("services/config.php");
                                                        $query_nm = 'select count("ThongTinCP_NM".id) as "SoLuong"
                                                                     from "ThongTinCP_NM" where "tinhTrangGiayPhep" ='."'"."f"."'";
                                                        $result_nm = pg_query($tiengiang_db, $query_nm);
                                                        if (!$result_nm) {
                                                            echo "Không có dữ liệu.\n";
                                                            exit;
                                                        }

                                                        $data_nm = array();
                                                        while ($row = pg_fetch_assoc($result_nm)) {
                                                            $data_nm[] = $row;
                                                        }
                                                        echo $data_nm[0]["SoLuong"]
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="row">
                                                <span class="col-md-7 text-bold font-size-14 mrg-top-20">Số giấy phép sắp hết hạn: </span>
                                                <span class="col-md-5 text-bold text-warning font-size-40">
                                                    <?php
                                                        require_once("services/config.php");
                                                        $query = 'select count("ThongTinCP_NM".id) as "SoLuong"
                                                                  from "ThongTinCP_NM" where "ngayHetHan" <='."CURRENT_DATE + 7".' AND "tinhTrangGiayPhep" ='."'t'";
                                                        $result = pg_query($tiengiang_db, $query);
                                                        if (!$result) {
                                                            echo "Không có dữ liệu.\n";
                                                            exit;
                                                        }

                                                        $data = array();
                                                        while ($row = pg_fetch_assoc($result)) {
                                                            $data[] = $row;
                                                        }
                                                        echo $data[0]["SoLuong"]
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-block no-pdd">
                                        <div class="card-header bg-danger-inverse">
                                            <h5 class="text-bold text-center">GIẤY PHÉP <br> XẢ THẢI</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <span class="col-md-7 text-bold font-size-14 mrg-top-20">Tổng số giấy phép: </span>
                                                <span class="col-md-5 text-bold text-success font-size-40">
                                                    <?php
                                                        require_once("services/config.php");
                                                        $query = 'select count("ThongTinCP_XT".id) as "SoLuong"
                                                                  from "ThongTinCP_XT"';
                                                        $result = pg_query($tiengiang_db, $query);
                                                        if (!$result) {
                                                            echo "Không có dữ liệu.\n";
                                                            exit;
                                                        }

                                                        $data = array();
                                                        while ($row = pg_fetch_assoc($result)) {
                                                            $data[] = $row;
                                                        }
                                                        echo $data[0]["SoLuong"]
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="row">
                                                <span class="col-md-7 text-bold font-size-14 mrg-top-20">Số giấy phép hết hiệu lực: </span>
                                                <span class="col-md-5 text-bold font-size-40" style="color: #ff0000">
                                                     <?php
                                                         require_once("services/config.php");
                                                         $query = 'select count("ThongTinCP_XT".id) as "SoLuong"
                                                                   from "ThongTinCP_XT" where "tinhTrangGiayPhep" ='."'"."f"."'";
                                                         $result = pg_query($tiengiang_db, $query);
                                                         if (!$result) {
                                                             echo "Không có dữ liệu.\n";
                                                             exit;
                                                         }

                                                         $data = array();
                                                         while ($row = pg_fetch_assoc($result)) {
                                                             $data[] = $row;
                                                         }
                                                         echo $data[0]["SoLuong"]
                                                     ?>
                                                </span>
                                            </div>
                                            <div class="row">
                                                <span class="col-md-7 text-bold font-size-14 mrg-top-20">Số giấy phép sắp hết hạn: </span>
                                                <span class="col-md-5 text-bold text-warning font-size-40">
                                                    <?php
                                                        require_once("services/config.php");
                                                        $query = 'select count("ThongTinCP_XT".id) as "SoLuong"
                                                                  from "ThongTinCP_XT" where "ngayHetHan" <='."CURRENT_DATE + 7".' AND "tinhTrangGiayPhep" ='."'t'";
                                                        $result = pg_query($tiengiang_db, $query);
                                                        if (!$result) {
                                                            echo "Không có dữ liệu.\n";
                                                            exit;
                                                        }

                                                        $data = array();
                                                        while ($row = pg_fetch_assoc($result)) {
                                                            $data[] = $row;
                                                        }
                                                        echo $data[0]["SoLuong"]
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-block no-pdd">
                                        <div class="card-header bg-warning-inverse">
                                            <h5 class="text-bold text-center">GIẤY PHÉP THĂM DÒ <br> NƯỚC DƯỚI ĐẤT</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <span class="col-md-7 text-bold font-size-14 mrg-top-20">Tổng số giấy phép: </span>
                                                <span class="col-md-5 text-bold text-success font-size-40">
                                                    <?php
                                                        require_once("services/config.php");
                                                        $query = 'select count("ThongTinCP_TD".id) as "SoLuong"
                                                                  from "ThongTinCP_TD"';
                                                        $result = pg_query($tiengiang_db, $query);
                                                        if (!$result) {
                                                            echo "Không có dữ liệu.\n";
                                                            exit;
                                                        }

                                                        $data = array();
                                                        while ($row = pg_fetch_assoc($result)) {
                                                            $data[] = $row;
                                                        }
                                                        echo $data[0]["SoLuong"]
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="row">
                                                <span class="col-md-7 text-bold font-size-14 mrg-top-20">Số giấy phép hết hiệu lực: </span>
                                                <span class="col-md-5 text-bold font-size-40" style="color: #ff0000">
                                                    <?php
                                                        require_once("services/config.php");
                                                        $query = 'select count("ThongTinCP_TD".id) as "SoLuong"
                                                                  from "ThongTinCP_TD" where "tinhTrangGiayPhep" ='."'"."f"."'";
                                                        $result = pg_query($tiengiang_db, $query);
                                                        if (!$result) {
                                                            echo "Không có dữ liệu.\n";
                                                            exit;
                                                        }

                                                        $data = array();
                                                        while ($row = pg_fetch_assoc($result)) {
                                                            $data[] = $row;
                                                        }
                                                        echo $data[0]["SoLuong"]
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="row">
                                                <span class="col-md-7 text-bold font-size-14 mrg-top-20">Số giấy phép sắp hết hạn: </span>
                                                <span class="col-md-5 text-bold text-warning font-size-40">
                                                    <?php
                                                        require_once("services/config.php");
                                                        $query = 'select count("ThongTinCP_TD".id) as "SoLuong"
                                                                  from "ThongTinCP_TD" where "ngayHetHan" <='."CURRENT_DATE + 7".' AND "tinhTrangGiayPhep" ='."'t'";
                                                        $result = pg_query($tiengiang_db, $query);
                                                        if (!$result) {
                                                            echo "Không có dữ liệu.\n";
                                                            exit;
                                                        }

                                                        $data = array();
                                                        while ($row = pg_fetch_assoc($result)) {
                                                            $data[] = $row;
                                                        }
                                                        echo $data[0]["SoLuong"]
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- DOM danh sách cập nhật tự động -->
                        <div class="row font-size-14">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-block pdd-vertical-15 pdd-horizon-15">
                                        <h4 class="card-title text-bold text-info">
                                            BÁO CÁO VƯỢT NGƯỠNG
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="table_alert" class="table table-striped table-bordered table-condensed">
                                                    <thead>
                                                        <tr class="bg-info" role="row" style="color: #000">
                                                            <th scope="col" class="bg-info text-white fixed-header text-center">Tên trạm</th>
                                                            <th scope="col" class="bg-info text-white fixed-header text-center">Tên công trình</th>
                                                            <th scope="col" class="bg-info text-white fixed-header text-center">Trạng thái</th>
                                                            <th scope="col" class="bg-info text-white fixed-header text-center">Ngày gửi dữ liệu</th>
                                                            <th scope="col" class="bg-info text-white fixed-header text-center">Giờ gửi dữ liệu</th>
                                                            <th scope="col" class="bg-info text-white fixed-header text-center">Vượt ngưỡng</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-dark text-bold" style="text-align: center">
                                                        <!-- Dom data vượt ngưỡng -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                        <!-- DOM Chart Số lượng giấy phép -->
                        <div class="row font-size-14">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-block pdd-vertical-15 pdd-horizon-15">
                                        <h4 class="card-title text-bold text-info">
                                            THỐNG KÊ SỐ LƯỢNG GIẤY PHÉP ĐƯỢC CẤP QUA TỪNG NĂM
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form class="form-horizontal">
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-3 control-label">
                                                            <b>Ngày cấp phép từ</b>
                                                        </label>
                                                        <div class="col-md-3">
                                                            <input type="text" id="fromDate" class="form-control" placeholder="Từ ngày" style="height: 1.85rem" />
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-3 control-label">
                                                            <b>Ngày cấp phép đến</b>
                                                        </label>
                                                        <div class="col-md-3">
                                                            <input type="text" id="toDate" class="form-control" placeholder="Đến ngày" style="height: 1.85rem" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-3 control-label">
                                                            <b>Lựa chọn Công trình khai thác</b>
                                                        </label>
                                                        <div class="col-md-3">
                                                            <select class="form-control" id="type_ct_option">
                                                                <option value="ndd">Công trình khai thác sử dụng Nước dưới đất</option>
                                                                <option value="nm">Công trình khai thác sử dụng Nước mặt</option>
                                                                <option value="xt">Công trình Xả thải</option>
                                                                <option value="td">Công trình thăm dò Nước dưới đất</option>
                                                            </select>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-3 control-label">
                                                            <b>Lựa chọn Quận/Huyện</b>
                                                        </label>
                                                        <div class="col-md-3">
                                                            <select class="form-control" id="district_option">
                                                                <!-- Lựa chọn Quận/Huyện -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <div class="list-ctkt">
                                                    <a href="#" class="btn btn-info" id="search_view">
                                                        <i class="ti-search pdd-right-5"></i>
                                                        <span>Tìm kiếm</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: -20px">
                                            <div class="col-md-12">
                                                <div class="tab-info">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="nav-item">
                                                            <a href="#nav-tabs-3" class="nav-link active" role="tab" data-toggle="tab">
                                                                <i class="icon-chart pdd-right-10"></i>
                                                                <b>Biểu đồ số lượng giấy phép được cấp qua các năm</b>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div role="tabpanel" class="tab-pane fade in active" id="nav-tabs-3">
                                                            <div class="pdd-top-10">
                                                                <div id="chart_data" style="height: 300px"></div>
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
                    </div>
                </div>
                <!-- Content Wrapper END -->
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

    <!-- Datatables JS -->
    <script src="vendors/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables/media/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables/media/js/datetime-moment.js"></script>

    <!-- Datatables Plugin -->
    <script src="vendors/datatables/media/tables/datatables.min.js"></script>
    <script src="vendors/datatables/media/tables/extensions/responsive.min.js"></script>
    <script src="vendors/datatables/media/tables/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables/media/tables/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables/media/tables/dataTables.select.min.js"></script>
    <script src="vendors/datatables/media/tables/jszip.min.js"></script>
    <script src="vendors/datatables/media/tables/pdfmake.min.js"></script>
    <script src="vendors/datatables/media/tables/vfs_fonts.js"></script>
    <script src="vendors/datatables/media/tables/buttons.html5.min.js"></script>

    <!-- Dùng Amchart -->
    <script src="vendors/amchart/core.js"></script>
    <script src="vendors/amchart/charts.js"></script>
    <script src="vendors/amchart/lang/vi_VN.js"></script>
    <script src="vendors/amchart/themes/animated.js"></script>
    <script src="vendors/amchart/themes/dataviz.js"></script>

    <!-- Main JS Custom -->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/forms/form-elements.js"></script>

    <script>
        /*----- DOM Datatable Realtime -----*/
        // var table_alert = $('#table_alert').DataTable({
        //     "ajax": 'services/giayphep/render-table-alert.php',
        //     columns: [
        //         {"data": "tentram"},
        //         {"data": "tencongtrinh"},
        //         {"data": "tinhtrang"},
        //         {"data": "day"},
        //         {"data": "time"},
        //         {"data": "vuotnguong"}
        //     ],
        //     order: [
        //         [1, 'asc']
        //     ],
        //     "pageLength": 5,
        //     autoWidth: false,
        //     "language": {
        //         pagingType: "full_numbers",
        //         search: '<span>Tìm kiếm:</span> _INPUT_',
        //         searchPlaceholder: 'Gõ để tìm...',
        //         paginate: {
        //             'first': 'First',
        //             'last': 'Last',
        //             'next': $('html').attr('dir') == 'rtl' ? '<span style="font-size:13px;">Trước</span>' : '<span style="font-size:13px;">Sau</span>',
        //             'previous': $('html').attr('dir') == 'rtl' ? '<span style="font-size:13px;">Sau</span>' : '<span style="font-size:13px;">Trước</span>'
        //         },
        //         sLengthMenu: "<span>Hiển thị&nbsp;</span> _MENU_<span> kết quả</span>",
        //         sZeroRecords: "Không tìm thấy kết quả",
        //         sInfo: "Hiển thị _START_ đến _END_ trên _TOTAL_ dòng",
        //         sInfoFiltered: "(tất cả _MAX_ dòng)",
        //         sInfoEmpty: "Hiển thị 0 đến _END_ trên _TOTAL_ dòng",
        //     },
        // });

        // setInterval( function () {
        //     table_alert.ajax.reload();
        // }, 5000 );

        /*----- DOM chart -----*/
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

        /*** DOM Option and Process Input ***/
        $('#fromDate').datepicker({
            language: "vi",
            format: "dd/mm/yyyy",
        })
        $('#toDate').datepicker({
            language: "vi",
            format: "dd/mm/yyyy"
        });
        $('#fromDate').val(moment().format("DD/MM/YYYY"))
        var toDate = moment().add("days", 1).format("DD/MM/YYYY");
        $('#toDate').val(toDate)

        /*---- DOM Option Quận/huyện và Phường/xã ----*/
        $.getJSON("services/quanhuyen.php", function(quanhuyen) {
            $('#district_option')
                .append($("<option></option>")
                    .attr('value', 'none').text("--Lựa chọn Quận/Huyện--"));
            $.each(quanhuyen, function(key, value) {
                $('#district_option')
                    .append($("<option></option>")
                        .attr('value', value.id).text(value.name));
            });
        })

        function Render_chart(div_id, data_chart, data) {
            am4core.useTheme(am4themes_animated);
            am4core.ready(function() {
                /** Remove Logo **/
                $("g[opacity='0.3']").remove();
                $("g[opacity='0.4']").remove();
                var chart = am4core.create(div_id, am4charts.XYChart);
                chart.data = data_chart;

                chart.language.locale = am4lang_vi_VN;
                chart.logo.height = -500;
                chart.fontSize = 13;
                chart.numberFormatter.numberFormat = "#."

                var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "year";
                categoryAxis.renderer.grid.template.location = 0;
                categoryAxis.renderer.minGridDistance = 30;

                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.min = 0;

                var series = chart.series.push(new am4charts.ColumnSeries());
                series.dataFields.valueY = data;
                series.dataFields.categoryX = "year";
                series.name = "";
                series.columns.template.tooltipText = "Năm {categoryX}: [bold]{valueY} giấy phép[/]";
                series.columns.template.fillOpacity = .8;

                var columnTemplate = series.columns.template;
                columnTemplate.strokeWidth = 2;
                columnTemplate.strokeOpacity = 1;

                var labelBullet = series.bullets.push(new am4charts.LabelBullet());
                labelBullet.label.text = "{valueY} giấy phép";
                labelBullet.locationY = 0.2;
                labelBullet.label.hideOversized = true;
            });
        };

        function Render_stack_chart(div_id, data_chart, data) {
            am4core.useTheme(am4themes_animated);
            am4core.ready(function() {
                /** Remove Logo **/
                $("g[opacity='0.3']").remove();
                $("g[opacity='0.4']").remove();
                var chart = am4core.create(div_id, am4charts.XYChart);
                chart.data = data_chart;

                chart.language.locale = am4lang_vi_VN;
                chart.logo.height = -500;
                chart.fontSize = 13;
                chart.numberFormatter.numberFormat = "#."

                var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "year";
                categoryAxis.renderer.grid.template.location = 0;
                categoryAxis.renderer.minGridDistance = 30;

                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.min = 0;
                valueAxis.extraMax = 0.2;
                valueAxis.calculateTotals = true;

                function createSeries(field, name, color) {
                    var series = chart.series.push(new am4charts.ColumnSeries());
                    series.name = name;
                    series.dataFields.valueY = field;
                    series.dataFields.categoryX = "year";
                    series.sequencedInterpolation = true;

                    series.stacked = true;

                    series.columns.template.width = am4core.percent(60);
                    series.columns.template.fill = am4core.color(color);
                    series.columns.template.stroke = am4core.color("#000");
                    series.columns.template.strokeOpacity = 0.5;
                    series.columns.template.tooltipText = "[bold]{name}[/]\n[font-size:14px]{categoryX}: {valueY}";

                    var labelBullet = series.bullets.push(new am4charts.LabelBullet());
                    labelBullet.label.text = "{valueY} giấy phép";
                    labelBullet.locationY = 0.5;
                    labelBullet.label.hideOversized = true;

                    return series;
                }

                createSeries("866", "TP.Cao Lãnh", "#55ffa7");
                createSeries("867", "TP.Sa Đéc", "#ff2abb");
                createSeries("868", "TP.Hồng Ngự", "#ffc100");
                createSeries("869", "H.Tân Hồng", "#ffa6f1");
                createSeries("870", "H.Hồng Ngự", "#ffc100");
                createSeries("871", "H.Tam Nông", "#c0b9ff");
                createSeries("872", "H.Tháp Mười", "#ff89a3");
                createSeries("873", "H.Cao Lãnh", "#3dd241");
                createSeries("874", "H.Thanh Bình", "#ffff92");
                createSeries("875", "H.Lấp Vò", "#deff49");
                createSeries("876", "H.Lai Vung", "#47bbff");
                createSeries("877", "H.Châu Thành", "#ff7b5a");

                var totalSeries = chart.series.push(new am4charts.ColumnSeries());
                totalSeries.dataFields.valueY = "none";
                totalSeries.dataFields.categoryX = "year";
                totalSeries.stacked = true;
                totalSeries.hiddenInLegend = true;
                totalSeries.columns.template.strokeOpacity = 0;

                var totalBullet = totalSeries.bullets.push(new am4charts.LabelBullet());
                totalBullet.dy = -20;
                totalBullet.label.text = "Tổng: [bold]{valueY.total}";
                totalBullet.label.hideOversized = false;
                totalBullet.label.fontSize = 14;
                totalBullet.label.background.fill = totalSeries.stroke;
                totalBullet.label.background.fillOpacity = 0.2;
                totalBullet.label.padding(5, 10, 5, 10);

                chart.legend = new am4charts.Legend();
            });
        };

        /*---- Process Data ----*/
        $("#search_view").on("click", function() {
            var fromDate_default = $("#fromDate").val()
            fromDate_default_split = fromDate_default.split("/");
            fromDate_new = fromDate_default_split[2] + "-" + fromDate_default_split[1] + "-" + fromDate_default_split[0];
            var toDate_dafault = $("#toDate").val()
            toDate_default_split = toDate_dafault.split("/");
            toDate_new = toDate_default_split[2] + "-" + toDate_default_split[1] + "-" + toDate_default_split[0];
            var type_ct = $("#type_ct_option").val()
            var district = $("#district_option").val()

            var res;
            $.ajax({
                url: "services/giayphep/render-chart.php?district=" + district + "&type_ct=" + type_ct +
                    "&fromDate=" + fromDate_new + " 00:00:00" + "&toDate=" + toDate_new + " 23:59:59",
                async: false,
                dataType: 'json',
                success: function (data) {
                    res = data;
                }
            });

            if (district != "none") {
                Render_chart("chart_data", res.data, type_ct)
            } else {
                Render_stack_chart("chart_data", res.data, type_ct)
            }

        })

        /*---- Load Chard Lần đầu ----*/
        $("#fromDate").val("01/01/2010")
        var toDate_dafault = $("#toDate").val()
        toDate_default_split = toDate_dafault.split("/");
        toDate_new = toDate_default_split[2] + "-" + toDate_default_split[1] + "-" + toDate_default_split[0];
        var type_ct = "ndd"
        var district = "none"

        var res;
        $.ajax({
            url: "services/giayphep/render-chart.php?district=" + district + "&type_ct=" + type_ct +
                "&fromDate=" + "2010-01-01 00:00:00" + "&toDate=" + toDate_new + " 23:59:59",
            async: false,
            dataType: 'json',
            success: function (data) {
                res = data;
            }
        });

        Render_stack_chart("chart_data", res.data, type_ct)
    </script>
</body>
</html>
