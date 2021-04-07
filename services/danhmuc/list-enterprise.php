<?php
include "../config.php"
?>
<?php
header('Content-Type:application/json');
$nguoidaidien = $_POST["nguoidaidien"];
$diahchi = $_POST["diachi"];
$masothue = $_POST["masothue"];

$querry_data = 'SELECT enterprise.*, loaihinhdoanhnghiep.ten "type_doanhnghiep" FROM "Enterprise" enterprise';
$querry_data .= ' LEFT JOIN "LoaiHinhDoanhNghiep" loaihinhdoanhnghiep ON enterprise.type = loaihinhdoanhnghiep.id';
$querry_data .= ' WHERE ';

if ($_POST["tendoanhnghiep"] == "all") {
    $querry_data .= '(1=1) AND ';
} else {
    $querry_data .= '(';
    $enterprise_option = $_POST["tendoanhnghiep"];
    foreach ($enterprise_option as $i => $value) {
        if ($i > 0) {
            $querry_data .= ' OR ';
        }
        $querry_data .= 'enterprise.id = ' . "'" . (int)$value . "' ";
    }
    $querry_data .= ') AND ';
}
$querry_data .= '(enterprise."address" IS NULL OR enterprise."address" ILIKE ' . "'%" . $diahchi . "%'" . ') AND ';
$querry_data .= '(enterprise."agent" IS NULL OR enterprise."address" ILIKE ' . "'%" . $nguoidaidien . "%'" . ') AND ';
$querry_data .= '(enterprise."tin" IS NULL OR enterprise."tin" ILIKE ' . "'%" . $diahchi . "%'" . ')';

// echo $querry_data;
$result = pg_query($tiengiang_db, $querry_data);
if (!$result) {
    echo "Không có dữ liệu.\n";
    exit;
}

/*** Chuyển định dạng từ Array sang Json ***/
$data = array();
while ($row = pg_fetch_assoc($result)) {
    $data[] = $row;
}

$jsonData = json_encode($data);
$original_data = json_decode($jsonData, true);
$option = array();
foreach ($original_data as $key => $value) {
    $option[] = array(
        "madoanhnghiep" => $value['id'],
        "tendoanhnghiep" => $value['name'],
        "masothue" => $value['tin'],
        "loaihinh" => $value['type_doanhnghiep'],
        "accountNumber" => $value['accountNumber'],
        "totalInvestment" => $value['totalInvestment'],
        "profession" => $value['profession'],
        "dienthoai" => $value['phone'],
        "diachi" => $value['address'],
        "tinhtrang" => $value['active'] == 't' ? "Còn hoạt động" : "Không hoạt động",
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
