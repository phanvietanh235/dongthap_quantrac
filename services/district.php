<?php
include "config.php"
?>
<?php
header('Content-Type: application/json');
/*---- Thông tin Quận/Huyện ----*/
$querry_districts = 'SELECT ma_dvhc, ma_dvhc_cha, "tenDVHC"
                    FROM "District" WHERE ma_dvhc_cha LIKE ' . "'" . '/87/%' . "'";
$result = pg_query($tiengiang_db, $querry_districts);
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
        'id' => $value['ma_dvhc'],
        'name' => $value['tenDVHC'],
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
