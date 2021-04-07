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

$ngaycapphep = explode("-", $data[0]["ngayCapPhep"]);
$ngaycapphep_new = $ngaycapphep[2] . "/" . $ngaycapphep[1] . "/" . $ngaycapphep[0];

/*---- ThongTinCP_NM ----*/
$content = '<form class="form-horizontal pdd-horizon-10">
        <div class="form-group row list-ctkt">';
$content .= '<label style="margin-top: 7px" class="col-lg-12 control-label">
        <b>Số giấy phép</b>
        </label>';
$content .= '<div class="col-lg-12">
        <input class="form-control input-sm" disabled value="' . $data[0]["soGiayPhepNM"] . '"/>' .
    '</div>';

$content .= '<label style="margin-top: 7px" class="col-lg-12 control-label">
        <b>Loại giấy phép</b>
        </label>';
$content .= '<div class="col-lg-12">
        <input class="form-control input-sm" disabled value="' . $data[0]["LoaiGiayPhep"] . '"/>' .
    '</div>';

$content .= '<label style="margin-top: 7px" class="col-lg-12 control-label">
        <b>Ngày giấy phép</b>
        </label>';
$content .= '<div class="col-lg-12">
        <input class="form-control input-sm date-cus" disabled value="' . $ngaycapphep_new . '"/>' .
    '</div>';

$content .= '<label style="margin-top: 7px" class="col-lg-12 control-label">
        <b>Tình trạng giấy phép</b>
        </label>';
if ($data[0]["tinhTrangGiayPhep"] == 't') {
    $content .= '<div class="col-lg-12">
        <input class="form-control input-sm" disabled value="' . 'Còn hiệu lực' . '"/>' .
        '</div>';
} else {
    $content .= '<div class="col-lg-12">
        <input class="form-control input-sm" disabled value="' . 'Hết hiệu lực' . '"/>' .
        '</div>';
}

/*---- Link đến thông tin chi tiết của điểm ----*/
$content .= '<div class="col-lg-12 text-right" style="margin-top: 7px">
        <a href="services/ktsd-nm/form-gp-nm.php?macongtrinh=' . $data[0]["macongtrinh"] . '&idgp=' . $data[0]["idgp"] .
    '" style="margin-top: 7px; float: right" class="control-label btn btn-xs btn-info" target="_blank">
        <b>Xem chi tiết</b>
        </a></div>';

$content .= '</div></form>';
echo $content;
?>
