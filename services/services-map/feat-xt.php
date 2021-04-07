<?php
include "../config.php"
?>
<?php
$querry_feat = 'SELECT * FROM feat_ktsd_xt WHERE idgieng = ' . "'" . $_POST["idgieng"] . "'";
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

/*---- CT_KTSD ----*/
$content = '<form class="form-horizontal pdd-horizon-10">
        <div class="form-group row list-ctkt">';
$content .= '<label style="margin-top: 7px" class="col-lg-12 control-label">
        <b>Tên công trình</b>
        </label>';
$content .= '<div class="col-lg-12">
        <textarea class="form-control input-sm" rows="2" disabled>' . $data[0]["tenCongTrinh"] . '</textarea>
        </div>';

$content .= '<label style="margin-top: 7px" class="col-lg-12 control-label">
        <b>Địa chỉ công trình</b>
        </label>';
$content .= '<div class="col-lg-12">
        <textarea class="form-control input-sm" disabled>' . $data[0]["diaChiCongTrinh"] . '</textarea>
        </div>';

$content .= '<label style="margin-top: 7px" class="col-lg-12 control-label">
        <b>Cơ sở khai thác</b>
        </label>';
$content .= '<div class="col-lg-12">
        <textarea class="form-control input-sm" disabled>' . $data[0]["coSoKTSD"] . '</textarea>
        </div>';

$content .= '<label style="margin-top: 7px" class="col-lg-12 control-label">
        <b>Năm xây dựng</b>
        </label>';
$content .= '<div class="col-lg-12">
        <input class="form-control input-sm" disabled value="' . $data[0]["namXDVH"] . '"/>' .
    '</div>';

$content .= '<label style="margin-top: 7px" class="col-lg-12 control-label">
        <b>Thời hạn khai thác sử dụng</b>
        </label>';
$content .= '<div class="col-lg-12">
        <input class="form-control input-sm" disabled value="' . $data[0]["thoiHanKTSD"] . '"/>' .
    '</div>';

/*---- Link đến thông tin chi tiết của điểm ----*/
$content .= '<div class="col-lg-12 text-right" style="margin-top: 7px">
        <a href="services/ktsd-xt/ktsd-xt-info.php?macongtrinh=' . $data[0]["macongtrinh"] .
    '" style="margin-top: 7px; float: right" class="control-label btn btn-xs btn-info" target="_blank">
        <b>Xem chi tiết</b>
        </a></div>';

$content .= '</div></form>';
echo $content;
?>
