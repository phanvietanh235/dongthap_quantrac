<?php
include "config.php"
?>
<?php
header('Content-Type: application/json');
/*** Querry lựa chọn Loại hình doanh nghiệp ***/
$querry_option = 'SELECT * FROM "LoaiHinhDoanhNghiep"';
$result = pg_query($tiengiang_db, $querry_option);
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
        'id' => $value['id'],
        'name' => $value['ten'],
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
