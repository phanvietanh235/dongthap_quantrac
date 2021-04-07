<?php
include "../config.php"
?>
<?php
$querry_feat = 'SELECT * FROM feat_ktsd_ndd WHERE idgieng = ' . "'" . $_POST["idgieng"] . "'";
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

/*---- DiemKTSD_NDD Kết cấu giếng khoan ----*/
$content = '<form class="form-horizontal pdd-horizon-10">
        <div class="form-group row list-ctkt">';
$content .= '<label style="margin-top: 7px" class="col-lg-12 control-label">
        <b>Kết cấu giếng khoan</b>
        </label>';
if ($data[0]["ketCauGiengKhoan"] != null) {
    $content .= '<div class="col-lg-12">
            <textarea class="form-control input-sm" disabled>' . $data[0]["ketCauGiengKhoan"] . '</textarea>
            </div>';
} else {
    $content .= '<div class="col-lg-12">
            <input class="form-control input-sm" disabled value="' . $data[0]["ketCauGiengKhoan"] . '"/>' .
        '</div>';
}

/*---- DiemKTSD_NDD Mô tả vùng bảo hộ vệ sinh ----*/
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
$content .= '<div class="col-lg-12" style="margin-top: 7px">
        <a href="services/giamsat-tnn/giamsat-info.php?idpoi=' . $data[0]["idgieng"] . '&type=ktsd_ndd&name=' . $data[0]["soHieuGieng"] .
    '" style="margin-top: 7px; float: left" class="control-label btn btn-xs btn-success" target="_blank">
        <i class="fa fa-table"></i>
        <b>Xem dữ liệu giám sát</b>
        </a>
        <a href="services/ktsd-ndd/form-poi-ktsd-ndd.php?macongtrinh=' . $data[0]["macongtrinh"] . '&idgieng=' . $data[0]["idgieng"] .
    '" style="margin-top: 7px; float: right" class="control-label btn btn-xs btn-info" target="_blank">
        <b>Xem chi tiết</b>
        </a></div>';

$content .= '</div></form>';
echo $content;
?>
