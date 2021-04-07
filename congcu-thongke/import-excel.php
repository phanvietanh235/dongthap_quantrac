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
    <link rel="shortcut icon" href="../assets/images/SoTNMT.ico">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="../vendors/PACE/themes/blue/pace-theme-minimal.css" />
    <link rel="stylesheet" href="../vendors/perfect-scrollbar/css/perfect-scrollbar.min.css" />

    <!-- Page Plugins CSS -->
    <link rel="stylesheet" href="../vendors/selectize/dist/css/selectize.default.css" />
    <link rel="stylesheet" href="../vendors/bootstrap-daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="../vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" />
    <link rel="stylesheet" href="../vendors/summernote/dist/summernote.css" />

    <link rel="stylesheet" href="../vendors/bower-jvectormap/jquery-jvectormap-1.2.2.css" />
    <link rel="stylesheet" href="../vendors/nvd3/build/nv.d3.min.css" />

    <!-- page plugins css -->
    <link rel="stylesheet" href="../vendors/datatables/media/css/jquery.dataTables.css" />

    <!-- Core CSS -->
    <link href="../assets/css/ei-icon.css" rel="stylesheet">
    <link href="../assets/css/themify-icons.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/fonts/icomoon/styles.min.css" rel="stylesheet">
    <link href="../assets/fonts/glyphicon/glyphicon.css" rel="stylesheet">
    <link href="../assets/css/animate.min.css" rel="stylesheet">
    <link href="../assets/css/app.css" rel="stylesheet">
