<?php
include "../config.php";
?>
<?php
$macongtrinh = $_GET["macongtrinh"];
if (isset($_GET["idgp"])) {
    $querry_gp_ndd = 'SELECT thongtincp_ndd.*, loaigiayphep.name "LoaiGiayPhep", ctktsd."coSoKTSD", 
                         enterprise.name "TenDoanhNghiep", donvicapphep.name "DonViCapPhep" 
                         FROM "ThongTinCP_NDD" thongtincp_ndd
                         LEFT JOIN "CT_KTSD" ctktsd ON thongtincp_ndd.ma_congtrinhktsd = ctktsd.id
                         LEFT JOIN "LoaiGiayPhep" loaigiayphep on thongtincp_ndd.ma_loaigiayphep = loaigiayphep.id
                         LEFT JOIN "Enterprise" enterprise on thongtincp_ndd.ma_doanhnghiep = enterprise.id
                         LEFT JOIN "DonViCapPhep" donvicapphep on thongtincp_ndd.ma_donvicapphep = donvicapphep.id
                         WHERE thongtincp_ndd.ma_congtrinhktsd =' . "'" . $macongtrinh . "'" . "AND thongtincp_ndd.id =" . "'" . $_GET["idgp"] . "'";
    $result_gp_ndd = pg_query($tiengiang_db, $querry_gp_ndd);
    if (!$result_gp_ndd) {
        echo "Không có dữ liệu.\n";
        exit;
    }
    $data_gp_ndd = array();
    while ($row = pg_fetch_assoc($result_gp_ndd)) {
        $data_gp_ndd[] = $row;
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block pdd-vertical-15 pdd-horizon-15">
                                        <h4 class="card-title text-bold">
                                            THÔNG TIN GIẤY PHÉP KHAI THÁC SỬ DỤNG NƯỚC DƯỚI ĐẤT
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- Thêm các attribute cho form để gửi upload File -->
                                                <form action="upload-gp-ndd.php" class="form-horizontal" id="fileinfo" name="fileinfo" enctype="multipart/form-data" method="post">
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Số giấy phép</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            if (isset($_GET['idgp'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="sogiayphep" 
                                                                    value=' . '"' . $data_gp_ndd[0]["soGiayPhepNDD"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="sogiayphep"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Loại giấy phép</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <select class="form-control" id="loaigiayphep">
                                                                <!-- DOM from Database -->
                                                            </select>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Thời hạn cấp phép</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            if (isset($_GET['idgp'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="thoihan_cp" 
                                                                        value=' . '"' . $data_gp_ndd[0]["thoiHanGiayPhep"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="thoihan_cp"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Ngày cấp phép</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            if (isset($_GET['idgp'])) {
                                                                if (is_null($data_gp_ndd[0]["ngayCapPhep"])) {
                                                                    echo '<input type="text" class="form-control input-sm" id="ngaycapphep" 
                                                                            value=' . '"' . '"' . '/>';
                                                                } else {
                                                                    $ngaycapphep = explode("-", $data_gp_ndd[0]["ngayCapPhep"]);
                                                                    $ngaycapphep_new = $ngaycapphep[2] . "/" . $ngaycapphep[1] . "/" . $ngaycapphep[0];
                                                                    echo '<input type="text" class="form-control input-sm" id="ngaycapphep" 
                                                                                value=' . '"' . $ngaycapphep_new . '"' . '/>';
                                                                }
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="ngaycapphep"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Ngày hết hạn</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            if (isset($_GET['idgp'])) {
                                                                if (is_null($data_gp_ndd[0]["ngayHetHan"])) {
                                                                    echo '<input type="text" class="form-control input-sm" id="ngayhethan" 
                                                                            value=' . '"' . '"' . '/>';
                                                                } else {
                                                                    $ngayhethan = explode("-", $data_gp_ndd[0]["ngayHetHan"]);
                                                                    $ngayhethan_new = $ngayhethan[2] . "/" . $ngayhethan[1] . "/" . $ngayhethan[0];
                                                                    echo '<input type="text" class="form-control input-sm" id="ngayhethan" 
                                                                                value=' . '"' . $ngayhethan_new . '"' . '/>';
                                                                }
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="ngayhethan"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Tình trạng giấy phép</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <select class="form-control input-sm" id="tinhtrang_gp">
                                                                <?php
                                                                if ($data_gp_ndd[0]["tinhTrangGiayPhep"] == 't') {
                                                                    echo '<option value="f">Hết hiệu lực</option>
                                                                            <option value="t" selected>Còn hiệu lực</option>';
                                                                } else {
                                                                    echo '<option value="f" selected>Hết hiệu lực</option>
                                                                            <option value="t">Còn hiệu lực</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Doanh nghiệp</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <select class="form-control" id="doanhnghiep" style="width: 100%">
                                                                <!-- DOM from Database -->
                                                            </select>
                                                        </div>
                                                        <?php
                                                        if (isset($_GET['idgp'])) {
                                                            echo '<label style="margin-top: 7px" class="col-md-2 control-label">
                                                                <b>Cơ sở sản xuất</b>
                                                                </label>';
                                                        }
                                                        ?>
                                                        <div class="col-md-4">
                                                            <?php
                                                            if (isset($_GET['idgp'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="coso_sanxuat" 
                                                                    value=' . '"' . $data_gp_ndd[0]["coSoKTSD"] . '"' . '/>';
                                                            } /* else {
                                                                    echo '<input type="text" class="form-control input-sm" id="coso_sanxuat"/>';
                                                                } */
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Đơn vị cấp phép</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <select class="form-control" id="donvi_cp">
                                                                <!-- DOM from Database -->
                                                            </select>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Đơn vị quản lý</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <select class="form-control" id="donvi_ql">
                                                                <!-- DOM from Database -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Tổng lưu lượng khai thác</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            if (isset($_GET['idgp'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="luuluong_kt" 
                                                                        value=' . '"' . $data_gp_ndd[0]["tongLuuLuongKT"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="luuluong_kt"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Phương thức khai thác</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            if (isset($_GET['idgp'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="phuongthuc_kt" 
                                                                        value=' . '"' . $data_gp_ndd[0]["phuongThucKT"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="phuongthuc_kt"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Phạm vi cấp nước</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            if (isset($_GET['idgp'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="phamvi_capnuoc" 
                                                                        value=' . '"' . $data_gp_ndd[0]["phamViCapNuoc"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="phamvi_capnuoc"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Số lượng GK được đầu tư</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            if (isset($_GET['idgp'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="soluong_gieng" 
                                                                        value=' . '"' . $data_gp_ndd[0]["soLuongGKDuocPhepDauTu"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="soluong_gieng"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Số quyết định vùng BHVS</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            if (isset($_GET['idgp'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="soqd_bhvs" 
                                                                            value=' . '"' . $data_gp_ndd[0]["quyetDinhVungBHVS"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="soqd_bhvs"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Ngày ban hành BHVS</b>
                                                        </label>
                                                        <div class="col-md-2">
                                                            <?php
                                                            if (isset($_GET['idgp'])) {
                                                                if (is_null($data_gp_ndd[0]["ngayBanHanhQDVungBHVS"])) {
                                                                    echo '<input type="text" class="form-control input-sm" id="ngaybanhanh" 
                                                                            value=' . '"' . '"' . '/>';
                                                                } else {
                                                                    $ngaybanhanh = explode("-", $data_gp_ndd[0]["ngayBanHanhQDVungBHVS"]);
                                                                    $ngaybanhanh_new = $ngaybanhanh[2] . "/" . $ngaybanhanh[1] . "/" . $ngaybanhanh[0];
                                                                    echo '<input type="text" class="form-control input-sm" id="ngaybanhanh" 
                                                                            value=' . '"' . $ngaybanhanh_new . '"' . '/>';
                                                                }
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="ngaybanhanh"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Ghi chú</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <?php
                                                            if (isset($_GET['idgp'])) {
                                                                echo '<input type="text" class="form-control input-sm" id="ghichu" 
                                                                        value=' . '"' . $data_gp_ndd[0]["ghiChu"] . '"' . '/>';
                                                            } else {
                                                                echo '<input type="text" class="form-control input-sm" id="ghichu"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row list-ctkt">
                                                        <label style="margin-top: 7px" class="col-md-2 control-label">
                                                            <b>Bản số giấy phép</b>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <input type="file" name="uploaded_qp_ndd" style="margin-top: 3px; width: 165px">
                                                            <input type="submit" value="" id="hidden-submit-gp" hidden/>
                                                            <?php
                                                            /*---- Khi có idgq thì cần tạo 1 input ẩn để lưu input nhằm upload file----*/
                                                            if (isset($_GET['idgp'])) {
                                                                if (isset(explode("/", $data_gp_ndd[0]['taiLieuDinhKem'])[9])) {
                                                                    $filename = explode("/", $data_gp_ndd[0]['taiLieuDinhKem'])[9];
                                                                } else {
                                                                    $filename = explode("/", $data_gp_ndd[0]['taiLieuDinhKem'])[8];
                                                                }

                                                                echo '<input type="hidden" id="id_gp" name="id_gp" value="' . $_GET['idgp'] . '">
                                                                            <span class="text-info" id="gp_ndd_file">' . $filename . '</span>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="col-md-6" style="margin-left: -55px">
                                                            <?php
                                                            if (isset($_GET['idgp'])) {
                                                                echo '<a id="modal-gp-ndd" class="btn-xs btn btn-info btn-sm" style="cursor: pointer"
                                                                            data-target="#modal-gp" data-toggle="modal">
                                                                            <i class="fa fa-eye pdd-right-5 font-size-12 text-white"></i>
                                                                            <span class="text-bold text-white font-size-10">Xem file</span>
                                                                        </a>';
                                                            }
                                                            ?>
                                                            <!-- <a class="btn-xs btn-outline-success" style="cursor: pointer"
                                                                    data-target="#modal-gp" data-toggle="modal">
                                                                <i class="ti-import pdd-right-5 font-size-12"></i>
                                                                <span class="text-bold font-size-10">Tải về</span>
                                                            </a> -->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="list-ctkt text-right">
                                                    <a href="#" class="btn btn-success btn-sm" id="save_gp_ndd">
                                                        <i class="ti-save-alt pdd-right-5"></i>
                                                        <span>Lưu thông tin</span>
                                                    </a>
                                                    <?php
                                                    echo '<a href=' . '"ktsd-ndd-info.php?macongtrinh=' . $macongtrinh . '"'
                                                        . ' class="btn btn-info btn-sm">
                                                                <i class="ti-save-alt pdd-right-5"></i><span>Quay lại</span></a>';
                                                    ?>
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
    <script>
        $("#modal-gp-ndd").click(function() {
            <?php
            if (isset($_GET['idgp'])) {
                echo "PDFObject.embed(" . "'" . $data_gp_ndd[0]['taiLieuDinhKem'] . "'," .
                    '"#pdf_preview", {height: "45rem"});
                         $("#modal-gp").show();';
            } else {
                echo "console.log('Không có mã giấy phép')";
            }
            ?>
        })
    </script>
    <script>
        /*** DOM option Loại giấy phép ***/
        $.getJSON("../loaigiayphep.php", function(loaigiayphep) {
            /* $('#loaigiayphep')
                .append($("<option></option>")
                    .attr('value', 'none').text("--Loại giấy phép--")); */
            $.each(loaigiayphep, function(key, value) {
                /*** Đánh dấu Option Loại giấy phép được chọn ***/
                <?php
                if (isset($_GET['idgp'])) {
                    echo 'if (value.id == ' . $data_gp_ndd[0]["ma_loaigiayphep"] . ') {
                            $("#loaigiayphep")
                                .append($("<option></option>")
                                    .attr("value", value.id).attr("selected", "selected").text(value.name));
                        } else {
                            $("#loaigiayphep")
                                .append($("<option></option>")
                                    .attr("value", value.id).text(value.name));
                        }';
                } else {
                    echo '$("#loaigiayphep")
                            .append($("<option></option>")
                                .attr("value", value.id).text(value.name));';
                }
                ?>
            });
        })

        /*** Dom Option Doanh nghiệp ***/
        $("#doanhnghiep").select2({
            ajax: {
                url: "../doanhnghiep.php",
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
            placeholder: "--Lựa chọn Doanh nghiệp--",
            allowClear: true,
            width: "resolve",
            language: {
                searching: function() {
                    return "Đang tìm ...";
                }
            },
        });
        /*** Tìm Doanh nghiệp để gắn selected ***/
        <?php
        if (isset($_GET['idgp'])) {
            $querry_option = 'SELECT * FROM "Enterprise"'
                . ' WHERE id=' . $data_gp_ndd[0]["ma_doanhnghiep"];
            $result = pg_query($tiengiang_db, $querry_option);
            if (!$result) {
                echo "Không có dữ liệu";
            }

            $quanhuyen_selected = [];
            while ($row = pg_fetch_assoc($result)) {
                $quanhuyen_selected[] = array(
                    "id" => $row['id'],
                    "text" => $row['name']
                );
            }

            echo '$("#doanhnghiep").select2("trigger", "select", {
                        data: ' .
                '{ id:' . $quanhuyen_selected[0]["id"] . ',' .
                'text:' . "'" . $quanhuyen_selected[0]["text"] . "'" .
                ',}' . '});';
        }
        ?>

        /*** DOM Option Đơn vị cấp phép ***/
        $.getJSON("../donvicapphep.php", function(donvi_cp) {
            /* $('#donvi_cp')
                .append($("<option></option>")
                    .attr('value', 'none').text("--Lựa chọn đơn vị cấp phép--")); */
            $.each(donvi_cp, function(key, value) {
                /*** Đánh dấu Option Đơn vị cấp phép được chọn ***/
                <?php
                if (isset($_GET['idgp'])) {
                    echo 'if (value.id == ' . $data_gp_ndd[0]["ma_donvicapphep"] . ') {
                            $("#donvi_cp")
                                .append($("<option></option>")
                                    .attr("value", value.id).attr("selected", "selected").text(value.name));
                        } else {
                            $("#donvi_cp")
                                .append($("<option></option>")
                                    .attr("value", value.id).text(value.name));
                        }';
                } else {
                    echo '$("#donvi_cp")
                            .append($("<option></option>")
                                .attr("value", value.id).text(value.name));';
                }
                ?>
            });
        })

        /*** DOM Option Đơn vị quản lý ***/
        $.getJSON("../donviquanly.php", function(donvi_ql) {
            /* $('#donvi_ql')
                .append($("<option></option>")
                    .attr('value', 'none').text("--Lựa chọn đơn vị đơn vị--")); */
            $.each(donvi_ql, function(key, value) {
                /*** Đánh dấu Option Đơn vị cấp phép được chọn ***/
                <?php
                if (isset($_GET['idgp'])) {
                    echo 'if (value.id == ' . $data_gp_ndd[0]["ma_donviquanly"] . ') {
                            $("#donvi_ql")
                                .append($("<option></option>")
                                    .attr("value", value.id).attr("selected", "selected").text(value.name));
                            } else {
                                $("#donvi_ql")
                                    .append($("<option></option>")
                                        .attr("value", value.id).text(value.name));
                            }';
                } else {
                    echo '$("#donvi_ql")
                            .append($("<option></option>")
                                .attr("value", value.id).text(value.name));';
                }
                ?>
            });
        })
    </script>
    <script>
        $('#ngaycapphep').datepicker({
            language: "vi",
            format: "dd/mm/yyyy"
        });
        $('#ngayhethan').datepicker({
            language: "vi",
            format: "dd/mm/yyyy"
        });
        $('#ngaybanhanh').datepicker({
            language: "vi",
            format: "dd/mm/yyyy"
        });

        /*** Get Name file ***/
        <?php
        if (isset($_GET['idgp'])) {
            echo '$("input[name=' . "'" . "uploaded_qp_ndd" . "'" . ']").change(function(){
                    $("#gp_ndd_file").hide();
                    $("#modal-gp-ndd").hide();
                    });';
        }
        ?>

        $("#save_gp_ndd").click(function() {
            var sogiayphep = $("#sogiayphep").val();
            var loaigiayphep = $("#loaigiayphep").val();
            var thoihan_cp = $("#thoihan_cp").val();
            var ngaycapphep = $("#ngaycapphep").val();
            var ngayhethan = $("#ngayhethan").val();
            var tinhtrang_gp = $("#tinhtrang_gp").val();
            var doanhnghiep = $("#doanhnghiep").val();
            var coso_sanxuat = $("#coso_sanxuat").val();
            var donvi_cp = $("#donvi_cp").val();

            var donvi_ql = $("#donvi_ql").val();
            var luuluong_kt = $("#luuluong_kt").val();
            var phuongthuc_kt = $("#phuongthuc_kt").val();
            var phamvi_capnuoc = $("#phamvi_capnuoc").val();
            var soluong_gieng = $("#soluong_gieng").val();
            var soqd_bhvs = $("#soqd_bhvs").val();
            var ngaybanhanh = $("#ngaybanhanh").val();
            var ghichu = $("#ghichu").val();

            var fileName = $("input[name='uploaded_qp_ndd']").val().split('/').pop().split('\\').pop();
            var tailieudinhkem = tailieudinhkem_host + "services/ktsd-ndd/upload-files/" +
                <?php
                if (isset($_GET['idgp'])) {
                    echo $_GET['idgp'] . '+ "/" + fileName;';
                } else {
                    $cur_count_select = pg_query($tiengiang_db, 'SELECT id FROM "ThongTinCP_NDD" ORDER BY id DESC LIMIT 1');
                    $cur_arr = array();
                    while ($row = pg_fetch_assoc($cur_count_select)) {
                        $cur_arr[] = $row;
                    }
                    /*** Lấy giá trị cur = ID ***/
                    $cur_count = $cur_arr[0]['id'] + 2;
                    echo $cur_count . ' + "/" + fileName;';
                }
                ?>

            /*---- Update CSDL ----*/
            var response_post = $.post("save-gp-ndd.php", {
                <?php
                if (isset($_GET['idgp'])) {
                    /*** Update ThongtinCP_NDD ***/
                    echo 'id_gp:' . $_GET['idgp'] . ', ' .
                        'macongtrinh:' . $macongtrinh . ', ';
                } else {
                    /*** Insert ThongtinCP_NDD ***/
                    echo 'macongtrinh:' . $macongtrinh . ', ';
                }
                ?> "sogiayphep": sogiayphep,
                "loaigiayphep": loaigiayphep,
                "thoihan_cp": thoihan_cp,
                "ngaycapphep": ngaycapphep,
                "ngayhethan": ngayhethan,
                "tinhtrang_gp": tinhtrang_gp,
                "doanhnghiep": doanhnghiep,
                "luuluong_kt": luuluong_kt,
                "phuongthuc_kt": phuongthuc_kt,
                "phamvi_capnuoc": phamvi_capnuoc,
                "soluong_gieng": soluong_gieng == "" ? 'NULL' : soluong_gieng,
                "soqd_bhvs": soqd_bhvs,
                "ngaybanhanh": ngaybanhanh,
                "ghichu": ghichu,
                "donvi_ql": donvi_ql,
                "tailieudinhkem": tailieudinhkem,
                /*** Update CT_KTSD ***/
                "coso_sanxuat": coso_sanxuat,
                "donvi_cp": donvi_cp,
            }).done(function(data) {
                if (data == "error") {
                    alert("Lỗi cập nhật dữ liệu")
                } else {
                    alert("Cập nhật thành công!")
                    location.reload();
                }
            })

            /*---- Upload File ----*/
            $("#hidden-submit-gp").trigger('click');
        })
    </script>
</body>

</html>
