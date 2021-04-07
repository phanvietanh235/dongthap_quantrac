<?php
include "../config.php"
?>
<?php
header('Content-Type:application/json');
$name_loaihinh_dn = $_POST["name_loaihinh_dn"];

$querry_data = 'SELECT * FROM "LoaiHinhDoanhNghiep"';
$querry_data .= ' WHERE ';
$querry_data .= '"ten" IS NULL OR "ten" ILIKE ' . "'%" . $name_loaihinh_dn . "%'";

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
        "ma" => $value['id'],
        "ten" => $value['ten'],
        "mota" => $value['moTa'],
        "cancuphaply" => $value['canCuPhapLy']
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