</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Side Nav START -->
            <div class="side-nav">
                <div class="side-nav-inner">
                    <div class="side-nav-logo">
                        <a href="../index.php">
                            <img src="../assets/images/monre_logo.png" class="cus_logo"/>
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
                            <a href="../index.php">
                                <span class="icon-holder">
                                    <i class="icon-home2 font-size-14"></i>
                                </span>
                                <span class="title">Trang chủ</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../map.php">
                                <span class="icon-holder">
                                    <i class="fa fa-map"></i>
                                </span>
                                <span class="title">Bản đồ</span>
                            </a>
                        </li>
                        <!-- Dữ liệu công trình -->
                        <li class="nav-item dropdown open">
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
                                    <a href="import-excel.php">
                                        <i class="ti-export pdd-right-5"></i>
                                        <span>Chuyển File bán tự động</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="threshold.php">
                                        <i class="ti-alert pdd-right-5"></i>
                                        <span>Danh sách vượt ngưỡng</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="statistic.php">
                                        <i class="ti-bar-chart-alt pdd-right-5"></i>
                                        <span>Thống kê quan trắc</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="aqi-wqi.php">
                                        <i class="fa fa-leaf pdd-right-5"></i>
                                        <span>Đánh giá AQI - WQI</span>
                                    </a>
                                </li>
                                <li>
                                    <!-- <a href="report.php">
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
                                    <a class="" href="../congtrinh-quantrac/giengqt-ndd.php">Giếng QT Nước dưới đất</a>
                                </li>
                                <li>
                                    <a class="" href="../congtrinh-quantrac/diemqt-nm.php">Điểm QT Nước mặt</a>
                                </li>
                                <li>
                                    <a class="" href="../congtrinh-khaithac/giamsatnuoc.php">Giám sát tài nguyên nước</a>
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
                                <!--<li>
                                    <a href="../congtrinh-khaithac/ktsd-nuocmat.php" class="">KTSD Nước mặt</a>
                                </li>
                                <li>
                                    <a href="../congtrinh-khaithac/ktsd-nuocduoidat.php" class="">KTSD Nước dưới đất</a>
                                </li>-->
                                <li>
                                    <a href="../congtrinh-khaithac/nguonxathai.php" class="">Nguồn xả thải</a>
                                </li>
                                <!-- <li>
                                    <a href="../congtrinh-khaithac/thamdo.php" class="">CT Thăm dò Nước dưới đất</a>
                                </li> -->
                                <!-- <li>
                                    <a class="" href="../congtrinh-khaithac/giamsatnuoc.php">Giám sát tài nguyên nước</a>
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
                                    <a href="../baocao-thongke/giayphep-nuocmat.php" class="">Giấy phép Nước mặt</a>
                                </li>
                                <li>
                                    <a href="../baocao-thongke/giayphep-nuocduoidat.php" class="">Giấy phép Nước dưới đất</a>
                                </li> -->
                                <li>
                                    <a href="../baocao-thongke/giayphep-xathai.php" class="">Giấy phép Xả thải</a>
                                </li>
                                <!--<li>
                                    <a href="../baocao-thongke/giayphep-thamdo.php" class="">Giấy phép Thăm dò</a>
                                </li>-->
                                <!-- <li>
                                    <a href="../baocao-thongke/giayphep-hanhnghe.php" class="">Giấy phép Hành nghề</a>
                                </li> -->
                                <li>
                                    <a href="../baocao-thongke/thongke-tramquantrac.php" class="">Thống kê Trạm quan trắc</a>
                                </li>
                                <li>
                                    <a href="../baocao-thongke/hochua-lvs.php" class="">Tổng hợp hồ chứa, LVS</a>
                                </li>
                                <li>
                                    <a href="../baocao-thongke/ctkt-nguonnuoc.php" class="">Số CTKT theo Nguồn nước</a>
                                </li>
                                <li>
                                    <a href="../baocao-thongke/ctkt-mucdichsudung.php" class="">Số CTKT theo MĐSD</a>
                                </li>
                                <!-- <li>
                                    <a href="../baocao-thongke/ctkt-loaihinh.php" class="">Số CTKT theo Loại hình</a>
                                </li>
                                <li>
                                    <a href="../baocao-thongke/water-ktsd-cp.php" class="">Lượng nước KTSD được CP</a>
                                </li> -->
                                <li>
                                    <a href="../baocao-thongke/gp-dacap.php" class="">Số lượng GP đã cấp</a>
                                </li>
                                <li>
                                    <a href="../baocao-thongke/tien-cqkt.php" class="">Tiền cấp quyền KT</a>
                                </li>
                                <!--<li>
                                    <a href="../baocao-thongke/danhmuc-ctktsd.php" class="">Danh mục CTKTSD</a>
                                </li> -->
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
                                            <a class="mrg-left-10" href="../danhmuc/doanhnghiep.php">Doanh nghiệp</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../danhmuc/loaihinhdoanhnghiep.php">Loại hình doanh
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
                                            <a class="mrg-left-10" href="../danhmuc/donvicapphep.php">Đơn vị cấp phép</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../danhmuc/donviquanly.php">Đơn vị quản lý</a>
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
                                            <a class="mrg-left-10" href="../danhmuc/doituongktsd.php">Đối tượng khai thác</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../danhmuc/mucdichktsd.php">Mục đích khai thác</a>
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
                                            <a class="mrg-left-10" href="../danhmuc/diadanh.php">Địa danh</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../danhmuc/loaidiadanh.php">Loại địa danh</a>
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
                                            <a class="mrg-left-10" href="../danhmuc/loaitram.php">Loại trạm</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../danhmuc/loaihinh.php">Loại hình</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../danhmuc/loaicongtrinh.php">Loại công trình</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../danhmuc/loaigiayphep.php">Loại giấy phép</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../danhmuc/quychuan.php">Quy chuẩn</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../danhmuc/thongso.php">Thông số</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../danhmuc/donvi.php">Đơn vị</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../danhmuc/chatluongmt.php">Chất lượng môi trường</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../danhmuc/mucdichsudung.php">Mục đích sử dụng</a>
                                        </li>
                                        <li>
                                            <a class="mrg-left-10" href="../danhmuc/chitieu.php">Chỉ tiêu</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="../danhmuc/tangchuanuoc.php" class="">Tầng chứa nước</a>
                                </li>
                                <li>
                                    <a href="../danhmuc/luuvucsong.php" class="">Lưu vực sông</a>
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
                                    <img class="profile-img img-fluid" src="../assets/images/logo/user.png" alt="">
                                    <div class="user-info">
                                            <span class="name pdd-right-5">
                                                <?php
                                                require_once("../services/config.php");
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
                                        <a href="../logout.php">
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
                                                    <div class="panel-heading" style="text-align: center">
                                                        <b>CÁC NGUỒN TIẾP NHẬN</b>
                                                    </div>
                                                    <ul class="list-group">
                                                        <li class="list-group-item">Các trạm quan trắc tự động</li>
                                                        <li class="list-group-item">Các trạm quan trắc bán tự động</li>
                                                        <li class="list-group-item">Các doanh nghiệp xả thải trên 1000 m³</li>
                                                    </ul>
                                                    <a href="../HDSD_QuanTracDongThap.docx">Hướng dẫn sử dụng</a>
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
                                                            <div class="col-md-12 align-self-center">
                                                                <div class="form-group">
                                                                    <button class="btn btn-info pull-right" data-dismiss="modal" type="submit">Gửi đến chúng tôi
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
                                <button class="btn btn-info" data-dismiss="modal" type="button">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal END -->

                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4 class="card-title">
                                                    <b>
                                                        <i class="ti-export pdd-right-5"></i>
                                                        Chuyển dữ liệu bán tự động
                                                    </b>
                                                </h4>
                                                <form class="form-horizontal mrg-top-10 pdd-right-30">
                                                    <div class="form-group row">
                                                        <label for="" style="margin-top: 7px" class="col-md-2 control-label">
                                                            <i class="icon-yelp pdd-right-5"></i>
                                                            <b>Quy chuẩn</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <select class="form-control" id="standard-option">
                                                                <!-- DOM từ DB -->
                                                            </select>
                                                        </div>
                                                        <label for="" style="margin-top: 7px" class="col-md-2 control-label">
                                                            <i class="icon-certificate pdd-right-5"></i>
                                                            <b>Mục đích sử dụng</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <select class="form-control" id="purpose-option">
                                                                <!-- DOM từ DB -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" style="margin-top: 7px" class="col-md-2 control-label">
                                                            <i class="icon-certificate pdd-right-5"></i>
                                                            <b>Công trình quan trắc</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <select class="form-control" id="quantrac-option">
                                                                <option value="1">Giếng Giếng QT Nước dưới đất</option>
                                                                <option value="2" disabled>Điểm quan trắc nước mặt (beta)</option>
                                                            </select>
                                                        </div>
                                                        <label for="" style="margin-top: 12px" class="col-md-2 control-label">
                                                            <i class="icon-file-spreadsheet pdd-right-5"></i>
                                                            <b>Chọn file</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <input class="form-control" type="file" id="excelfile"
                                                                   style="height: calc(2.25rem + 2px)">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" style="margin-top: 12px" class="col-md-2 control-label">
                                                            <i class="icon-file-excel pdd-right-5"></i>
                                                            <a href="text/File_test_import.xlsx"><b>File mẫu</b></a>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <a href="#" class="btn btn-info text-white" name="upload" onclick="ProcessExcel()">
                                                                <i class="ti-export pdd-right-5"></i>
                                                                <span>Chuyển dữ liệu bán tự động</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <!-- DOM kết quả thẻ div Search Error và Search Success -->
                                                        <div class="col-xs-12 col-md-12 upload-error" style="text-align: center; display: none">
                                                            <i class="icon-alert" style="color: #FF0000; font-size: 16px; margin-top: -1px"></i>
                                                            <span id="error_upload" style="color: #FF0000"></span>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 upload-success" style="text-align: center; display: none">
                                                            <i class="icon-check" style="color: #008000; font-size: 20px; margin-top: -1px"></i>
                                                            <span id="success_upload" style="color: #008000"></span>
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
                </div>
                <!-- Content Wrapper END -->

                <!-- Footer -->
                <footer class="content-footer">
                    <div class="footer">
                        <div class="copyright">
                            <span>Copyright © 2020 <b class="text-dark">Sở tài nguyên môi trường Đồng Tháp</b></span>
                            <span class="go-right">
                                <a href="#" class="text-gray mrg-right-15">
                                    <b>
                                        Phiên bản&nbsp;&nbsp;<span class="text-info">1.0</span>
                                    </b>
                                </a>
                            </span>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- Page Container END -->
        </div>
    </div>

    <script src="../assets/js/vendor.js"></script>

    <!-- Page Plugins JS -->
    <script src="../vendors/d3/d3.min.js"></script>
    <script src="../vendors/nvd3/build/nv.d3.min.js"></script>
    <script src="../vendors/jquery.sparkline/index.js"></script>

    <!-- Import Excel -->
    <script src="../vendors/import-excel/xlsx.full.min.js"></script>

    <script src="../vendors/selectize/dist/js/standalone/selectize.min.js"></script>
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="../vendors/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="../vendors/summernote/dist/summernote.min.js"></script>

    <!-- Main JS Custom -->
    <script src="../assets/js/app.js"></script>
    <script src="js/import-excel.js"></script>
    <script src="../assets/js/forms/form-elements.js"></script>

    <script>
        if ($("*").width() <= 1440 && $("*").width() >= 767) {
            $(".app").toggleClass("is-collapsed");
        }

        $('.dropdown-menu').on('click', function(e) {
            e.stopPropagation();
        });
    </script>
</body>

</html>
