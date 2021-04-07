<?php
include "../config.php";
?>
<?php
$idpoi = $_GET["idpoi"];
$type = $_GET["type"];
$name = $_GET["name"];
?><?php
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
                                        <span>Mẫu báo cáo</span> -->
                                    </a>

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
                                <li>
                                    <a href="../../baocao-thongke/giayphep-nuocmat.php" class="">Giấy phép Nước mặt</a>
                                </li>
                                <li>
                                    <a href="../../baocao-thongke/giayphep-nuocduoidat.php" class="">Giấy phép Nước dưới
                                        đất</a>
                                </li>
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
                                    <a href="../../baocao-thongke/thongke-tramquantrac.php" class="">Thống kê Trạm quan
                                        trắc</a>
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
                                                <i class="fa fa-exclamation-circle pdd-right-10"></i> Đơn vị phát triển phần
                                                mềm
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="aboutTabsContent">
                                        <div role="tabpanel" class="tab-pane fade in active" id="about">
                                            <div class="pdd-horizon-15 pdd-vertical-20">
                                                <p>Hệ thống truyền, nhận, quản lý và công bố dữ liệu các hệ thống quản trị
                                                    tài nguyên nước của tỉnh Đồng Tháp tích hợp số liệu quan trắc các nguồn
                                                    thải từ các khu công nghiệp, khu chế xuất và khu công nghệ
                                                    cao nói riêng và quan trắc nguồn điểm nói chung nhằm mục đích bảo vệ
                                                    nguồn tiếp nhận (sông, hồ), đảm bảo chất lượng nước thải của các khu
                                                    công nghiệp, khu chế xuất, khu công nghệ cao trước khi thải vào
                                                    nguồn tiếp nhận;</p>
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading" style="text-align: center">
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
                                                            <div class="col-md-12 align-self-center">
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
                                                <p style="text-transform: uppercase">Trung tâm ứng dụng công nghệ thông tin
                                                    phía Nam</p>
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
                <!-- Modal END -->

                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="container-fluid">
                        <div class="page-title" style="text-align: center">
                            <h3>
                                <b>GIÁM SÁT CÔNG TRÌNH
                                    <?php
                                    if ($type == "ktsd_ndd") {
                                        echo "KHAI THÁC SỬ DỤNG NƯỚC DƯỚI ĐẤT " . "<span class='text-danger'>" . $name . "</span>";
                                    } else if ($type == "ktsd_nm") {
                                        echo "KHAI THÁC SỬ DỤNG NƯỚC MẶT " . "<span class='text-danger'>" . $name . "</span>";
                                    } else if ($type == "xt") {
                                        echo "XẢ THẢI " . "<span class='text-danger'>" . $name . "</span>";
                                    } else {
                                        echo "THĂM DÒ NƯỚC DƯỚI ĐẤT " . "<span class='text-danger'>" . $name . "</p>";
                                    }
                                    ?>
                                </b>
                            </h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block pdd-vertical-15 pdd-horizon-15">
                                        <h4 class="card-title text-bold text-info">
                                            Số liệu mới nhất <p id="real_time_services"></p>
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="newest_data" class="table table-sm table-hover table-bordered">
                                                    <!-- DOM after Process Data -->
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-block pdd-vertical-15 pdd-horizon-15">
                                        <h4 class="card-title text-bold text-info">
                                            Hiển thị dữ liệu
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form class="form-horizontal">
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-1 control-label">
                                                            <b>Từ ngày</b>
                                                        </label>
                                                        <div class="col-md-3">
                                                            <input type="text" id="fromDate_giamsat" class="form-control" placeholder="Từ ngày" style="height: 1.85rem" />
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-1 control-label">
                                                            <b>Đến ngày</b>
                                                        </label>
                                                        <div class="col-md-3">
                                                            <input type="text" id="toDate_giamsat" class="form-control" placeholder="Đến ngày" style="height: 1.85rem" />
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Lựa chọn thông số</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <select class="form-control" id="para_option">
                                                                <!-- Lựa chọn thông số -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt" style="justify-content: center">
                                                        <div class="col-md-4"></div>
                                                        <!-- <div class="col-md-8" style="margin-top: -5px">
                                                            <div class="radio radio-inline">
                                                                <input type="radio" name="form-5" id="linechart-option" checked>
                                                                <label for="linechart-option">
                                                                    <i class="fa fa-line-chart pdd-right-5"></i>
                                                                    Biểu đồ đường
                                                                </label>
                                                            </div>
                                                            <div class="radio radio-inline">
                                                                <input type="radio" name="form-5" id="barchart-option">
                                                                <label for="barchart-option">
                                                                    <i class="fa fa-bar-chart-o pdd-right-5"></i>
                                                                    Biểu đồ cột
                                                                </label>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5"></div>
                                            <div class="col-md-7">
                                                <div class="list-ctkt">
                                                    <a href="#" class="btn btn-info btn-sm" id="search_view">
                                                        <i class="ti-search pdd-right-5"></i>
                                                        <span>Tìm kiếm</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="tab-info">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="nav-item">
                                                            <a href="#nav-tabs-1" class="nav-link active" role="tab" data-toggle="tab">
                                                                <i class="icon-search4 pdd-right-10"></i>
                                                                Kết quả thống kê
                                                            </a>
                                                        </li>
                                                        <!-- <li class="nav-item">
                                                            <a href="#nav-tabs-2" class="nav-link"
                                                               role="tab" data-toggle="tab">
                                                                <i class="icon-calculator2 pdd-right-10"></i>
                                                                Min/Max/Trung bình
                                                            </a>
                                                        </li> -->
                                                        <li class="nav-item">
                                                            <a href="#nav-tabs-3" class="nav-link" role="tab" data-toggle="tab">
                                                                <i class="icon-chart pdd-right-10"></i>
                                                                Biểu đồ
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div role="tabpanel" class="tab-pane fade in active" id="nav-tabs-1">
                                                            <div class="pdd-horizon-15 pdd-vertical-20">
                                                                <div class="table-overflow">
                                                                    <p class="text-uppercase text-bold
                                                                    text-center font-size-14 mrg-btm-10" id="title_view"></p>
                                                                    <table id="view_data_table" class="table table-sm table-hover table-bordered">
                                                                        <!-- DOM after Process Data -->
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div role="tabpanel" class="tab-pane fade" id="nav-tabs-2">
                                                            <div class="pdd-horizon-15 pdd-vertical-20">
                                                                <p>Min/Max/Trung bình</p>
                                                            </div>
                                                        </div> -->
                                                        <div role="tabpanel" class="tab-pane fade" id="nav-tabs-3">
                                                            <div class="pdd-horizon-15 pdd-vertical-20">
                                                                <p class="text-uppercase text-bold
                                                                    text-center font-size-14 mrg-btm-10" id="title_chart"></p>
                                                                <div id="chart_data" style="height: 360px"></div>
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
            </div>
            <!-- Content Wrapper END -->
        </div>
        <!-- Page Container END -->
    </div>

    <script src="../../assets/js/vendor.js"></script>

    <!-- Page Plugins JS -->
    <script src="../../vendors/moment/min/moment.min.js"></script>

    <script src="../../vendors/d3/d3.min.js"></script>
    <script src="../../vendors/nvd3/build/nv.d3.min.js"></script>
    <script src="../../vendors/jquery.sparkline/index.js"></script>
    <!-- Dùng Amchart -->
    <script src="../../vendors/amchart/core.js"></script>
    <script src="../../vendors/amchart/charts.js"></script>
    <script src="../../vendors/amchart/lang/vi_VN.js"></script>
    <script src="../../vendors/amchart/themes/animated.js"></script>

    <script src="../../vendors/select2/dist/js/select2.js"></script>
    <script src="../../vendors/tabulator/dist/js/tabulator.js"></script>

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

    <!-- Newest Data -->
    <script>
        /*---- Option Range Date ----*/
        $('#fromDate_giamsat').datepicker({
            language: "vi",
            format: "dd/mm/yyyy",
        })
        $('#toDate_giamsat').datepicker({
            language: "vi",
            format: "dd/mm/yyyy"
        });
        $('#fromDate_giamsat').val(moment().format("DD/MM/YYYY"))
        var toDate = moment().add("days", 1).format("DD/MM/YYYY");
        $('#toDate_giamsat').val(toDate)

        /*---- Option Thông số ----*/
        $.getJSON(
            <?php
            echo "'parameter-option.php?idpoi=" . $idpoi . '&type=' . $type . "'";
            ?>,
            function(para_opt) {
                $.each(para_opt, function(key, value) {
                    if (key == 0) {
                        if (value.unitname != "") {
                            $('#para_option')
                                .append($("<option selected></option>")
                                    .attr('value', value.id).text(value.name + " (" + value.unitname + ")"));
                        } else {
                            $('#para_option')
                                .append($("<option selected></option>")
                                    .attr('value', value.id).text(value.name));
                        }
                    } else {
                        if (value.unitname != "") {
                            $('#para_option')
                                .append($("<option></option>")
                                    .attr('value', value.id).text(value.name + " (" + value.unitname + ")"));
                        } else {
                            $('#para_option')
                                .append($("<option></option>")
                                    .attr('value', value.id).text(value.name));
                        }
                    }
                });
            })

        var table;
        var columns_title = [/* {
                title: "Thời gian",
                field: "time",
                hozAlign: "center"
            }, */
            {
                title: "Thông số",
                field: "thongso",
                hozAlign: "center"
            },
            {
                title: "Giá trị",
                field: "v",
                hozAlign: "center",
                formatter: function(cell, formatterParams, onRendered) {
                    var inlimit = cell._cell.row.data.inlimit;
                    var min = cell._cell.row.data.min;
                    var max = cell._cell.row.data.max;
                    var donvi = cell._cell.row.data.donvi;
                    if (donvi == null) {
                        donvi = '';
                    }
                    if (min == null) {
                        min = 'Không có ngưỡng';
                    }
                    if (max == null) {
                        max = 'Không có ngưỡng';
                    }

                    if (inlimit == "Y") {
                        return "<b style='color: red'>" + cell.getValue() + " " + donvi +
                            " (min: " + min + " và max: " + max + ") " + "</b>"
                    } else {
                        return "<b>" + cell.getValue() + " " + donvi + "</b>"
                    }
                }
            },
        ]

        var response_post = $.get("newest-data.php?", {
            <?php
            echo "'idpoi':" . $idpoi . "," .
                "'type':" . "'" . $type . "'"
            ?>
        });

        response_post.done(function(data) {
            if (data.length != 0) {
                $("#newest_data").css("border-top", "1px solid #dee2e6");
                table = new Tabulator("#newest_data", {
                    columns: columns_title,
                    layout: "fitColumns",
                })

                /*** Load Data lần đầu ***/
                $("#real_time_services").html(data[0].time)
                <?php
                echo 'table.setData("newest-data.php?idpoi=' . $idpoi . '&type=' . $type . '");'
                ?>
                /*** Load Data dữ liệu các lần tiếp theo ***/
                setInterval(function() {
                    <?php
                    echo 'table.replaceData("newest-data.php?idpoi=' . $idpoi . '&type=' . $type . '")'
                    ?>

                    var response_post = $.get("newest-data.php?", {
                        <?php
                        echo "'idpoi':" . $idpoi . "," .
                            "'type':" . "'" . $type . "'"
                        ?>
                    }).done(function(data) {
                        $("#real_time_services").html(data[0].time)
                    });
                }, 10000)
            } else {
                $("#newest_data").css("border-top", "none");
                table = new Tabulator("#newest_data", {
                    height: "70px",
                    placeholder: "<p class='text-danger text-bold font-size-14'>" +
                        "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
                })
            }
        })
    </script>

    <script>
        function search_view() {
            /*** View Table ***/
            var view_table;
            var columns_title_table = [{
                    title: "STT",
                    formatter: "rownum",
                    hozAlign: "center"
                },
                {
                    title: "Ngày",
                    field: "day",
                    hozAlign: "center"
                },
                {
                    title: "Giờ",
                    field: "time",
                    hozAlign: "center"
                },
                {
                    title: "Giá trị",
                    field: "val",
                    hozAlign: "center"
                }
            ];

            /*** Lấy thông số trạm và Parameter ***/
            var para_opt = $("#para_option").val();
            var fromDate = $("#fromDate_giamsat").val();
            var toDate = $("#toDate_giamsat").val();
            $("#title_view").html("Bảng dữ liệu thông số " + $("#para_option option:selected").html())

            /*** Nếu thời gian đi hoặc thời gian đến rỗng ***/
            if (fromDate == '') {
                fromDate_data = '1900-01-01';
            } else {
                var fromDate_data_split = fromDate.split("/");
                fromDate_data = fromDate_data_split[2] + "-" + fromDate_data_split[1] + "-" + fromDate_data_split[0];
            }

            if (toDate == '') {
                toDate_data = '2900-01-01';
            } else {
                var toDate_data_split = toDate.split("/");
                toDate_data = toDate_data_split[2] + "-" + toDate_data_split[1] + "-" + toDate_data_split[0];
            }

            /*** Table ***/
            var response_post_table = $.get("render-table.php?", {
                "para_opt": para_opt,
                "fromDate": fromDate_data + " 00:00:00",
                "toDate": toDate_data + " 23:59:59",
                <?php
                echo "'idpoi':" . $idpoi . "," .
                    "'type':" . "'" . $type . "'"
                ?>
            })

            response_post_table.done(function(data) {
                if (data.length != 0) {
                    $("#view_data_table").css("border-top", "1px solid #dee2e6");
                    view_table = new Tabulator("#view_data_table", {
                        columns: columns_title_table,
                        layout: "fitColumns",
                        ajaxURL: "render-table.php",
                        ajaxParams: {
                            "para_opt": para_opt,
                            "fromDate": fromDate_data + " 00:00:00",
                            "toDate": toDate_data + " 23:59:59",
                            <?php
                            echo "'idpoi':" . $idpoi . "," .
                                "'type':" . "'" . $type . "'"
                            ?>
                        },
                        ajaxConfig: "get",
                        pagination: "local",
                        paginationSize: 10,
                        langs: {
                            "vi": {
                                "pagination": {
                                    "first": "<",
                                    "first_title": "Trang đầu",
                                    "last": ">",
                                    "last_title": "Trang cuối",
                                    "prev": "Trước",
                                    "prev_title": "Trang trước",
                                    "next": "Sau",
                                    "next_title": "Trang sau",
                                }
                            }
                        }
                    })
                    view_table.setData();
                    view_table.setLocale("vi");
                } else {
                    $("#view_data_table").css("border-top", "none");
                    view_table = new Tabulator("#view_data_table", {
                        height: "70px",
                        placeholder: "<p class='text-danger text-bold font-size-14'>" +
                            "<i class='icon-alert pdd-right-5'></i>Không có dữ liệu!</p>",
                    })
                }
            })

            /*** Chart ***/
            $("#title_chart").html("Biểu đồ dữ liệu thông số " + $("#para_option option:selected").html())
            var response_post_chart = $.get("render-chart.php?", {
                "para_opt": para_opt,
                "fromDate": fromDate_data + " 00:00:00",
                "toDate": toDate_data + " 23:59:59",
                <?php
                echo "'idpoi':" . $idpoi . "," .
                    "'type':" . "'" . $type . "'"
                ?>
            }).done(function(res) {
                unit = res.range.unit;
                min = res.range.min;
                max = res.range.max;
                Render_chart("chart_data", res.data, "datetime", "val", unit, min, max)
            })
        }

        function updateScroll() {
            $('html,body').animate({
                scrollTop: 530
            });
        }

        $("#search_view").click(function() {
            search_view();
            setTimeout(updateScroll(), 1000);
        })

        /*---- Hiển thị lần đầu tiên show dữ liệu của ngày hiện tại và ngày hôm qua ----*/
        var fromDate_default = $("#fromDate_giamsat").val()
        fromDate_default_split = fromDate_default.split("/");
        fromDate_new = fromDate_default_split[2] + "-" + fromDate_default_split[1] + "-" + fromDate_default_split[0];
        var toDate_dafault = $("#toDate_giamsat").val()
        toDate_default_split = toDate_dafault.split("/");
        toDate_new = toDate_default_split[2] + "-" + toDate_default_split[1] + "-" + toDate_default_split[0];

        /*** Load Table First Times (Ajax gọi Option) ***/
        var para_option;
        var name_table;
        var name_chart;
        $.ajax({
            async: false,
            url: "parameter-option.php",
            type: "get",
            data: {
                <?php
                echo "'idpoi':" . $idpoi . "," .
                    "'type':" . "'" . $type . "'"
                ?>
            },
            dataType: 'json',
            success: function(data) {
                para_option = data[0].id;
                if (data[0].unitname != "") {
                    name_table = "Bảng dữ liệu thông số " + data[0].name + " (" + data[0].unitname + ")"
                    name_chart = "Biểu đồ dữ liệu thông số " + data[0].name + " (" + data[0].unitname + ")"
                } else {
                    name_table = "Bảng dữ liệu thông số " + data[0].name
                    name_chart = "Biểu đồ dữ liệu thông số " + data[0].name
                }
            }
        })
        $("#title_view").html(name_table)

        var view_table;
        var columns_title_table = [{
                title: "STT",
                formatter: "rownum",
                hozAlign: "center"
            },
            {
                title: "Ngày",
                field: "day",
                hozAlign: "center"
            },
            {
                title: "Giờ",
                field: "time",
                hozAlign: "center"
            },
            {
                title: "Giá trị",
                field: "val",
                hozAlign: "center"
            }
        ];

        $("#view_data_table").css("border-top", "1px solid #dee2e6");
        view_table = new Tabulator("#view_data_table", {
            columns: columns_title_table,
            layout: "fitColumns",
            ajaxURL: "render-table.php",
            ajaxParams: {
                "para_opt": para_option,
                "fromDate": fromDate_new + " 00:00:00",
                "toDate": toDate_new + " 23:59:59",
                <?php
                echo "'idpoi':" . $idpoi . "," .
                    "'type':" . "'" . $type . "'"
                ?>
            },
            ajaxConfig: "get",
            pagination: "local",
            paginationSize: 10,
            langs: {
                "vi": {
                    "pagination": {
                        "first": "<",
                        "first_title": "Trang đầu",
                        "last": ">",
                        "last_title": "Trang cuối",
                        "prev": "Trước",
                        "prev_title": "Trang trước",
                        "next": "Sau",
                        "next_title": "Trang sau",
                    }
                }
            }
        })
        view_table.setData();
        view_table.setLocale("vi");

        /*** Load Chart First Times (Ajax gọi Option) ***/
        $("#title_chart").html(name_chart)
        var response_post_chart = $.get("render-chart.php?", {
            "para_opt": para_option,
            "fromDate": fromDate_new + " 00:00:00",
            "toDate": toDate_new + " 23:59:59",
            <?php
            echo "'idpoi':" . $idpoi . "," .
                "'type':" . "'" . $type . "'"
            ?>
        }).done(function(res) {
            unit = res.range.unit;
            min = res.range.min;
            max = res.range.max;
            Render_chart("chart_data", res.data, "datetime", "val", unit, min, max)
        })
    </script>

    <script>
        function Render_chart(div_id, data_chart, key, data, unit, min, max) {
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
                chart.dateFormatter.inputDateFormat = "HH:mm:ss, dd/MM/yyyy";

                /*** View Chart Line theo Date ***/
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.grid.template.location = 0;
                dateAxis.renderer.minGridDistance = 50;
                /*** Thay đổi width chart do khoảng cách thời gian ***/
                dateAxis.baseInterval = {
                    "timeUnit": "second",
                    "count": 1
                }
                dateAxis.tooltipDateFormat = "HH:mm:ss, dd/MM/yyyy";
                dateAxis.periodChangeDateFormats.setKey("hour", "[bold]dd-MM[/]");
                dateAxis.title.text = "Thời gian"
                dateAxis.showOnInit = false;

                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                if (unit != "") {
                    valueAxis.title.text = "Giá trị (" + unit + ")";
                } else {
                    valueAxis.title.text = "Giá trị";
                }
                valueAxis.min = 0;

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = data;
                series.dataFields.dateX = key;
                series.strokeWidth = 2;
                series.tensionX = 2;
                series.stroke = "#007bff";
                /* series.fill = "#007bff"; */
                series.fillOpacity = 0;
                series.yAxis = valueAxis;
                series.tooltipText = "Thời gian: {dateX.formatDate(\"dd/MM/yyyy\")}" +
                    "\n Giá trị: [bold font-size: 13]{valueY}[/]";


                /*** Min Max Range ***/
                if (min != null) {
                    var min_range = valueAxis.axisRanges.create();
                    min_range.value = min;
                    min_range.grid.stroke = am4core.color("#ff0000");
                    min_range.grid.strokeWidth = 2;
                    min_range.grid.strokeOpacity = 1;
                    min_range.label.inside = true;
                    if (unit == "") {
                        min_range.label.text = "[font-style: italic] Giá trị nhỏ nhất: [font-style: italic]" + min;
                    } else {
                        min_range.label.text = "[font-style: italic] Giá trị nhỏ nhất: " +
                            "[font-style: italic]" + min + " [font-style: italic]" + unit;
                    }
                    min_range.label.fill = min_range.grid.stroke;
                    min_range.label.align = "right";
                    min_range.label.verticalCenter = "bottom";
                    /* min_range.label.dx = 10; */
                    min_range.label.dy = 10;
                }

                if (max != null) {
                    var max_range = valueAxis.axisRanges.create();
                    max_range.value = max;
                    max_range.grid.stroke = am4core.color("#ff0000");
                    max_range.grid.strokeWidth = 2;
                    max_range.grid.strokeOpacity = 1;
                    max_range.label.inside = true;
                    if (unit == "") {
                        max_range.label.text = "[font-style: italic] Giá trị lớn nhất: [font-style: italic]" + max;
                    } else {
                        max_range.label.text = "[font-style: italic] Giá trị lớn nhất: " +
                            "[font-style: italic]" + max + " [font-style: italic]" + unit;
                    }
                    max_range.label.fill = max_range.grid.stroke;
                    max_range.label.align = "right";
                    max_range.label.verticalCenter = "bottom";
                    max_range.label.dy = 10;
                }

                chart.cursor = new am4charts.XYCursor();
                chart.cursor.xAxis = dateAxis;
                chart.cursor.lineY.opacity = 0;
                chart.cursor.snapToSeries = series;

                chart.scrollbarX = new am4core.Scrollbar();
                chart.scrollbarX.parent = chart.bottomAxesContainer;

                chart.exporting.menu = new am4core.ExportMenu();
                chart.exporting.menu.align = "right";
                chart.exporting.menu.verticalAlign = "top";
                chart.exporting.menu.items = [{
                    "label": "<i class='fa fa-bar-chart-o font-size-16' style='padding-top: 6px'>",
                    "menu": [
                        {
                            "label": "<i class='fa fa-file-photo-o font-size-16'>",
                            "menu": [
                                {"type": "png", "label": "PNG"},
                                {"type": "pdf", "label": "PDF"}
                            ]
                        }, {
                            "label": "<i class='fa fa-file-excel-o font-size-16'>",
                            "menu": [
                                {"type": "xlsx", "label": "XLSX"},
                                {"type": "pdfdata", "label": "PDF"}
                            ]
                        }
                    ]
                }];

                chart.invalidateData();
            });
        };
    </script>
</body>

</html>
