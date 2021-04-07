<?php
include "../config.php"
?>
<?php
$querry_feat = 'SELECT * FROM feat_qt_nm WHERE idgieng = ' . "'" . $_POST["idgieng"] . "'";
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
        <b>Mã Trạm Cũ</b>
        </label>';
if ($data[0]["ma_tramcu"] != null) {
    $content .= '<div class="col-lg-12">
            <input class="form-control input-sm" disabled value="' . $data[0]["ma_tramcu"] . '"/>' .
        '</div>';
} else {
    $content .= '<div class="col-lg-12">
            <input class="form-control input-sm" disabled value="' . $data[0]["ma_tramcu"] . '"/>' .
        '</div>';
}

/*---- DiemKTSD_NM Nguồn khai thác ----*/
$content .= '<label style="margin-top: 7px" class="col-lg-12 control-label">
        <b>Số Hiệu Điểm QT</b>
        </label>';
if ($data[0]["soHieuDiemQT"] != null) {
    $content .= '<div class="col-lg-12">
            <textarea class="form-control input-sm" disabled>' . $data[0]["soHieuDiemQT"] . '</textarea>
            </div>';
} else {
    $content .= '<div class="col-lg-12">
            <input class="form-control input-sm" disabled value="' . $data[0]["soHieuDiemQT"] . '"/>' .
        '</div>';
}



/*---- Link đến thông tin chi tiết của điểm ----*/
$content .= '<div class="col-lg-12 text-right" style="margin-top: 7px">
        <a href="services/giamsat-tnn/giamsat-info.php?idpoi=' . $data[0]["idgieng"] . '&type=ktsd_nm&name=' . $data[0]["soHieuDiemQT"] .
    '" style="margin-top: 7px; float: left" class="control-label btn btn-xs btn-success" target="_blank">
        <i class="fa fa-table"></i>
        <b>Xem dữ liệu giám sát</b>
        </a>
        <a href="services/qt-nm/form-poi-qt-nm.php?macongtrinh=' . $data[0]["macongtrinh"] . '&iddiem=' . $data[0]["idgieng"] .
    '" style="margin-top: 7px; float: right" class="control-label btn btn-xs btn-info" target="_blank">
        <b>Xem chi tiết</b>
        </a></div>';

$content .= '</div></form>';
echo $content;
?>
