<?php
include "../config.php"
?>
<?php
$querry_feat = 'SELECT * FROM feat_ktsd_nm WHERE idgieng = ' . "'" . $_POST["idgieng"] . "'";
$result = pg_query($tiengiang_db, $querry_feat);
if (!$result) {
    echo "Không có dữ liệu.\n";
    exit;
}

/*** Chuyển định dạng từ Array sang Json ***/
$data = array();
while ($row = pg_fetch_assoc($result)) {
    $data[] = $row;
}

/*---- DiemKTSD_NM Lưu lượng KTLN Mùa khô ----*/
$content = '<form class="form-horizontal pdd-horizon-10">
        <div class="form-group row list-ctkt">';
$content .= '<label style="margin-top: 7px" class="col-lg-12 control-label">
        <b>Lưu lượng khai thác lớn nhất Mùa khô</b>
        </label>';
if ($data[0]["luuLuongKTLNMuaKho"] != null) {
    $content .= '<div class="col-lg-12">
            <input class="form-control input-sm" disabled value="' . $data[0]["luuLuongKTLNMuaKho"] . '"/>' .
        '</div>';
} else {
    $content .= '<div class="col-lg-12">
            <input class="form-control input-sm" disabled value="' . $data[0]["luuLuongKTLNMuaKho"] . '"/>' .
        '</div>';
}

/*---- DiemKTSD_NM Nguồn khai thác ----*/
$content .= '<label style="margin-top: 7px" class="col-lg-12 control-label">
        <b>Nguồn khai thác</b>
        </label>';
if ($data[0]["nguonKhaiThac"] != null) {
    $content .= '<div class="col-lg-12">
            <textarea class="form-control input-sm" disabled>' . $data[0]["nguonKhaiThac"] . '</textarea>
            </div>';
} else {
    $content .= '<div class="col-lg-12">
            <input class="form-control input-sm" disabled value="' . $data[0]["nguonKhaiThac"] . '"/>' .
        '</div>';
}

/*---- DiemKTSD_NM Phương thức khai thác ----*/
$content .= '<label style="margin-top: 7px" class="col-lg-12 control-label">
        <b>Phương thức khai thác</b>
        </label>';
if ($data[0]["phuongThucKT"] != null) {
    $content .= '<div class="col-lg-12">
            <textarea class="form-control input-sm" disabled>' . $data[0]["phuongThucKT"] . '</textarea>
            </div>';
} else {
    $content .= '<div class="col-lg-12">
            <input class="form-control input-sm" disabled value="' . $data[0]["phuongThucKT"] . '"/>' .
        '</div>';
}

/*---- DiemKTSD_NM Phương thức xả thải ----*/
$content .= '<label style="margin-top: 7px" class="col-lg-12 control-label">
        <b>Mô tả vùng bảo hộ vệ sinh</b>
        </label>';
if ($data[0]["moTaVungBHVS"] != null) {
    $content .= '<div class="col-lg-12">
            <textarea class="form-control input-sm" disabled>' . $data[0]["moTaVungBHVS"] . '</textarea>
            </div>';
} else {
    $content .= '<div class="col-lg-12">
            <input class="form-control input-sm" disabled value="' . $data[0]["moTaVungBHVS"] . '"/>' .
        '</div>';
}

/*---- Link đến thông tin chi tiết của điểm ----*/
$content .= '<div class="col-lg-12 text-right" style="margin-top: 7px">
        <a href="services/giamsat-tnn/giamsat-info.php?idpoi=' . $data[0]["idgieng"] . '&type=ktsd_nm&name=' . $data[0]["soHieuDiem"] .
    '" style="margin-top: 7px; float: left" class="control-label btn btn-xs btn-success" target="_blank">
        <i class="fa fa-table"></i>
        <b>Xem dữ liệu giám sát</b>
        </a>
        <a href="services/ktsd-nm/form-poi-ktsd-nm.php?macongtrinh=' . $data[0]["macongtrinh"] . '&iddiem=' . $data[0]["idgieng"] .
    '" style="margin-top: 7px; float: right" class="control-label btn btn-xs btn-info" target="_blank">
        <b>Xem chi tiết</b>
        </a></div>';

$content .= '</div></form>';
echo $content;
?>
