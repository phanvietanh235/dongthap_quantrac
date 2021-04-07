<?php
include "config.php"
?>
<?php
header('Content-Type: application/json');
$querry_option = 'SELECT * FROM "Basin"';
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
/*** Push Sum ***/
$tong_toanbo = 0;
$tong_huuich = 0;
foreach ($original_data as $key => $value) {
    $tong_toanbo += $value['capacity'];
    $tong_huuich += $value['netcapacity'];
}

$option[] = array(
    'name' => 'Tổng',
    'toanbo' => $tong_toanbo,
    'huuich' => $tong_huuich
);
foreach ($original_data as $key => $value) {
    $option[] = array(
        'name' => $value['name'],
        'toanbo' => is_null($value['capacity']) == true ? 0 : $value['capacity'],
        'huuich' => is_null($value['netcapacity']) == true ? 0 : $value['netcapacity']
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
